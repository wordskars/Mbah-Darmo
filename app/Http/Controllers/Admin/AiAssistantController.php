<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AiAssistantController extends Controller
{
    /**
     * Permanent Static Text-Prompt Dictionary (Pure Text-Driven Pipeline Roadmap)
     * Pemetaan visual prompt terkunci per produk Warung Mbah Darmo.
     * Bebas 100% dari ketergantungan file foto mentah di folder lokal.
     */
    private const PRODUCT_VISUAL_PROMPTS = [
        'mendoan-tempe-mbah-darmo' => 'a traditional Javanese woven bamboo tray lined with a fresh green banana leaf holding authentic Indonesian tempe mendoan: wide flat thin elongated rectangular sheets of tempeh (not rolled), coated in a soft floppy pale-yellow flour batter with green scallions, half-cooked moist tender and non-crispy, realistic authentic food photography with natural cooked texture, arranged flat on banana leaf, accompanied by a small dipping bowl of dark sweet soy sauce with sliced chilies (sambal kecap)',
        'babat-gongso-semarangan' => 'a dark ceramic claypot dish filled with authentic natural babat gongso: natural cooked bite-sized pieces of beef tripe sautéed in rich dark sweet soy sauce with sliced red chilies and shallots',
        'oseng-kikil-koyor-pedas' => 'a small copper serving pan with spicy oseng kikil sapi: translucent chewy cubes of beef tendon and cow skin glistening in dark spicy red chili oil sauce with whole red chilies',
        'mie-gepeng-batok-arang-original' => 'a deep porcelain noodle bowl of savory Indonesian wok-fried flat noodles topped with shredded chicken, green vegetables, and sliced chili',
        'mie-gepeng-batok-arang-pedas-level-3' => 'a deep porcelain noodle bowl of spicy Indonesian wok-fried flat noodles with fiery red chili rawit, scallions, and charcoal aroma',
        'nasi-goreng-arang-mbah-darmo' => 'a round white ceramic plate of traditional Indonesian charcoal-fried dark savory nasi goreng topped with a sunny-side-up fried egg and cucumber slices',
        'kopi-tubruk-mbah-darmo' => 'a vintage ceramic coffee cup of hot dark traditional Javanese black kopi tubruk with fine coffee grounds settled at the bottom',
        'kopi-manual-brew-arang' => 'a classic glass coffee mug of hot Javanese charcoal manual brew drip coffee with rich crema',
        'wedang-uwuh-mbah-darmo' => 'a wide clear glass cup of hot crimson-red Javanese herbal spice tea with visible sappan wood, cinnamon stick, cloves, and ginger (wedang uwuh)',
        'es-teh-tarik-gula-aren' => 'a tall clear drinking glass of chilled layered iced teh tarik milk tea with dark gula aren palm sugar syrup at the bottom, creamy froth on top, and ice cubes with a straw',
        'bakmie-goreng-ayam' => 'a deep porcelain noodle bowl of Indonesian wok-fried Javanese bakmie goreng with tender shredded chicken, fried egg, cabbage, and green scallions',
        'bakmie-kuah-ayam' => 'a steaming ceramic soup bowl of Javanese bakmie kuah noodle soup with rich savory chicken broth, shredded chicken, poached egg, and fresh scallions',
        'bakmie-kuah-koyor' => 'a rich steaming ceramic soup bowl of Javanese bakmie kuah noodle soup topped with tender braised beef tendon (koyor), rich savory broth, and fried shallots',
        'bihun-goreng-ayam' => 'a deep porcelain bowl of stir-fried rice vermicelli bihun goreng with tender shredded chicken, scrambled egg, and green scallions',
        'gulai-jeroan' => 'a traditional Javanese claypot filled with rich golden coconut curry gulai jeroan featuring tender beef offal, liver, and intestine cooked in aromatic spiced broth with red chilies',
        'krengsengan' => 'a rustic iron pan filled with spicy Javanese krengsengan: tender sautéed beef chunks in rich dark sweet soy paste sauce with green and red chili slices',
        'kwetiau-goreng-ayam' => 'a steaming porcelain dish of stir-fried flat rice noodles kwetiau goreng with savory shredded chicken, egg, bean sprouts, and scallions',
        'nasi-goreng-ayam' => 'a round white ceramic plate of traditional Indonesian charcoal-fried dark savory nasi goreng topped with shredded chicken, a sunny-side-up fried egg, and cucumber slices',
        'nasi-goreng-koyor' => 'a round ceramic plate of dark savory Javanese charcoal-fried nasi goreng topped with tender braised beef tendon (koyor) and a sunny-side-up fried egg',
        'oseng-koyor' => 'a small rustic serving pan of spicy oseng koyor: tender glossy braised beef tendon sautéed in sweet soy sauce with whole red chilies and shallots',
        'sate-kambing' => 'a traditional wooden platter with 10 skewers of grilled Javanese sate kambing tender goat meat, glazed in sweet soy sauce and served with sliced shallots, cabai rawit, and lime',
        'tengkleng' => 'a traditional claypot bowl of savory Javanese tengkleng goat bone marrow and meat soup cooked in light golden spiced broth with fresh chilies',
        'tongseng' => 'a ceramic bowl of steaming Javanese tongseng beef stew in rich creamy coconut milk curry with cabbage, tomatoes, and sliced chilies',
        'wedang-asem' => 'a clear glass mug of hot refreshing Javanese wedang asem tamarind herbal drink with a golden brown translucent hue',
        'wedang-jeruk' => 'a vintage glass cup of warm Javanese wedang jeruk hot citrus drink with floating lime slices and golden honey',
        'wedang-ronde-rempah' => 'a traditional Javanese porcelain bowl of hot wedang ronde ginger soup filled with colorful chewy glutinous rice balls, crushed peanuts, and aromatic ginger slices',
        'wedang-saraba' => 'a clay mug of warm spiced Bugis-Javanese wedang saraba ginger drink with palm sugar and creamy coconut milk',
    ];

    /**
     * Konsep Desain & Komposisi Visual (Stok Konsep Desain / Strategi Random)
     * Menggantikan [STRATEGI VISUAL & KOMPOSISI] pada Master Prompt.
     */
    public const VISUAL_VARIATIONS = [
        'original' => [
            'name' => 'Orisinil (Classic Studio Framing)',
            'short_name' => 'Orisinil',
            'strategy' => 'Framing and composition: The food presentation is placed comfortably in the lower half of the frame with balanced moderate breathing-room margins on the left, right, and bottom edges (not touching borders, not cropped). The upper area of the frame is completely empty, plain, solid crimson red studio backdrop (#DC143C) with zero graphics, zero text, zero watermark, and zero numbers. Clean solid red background with zero extra dishes, zero duplicate items.',
        ],
        'variasi_1' => [
            'name' => 'Variasi 1: Floating Minimalist (Seperti Gambar 2)',
            'short_name' => 'Floating Minimalist',
            'strategy' => 'The copper pot is levitating slightly in the center of the frame, casting a soft, diffused shadow on the rich red background. Multiple blurred copper pots, similar to image_0.png, are softly visible in the foreground and far background (bokeh effect), creating depth. The cream-colored text from image_1.png\'s font style is stacked cleanly above the levitating pot.',
        ],
        'variasi_2' => [
            'name' => 'Variasi 2: Top-Down Artisanal (Jepretan Atas)',
            'short_name' => 'Top-Down Artisanal',
            'strategy' => 'A perfect top-down (flat lay) shot. The copper pot is centered on a dark wooden rustic table surface that peeks through the rich red background around the edges. Ingredients like scattered whole red chilies, a few peppercorns, and a small traditional clay pestle are artfully arranged around the pot. The cream-colored text is positioned in the lower third, over the wooden surface.',
        ],
        'variasi_3' => [
            'name' => 'Variasi 3: Spotlight Dramatic (Chiaroscuro)',
            'short_name' => 'Spotlight Dramatic',
            'strategy' => 'The copper pot is positioned slightly off-center on a dark, textured red surface. A strong, dramatic spotlight from the side illuminates only the glossy texture of the kikil and koyor and the metallic rim of the pot, leaving the rest of the background in deep shadow. The cream-colored text is brightly lit in the upper half of the poster, catching the light.',
        ],
        'variasi_4' => [
            'name' => 'Variasi 4: Kebyar Bumbu & Tekstur',
            'short_name' => 'Kebyar Bumbu & Tekstur',
            'strategy' => 'Close-up shot focusing intensely on the glossy, rich texture of the kikil and koyor in the copper pot. The foreground has a dynamic splash of chili oil and dried chilies frozen in motion. A sprinkle of fresh chopped scallions and a lime wedge rests on the pot\'s rim. The background is a smooth deep red gradient. The cream-colored text is overlayed in the upper space, large and bold.',
        ],
    ];

    // ─────────────────────────────────────────────────────────────────────────
    // INDEX
    // ─────────────────────────────────────────────────────────────────────────
    public function index()
    {
        [$top5, $bottom5] = $this->getSalesData();

        $lastPromos = Promotion::where('source', 'ai_generated')
            ->latest()
            ->take(10)
            ->get();

        $visualVariations = self::VISUAL_VARIATIONS;

        return view('admin.ai-assistant.index', compact(
            'top5', 'bottom5', 'lastPromos', 'visualVariations'
        ));
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

        // Filter sesuai pilihan user (pastikan tidak ada duplikasi input)
        $selectedProducts = empty($selectedNames)
            ? $bottom5List
            : array_values(array_filter($bottom5List, fn ($p) => in_array($p['name'], $selectedNames)));

        $selectedProducts = array_values(array_unique($selectedProducts, SORT_REGULAR));

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

        $count = count($selectedProducts);
        $aspectRatio = 'feeds';
        $size = '1080*1344';

        // ── Layout Matrix ───────────────────────────────────────────────
        if ($count === 1) {
            $layoutDesc = 'centered hero focal shot';
        } elseif ($count === 2) {
            $layoutDesc = 'side-by-side 2-item horizontal layout';
        } elseif ($count === 3) {
            $layoutDesc = 'neat 3-item triangular arrangement';
        } elseif ($count === 4) {
            $layoutDesc = 'balanced 4-item 2x2 grid arrangement';
        } else {
            $layoutDesc = "balanced {$count}-item table arrangement";
        }

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

        $productListForText = implode(', ', array_map(fn ($p) => $p['name'], $selectedProducts));
        $customPrompt = trim($request->input('custom_prompt', ''));
        $extraInstruction = $customPrompt ? "\nTambahan instruksi: {$customPrompt}" : '';

        // Random seed buat variasi tiap generate
        $seeds = ['kreatif', 'unik', 'menggugah', 'inovatif', 'segar', 'menarik', 'bold', 'memukau'];
        $seed = $seeds[array_rand($seeds)];

        $strategyPrompt = <<<PROMPT
Kamu adalah Marketing Strategist profesional untuk Warung Mbah Darmo, warung makan heritage Jawa legendaris di Yogyakarta.
Tugas: Buat kampanye promo bertema "{$randomStrategy}" yang {$seed} dan TERINTEGRASI EKSKLUSIF HANYA dengan produk yang dipilih user berikut: {$productListForText}.{$extraInstruction}

ATURAN KETAT PRODUK & BRANDING (WAJIB DIPATUHI):
- HANYA gunakan produk yang dipilih user di atas! DILARANG KERAS menambahkan, menyebutkan, atau mengarang menu lain yang tidak ada dalam daftar (misal: dilarang menambahkan sate kambing, es cendol, es teh, bakmie, dll jika tidak ada di daftar pilihan user).
- Jika user hanya memilih 1 produk ({$count} produk), strategi dan judul promo HARUS 100% fokus khusus pada 1 produk tersebut saja!
- JANGAN PERNAH mencantumkan kata 'Warung', 'Mbah', atau 'Darmo' pada HEADLINE atau JUDUL! Tulis hanya nama menu murni dan tema promonya (karena logo sudah ada terpisah di poster).

Format Output WAJIB (tanpa tanda bintang markdown):
HEADLINE: [1 headline sangat singkat & padat, Title Case, 2-3 KATA SAJA, contoh: Weekend Special atau Promo Berkah]
JUDUL: [Judul promo yang SINGKAT dan MENARIK untuk poster, MAKSIMAL 3-5 KATA, format "Tema Promo: Menu Pilihan", contoh jika 1 produk: "Weekend Special: Oseng Kikil & Koyor Pedas" atau "Promo Berkah: Mendoan Tempe". DILARANG tulis Mbah Darmo!]
STRATEGI: [Penjelasan strategi promosi mendalam (3-4 kalimat) HANYA untuk produk terpilih, jelaskan keunikan rasa, porsi, target konsumen, dan penawaran hemat secara informatif.]
COPYWRITING: [Narasi promosi emosional singkat menggugah selera, 1-2 kalimat, HANYA mengenai produk terpilih.]
DISKON: [Besaran diskon/penawaran hemat yang informatif, misal: 45% atau Hemat 30% atau Potongan Rp 15.000 atau Buy 1 Get 1]
CTA: [Ajakan bertindak tegas dan persuasif, 1 kalimat.]
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
                        'max_tokens' => 450,
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
            $fallbackHeadline = ucwords(strtolower($randomStrategy));
            $strategyText = "HEADLINE: {$fallbackHeadline}\n"
                ."JUDUL: {$randomStrategy}: {$productListForText}\n"
                ."STRATEGI: Penawaran bundling eksklusif yang dirancang taktis dengan memadukan menu-menu pilihan favorit untuk memberikan kepuasan porsi lengkap dan cita rasa autentik heritage Jawa dengan harga hemat bersahabat.\n"
                ."COPYWRITING: Nikmati cita rasa autentik heritage Jawa dengan penawaran terbaik hari ini!\n"
                ."DISKON: 45%\n"
                .'CTA: Pesan sekarang sebelum kehabisan — stok terbatas!';
        }

        // Ekstrak headline & judul dari teks strategi
        $headlineMatch = [];
        preg_match('/HEADLINE:\s*(.+)/i', $strategyText, $headlineMatch);
        $headline = trim($headlineMatch[1] ?? ucwords(strtolower($randomStrategy)));
        $headline = trim(preg_replace('/[*_"`]/', '', $headline));
        $headline = trim(preg_replace('/\b(warung\s+)?mbah\s+darmo\b/i', '', $headline));

        $judulMatch = [];
        preg_match('/JUDUL:\s*(.+)/i', $strategyText, $judulMatch);
        $judulPromo = trim($judulMatch[1] ?? "{$randomStrategy}: {$productListForText}");
        $judulPromo = trim(preg_replace('/\b(warung\s+)?mbah\s+darmo\b/i', '', $judulPromo));

        // Ekstrak copywriting & cta untuk mengisi ruang bawah poster secara menarik
        $copywritingMatch = [];
        preg_match('/COPYWRITING:\s*(.+)/i', $strategyText, $copywritingMatch);
        $copywriting = trim($copywritingMatch[1] ?? '');

        $ctaMatch = [];
        preg_match('/CTA:\s*(.+)/i', $strategyText, $ctaMatch);
        $cta = trim($ctaMatch[1] ?? 'Pesan Sekarang • Stok Terbatas!');

        // Ekstrak besaran diskon
        $diskonMatch = [];
        preg_match('/DISKON:\s*(.+)/i', $strategyText, $diskonMatch);
        $groqDiscount = trim($diskonMatch[1] ?? '');

        // Tentukan label diskon berdasarkan input user atau hasil AI
        $requestedDiscount = trim($request->input('discount_label', ''));
        if ($requestedDiscount === 'auto') {
            $discountLabel = $groqDiscount ?: '45%';
        } elseif (! empty($requestedDiscount)) {
            $discountLabel = $requestedDiscount;
        } else {
            $discountLabel = '';
        }

        // ── Seleksi Variasi Visual & Komposisi (Stok Konsep Desain / Strategi Random) ──
        $requestedVisualStrategy = $request->input('visual_strategy', 'random');
        $variationKeys = array_keys(self::VISUAL_VARIATIONS);

        if ($requestedVisualStrategy === 'random' || ! isset(self::VISUAL_VARIATIONS[$requestedVisualStrategy])) {
            $lastVariation = $request->input('last_variation');
            $candidates = array_values(array_filter($variationKeys, fn ($k) => $k !== $lastVariation));
            $chosenKey = ! empty($candidates) ? $candidates[array_rand($candidates)] : $variationKeys[array_rand($variationKeys)];
        } else {
            $chosenKey = $requestedVisualStrategy;
        }

        $chosenVariation = self::VISUAL_VARIATIONS[$chosenKey];
        $strategyClause = $chosenVariation['strategy'];

        // ── Build image prompt → Wavespeed AI dengan Master Prompt & Variasi Terpilih ────
        $cleanDishName = function (string $name): string {
            return trim(preg_replace('/\b(warung\s+)?mbah\s+darmo\b/i', '', $name));
        };

        $rawFirstDishName = $selectedProducts[0]['name'] ?? 'Oseng Kikil & Koyor Pedas';
        $firstDishName = $cleanDishName($rawFirstDishName);
        $isOsengKikil = Str::contains(strtolower($rawFirstDishName), ['kikil', 'koyor']);

        if ($count === 1 && $isOsengKikil) {
            $dishClause = "the specific copper pot of 'Oseng Kikil & Koyor Pedas' from image_0.png, including the whole red chili inside";
            $effectiveStrategyClause = $strategyClause;
        } elseif ($count === 1) {
            $dishDesc = $this->getDishVisualDescription($rawFirstDishName);
            $dishClause = "the specific authentic Indonesian dish '{$firstDishName}' ({$dishDesc})";
            $effectiveStrategyClause = str_replace(
                ['The copper pot', 'the copper pot', 'copper pots', 'kikil and koyor'],
                ['The authentic served dish', 'the served dish', 'served dishes', 'the dish'],
                $strategyClause
            );
        } else {
            $dishesList = array_map(function ($p, $idx) use ($count, $cleanDishName) {
                $num = $idx + 1;
                $cleanName = $cleanDishName($p['name']);

                return "Distinct Item #{$num} of {$count} ('{$cleanName}'): ".$this->getDishVisualDescription($p['name']);
            }, $selectedProducts, array_keys($selectedProducts));
            $dishesStr = implode('. ', $dishesList);
            $dishClause = "EXACTLY {$count} UNIQUE non-repeating dishes [ {$dishesStr} ] arranged in {$layoutDesc}";
            $effectiveStrategyClause = str_replace(
                ['The copper pot', 'the copper pot', 'copper pots', 'kikil and koyor'],
                ['The culinary dishes', 'the dishes', 'dishes', 'the dishes'],
                $strategyClause
            );
        }

        // Bersihkan nama menu murni tanpa mengulang tema promo / headline & tanpa embel-embel Mbah Darmo
        $productNamesOnly = implode(' & ', array_map(fn ($p) => $cleanDishName($p['name']), $selectedProducts));

        // Instruksikan posisi headline lebih turun agar tidak bertubrukan dengan logo di pojok kiri atas
        $textBlockClause = "The entire text block ('{$headline}' and '{$productNamesOnly}') must be present, but the font style must be changed to the bold, rounded, cream-colored, retro-serif typeface. IMPORTANT PLACEMENT: Shift the text block lower down, starting comfortably below the top margin (leave the top 22% of the frame completely clear and empty for the brand logo). The headline '{$headline}' must start lower down in the upper-middle area with ample top breathing room, followed by '{$productNamesOnly}' as the dish title underneath. Do NOT place text high near the top edge, and do NOT repeat or duplicate '{$headline}'. CRITICAL BRANDING RULE: NEVER write, render, or print 'Warung', 'Mbah', or 'Darmo' anywhere on the poster text. Only render '{$headline}' and '{$productNamesOnly}'.";

        $imagePrompt = "A high-resolution, photorealistic commercial food photography promotional poster featuring {$dishClause}. {$textBlockClause} The background color is a deep, rich red, consistent across all variations. {$effectiveStrategyClause} The overall aesthetic is premium, artisanal, and appetizing, 8k resolution, professional commercial food photography.";

        $size = ($aspectRatio === 'story') ? '864*1536' : '1080*1344';

        // ── Wavespeed AI → generate image ────────────────────────────────
        $wavespeedKey = env('WAVESPEED_API_KEY');
        $bannerUrl = null;

        if (! empty($wavespeedKey)) {
            try {
                $negativePromptStr = 'Warung, Mbah, Darmo, Warung Mbah Darmo, restaurant brand name text, brand watermark, split screen, multi panel, top and bottom split, top and bottom panels, stacked frames, collage, 2 frames, diptych, triptych, divided image, horizontal split line, 2 pictures, two separate photos, split frame, dual perspective, upper lower split, two images stacked, double frame, duplicate food, duplicate dishes, duplicate plates, duplicate drinks, identical dishes, repeated items, repeated food, twin dishes, copied food, distorted logo, messy typography, unreadable letters, text near top border, text touching top edge, text in top left corner, circular discount badge, percentage circle sticker, sale tag icon, discount watermark, low resolution, cartoon, illustration, blurry';

                $wsRes = Http::retry(2, 2000)
                    ->withoutVerifying()
                    ->timeout(120)
                    ->withHeaders([
                        'Authorization' => "Bearer {$wavespeedKey}",
                        'Content-Type' => 'application/json',
                    ])
                    ->post('https://api.wavespeed.ai/api/v3/wavespeed-ai/z-image/turbo', [
                        'prompt' => $imagePrompt,
                        'negative_prompt' => $negativePromptStr,
                        'size' => $size,
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
                        for ($i = 0; $i < 30; $i++) {
                            sleep(2);
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
                            $fullPath = $bannerDir.'/'.$fileName;
                            file_put_contents($fullPath, $imgContents);
                            $this->overlayPosterDesign($fullPath, [
                                'judul' => $judulPromo,
                                'headline' => $headline,
                                'copywriting' => $copywriting,
                                'cta' => $cta,
                                'discount' => $discountLabel,
                                'is_maroon_logo' => ($chosenKey === 'variasi_5'),
                            ]);
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
            'discount_type' => ! empty($discountLabel) ? 'percentage' : 'bundling',
            'discount_value' => $discountLabel ?: null,
            'banner_image' => $bannerUrl,
            'source' => 'ai_generated',
            'is_active' => false,
            'valid_until' => now()->addDays(7),
        ]);

        // ── Response ──────────────────────────────────────────────────────
        return response()->json([
            'status' => 'success',
            'promotion_id' => $promotion->id,
            'headline' => $headline,
            'judul_promo' => $judulPromo,
            'strategy_text' => $strategyText,
            'discount_label' => $discountLabel,
            'visual_variation_key' => $chosenKey,
            'visual_variation_name' => $chosenVariation['name'],
            'visual_variation_short' => $chosenVariation['short_name'],
            'banner_url' => $bannerUrl ?? asset('images/logo-transparent.png'),
            'selected_products' => $selectedProducts,
            'aspect_ratio' => $aspectRatio,
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

    /**
     * Konversi nama menu ke deskripsi visual makanan dalam Bahasa Inggris
     * menggunakan Kamus Prompt Permanen (PRODUCT_VISUAL_PROMPTS) & fallback rules.
     */
    private function getDishVisualDescription(string $name): string
    {
        $slug = Str::slug($name);

        // 1. Direct Lookup dari Kamus Static Text-Prompt
        if (isset(self::PRODUCT_VISUAL_PROMPTS[$slug])) {
            return self::PRODUCT_VISUAL_PROMPTS[$slug];
        }

        $lower = strtolower($name);

        // 1. Exact match / slug check
        $slug = Str::slug($name);
        if (isset(self::PRODUCT_VISUAL_PROMPTS[$slug])) {
            return self::PRODUCT_VISUAL_PROMPTS[$slug];
        }

        // 2. Drinks — Visually distinct glass/cup vessels
        if (str_contains($lower, 'ronde')) {
            return self::PRODUCT_VISUAL_PROMPTS['wedang-ronde-rempah'];
        }
        if (str_contains($lower, 'saraba')) {
            return self::PRODUCT_VISUAL_PROMPTS['wedang-saraba'];
        }
        if (str_contains($lower, 'asem')) {
            return self::PRODUCT_VISUAL_PROMPTS['wedang-asem'];
        }
        if (str_contains($lower, 'jeruk')) {
            return self::PRODUCT_VISUAL_PROMPTS['wedang-jeruk'];
        }
        if (str_contains($lower, 'uwuh')) {
            return self::PRODUCT_VISUAL_PROMPTS['wedang-uwuh-mbah-darmo'];
        }
        if (str_contains($lower, 'tarik') || (str_contains($lower, 'teh') && str_contains($lower, 'es'))) {
            return self::PRODUCT_VISUAL_PROMPTS['es-teh-tarik-gula-aren'];
        }
        if (str_contains($lower, 'kopi') || str_contains($lower, 'tubruk') || str_contains($lower, 'coffee')) {
            return self::PRODUCT_VISUAL_PROMPTS['kopi-tubruk-mbah-darmo'];
        }

        // 3. Food dishes — Visually distinct vessels
        if (str_contains($lower, 'sate') || str_contains($lower, 'satay')) {
            return self::PRODUCT_VISUAL_PROMPTS['sate-kambing'];
        }
        if (str_contains($lower, 'tengkleng')) {
            return self::PRODUCT_VISUAL_PROMPTS['tengkleng'];
        }
        if (str_contains($lower, 'tongseng')) {
            return self::PRODUCT_VISUAL_PROMPTS['tongseng'];
        }
        if (str_contains($lower, 'gulai')) {
            return self::PRODUCT_VISUAL_PROMPTS['gulai-jeroan'];
        }
        if (str_contains($lower, 'krengsengan')) {
            return self::PRODUCT_VISUAL_PROMPTS['krengsengan'];
        }
        if (str_contains($lower, 'mendoan') || str_contains($lower, 'tempe')) {
            return self::PRODUCT_VISUAL_PROMPTS['mendoan-tempe-mbah-darmo'];
        }
        if (str_contains($lower, 'babat')) {
            return self::PRODUCT_VISUAL_PROMPTS['babat-gongso-semarangan'];
        }
        if (str_contains($lower, 'kikil')) {
            return self::PRODUCT_VISUAL_PROMPTS['oseng-kikil-koyor-pedas'];
        }
        if (str_contains($lower, 'koyor')) {
            if (str_contains($lower, 'nasi')) {
                return self::PRODUCT_VISUAL_PROMPTS['nasi-goreng-koyor'];
            }
            if (str_contains($lower, 'bakmie') || str_contains($lower, 'mie')) {
                return self::PRODUCT_VISUAL_PROMPTS['bakmie-kuah-koyor'];
            }

            return self::PRODUCT_VISUAL_PROMPTS['oseng-koyor'];
        }
        if (str_contains($lower, 'bihun')) {
            return self::PRODUCT_VISUAL_PROMPTS['bihun-goreng-ayam'];
        }
        if (str_contains($lower, 'kwetiau')) {
            return self::PRODUCT_VISUAL_PROMPTS['kwetiau-goreng-ayam'];
        }
        if (str_contains($lower, 'bakmie kuah') || str_contains($lower, 'mie kuah')) {
            return self::PRODUCT_VISUAL_PROMPTS['bakmie-kuah-ayam'];
        }
        if (str_contains($lower, 'mie') || str_contains($lower, 'bakmie') || str_contains($lower, 'noodle')) {
            return self::PRODUCT_VISUAL_PROMPTS['bakmie-goreng-ayam'];
        }
        if (str_contains($lower, 'nasi goreng') || str_contains($lower, 'fried rice')) {
            return self::PRODUCT_VISUAL_PROMPTS['nasi-goreng-ayam'];
        }

        return 'a distinct white ceramic plate featuring '.$name;
    }

    /**
     * Helper untuk word-wrap teks GD FreeType
     */
    private function wrapTextForGd(string $text, int $fontSize, string $fontPath, int $maxWidth): array
    {
        $words = explode(' ', $text);
        $lines = [];
        $current = '';

        foreach ($words as $word) {
            $test = $current === '' ? $word : $current.' '.$word;
            $bbox = imagettfbbox($fontSize, 0, $fontPath, $test);
            $width = abs($bbox[4] - $bbox[0]);

            if ($width > $maxWidth && $current !== '') {
                $lines[] = $current;
                $current = $word;
            } else {
                $current = $test;
            }
        }

        if ($current !== '') {
            $lines[] = $current;
        }

        return $lines;
    }

    /**
     * Hitung ukuran font optimal & line wrapping yang pas dengan area atas poster secara dinamis
     * berdasarkan panjang teks dan sisa ruang kosong di atas makanan.
     */
    private function calculateOptimalLayout(string $headingText, string $subText, int $canvasW, int $canvasH, string $fontPath): array
    {
        $maxW = (int) ($canvasW * 0.82);

        $maxHSize = max(44, (int) ($canvasW * 0.058));
        $minHSize = max(26, (int) ($canvasW * 0.030));

        for ($hSize = $maxHSize; $hSize >= $minHSize; $hSize -= 2) {
            $sSize = ! empty($subText) ? max(22, (int) ($hSize * 0.76)) : 0;

            $hLines = $this->wrapTextForGd($headingText, $hSize, $fontPath, $maxW);
            $sLines = ! empty($subText) ? $this->wrapTextForGd($subText, $sSize, $fontPath, $maxW) : [];

            $overflow = false;
            foreach ($hLines as $l) {
                $bbox = imagettfbbox($hSize, 0, $fontPath, $l);
                if (abs($bbox[4] - $bbox[0]) > $maxW) {
                    $overflow = true;
                    break;
                }
            }
            if (! $overflow && ! empty($sLines)) {
                foreach ($sLines as $l) {
                    $bbox = imagettfbbox($sSize, 0, $fontPath, $l);
                    if (abs($bbox[4] - $bbox[0]) > $maxW) {
                        $overflow = true;
                        break;
                    }
                }
            }
            if ($overflow) {
                continue;
            }

            $hSpacing = (int) ($hSize * 1.08);
            $sSpacing = (int) ($sSize * 1.10);
            $transitionGap = ! empty($sLines) ? (int) ($hSize * 0.45 + $sSize * 0.65) : 0;

            $hBlockH = count($hLines) > 1 ? (count($hLines) - 1) * $hSpacing : 0;
            $sBlockH = count($sLines) > 1 ? (count($sLines) - 1) * $sSpacing : 0;
            $totalH = (int) ($hSize * 0.85) + $hBlockH + $transitionGap + $sBlockH + (! empty($sLines) ? (int) ($sSize * 0.25) : 0);

            $lineCount = count($hLines) + count($sLines);
            $effectiveAvailH = (int) ($canvasH * ($lineCount > 3 ? 0.21 : ($lineCount > 2 ? 0.24 : 0.28)));

            if ($totalH <= $effectiveAvailH) {
                return [
                    'hSize' => $hSize,
                    'hLines' => $hLines,
                    'hSpacing' => $hSpacing,
                    'sSize' => $sSize,
                    'sLines' => $sLines,
                    'sSpacing' => $sSpacing,
                    'transitionGap' => $transitionGap,
                    'totalH' => $totalH,
                ];
            }
        }

        return [
            'hSize' => $minHSize,
            'hLines' => $this->wrapTextForGd($headingText, $minHSize, $fontPath, $maxW),
            'hSpacing' => (int) ($minHSize * 1.08),
            'sSize' => ! empty($subText) ? (int) ($minHSize * 0.76) : 0,
            'sLines' => ! empty($subText) ? $this->wrapTextForGd($subText, (int) ($minHSize * 0.76), $fontPath, $maxW) : [],
            'sSpacing' => (int) ($minHSize * 0.80),
            'transitionGap' => (int) ($minHSize * 0.90),
            'totalH' => (int) ($canvasH * 0.25),
        ];
    }

    /**
     * Overlay poster branding Warung Mbah Darmo:
     * - Logo di pojok kiri atas dengan padding proporsional
     * - Typography stack terstruktur mengisi area atas poster secara dinamis & proporsional
     */
    private function overlayPosterDesign(string $bannerPath, array $promoData = []): void
    {
        if (! file_exists($bannerPath)) {
            return;
        }

        $banner = @imagecreatefromjpeg($bannerPath);
        if (! $banner) {
            return;
        }

        $bannerWidth = imagesx($banner);
        $bannerHeight = imagesy($banner);

        // 1. Overlay Logo Warung Mbah Darmo di pojok kiri atas
        $logoPath = public_path('product-images/logo-white.png');
        if (file_exists($logoPath)) {
            $logo = @imagecreatefrompng($logoPath);
            if ($logo) {
                imagealphablending($logo, true);
                imagesavealpha($logo, true);

                $logoWidth = imagesx($logo);
                $logoHeight = imagesy($logo);

                // Resize logo proporsional ~18% dari lebar banner agar rapi di pojok kiri atas
                $targetWidth = (int) ($bannerWidth * 0.18);
                $targetHeight = (int) ($logoHeight * ($targetWidth / $logoWidth));

                $resizedLogo = imagecreatetruecolor($targetWidth, $targetHeight);
                imagealphablending($resizedLogo, false);
                imagesavealpha($resizedLogo, true);
                $transparent = imagecolorallocatealpha($resizedLogo, 0, 0, 0, 127);
                imagefill($resizedLogo, 0, 0, $transparent);

                imagecopyresampled(
                    $resizedLogo, $logo,
                    0, 0, 0, 0,
                    $targetWidth, $targetHeight,
                    $logoWidth, $logoHeight
                );

                // Khusus variasi dengan latar atas krem (Variasi 5), jadikan logo berwarna maroon agar kontras dan terbaca
                if (! empty($promoData['is_maroon_logo'])) {
                    $maroonR = 115;
                    $maroonG = 25;
                    $maroonB = 28;

                    for ($x = 0; $x < $targetWidth; $x++) {
                        for ($y = 0; $y < $targetHeight; $y++) {
                            $rgba = imagecolorat($resizedLogo, $x, $y);
                            $alpha = ($rgba >> 24) & 0x7F;
                            if ($alpha < 127) {
                                $origR = ($rgba >> 16) & 0xFF;
                                $factor = $origR / 255;
                                $color = imagecolorallocatealpha(
                                    $resizedLogo,
                                    (int) ($maroonR * $factor),
                                    (int) ($maroonG * $factor),
                                    (int) ($maroonB * $factor),
                                    $alpha
                                );
                                imagesetpixel($resizedLogo, $x, $y, $color);
                            }
                        }
                    }
                }

                $paddingX = (int) ($bannerWidth * 0.04);
                $paddingY = (int) ($bannerHeight * 0.038);

                imagealphablending($banner, true);
                imagecopy($banner, $resizedLogo, $paddingX, $paddingY, 0, 0, $targetWidth, $targetHeight);
            }
        }

        // 2. Setup Font & Label Diskon (jika ada) — Teks judul di background sudah digenerate langsung oleh AI, layer teks GD dihapus agar tidak duplikat
        $discountLabel = trim($promoData['discount'] ?? '');
        $titleFont = public_path('fonts/headline.ttf');
        if (! file_exists($titleFont)) {
            $titleFont = public_path('fonts/title-bold.ttf');
        }
        if (! file_exists($titleFont)) {
            $titleFont = 'C:/Windows/Fonts/arialbd.ttf';
        }

        if (! empty($discountLabel) && file_exists($titleFont) && function_exists('imagettftext')) {
            $badgeText = $discountLabel;
            if (is_numeric($badgeText)) {
                $badgeText = "DISKON {$badgeText}%";
            } elseif (preg_match('/^\d+%/i', $badgeText)) {
                $badgeText = "DISKON {$badgeText}";
            }

            // Ukuran font label yang proporsional — tidak terlalu besar, tidak terlalu kecil, tapi jelas
            $badgeFontSize = max(18, min(26, (int) ($bannerWidth * 0.024)));
            $badgeBbox = imagettfbbox($badgeFontSize, 0, $titleFont, $badgeText);
            $badgeTextW = abs($badgeBbox[4] - $badgeBbox[0]);
            $badgeTextH = abs($badgeBbox[5] - $badgeBbox[1]);

            $badgePadX = (int) ($badgeFontSize * 1.3);
            $badgePadY = (int) ($badgeFontSize * 0.6);

            $badgeW = $badgeTextW + ($badgePadX * 2);
            $badgeH = $badgeTextH + ($badgePadY * 2);

            $badgeX1 = (int) (($bannerWidth - $badgeW) / 2);
            $badgeX2 = $badgeX1 + $badgeW;

            // Posisi Y berada di antara teks judul dan bibir atas makanan
            $badgeCenterY = (int) ($bannerHeight * 0.435);
            $badgeY1 = $badgeCenterY - (int) ($badgeH / 2);
            $badgeY2 = $badgeY1 + $badgeH;

            $badgeRadius = (int) ($badgeH / 2);

            // Warna tema Warung Mbah Darmo: Crimson base, Gold border, Ivory text
            $shadowColor = imagecolorallocatealpha($banner, 18, 3, 5, 85);
            $goldBorder = imagecolorallocate($banner, 247, 211, 113);
            $crimsonFill = imagecolorallocate($banner, 142, 27, 19);
            $ivoryText = imagecolorallocate($banner, 255, 248, 235);
            $darkTextShadow = imagecolorallocatealpha($banner, 20, 2, 4, 75);

            // Bayangan drop-shadow pill badge
            $this->drawRoundedRectangle($banner, $badgeX1 + 2, $badgeY1 + 4, $badgeX2 + 2, $badgeY2 + 4, $badgeRadius, $shadowColor);
            // Border emas vintage (outer)
            $this->drawRoundedRectangle($banner, $badgeX1, $badgeY1, $badgeX2, $badgeY2, $badgeRadius, $goldBorder);
            // Isi merah marun crimson (inner)
            $this->drawRoundedRectangle($banner, $badgeX1 + 3, $badgeY1 + 3, $badgeX2 - 3, $badgeY2 - 3, max(1, $badgeRadius - 3), $crimsonFill);

            // Teks berada tepat di tengah pill badge
            $textX = $badgeX1 + (int) (($badgeW - $badgeTextW) / 2);
            $textY = $badgeY1 + (int) (($badgeH + $badgeTextH) / 2) - 2;

            imagettftext($banner, $badgeFontSize, 0, $textX + 2, $textY + 2, $darkTextShadow, $titleFont, $badgeText);
            imagettftext($banner, $badgeFontSize, 0, $textX, $textY, $ivoryText, $titleFont, $badgeText);
        }

        imagejpeg($banner, $bannerPath, 95);
    }

    /**
     * Helper untuk menggambar rounded rectangle dengan antialiasing sederhana di GD
     */
    private function drawRoundedRectangle($image, int $x1, int $y1, int $x2, int $y2, int $radius, int $color): void
    {
        $radius = min($radius, (int) (abs($x2 - $x1) / 2), (int) (abs($y2 - $y1) / 2));
        if ($radius <= 0) {
            imagefilledrectangle($image, $x1, $y1, $x2, $y2, $color);

            return;
        }

        // Area persegi panjang utama (tengah)
        imagefilledrectangle($image, $x1 + $radius, $y1, $x2 - $radius, $y2, $color);
        imagefilledrectangle($image, $x1, $y1 + $radius, $x2, $y2 - $radius, $color);

        // 4 sudut lengkung
        imagefilledellipse($image, $x1 + $radius, $y1 + $radius, $radius * 2, $radius * 2, $color);
        imagefilledellipse($image, $x2 - $radius, $y1 + $radius, $radius * 2, $radius * 2, $color);
        imagefilledellipse($image, $x1 + $radius, $y2 - $radius, $radius * 2, $radius * 2, $color);
        imagefilledellipse($image, $x2 - $radius, $y2 - $radius, $radius * 2, $radius * 2, $color);
    }

    /**
     * Backward-compatible alias
     */
    private function overlayLogoAndHeadline(string $bannerPath, string $headline = ''): void
    {
        $this->overlayPosterDesign($bannerPath, ['headline' => $headline]);
    }
}
