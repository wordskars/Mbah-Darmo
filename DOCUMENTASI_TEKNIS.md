# Dokumentasi Teknis Website Warung Mbah Darmo

Dokumen ini menjelaskan arsitektur dan fitur website berdasarkan implementasi kode yang saat ini terdapat pada proyek. Dokumen ini sengaja membedakan teknologi yang terpasang dengan teknologi yang benar-benar digunakan oleh setiap alur fitur, sehingga tidak ada kesimpulan yang dibuat berdasarkan asumsi.

## 1. Gambaran Umum Sistem

Website Warung Mbah Darmo adalah aplikasi web berbasis Laravel yang menampilkan:

- halaman utama warung;
- katalog menu;
- informasi paket franchise;
- halaman kontak;
- panel login administrator;
- dashboard laporan dan operasional;
- pengelolaan menu;
- pengelolaan promo dan banner;
- pencatatan penjualan;
- AI Promo Assistant.

Arsitektur utama aplikasi menggunakan pola MVC Laravel:

```text
Route
  -> Controller
  -> Eloquent Model / Query Builder
  -> Database SQLite atau layanan Firebase
  -> Blade View
  -> Browser pengguna
```

Permintaan halaman publik melewati route Laravel, diproses oleh controller, kemudian diteruskan ke Blade sebagai data view. Permintaan dari panel administrator juga melewati middleware autentikasi dan role admin sebelum controller dapat mengubah data.

## 2. Tech Stack

### Framework dan Bahasa

- Laravel 13 digunakan sebagai framework backend.
- PHP 8.3 atau lebih baru digunakan sebagai bahasa server-side.
- Eloquent ORM digunakan untuk model dan relasi database.
- Blade digunakan sebagai template engine.
- Laravel middleware digunakan untuk autentikasi dan pembatasan akses admin.
- Laravel Vite digunakan untuk proses build aset frontend.

### Styling Frontend

- Tailwind CSS 4 telah dipasang dan diimpor pada `resources/css/app.css`.
- Vite dan `@tailwindcss/vite` digunakan sebagai pipeline Tailwind CSS.
- Bootstrap 5 juga digunakan untuk komponen dan layout.
- Bootstrap Icons digunakan untuk ikon pada antarmuka.
- Sebagian besar halaman aplikasi saat ini menggunakan kombinasi Bootstrap, CSS custom, utility class, dan CSS inline di Blade.
- Tailwind CSS tersedia sebagai bagian dari stack frontend, tetapi styling utama halaman website yang ada saat ini tidak sepenuhnya dibangun dari utility Tailwind.

Dengan kata lain, Tailwind CSS merupakan bagian dari stack frontend yang dikonfigurasi pada proyek, sementara tampilan actual banyak memakai sistem CSS custom dan Bootstrap.

### Database

Database utama proyek saat ini adalah **SQLite**, bukan MySQL.

Konfigurasi aktif adalah:

```text
DB_CONNECTION=sqlite
```

File database berada pada:

```text
database/database.sqlite
```

Konfigurasi koneksi SQLite tersedia pada `config/database.php`. Konfigurasi MySQL tetap tersedia di konfigurasi Laravel sebagai opsi teknis, tetapi tidak aktif sebagai koneksi utama berdasarkan konfigurasi environment yang digunakan.

Database menyimpan data aplikasi utama, termasuk:

- user dan autentikasi;
- menu;
- kategori;
- promo;
- transaksi penjualan;
- paket franchise;
- session;
- cache;
- queue;

jika Laravel dikonfigurasi untuk menggunakan database bagi fitur tersebut.

### Firebase

Firebase digunakan sebagai layanan tambahan khusus untuk sinkronisasi dan penyimpanan gambar menu.

Firebase menyediakan dua fungsi utama:

1. **Firebase Storage** untuk menyimpan gambar menu.
2. **Cloud Firestore** untuk menyimpan salinan dokumen data menu agar sinkron.

Implementasi Firebase berada pada `app/Services/FirebaseService.php`.

Alur sinkronisasi menu:

```text
Admin mengunggah gambar menu
  -> FirebaseService mencoba Firebase Storage
  -> URL gambar berhasil diperoleh atau fallback ke storage lokal
  -> Menu disimpan ke database SQLite melalui Eloquent
  -> Data menu dikirim ke Cloud Firestore
```

Firestore merupakan sinkronisasi tambahan. Tampilan menu utama website tidak membaca Firestore secara langsung; tampilan website tetap membaca database Laravel SQLite melalui model Eloquent.

Jika Firebase Storage atau kredensial tidak tersedia, gambar menu disimpan sebagai fallback pada storage lokal Laravel.

## 3. Route, Controller, dan Blade View

Route utama website terdapat pada `routes/web.php`.

### Route Publik

- `/` menampilkan homepage.
- `/menu` menampilkan katalog menu.
- `/franchise` menampilkan daftar paket franchise.
- `/franchise/{slug}` menampilkan detail paket franchise.
- `/kontak` menampilkan halaman kontak.
- `/admin/login` menampilkan login administrator.

### Route Administrator

Route admin berada di bawah prefix `/admin` dan dilindungi oleh:

```text
auth
admin
```

Middleware pertama memastikan admin sudah login. Middleware kedua memastikan akun memiliki role `admin`.

### Penggunaan Blade

Blade merender:

- layout publik pada `resources/views/layouts/app.blade.php`;
- layout admin pada `resources/views/layouts/admin.blade.php`;
- homepage pada `resources/views/home/index.blade.php`;
- halaman menu;
- dashboard;
- halaman menu admin;
- halaman promo admin;
- halaman laporan;
- AI Promo Assistant.

## 4. Struktur Database

### Tabel `users`

Migration `0001_01_01_000000_create_users_table.php` membuat tabel user dengan kolom:

- `id`;
- `name`;
- `email`;
- `password`;
- `email_verified_at`;
- `remember_token`;
- timestamps.

Migration tambahan menambahkan:

- `role`.

Nilai role digunakan oleh model `User::isAdmin()` untuk menentukan apakah akun memiliki akses dashboard admin.

### Tabel `categories`

Kolom utama:

- `id`;
- `name`;
- `slug`;
- timestamps.

Relasi:

```text
Category 1 ──── N Menu
```

Kategori digunakan sebagai pengelompokan pada halaman menu publik.

### Tabel `menus`

Migration tabel menu berisi:

- `category_id`;
- `name`;
- `slug`;
- `price`;
- `short_description_hover`;
- `description`;
- `image`;
- `spice_level`;
- `is_available`;
- `is_featured`;
- timestamps.

Relasi menu:

```text
Category 1 ──── N Menu 1 ──── N SalesTransaction
```

Kolom krusial:

- `category_id` adalah foreign key menuju kategori.
- `price` disimpan sebagai decimal.
- `slug` merupakan identitas URL dan bersifat unik.
- `is_available` menentukan apakah menu tampil kepada pelanggan.
- `is_featured` menentukan apakah menu masuk query menu unggulan homepage.
- `image` dapat berisi path lokal atau URL Firebase Storage.

Model `Menu` menyediakan:

- relasi `category`;
- relasi `salesTransactions`;
- atribut `formatted_price`;
- atribut `image_url`;
- atribut `total_sold`.

`image_url` dapat memilih gambar Firebase, file lokal, atau fallback gambar restoran berdasarkan nama dan slug menu.

### Tabel `promotions`

Tabel promo berisi:

- `id`;
- `title`;
- `description`;
- `discount_type`;
- `discount_value`;
- `banner_image`;
- `source`;
- `ai_strategy_text`;
- `is_active`;
- `valid_until`;
- timestamps.

Nilai `discount_type` dapat berupa:

- `percentage`;
- `fixed`;
- `bundling`.

Nilai `source` dapat:

- `manual`;
- `ai_generated`.

Kolom yang mengendalikan penampilan homepage adalah:

```text
is_active
valid_until
```

Model `Promotion` menyediakan cast:

- `is_active` sebagai boolean;
- `valid_until` sebagai date.

Model juga memiliki scope:

```php
Promotion::active()
```

Scope tersebut menerjemahkan `is_active = true`.

### Tabel `sales_transactions`

Tabel pencatatan penjualan berisi:

- `menu_id`;
- `quantity_sold`;
- `revenue`;
- `transaction_date`;
- `notes`;
- timestamps.

Setiap transaksi berelasi dengan satu menu:

```text
Menu 1 ──── N SalesTransaction
```

Ketika admin mencatat penjualan:

```text
revenue = harga menu × quantity_sold
```

Data tersebut menjadi dasar dashboard, grafik penjualan, produk terlaris, dan AI Promo Assistant.

### Tabel `franchise_packages`

Tabel paket franchise menyimpan informasi bisnis:

- nama paket;
- slug;
- harga;
- luas ruang;
- kapasitas;
- proyeksi ROI;
- deskripsi;
- highlight;
- daftar menu;
- gambar layout;
- jumlah staf;
- estimasi pendapatan;
- financial breakdown;
- warna;
- urutan tampilan.

Kolom berupa JSON disimpan sebagai text dan diproses sesuai kebutuhan halaman Blade.

## 5. CRUD Menu Backend

Pengelolaan menu berada pada `app/Http/Controllers/Admin/MenuController.php`.

### Fetch Data

Halaman index admin mengambil menu beserta kategorinya dan menampilkannya secara paginated.

Halaman menu publik mengambil hanya menu yang memenuhi:

```text
is_available = true
```

Frontend mendukung pencarian nama dan filter kategori.

### Create

Saat admin membuat menu:

1. Laravel memvalidasi kategori, nama, harga, level pedas, status, dan gambar.
2. Nama dikonversi menjadi slug unik dengan tambahan karakter acak.
3. Gambar dicoba diunggah ke Firebase Storage.
4. Jika berhasil, URL Firebase disimpan pada menu.
5. Jika gagal, gambar disimpan ke storage lokal.
6. Menu dibuat di database SQLite.
7. Data menu disinkronkan ke Firestore.

### Update

Saat admin memperbarui menu:

1. Data form divalidasi.
2. Status `is_available` dan `is_featured` diperbarui dari checkbox.
3. Jika ada gambar baru, gambar lama dihapus dan gambar baru diunggah.
4. Data model diperbarui di SQLite.
5. Firestore diperbarui.

### Delete

Saat menu dihapus:

1. Gambar menu dihapus dari penyimpanan.
2. Dokumen Firestore menu dihapus.
3. Menu dihapus dari database.
4. Transaksi penjualan yang terkait dihapus karena foreign key menggunakan cascade.

## 6. Fitur Promo dan Banner

### Pengelolaan Promo Manual

`PromotionController` menyediakan fungsi CRUD:

- index;
- create;
- store;
- edit;
- update;
- destroy.

Saat promo dibuat atau diperbarui, admin dapat mengatur:

- judul;
- deskripsi;
- tipe diskon;
- nilai diskon;
- banner gambar;
- status aktif;
- tanggal berlaku.

Banner upload disimpan pada:

```text
storage/app/public/promotions
```

Laravel storage link memungkinkan banner diakses melalui URL public.

### Toggle Status Aktif

Backend mengubah status melalui:

```text
$request->boolean('is_active')
```

Status tersebut disimpan pada kolom `promotions.is_active`.

Ketika status nonaktif, query homepage tidak akan mengambil promo tersebut.

Ketika status aktif tetapi tanggal berlaku sudah lewat, promo tetap tidak ditampilkan oleh query homepage.

### Aturan Penampilan Homepage

Homepage mengambil promo dengan aturan:

```text
is_active = true
dan
valid_until NULL atau valid_until >= tanggal hari ini
```

Promo yang memenuhi aturan akan diurutkan dari yang terbaru dan semua promo valid akan diteruskan ke Blade.

Dengan aturan ini:

- promo aktif dan belum berakhir ditampilkan;
- promo aktif tanpa tanggal berlaku ditampilkan terus;
- promo aktif tetapi sudah lewat tanggal disembunyikan;
- promo nonaktif disembunyikan meskipun tanggal masih berlaku.

### Position Section

Section `Promo Warung Mbah Darmo` berada sebelum section `Hidangan Khas` pada homepage.

Section hanya dirender jika collection `activePromotions` tidak kosong.

Setiap promo ditampilkan sebagai kartu yang berisi:

- banner atau placeholder gambar;
- judul;
- deskripsi;
- nilai diskon;
- tanggal berlaku;
- tombol menuju katalog menu.

## 7. Dashboard Admin dan Sinkronisasi Operasional

### Dashboard

`DashboardController` menghitung:

- jumlah menu;
- jumlah promo aktif;
- jumlah transaksi;
- produk terlaris;
- pendapatan 30 hari terakhir;
- penjualan selama 7 hari terakhir;
- lima menu teratas selama 30 hari terakhir.

Data dihitung langsung dari database melalui Eloquent dan Query Builder.

### Laporan Penjualan

Panel laporan menerima parameter periode, misalnya hari.

Backend mengambil:

- transaksi dalam periode;
- total pendapatan;
- jumlah item terjual;
- sepuluh produk terlaris dalam periode.

### Pencatatan Penjualan

Admin memasukkan:

- menu;
- jumlah;
- tanggal;
- catatan.

Backend memvalidasi data lalu menghitung pendapatan dari harga menu dan jumlah penjualan.

Fitur ini merupakan pencatatan operasional manual, bukan checkout pelanggan atau sistem pesanan online.

## 8. AI Promo Assistant

AI Promo Assistant berada pada `app/Http/Controllers/Admin/AiAssistantController.php`.

### API yang Digunakan

Fitur AI saat ini benar-benar menggunakan dua layanan:

1. **Groq API** untuk menghasilkan teks dan strategi promo.
2. **Wavespeed AI** untuk menghasilkan gambar banner.

Konfigurasi Geminin yang ada pada environment tidak digunakan oleh implementasi AI Promo saat ini. Alur promo tidak memanggil Google Gemini.

### Pemilihan Produk

Backend memanggil data penjualan 30 hari terakhir melalui join antara:

```text
sales_transactions
menus
```

Dari data tersebut:

- lima menu teratas digunakan sebagai data penjualan terlaris;
- lima menu terbawah digunakan sebagai kandidat produk yang perlu dipromosikan.

Admin dapat memilih produk yang ingin diproses. Jika tidak memilih produk, backend mengambil lima produk terbawah sebagai fallback.

### Alur Generate

1. Admin membuka AI Promo Assistant.
2. Admin memilih produk dan dapat memasukkan prompt.
3. Backend memilih tema promo secara acak.
4. Backend memilih layout berdasarkan jumlah produk.
5. Backend memilih lighting dan visual variation.
6. Backend mengirim data produk dan instruksi ke Groq.
7. Groq mengembalikan strategi teks dan deskripsi promo.
8. Backend menyusun image prompt untuk Wavespeed.
9. Wavespeed menghasilkan gambar banner.
10. Laravel menyimpan gambar banner ke storage public.
11. Output AI disimpan ke tabel `promotions`.
12. Promo baru disimpan dengan status nonaktif.

### Penyimpanan Output AI

Promo hasil AI disimpan sebagai:

```text
source = ai_generated
is_active = false
valid_until = tanggal hari ini ditambah 7 hari
```

Field yang disimpan mencakup:

- judul;
- strategi AI;
- deskripsi;
- tipe diskon;
- nilai diskon;
- banner gambar;
- tanggal berlaku.

### Publish

Setelah menghasilkan promo, admin dapat menekan publish.

Publish menjalankan pembaruan:

```text
is_active = true
```

Promo belum tentu langsung muncul jika:

- tanggal `valid_until` sudah lewat;
- promo mengalami perubahan status;
- belum ada dokumen yang dirender ulang oleh request halaman utama.

Homepage akan menampilkan promo setelah browser atau reload meminta route `/` dan query backend menemukan promo aktif yang valid.

## 9. Alur Data Homepage

### Request Homepage

Browser meminta:

```text
GET /
```

Route `/` mengarahkan request ke `HomeController::index()`.

### Pengambilan Data

Controller mengambil dua kelompok data utama:

1. Menu unggulan yang tersedia.
2. Promo aktif yang masih berlaku.

Menu unggulan memenuhi:

```text
is_featured = true
is_available = true
```

Promo memenuhi:

```text
is_active = true
valid_until kosong atau >= hari ini
```

Data tersebut dikirim sebagai variable Blade:

- `$featuredMenus`;
- `$activePromotions`.

### Rendering

Blade merender:

1. Hero section.
2. Warisan rasa.
3. Informasi kemitraan.
4. Section promo, jika ada.
5. Section Hidangan Khas, jika ada menu unggulan.
6. Testimonial statis.
7. Banner CTA.
8. Footer.

Section promo berada tepat sebelum section Hidangan Khas pada homepage.

Tidak ada sistem real-time push seperti WebSocket pada alur ini. Perubahan admin baru terlihat melalui halaman utama setelah data dibaca ulang melalui request berikutnya atau setelah halaman direload.

## 10. Hubungan Admin dengan Tampilan Website

### Mengaktifkan Promo

```text
Admin mengubah is_active menjadi aktif
  -> data disimpan ke SQLite
  -> homepage membuka route /
  -> HomeController memfilter status dan tanggal
  -> Blade merender section promo
```

### Menonaktifkan Promo

```text
Admin mengubah is_active menjadi nonaktif
  -> data disimpan ke SQLite
  -> HomeController tidak mengambil promo tersebut
  -> section promo hilang jika tidak ada promo valid lain
```

### Mengubah Tanggal Berlaku

Jika `valid_until` diubah menjadi tanggal yang sudah lewat, promo akan dikeluarkan oleh filter homepage meskipun status aktif tetap aktif.

Jika dikosongkan, promo dianggap berlaku terus.

### Mengubah atau Menghapus Banner

Banner lama dihapus dari disk public saat banner baru diunggah. Homepage membaca `banner_image` terbaru dari record promo.

Jika banner tidak tersedia, Blade menampilkan placeholder berisi judul promo dan ikon speaker.

### Mengubah Ketersediaan Menu

```text
Admin mengubah is_available menjadi false
  -> menu tidak ditarik halaman publik
  -> menu tidak muncul pada katalog
  -> menu tidak muncul sebagai menu unggulan homepage
```

### Mengubah Menu Unggulan

Jika `is_featured` aktif dan menu masih tersedia, menu dapat dimuat pada query homepage. Query mengambil maksimal enam menu unggulan.

## 11. Alur Menu Publik

Halaman menu mengambil data melalui `MenuController`.

Backend:

1. mengambil kategori dan jumlah menu yang tersedia;
2. mengambil menu `is_available = true`;
3. mendukung pencarian `search`;
4. mendukung filter kategori;
5. mengurutkan menu unggulan terlebih dahulu.

Blade kemudian memformat:

- nama menu;
- kategori;
- harga;
- deskripsi;
- gambar;
- level pedas.

## 12. Kondisi Fitur yang Belum Tersedia

Berdasarkan kode yang ditemukan:

- tidak ada tabel `orders`;
- tidak ada tabel `order_items`;
- tidak ada route checkout pelanggan;
- tidak ada integrasi Midtrans;
- tidak ada callback payment gateway;
- tidak ada status pembayaran;
- tidak ada invoice digital;
- tidak ada Snap token;
- tidak ada refund atau settlement transaksi;
- pencatatan `sales_transactions` adalah pencatatan penjualan manual oleh admin.

Dependensi atau konfigurasi yang menyebut MySQL, Gemini, atau payment gateway tidak dapat dianggap aktif jika tidak dipanggil dalam alur aplikasi.

Implementasi AI saat ini menggunakan:

- Groq untuk teks;
- Wavespeed untuk gambar;
- database SQLite untuk penyimpanan hasil promo;
- storage lokal public untuk banner hasil AI.

## 13. Pengujian

Proyek menggunakan PHPUnit melalui Laravel Testing.

Test feature promo memverifikasi:

- homepage dapat merender;
- promo aktif yang valid ditampilkan;
- promo aktif yang sudah melewati tanggal disembunyikan;
- promo nonaktif disembunyikan;
- section promo muncul sebelum section Hidangan Khas.

Pengujian menggunakan database isolasi sehingga tidak mengubah atau menghapus data pengguna aktual yang digunakan aplikasi.

## 14. Ringkasan Arsitektur

```text
Browser Pelanggan
      |
      | GET /
      v
Laravel Route
      |
      v
HomeController
      |
      +--> Query Menu Unggulan dari SQLite
      |
      +--> Query Promo Aktif dan Masa Berlaku dari SQLite
      |
      v
Blade Homepage
      |
      v
Section Promo + Section Hidangan Khas


Panel Administrator
      |
      | Login + role admin
      v
Admin Controller
      |
      +--> CRUD Menu ---> SQLite
      |                 -> Firebase Storage
      |                 -> Firestore sinkronisasi
      |
      +--> CRUD Promo ---> SQLite + Storage Lokal
      |
      +--> Laporan Penjualan ---> SQLite
      |
      +--> AI Promo Assistant ---> Groq API
                                -> Wavespeed AI
                                -> SQLite promo
                                -> Storage banner
```
