<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesTransaction;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        [$top5, $bottom5] = $this->getSalesData();

        if ($top5->isEmpty() && $bottom5->isEmpty()) {
            return back()->with('error', 'Belum ada data transaksi penjualan untuk dianalisis.');
        }

        $top5Text    = $top5->map(fn($m) => "- {$m->name} ({$m->total_sold} terjual)")->join("\n");
        $bottom5Text = $bottom5->map(fn($m) => "- {$m->name} ({$m->total_sold} terjual)")->join("\n");

        $prompt = <<<PROMPT
Kamu adalah AI Strategi Promosi untuk Warung Mbah Darmo, sebuah warung makan heritage Jawa di Yogyakarta yang terkenal dengan Mie Gepeng Batok Arang dan konsep kuliner tradisional otentik.

Berdasarkan data penjualan 30 hari terakhir:

**TOP 5 PRODUK TERLARIS:**
{$top5Text}

**BOTTOM 5 PRODUK KURANG LAKU:**
{$bottom5Text}

Buatlah strategi promosi kreatif yang:
1. Mengusulkan minimal 3 bundling paket (Buy 1 Get 1, combo, dll) antara produk terlaris dan produk kurang laku
2. Menyertakan narasi promosi yang menarik untuk setiap bundling
3. Mengusulkan strategi diskon silang (cross-discount)
4. Memberikan rekomendasi waktu tayang promosi (mis: hari kerja, weekend, jam makan siang, dll)
5. Menyertakan tagline promosi dalam Bahasa Indonesia yang catchy dan sesuai branding Mbah Darmo

Format output dalam Bahasa Indonesia yang profesional namun hangat, sesuai karakter brand Warung Mbah Darmo. Gunakan format yang terstruktur dengan heading dan bullet points.
PROMPT;

        try {
            $apiKey = config('services.gemini.api_key');
            $model  = config('services.gemini.model', 'gemini-1.5-flash');

            $response = Http::timeout(60)->post(
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

            if ($response->failed()) {
                throw new \Exception('Gemini API error: ' . $response->body());
            }

            $data        = $response->json();
            $aiText      = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Tidak ada respons dari AI.';
            $lastPromos  = Promotion::where('source', 'ai_generated')->latest()->take(5)->get();

            return view('admin.ai-assistant.index', compact('top5', 'bottom5', 'aiText', 'lastPromos'))
                ->with('success', 'Strategi AI berhasil digenerate!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghubungi Gemini API: ' . $e->getMessage());
        }
    }

    public function publish(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'ai_strategy_text'=> 'required|string',
            'discount_type'   => 'nullable|in:percentage,fixed,bundling',
            'valid_until'     => 'nullable|date',
        ]);

        Promotion::create([
            'title'            => $validated['title'],
            'description'      => substr(strip_tags($validated['ai_strategy_text']), 0, 500),
            'ai_strategy_text' => $validated['ai_strategy_text'],
            'discount_type'    => $validated['discount_type'] ?? 'bundling',
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
