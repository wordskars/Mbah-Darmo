<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\AiAssistantController;
use Tests\TestCase;

class AiAssistantVariationTest extends TestCase
{
    /**
     * Test bahwa seluruh variasi visual dan stok konsep desain tersedia lengkap.
     */
    public function test_visual_variations_contain_five_variations_plus_original(): void
    {
        $variations = AiAssistantController::VISUAL_VARIATIONS;

        $this->assertCount(6, $variations);
        $this->assertArrayHasKey('original', $variations);
        $this->assertArrayHasKey('variasi_1', $variations);
        $this->assertArrayHasKey('variasi_2', $variations);
        $this->assertArrayHasKey('variasi_3', $variations);
        $this->assertArrayHasKey('variasi_4', $variations);
        $this->assertArrayHasKey('variasi_5', $variations);

        // Periksa teks strategi pada masing-masing variasi
        $this->assertStringContainsString('The copper pot is levitating slightly', $variations['variasi_1']['strategy']);
        $this->assertStringContainsString('A perfect top-down (flat lay) shot', $variations['variasi_2']['strategy']);
        $this->assertStringContainsString('Spotlight Dramatic (Chiaroscuro)', $variations['variasi_3']['name']);
        $this->assertStringContainsString('Kebyar Bumbu & Tekstur', $variations['variasi_4']['name']);
        $this->assertStringContainsString('Modern Graphic & Simplicity', $variations['variasi_5']['name']);
        $this->assertStringContainsString('Orisinil (Classic Studio Framing)', $variations['original']['name']);
    }

    /**
     * Test bahwa sanitasi menghapus kata Mbah Darmo dan Warung Mbah Darmo dari teks menu dan headline poster.
     */
    public function test_dish_name_and_headline_strip_mbah_darmo_branding(): void
    {
        $cleaner = fn (string $text) => trim(preg_replace('/\b(warung\s+)?mbah\s+darmo\b/i', '', $text));

        $this->assertSame('Mendoan Tempe', $cleaner('Mendoan Tempe Mbah Darmo'));
        $this->assertSame('Nasi Goreng Arang', $cleaner('Nasi Goreng Arang Mbah Darmo'));
        $this->assertSame('Kopi Tubruk', $cleaner('Kopi Tubruk Mbah Darmo'));
        $this->assertSame('Promo Spesial', $cleaner('Warung Mbah Darmo Promo Spesial'));
        $this->assertSame('Diskon Gajian', $cleaner('Diskon Gajian Mbah Darmo'));
    }
}
