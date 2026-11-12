<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Promotion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_all_active_promotions_before_featured_menus(): void
    {
        $this->travelTo('2026-11-06 12:00:00');

        $category = Category::create([
            'name' => 'Menu Utama',
            'slug' => 'menu-utama',
        ]);
        Menu::create([
            'category_id' => $category->id,
            'name' => 'Menu Unggulan',
            'slug' => 'menu-unggulan',
            'price' => 25000,
            'is_available' => true,
            'is_featured' => true,
        ]);
        Promotion::create([
            'title' => 'Promo Aktif Minggu Ini',
            'description' => 'Diskon khusus untuk pelanggan.',
            'discount_type' => 'percentage',
            'discount_value' => '20',
            'is_active' => true,
            'valid_until' => '2026-11-10',
        ]);
        Promotion::create([
            'title' => 'Promo Sudah Berakhir',
            'description' => 'Promo ini tidak boleh ditampilkan.',
            'is_active' => true,
            'valid_until' => '2026-11-05',
        ]);
        Promotion::create([
            'title' => 'Promo Aktif Tanpa Batas Waktu',
            'description' => 'Promo ini berlaku seterusnya.',
            'is_active' => true,
            'valid_until' => null,
        ]);
        Promotion::create([
            'title' => 'Promo Masih Nonaktif',
            'description' => 'Promo ini belum aktif.',
            'is_active' => false,
            'valid_until' => null,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Promo Warung Mbah Darmo');
        $response->assertSee('Promo Aktif Minggu Ini');
        $response->assertSee('Promo Aktif Tanpa Batas Waktu');
        $response->assertDontSee('Promo Sudah Berakhir');
        $response->assertDontSee('Promo Masih Nonaktif');
        $response->assertSeeInOrder([
            'Promo Warung Mbah Darmo',
            'Hidangan Khas',
        ]);
    }
}
