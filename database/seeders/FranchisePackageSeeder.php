<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FranchisePackage;

class FranchisePackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name'                    => 'EXPRESS',
                'slug'                    => 'express',
                'price'                   => 99000000,
                'space_required'          => '15–25 m²',
                'pax_capacity'            => 20,
                'roi_projection'          => '12–18 bulan',
                'monthly_revenue_estimate'=> 'Rp 35–55 Juta',
                'staff_count'             => 2,
                'description'             => 'Paket entry-level ideal untuk memulai bisnis kuliner dengan modal terjangkau. Cocok untuk booth, food court, atau gerai kecil di area strategis. Sistem operasional yang simpel dan efisien.',
                'highlights'              => json_encode([
                    'Investasi terjangkau mulai Rp 99 Juta',
                    'Operasional minimal 2 SDM',
                    'Cocok untuk booth & food court',
                    'SOP & training lengkap',
                    'Dukungan bahan baku terjamin',
                    'Lisensi merek 3 tahun',
                ]),
                'menu_list'               => json_encode([
                    'Mie Gepeng Batok Arang (2 varian)',
                    'Nasi Goreng Arang',
                    'Mendoan Tempe',
                    'Kopi Tubruk Mbah Darmo',
                    'Es Teh Tarik Gula Aren',
                    'Wedang Uwuh',
                ]),
                'layout_images'           => json_encode([]),
                'financial_breakdown'     => json_encode([
                    'hpp'     => 32,
                    'tenaga'  => 18,
                    'sewa'    => 10,
                    'royalti' => 5,
                    'lainnya' => 10,
                    'profit'  => 25,
                ]),
                'color_accent'            => '#A18A43',
                'sort_order'              => 1,
            ],
            [
                'name'                    => 'BASIC',
                'slug'                    => 'basic',
                'price'                   => 199000000,
                'space_required'          => '30–50 m²',
                'pax_capacity'            => 40,
                'roi_projection'          => '18–24 bulan',
                'monthly_revenue_estimate'=> 'Rp 65–95 Juta',
                'staff_count'             => 4,
                'description'             => 'Paket standar dengan konsep warung kopi modern bergaya heritage. Dilengkapi coffee bar sederhana dan area dining nyaman. Pilihan terbaik untuk membangun brand awareness di kota/kabupaten.',
                'highlights'              => json_encode([
                    'Coffee bar & wedangan setup',
                    'Desain interior heritage Jawa',
                    'Kapasitas 40 pax dining',
                    'Peralatan dapur standar lengkap',
                    'Sistem POS kasir terintegrasi',
                    'Marketing kit digital premium',
                    'Lisensi merek 5 tahun',
                ]),
                'menu_list'               => json_encode([
                    'Full menu EXPRESS +',
                    'Mie Gepeng Pedas Level 3',
                    'Oseng Kikil & Koyor Pedas',
                    'Kopi Manual Brew Arang',
                    'Aneka Wedangan (4 varian)',
                    'Snack & Camilan (3 varian)',
                ]),
                'layout_images'           => json_encode([]),
                'financial_breakdown'     => json_encode([
                    'hpp'     => 30,
                    'tenaga'  => 20,
                    'sewa'    => 12,
                    'royalti' => 5,
                    'lainnya' => 8,
                    'profit'  => 25,
                ]),
                'color_accent'            => '#800000',
                'sort_order'              => 2,
            ],
            [
                'name'                    => 'SIGNATURE',
                'slug'                    => 'signature',
                'price'                   => 379000000,
                'space_required'          => '60–100 m²',
                'pax_capacity'            => 80,
                'roi_projection'          => '20–30 bulan',
                'monthly_revenue_estimate'=> 'Rp 130–180 Juta',
                'staff_count'             => 8,
                'description'             => 'Paket restoran skala menengah dengan identitas visual dan arsitektur khas Mbah Darmo yang kuat. Dilengkapi full kitchen professional, coffee bar premium, dan area dining semi-outdoor yang instagramable.',
                'highlights'              => json_encode([
                    'Full kitchen professional setup',
                    'Coffee bar premium specialty',
                    'Desain arsitektur eksklusif Mbah Darmo',
                    'Area outdoor & indoor',
                    'Target revenue hingga 180 Juta/bulan',
                    'Manajer operasional berpengalaman',
                    'Pelatihan SDM 2 minggu di pusat',
                    'Lisensi merek 7 tahun + hak first refusal',
                ]),
                'menu_list'               => json_encode([
                    'Full menu BASIC +',
                    'Babat Gongso Semarangan',
                    'Mie Gepeng Special (5 varian)',
                    'Nasi Uduk Mbah Darmo',
                    'Cold Brew Kopi Arang',
                    'Minuman Rempah Premium (6 varian)',
                    'Dessert & Jajanan Pasar (4 varian)',
                ]),
                'layout_images'           => json_encode([]),
                'financial_breakdown'     => json_encode([
                    'hpp'     => 28,
                    'tenaga'  => 22,
                    'sewa'    => 13,
                    'royalti' => 5,
                    'lainnya' => 7,
                    'profit'  => 25,
                ]),
                'color_accent'            => '#6B1D1D',
                'sort_order'              => 3,
            ],
            [
                'name'                    => 'HERITAGE',
                'slug'                    => 'heritage',
                'price'                   => 799000000,
                'space_required'          => '150–300 m²',
                'pax_capacity'            => 150,
                'roi_projection'          => '24–36 bulan',
                'monthly_revenue_estimate'=> 'Rp 300–500 Juta',
                'staff_count'             => 18,
                'description'             => 'Flagship restaurant — pengalaman kuliner & heritage tertinggi dari Warung Mbah Darmo. Bangunan bergaya Jawa klasik dengan pengalaman dining premium, area privat, live cooking station, dan full specialty coffee bar.',
                'highlights'              => json_encode([
                    'Flagship dining experience premium',
                    'Full bangunan bergaya Jawa klasik autentik',
                    'Live cooking station arang terbuka',
                    'Specialty coffee bar kelas atas',
                    'Area private dining & event space',
                    'Revenue target hingga 500 Juta/bulan',
                    'Eksklusivitas wilayah (radius 5 km)',
                    'Full support tim manajemen Mbah Darmo',
                    'Lisensi merek 10 tahun + renewal preferensial',
                ]),
                'menu_list'               => json_encode([
                    'Full menu SIGNATURE +',
                    'Chef\'s Table Menu Eksklusif',
                    'Paket Tasting Menu 7 Courses',
                    'Specialty Seri Kopi Microlot',
                    'Minuman Herbal Kustom',
                    'Kue & Pastri Tradisional Jawa',
                    'Catering & Box Meal Service',
                ]),
                'layout_images'           => json_encode([]),
                'financial_breakdown'     => json_encode([
                    'hpp'     => 27,
                    'tenaga'  => 25,
                    'sewa'    => 14,
                    'royalti' => 5,
                    'lainnya' => 7,
                    'profit'  => 22,
                ]),
                'color_accent'            => '#1a1a1a',
                'sort_order'              => 4,
            ],
        ];

        foreach ($packages as $pkg) {
            FranchisePackage::firstOrCreate(['slug' => $pkg['slug']], $pkg);
        }
    }
}
