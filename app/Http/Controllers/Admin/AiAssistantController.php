<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesTransaction;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiAssistantController extends Controller
{
    public function index()
    {
        [$top5, $bottom5] = $this->getSalesData();
        $lastPromos = Promotion::where('source', 'ai_generated')->latest()->take(5)->get();

        return view('admin.ai-assistant.index', compact('top5', 'bottom5', 'lastPromos'));
    }

    public function generate(Request $request)
    {
        // Berikan waktu eksekusi skrip hingga 120 detik khusus proses AI
        @set_time_limit(120);
        @ini_set('max_execution_time', '120');

        [$top5, $bottom5] = $this->getSalesData();

        if ($top5->isEmpty() && $bottom5->isEmpty()) {
            return back()->with('error', 'Belum ada data transaksi penjualan untuk dianalisis.');
        }

        $top5Text    = $top5->map(fn($m) => "- {$m->name} ({$m->total_sold} terjual)")->join("\n");
        $bottom5Text = $bottom5->map(fn($m) => "- {$m->name} ({$m->total_sold} terjual)")->join("\n");

        $apiKey = config('services.gemini.api_key');
        $rawModel = config('services.gemini.model', 'gemini-1.5-flash-latest');
        $configuredModel = preg_replace('#^models/#', '', trim((string) $rawModel)) ?: 'gemini-1.5-flash-latest';

        if (empty($apiKey)) {
            return back()->with('error', 'API Key Gemini belum dikonfigurasi. Pastikan GEMINI_API_KEY telah diisi di file .env');
        }

        $customPrompt = trim($request->input('custom_prompt', ''));
        $userInstruction = '';
        if (!empty($customPrompt)) {
            $userInstruction = "\n\n**INSTRUKSI KHUSUS DARI ADMIN / PERTANYAAN LANJUTAN:**\n" . $customPrompt . "\nPastikan strategi yang dibuat mengakomodasi dan memprioritaskan instruksi khusus di atas.";
        }

        $systemGuardrail = <<<GUARDRAIL
Kamu adalah Asisten Khusus Warung Mbah Darmo, sebuah warung makan heritage Jawa di Yogyakarta yang terkenal dengan Mie Gepeng Batok Arang dan konsep kuliner tradisional otentik.
Kamu HANYA BOLEH menjawab pertanyaan terkait strategi promosi, menu makanan, resep/heritage, analisis data penjualan, dan operasional Warung Mbah Darmo.
Jika pengguna bertanya di luar topik Warung Mbah Darmo (seperti matematika umum, berita, coding luar, sains acak, atau percakapan umum yang tidak relevan), tolak secara sopan dan ingatkan pengguna bahwa kamu hanya melayani konsultasi bisnis dan strategi Warung Mbah Darmo.
GUARDRAIL;

        $prompt = <<<PROMPT
{$systemGuardrail}

Berdasarkan data penjualan 30 hari terakhir Warung Mbah Darmo:

**TOP 5 PRODUK TERLARIS:**
{$top5Text}

**BOTTOM 5 PRODUK KURANG LAKU (PERLU PROMO):**
{$bottom5Text}
{$userInstruction}

Tugas Anda:
1. Buatkan minimal 3 usulan paket bundling kreatif (Buy 1 Get 1, Combo Berkah, dll) antara produk terlaris dan produk kurang laku
2. Berikan narasi/copywriting promosi yang menggugah selera untuk setiap bundling
3. Usulkan strategi diskon silang (cross-discount)
4. Rekomendasi jadwal/waktu tayang promosi terbaik (hari kerja, weekend, jam makan siang/malam)
5. Tagline promosi khas Bahasa Indonesia yang catchy dan sesuai nuansa heritage Warung Mbah Darmo.

Format output dalam Bahasa Indonesia yang profesional, hangat, terstruktur rapi dengan heading dan bullet points.
PROMPT;

        // Generate Promo Image URL via Pollinations.ai (Flux model, Free, No API key)
        $topItemName = $top5->first()->name ?? 'Mie Gepeng Batok Arang';
        $bottomItemName = $bottom5->first()->name ?? 'Wedang Uwuh Heritage';
        $imagePrompt = "Traditional Indonesian heritage culinary advertisement promo for Warung Mbah Darmo, featuring {$topItemName} and {$bottomItemName}, authentic Javanese wood table, glowing charcoal batok bowl, warm restaurant atmosphere, high end commercial food photography, 8k resolution, cinematic lighting, appetizing presentation";
        $formattedPrompt = urlencode($imagePrompt);
        $promoImageUrl = "https://pollinations.ai/p/{$formattedPrompt}?width=800&height=600&nologo=true&model=flux";

        $candidateModels = array_unique([$configuredModel, 'gemini-flash-latest', 'gemini-3.5-flash', 'gemini-1.5-flash-latest']);
        $lastError = null;
        $aiText = null;

        foreach ($candidateModels as $model) {
            try {
                $response = Http::withoutVerifying()
                    ->connectTimeout(10)
                    ->timeout(25)
                    ->post(
                        "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}",
                        [
                            'contents' => [
                                ['parts' => [['text' => $prompt]]]
                            ],
                            'generationConfig' => [
                                'temperature'     => 0.8,
                                'maxOutputTokens' => 2048,
                            ]
                        ]
                    );

                if ($response->successful()) {
                    $data = $response->json();
                    $aiText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    if (!empty($aiText)) {
                        break;
                    }
                } else {
                    $lastError = 'Gemini API error (' . $response->status() . '): ' . $response->body();
                }
            } catch (\Exception $e) {
                $lastError = $e->getMessage();
            }
        }

        if (empty($aiText)) {
            Log::error('Gemini API Failed All Candidates: ' . ($lastError ?? 'Unknown error'));
            return back()->with('error', 'Gagal memproses AI: ' . ($lastError ?? 'Waktu tunggu habis atau model tidak merespons. Pastikan koneksi internet stabil.'));
        }

        $lastPromos    = Promotion::where('source', 'ai_generated')->latest()->take(5)->get();
        $userQueryText = $customPrompt ?: 'Analisis data transaksi terbaru dan buatkan opsi strategi bundling promo otomatis.';

        return view('admin.ai-assistant.index', compact('top5', 'bottom5', 'aiText', 'lastPromos', 'userQueryText', 'promoImageUrl'))
            ->with('success', 'Strategi AI & Desain Visual Promo berhasil digenerate!');
    }

    public function publish(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'ai_strategy_text'=> 'required|string',
            'discount_type'   => 'nullable|in:percentage,fixed,bundling',
            'banner_image'    => 'nullable|string',
            'valid_until'     => 'nullable|date',
        ]);

        Promotion::create([
            'title'            => $validated['title'],
            'description'      => substr(strip_tags($validated['ai_strategy_text']), 0, 500),
            'ai_strategy_text' => $validated['ai_strategy_text'],
            'discount_type'    => $validated['discount_type'] ?? 'bundling',
            'banner_image'     => $validated['banner_image'] ?? null,
            'source'           => 'ai_generated',
            'is_active'        => true,
            'valid_until'      => $validated['valid_until'] ?? now()->addDays(30),
        ]);

        return redirect()->route('admin.ai-assistant.index')
            ->with('success', 'Strategi AI berhasil diterbitkan sebagai promo aktif dan akan tampil di halaman publik!');
    }

    private function getSalesData(): array
    {
        $allSales = DB::table('sales_transactions')
            ->join('menus', 'menus.id', '=', 'sales_transactions.menu_id')
            ->select('menus.name', DB::raw('SUM(sales_transactions.quantity_sold) as total_sold'))
            ->where('sales_transactions.transaction_date', '>=', now()->subDays(30))
            ->groupBy('menus.id', 'menus.name')
            ->orderByDesc('total_sold')
            ->get();

        $top5    = $allSales->take(5);
        $bottom5 = $allSales->reverse()->take(5)->values();

        return [$top5, $bottom5];
    }
}
