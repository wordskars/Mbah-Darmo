<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Makanan Utama', 'slug' => 'makanan-utama'],
            ['name' => 'Oseng & Tumis', 'slug' => 'oseng-tumis'],
            ['name' => 'Snack & Camilan', 'slug' => 'snack-camilan'],
            ['name' => 'Kopi', 'slug' => 'kopi'],
            ['name' => 'Wedangan', 'slug' => 'wedangan'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
