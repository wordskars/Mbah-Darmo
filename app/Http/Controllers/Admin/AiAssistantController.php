<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiAssistantController extends Controller
{
    // ─────────────────────────────────────────────────────────────────────────
    // INDEX
    // ─────────────────────────────────────────────────────────────────────────
    public function index()
    {
        [$top5, $bottom5] = $this->getSalesData();

        $hasTemplate = file_exists(storage_path('app/public/templates/active_template.jpg'));
        $templateUrl = $hasTemplate ? asset('storage/templates/active_template.jpg') : null;

        $lastPromos = Promotion::where('source', 'ai_generated')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.ai-assistant.index', compact(
            'top5', 'bottom5', 'lastPromos', 'hasTemplate', 'templateUrl'
        ));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // UPLOAD TEMPLATE BACKGROUND
    // ─────────────────────────────────────────────────────────────────────────
    public function uploadTemplate(Request $request)
    {
        $request->validate([
            'template' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $targetDir = storage_path('app/public/templates');
        if (! file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $request->file('template')->move($targetDir, 'active_template.jpg');

        return redirect()->route('admin.ai-assistant.index')
            ->with('success', 'Template background berhasil diperbarui!');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // GENERATE — AJAX endpoint
    // ─────────────────────────────────────────────────────────────────────────
    public function generate(Request $request)
    {
        @set_time_limit(180);
        @ini_set('max_execution_time', '180');

        [, $bottom5] = $this->getSalesData();

        // Produk yang dipilih via checkbox (fallback ke semua bottom 5 jika kosong)
        $selectedNames = $request->input('selected_products', []);

        $bottom5List = $bottom5->take(5)->map(fn ($item) => [
            'name' => $item->name,
            'price' => 'Rp '.number_format($item->price ?? 0, 0, ',', '.'),
        ])->values()->toArray();

        // Filter sesuai pilihan user
        $selectedProducts = empty($selectedNames)
            ? $bottom5List
            : array_values(array_filter($bottom5List, fn ($p) => in_array($p['name'], $selectedNames)));

        if (empty($selectedProducts)) {
            $selectedProducts = $bottom5List;
        }

        // ── Tema & layout acak ────────────────────────────────────────────
        $strategies = [
            'Flash Sale 24 Jam', 'Promo Bundling Hemat', 'Diskon Gajian',
            'Weekend Special', 'Buy 1 Get 1', 'Happy Hour Siang',
            'Promo Tanggal Kembar', 'Combo Berkah', 'Promo Spesial Pelanggan Setia',
            'Midnight Deal', 'Promo Sahabat', 'Paket Hemat Keluarga',
        ];
        $randomStrategy = $strategies[array_rand($strategies)];

        $layouts = [
            'anti-gravity floating products with zero-gravity levitation effect, items floating at different heights with soft shadows beneath',
            'products arranged in a dynamic diagonal composition from bottom-left to top-right, floating mid-air',
            'products in a circular/oval arrangement floating around a central promo banner',
            'asymmetric layout: largest product hero on left, 4 smaller items scattered on right, all floating',
            'products in a clean grid formation floating at different Z-depths creating a 3D depth effect',
            'products dramatically levitating upward with motion blur trails, cinematic feel',
            'products arranged like an explosion outward from the center, radiating energy',
        ];
        $randomLayout = $layouts[array_rand($layouts)];

        $lightings = [
            'dramatic soft cinematic studio lighting with warm golden highlights',
            'cool neon-accent studio lighting with bright rim lights',
            'soft diffused overhead lighting like a luxury restaurant',
            'high-contrast dramatic side lighting for bold product pop',
            'warm morning golden hour feel, bright and appetizing',
        ];
        $randomLighting = $lightings[array_rand($lightings)];

        // ── Groq → text strategy ──────────────────────────────────────────
        $groqKey = env('GROQ_API_KEY');
        $groqModel = env('GROQ_MODEL', 'openai/gpt-oss-20b');

        $productListForText = implode(', ', array_map(fn ($p) => "{$p['name']} ({$p['price']})", $selectedProducts));
        $customPrompt = trim($request->input('custom_prompt', ''));
        $extraInstruction = $customPrompt ? "\nTambahan instruksi: {$customPrompt}" : '';

        // Random seed buat variasi tiap generate
        $seeds = ['kreatif', 'unik', 'menggugah', 'inovatif', 'segar', 'menarik', 'bold', 'memukau'];
        $seed = $seeds[array_rand($seeds)];

        $strategyPrompt = <<<PROMPT
Kamu adalah Marketing Strategist profesional untuk Warung Mbah Darmo, warung makan heritage Jawa di Yogyakarta.
Tugas: buat strategi promo bertema "{$randomStrategy}" yang {$seed} untuk produk berikut: {$productListForText}.{$extraInstruction}

Tulis strategi dengan format WAJIB:
JUDUL: [judul promo catchy, 3-7 kata]
STRATEGI: [deskripsi eksekusi singkat 2-3 kalimat, berbeda dari biasanya]
COPYWRITING: [narasi promo yang emosional dan menggugah selera, 2-3 kalimat]
CTA: [call-to-action kuat, 1 kalimat]

Tulis dalam Bahasa Indonesia yang hangat, autentik, dan sesuai nuansa heritage Warung Mbah Darmo. Jangan gunakan format markdown.
PROMPT;

        $strategyText = '';
        $lastError = null;

        if (! empty($groqKey)) {
            try {
                $groqRes = Http::withoutVerifying()
                    ->timeout(30)
                    ->withHeaders([
                        'Authorization' => "Bearer {$groqKey}",
                        'Content-Type' => 'application/json',
                    ])
                    ->post('https://api.groq.com/openai/v1/chat/completions', [
                        'model' => $groqModel,
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a creative marketing strategist for Warung Mbah Darmo. Always respond in Indonesian. Be creative and vary each response.'],
                            ['role' => 'user',   'content' => $strategyPrompt],
                        ],
                        'temperature' => 0.95,
                        'max_tokens' => 400,
                    ]);

                if ($groqRes->successful()) {
                    $strategyText = $groqRes->json('choices.0.message.content') ?? '';
                } else {
                    $lastError = 'Groq error ('.$groqRes->status().')';
                    Log::warning('Groq: '.$lastError.' — '.$groqRes->body());
                }
            } catch (\Exception $e) {
                $lastError = $e->getMessage();
                Log::warning('Groq exception: '.$lastError);
            }
        }

        // Fallback strategy text
        if (empty($strategyText)) {
            $strategyText = "JUDUL: {$randomStrategy} Warung Mbah Darmo\n"
                ."STRATEGI: Tawarkan bundling eksklusif untuk produk pilihan dengan harga spesial terbatas.\n"
                ."COPYWRITING: Nikmati cita rasa autentik heritage Jawa dengan penawaran terbaik hari ini!\n"
                .'CTA: Pesan sekarang sebelum kehabisan — stok terbatas!';
        }

        // Ekstrak judul dari teks strategi
        $judulMatch = [];
        preg_match('/JUDUL:\s*(.+)/i', $strategyText, $judulMatch);
        $judulPromo = trim($judulMatch[1] ?? "{$randomStrategy} Warung Mbah Darmo");

        // ── Build image prompt → Wavespeed ────────────────────────────────
        $productNamesForImage = implode(', ', array_map(fn ($p) => $p['name'], $selectedProducts));
        $count = count($selectedProducts);
        $plural = $count > 1 ? "{$count} Indonesian food dishes" : 'an Indonesian food dish';

        $imagePrompt = "Professional commercial promotional poster for 'Warung Mbah Darmo' Indonesian heritage restaurant. "
            ."Featuring {$plural}: {$productNamesForImage}. "
            ."Visual style: {$randomLayout}. "
            .'MANDATORY BACKGROUND: solid CRIMSON RED (#DC143C) studio background, rich and vibrant. '
            ."MANDATORY LOGO: white calligraphy text 'Warung Mbah Darmo' with traditional Javanese ornament border, positioned PROMINENTLY in TOP-LEFT CORNER, clean and legible. "
            ."Each food item is beautifully plated, {$randomLighting}. "
            ."Bold white promo headline '{$judulPromo}' centered in the poster with high contrast. "
            .'Price tags floating near each product. '
            .'8K resolution, ultra-detailed, professional commercial food photography style, high-end advertising design, vibrant and appetizing.';

        // ── Wavespeed AI → generate image ────────────────────────────────
        $wavespeedKey = env('WAVESPEED_API_KEY');
        $bannerUrl = null;

        if (! empty($wavespeedKey)) {
            try {
                $wsRes = Http::retry(2, 1500)
                    ->withoutVerifying()
                    ->timeout(60)
                    ->withHeaders([
                        'Authorization' => "Bearer {$wavespeedKey}",
                        'Content-Type' => 'application/json',
                    ])
                    ->post('https://api.wavespeed.ai/api/v3/wavespeed-ai/z-image/turbo', [
                        'prompt' => $imagePrompt,
                        'width' => 1024,
                        'height' => 1024,
                        'num_images' => 1,
                        'guidance_scale' => 3.5,
                    ]);

                if ($wsRes->successful()) {
                    $wsData = $wsRes->json();
                    $imageUrl = $wsData['data']['outputs'][0]
                        ?? $wsData['data']['images'][0]
                        ?? null;

                    // Async polling
                    if (empty($imageUrl) && ! empty($wsData['data']['id'])) {
                        $pollUrl = "https://api.wavespeed.ai/api/v3/predictions/{$wsData['data']['id']}/result";
                        for ($i = 0; $i < 25; $i++) {
                            sleep(3);
                            $poll = Http::withoutVerifying()->timeout(30)
                                ->withHeaders(['Authorization' => "Bearer {$wavespeedKey}"])
                                ->get($pollUrl);
                            $status = $poll->json('data.status') ?? '';
                            if (in_array($status, ['completed', 'succeeded'])) {
                                $imageUrl = $poll->json('data.outputs.0') ?? $poll->json('data.images.0');
                                break;
                            }
                            if (in_array($status, ['failed', 'error', 'cancelled'])) {
                                Log::error("Wavespeed {$status}: ".$poll->body());
                                break;
                            }
                        }
                    }

                    // Download & simpan lokal
                    if (! empty($imageUrl)) {
                        $bannerDir = storage_path('app/public/banners');
                        if (! file_exists($bannerDir)) {
                            mkdir($bannerDir, 0755, true);
                        }
                        $fileName = 'banner_'.time().'_'.rand(1000, 9999).'.jpg';
                        $imgContents = Http::withoutVerifying()->timeout(60)->get($imageUrl)->body();
                        if (! empty($imgContents)) {
                            file_put_contents($bannerDir.'/'.$fileName, $imgContents);
                            $bannerUrl = asset('storage/banners/'.$fileName);
                        }
                    } else {
                        Log::error('Wavespeed: No image URL in response. Body: '.$wsRes->body());
                    }
                } else {
                    Log::error('Wavespeed Error ('.$wsRes->status().'): '.$wsRes->body());
                }
            } catch (\Exception $e) {
                Log::error('Wavespeed Exception: '.$e->getMessage());
            }
        }

        // ── Auto-save ke history (Promotions) ────────────────────────────
        $promotion = Promotion::create([
            'title' => $judulPromo,
            'description' => substr(strip_tags($strategyText), 0, 500),
            'ai_strategy_text' => $strategyText,
            'discount_type' => 'bundling',
            'banner_image' => $bannerUrl,
            'source' => 'ai_generated',
            'is_active' => false,
            'valid_until' => now()->addDays(7),
        ]);

        // ── Response ──────────────────────────────────────────────────────
        return response()->json([
            'status' => 'success',
            'promotion_id' => $promotion->id,
            'judul_promo' => $judulPromo,
            'strategy_text' => $strategyText,
            'banner_url' => $bannerUrl ?? asset('images/logo-transparent.png'),
            'selected_products' => $selectedProducts,
            'strategy_type' => $randomStrategy,
            'created_at' => $promotion->created_at->format('d M Y, H:i'),
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PUBLISH (aktifkan promo)
    // ─────────────────────────────────────────────────────────────────────────
    public function publish(Request $request)
    {
        $validated = $request->validate([
            'promotion_id' => 'required|exists:promotions,id',
        ]);

        Promotion::where('id', $validated['promotion_id'])->update(['is_active' => true]);

        return response()->json(['status' => 'success', 'message' => 'Promo berhasil dipublikasikan!']);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PRIVATE: Ambil data penjualan + harga
    // ─────────────────────────────────────────────────────────────────────────
    private function getSalesData(): array
    {
        $allSales = DB::table('sales_transactions')
            ->join('menus', 'menus.id', '=', 'sales_transactions.menu_id')
            ->select(
                'menus.name',
                'menus.price',
                DB::raw('SUM(sales_transactions.quantity_sold) as total_sold')
            )
            ->where('sales_transactions.transaction_date', '>=', now()->subDays(30))
            ->groupBy('menus.id', 'menus.name', 'menus.price')
            ->orderByDesc('total_sold')
            ->get();

        $top5 = $allSales->take(5);
        $bottom5 = $allSales->reverse()->take(5)->values();

        return [$top5, $bottom5];
    }
}
