<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Category;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $makanan  = Category::where('slug', 'makanan-utama')->first();
        $oseng    = Category::where('slug', 'oseng-tumis')->first();
        $snack    = Category::where('slug', 'snack-camilan')->first();
        $kopi     = Category::where('slug', 'kopi')->first();
        $wedangan = Category::where('slug', 'wedangan')->first();

        $menus = [
            // Makanan Utama
            [
                'category_id'            => $makanan->id,
                'name'                   => 'Mie Gepeng Batok Arang Original',
                'slug'                   => 'mie-gepeng-batok-arang-original',
                'price'                  => 28000,
                'short_description_hover'=> 'Mie gepeng kenyal dimasak di atas bara arang kelapa, menghasilkan cita rasa smoky unik yang tak tertandingi. Bumbu rempah pilihan meresap sempurna.',
                'description'            => 'Signature dish Warung Mbah Darmo. Mie gepeng bertekstur kenyal dengan proses memasak tradisional menggunakan batok arang, memberikan aroma smoky yang khas dan autentik.',
                'spice_level'            => 'mild',
                'is_available'           => true,
                'is_featured'            => true,
            ],
            [
                'category_id'            => $makanan->id,
                'name'                   => 'Mie Gepeng Batok Arang Pedas Level 3',
                'slug'                   => 'mie-gepeng-pedas-level-3',
                'price'                  => 30000,
                'short_description_hover'=> 'Versi pedas dari signature mie gepeng kami. Cabai rawit segar dipadukan dengan bumbu rahasia Mbah Darmo, disajikan panas di atas bara arang.',
                'description'            => 'Bagi pecinta pedas, inilah tantangan sejati. Tiga level kepedasan yang bisa disesuaikan, tetap mempertahankan aroma smoky batok arang yang legendaris.',
                'spice_level'            => 'hot',
                'is_available'           => true,
                'is_featured'            => true,
            ],
            [
                'category_id'            => $makanan->id,
                'name'                   => 'Nasi Goreng Arang Mbah Darmo',
                'slug'                   => 'nasi-goreng-arang-mbah-darmo',
                'price'                  => 25000,
                'short_description_hover'=> 'Nasi goreng khas dengan teknik wok over arang. Aroma charcoal yang meresap dalam setiap butir nasi, lengkap dengan telur kampung dan lauk pilihan.',
                'description'            => 'Nasi goreng yang berbeda dari biasanya. Dimasak dengan api besar dari arang batok kelapa, menghasilkan rasa "wok hei" autentik yang biasa ditemukan di restoran premium.',
                'spice_level'            => 'medium',
                'is_available'           => true,
                'is_featured'            => true,
            ],
            // Oseng & Tumis
            [
                'category_id'            => $oseng->id,
                'name'                   => 'Oseng Kikil & Koyor Pedas',
                'slug'                   => 'oseng-kikil-koyor-pedas',
                'price'                  => 32000,
                'short_description_hover'=> 'Kikil dan koyor sapi empuk dimasak dengan bumbu oseng merah pedas nan gurih. Tekstur kenyal gelatinous yang memuaskan, cocok dengan nasi hangat.',
                'description'            => 'Olahan kikil dan koyor sapi yang dimasak hingga empuk sempurna dengan bumbu oseng tradisional Jawa. Kaya kolagen dan rasa.',
                'spice_level'            => 'hot',
                'is_available'           => true,
                'is_featured'            => false,
            ],
            [
                'category_id'            => $oseng->id,
                'name'                   => 'Babat Gongso Semarangan',
                'slug'                   => 'babat-gongso-semarangan',
                'price'                  => 35000,
                'short_description_hover'=> 'Babat sapi dimasak gongso dengan kecap manis Jawa dan rempah pilihan. Cita rasa manis-gurih-pedas khas Semarang yang autentik dan menggugah selera.',
                'description'            => 'Resep warisan babat gongso ala Semarang yang otentik. Proses memasak panjang menghasilkan babat yang empuk dengan bumbu yang meresap sempurna.',
                'spice_level'            => 'medium',
                'is_available'           => true,
                'is_featured'            => true,
            ],
            // Snack & Camilan
            [
                'category_id'            => $snack->id,
                'name'                   => 'Mendoan Tempe Mbah Darmo',
                'slug'                   => 'mendoan-tempe-mbah-darmo',
                'price'                  => 15000,
                'short_description_hover'=> 'Mendoan tempe setengah matang, renyah di luar lembut di dalam. Tepung berbumbu rahasia dengan daun bawang segar. Disajikan hangat dengan sambal kecap.',
                'description'            => 'Mendoan autentik khas Banyumas. Tempe tipis dibalut tepung berbumbu khusus, digoreng setengah matang untuk tekstur yang sempurna.',
                'spice_level'            => 'mild',
                'is_available'           => true,
                'is_featured'            => false,
            ],
            // Kopi
            [
                'category_id'            => $kopi->id,
                'name'                   => 'Kopi Manual Brew Arang',
                'slug'                   => 'kopi-manual-brew-arang',
                'price'                  => 22000,
                'short_description_hover'=> 'Single origin Arabika Jawa diseduh manual V60 dengan air yang dipanaskan di atas arang. Profil rasa: cokelat, karamel, dan sedikit earthy yang kompleks.',
                'description'            => 'Pengalaman ngopi yang berbeda. Biji kopi single origin pilihan diseduh dengan metode manual brewing V60, menggunakan air panas dari arang batok untuk rasa yang unik.',
                'spice_level'            => 'mild',
                'is_available'           => true,
                'is_featured'            => true,
            ],
            [
                'category_id'            => $kopi->id,
                'name'                   => 'Kopi Tubruk Mbah Darmo',
                'slug'                   => 'kopi-tubruk-mbah-darmo',
                'price'                  => 12000,
                'short_description_hover'=> 'Kopi tubruk tradisional dengan biji kopi Robusta pilihan yang digiling kasar. Disajikan dalam gelas beling klasik, teman setia suasana warung.',
                'description'            => 'Kembali ke akar. Kopi tubruk dengan kopi Robusta lokal pilihan, disajikan cara tradisional dengan gula aren Jawa.',
                'spice_level'            => 'mild',
                'is_available'           => true,
                'is_featured'            => false,
            ],
            // Wedangan
            [
                'category_id'            => $wedangan->id,
                'name'                   => 'Wedang Uwuh Mbah Darmo',
                'slug'                   => 'wedang-uwuh-mbah-darmo',
                'price'                  => 14000,
                'short_description_hover'=> 'Minuman rempah tradisional Jawa: jahe, kayu manis, cengkeh, pala, dan daun pandan. Hangat, aromatik, dan menyehatkan. Identitas khas warung wedangan.',
                'description'            => 'Wedang uwuh dengan 7 rempah pilihan yang diracik sesuai resep leluhur. Menghangatkan tubuh dan menyegarkan jiwa.',
                'spice_level'            => 'mild',
                'is_available'           => true,
                'is_featured'            => false,
            ],
            [
                'category_id'            => $wedangan->id,
                'name'                   => 'Es Teh Tarik Gula Aren',
                'slug'                   => 'es-teh-tarik-gula-aren',
                'price'                  => 13000,
                'short_description_hover'=> 'Teh hitam premium ditarik dengan teknik khas menghasilkan busa lembut, dipadukan gula aren asli Jawa. Segar manis dengan rasa karamel alami.',
                'description'            => 'Teh tarik ala Warung Mbah Darmo dengan gula aren asli sebagai pemanis. Dingin, creamy, dan menyegarkan.',
                'spice_level'            => 'mild',
                'is_available'           => true,
                'is_featured'            => false,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::firstOrCreate(['slug' => $menu['slug']], $menu);
        }
    }
}
