@extends('layouts.app')

@section('title', 'Warung Mbah Darmo')

@section('meta_description', 'Warung Mbah Darmo – Cita Rasa Warisan Jawa Otentik. Mie Gepeng Batok Arang legendaris, konsep kuliner heritage, dan peluang kemitraan franchise terpercaya di Yogyakarta.')

@section('extra-styles')

/* =========================================================
   HERO
   ========================================================= */

.hero-section {
    min-height: 100vh;
    height: 100vh;

    position: relative;
    overflow: hidden;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-top: -99px;
    padding-top: 73px;

    background-image:url("{{ asset('images/home/home.png') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.hero-section::before,
.hero-section::after {
    display: none !important;
    content: none !important;
}

.hero-section .container {
    position: relative;
    z-index: 2;
}

.hero-aura {
    display: none;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.18);

    color: #f5dfb0;

    padding: 7px 13px;
    border-radius: 3px;

    font-size: 9px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.hero-title {
    font-family: var(--font-heading);
    color: #fff;
    line-height: 1.03;
    font-weight: 700;
    max-width: 700px;
    margin: 0 auto;
    text-align: center;
}

.hero-section .d-flex.flex-wrap.gap-3.mb-5 {
    justify-content: center !important;
    width: 100%;
}

.hero-title .highlight {
    color: #fff;
    font-style: normal;
}

.hero-subtitle {
    max-width: 570px;
    color: rgba(255,255,255,0.82);
    font-family: var(--font-body);
    font-size: 13px;
    line-height: 1.7;
    font-style: normal;
}

.hero-section .hero-subtitle {
    text-align: center !important;
    margin-left: auto !important;
    margin-right: auto !important;
}

.hero-section .btn {
    border-radius: 3px;

    font-size: 10px;
    font-weight: 600;
}

.hero-section .btn-md-gold {
    background: #8f2920;
    border-color: #8f2920;
    color: #fff;
}

.hero-section .btn-md-outline {
    background: rgba(255,255,255,0.12);
    border-color: rgba(255,255,255,0.55) !important;
    color: #fff;
}

.hero-section .row.g-3 {
    display: none;
}

.hero-visual {
    display: none;
}

.value-image {
    width: 100%;
    height: 220px;
    overflow: hidden;
    border-radius: 14px;
    margin-bottom: 1.25rem;
}

.value-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.scroll-indicator {
    position: absolute;

    bottom: 22px;
    left: 50%;

    transform: translateX(-50%);

    z-index: 3;

    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;

    color: rgba(255,255,255,0.65);

    font-size: 8px;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.scroll-dot {
    width: 5px;
    height: 5px;

    background: #fff;

    border-radius: 50%;

    animation: scrollBounce 1.8s ease-in-out infinite;
}

@keyframes scrollBounce {
    0%,100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(7px);
    }
}


/* =========================================================
   PROMOTION
   Disembunyikan secara visual karena tidak ada di Figma
   ========================================================= */

.bg-md-warm.py-4 {
    display: none !important;
}


/* =========================================================
   GENERAL SECTION
   ========================================================= */

.section-label {
    color: #a33a2f;
    font-size: 8px;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: 600;
}

.section-title {
    font-family: var(--font-heading);

    color: #3b241c;

    font-size: clamp(1.5rem, 3vw, 2rem);

    line-height: 1.15;
}

.section-divider {
    width: 35px;
    height: 2px;

    margin: 12px auto;

    background: #a33a2f;
}

.text-md-muted {
    color: #77706a !important;
}


/* =========================================================
   SEJARAH / WARISAN
   Menggunakan class yang sudah ada
   ========================================================= */

section:has(.value-card) {
    background: #fffdf9;

    padding-top: 70px !important;
    padding-bottom: 75px !important;
}

section:has(.value-card) > .container > .text-center {
    margin-bottom: 42px !important;
}

/* Baris kartu dibuat relative + beri ruang bawah untuk overlap kartu tengah */
section:has(.value-card) .row.g-4 {
    max-width: 950px;

    margin-left: auto;
    margin-right: auto;

    position: relative;
    align-items: flex-start;

    padding-bottom: 55px;
}

section:has(.value-card) .value-card {
    background: transparent;

    border: none;

    border-radius: 0;

    padding: 0 !important;

    box-shadow: none !important;

    transform: none !important;

    display: flex;
    flex-direction: column;
}

section:has(.value-card) .value-card::before {
    display: none;
}

section:has(.value-card) .value-icon {
    width: 100%;
    height: 115px;

    border-radius: 4px;

    margin: 0 0 15px;

    border: none;

    background-size: cover;
    background-position: center;

    font-size: 0;

    position: relative;
}

/* Badge bintang kecil di tepi bawah setiap foto, sesuai figma */
section:has(.value-card) .value-icon::after {
    content: '\2726';

    position: absolute;
    bottom: -13px;
    left: 50%;
    transform: translateX(-50%);

    width: 26px;
    height: 26px;
    line-height: 26px;
    text-align: center;

    background: #fff;
    border-radius: 50%;

    color: #d2ad69;
    font-size: 11px;

    box-shadow: 0 2px 6px rgba(0,0,0,0.18);
}

section:has(.value-card) .col-md-6:nth-child(1) .value-icon {
    background-image: url("{{ asset('images/home/history-1985.jpg') }}");
}

section:has(.value-card) .col-md-6:nth-child(2) .value-icon {
    background-image: url("{{ asset('images/home/history-2005.jpg') }}");
}

section:has(.value-card) .col-md-6:nth-child(3) .value-icon {
    background-image: url("{{ asset('images/home/history-today.jpg') }}");
}

section:has(.value-card) .col-md-6:nth-child(4) {
    display: none;
}

/* Kartu tengah (2005): teks di atas, foto di bawah & diperbesar sampai overlap turun,
   sesuai posisi di figma. Hanya order/posisi CSS, HTML tidak diubah. */
section:has(.value-card) .col-md-6:nth-child(2) .value-icon {
    order: 4;

    height: auto;
    margin-top: 0;
    margin-bottom: 0;

    z-index: auto;

    box-shadow: none;
}

section:has(.value-card) .col-md-6:nth-child(2) h5 {
    order: 2;
}

section:has(.value-card) .col-md-6:nth-child(2) p {
    order: 3;
}

section:has(.value-card) .value-card h5 {
    font-family: var(--font-heading);

    color: #3b241c;

    font-size: 13px !important;

    margin-bottom: 7px !important;
}

section:has(.value-card) .value-card p {
    font-size: 9px !important;
    line-height: 1.65 !important;

    max-width: 200px;
}


/* =========================================================
   MENU HIGHLIGHT
   ========================================================= */

section:has(.menu-highlight-card) {
    background: #fffdf9 !important;

    padding-top: 70px !important;
    padding-bottom: 65px !important;
}

section:has(.menu-highlight-card) .section-label {
    color: #8f2920;
}

section:has(.menu-highlight-card) .section-title {
    font-size: 20px;
}

section:has(.menu-highlight-card) .menu-highlight-card {
    border: 1px solid #e8e0d8;

    border-radius: 5px;

    background: #fff;

    box-shadow: 0 3px 12px rgba(50,30,20,0.07);

    transition: all .25s ease;
}

section:has(.menu-highlight-card) .menu-highlight-card:hover {
    transform: translateY(-4px);

    box-shadow: 0 8px 20px rgba(50,30,20,0.10);
}

.menu-card-img-wrap {
    height: 150px !important;
}

.menu-card-img-wrap img {
    transition: transform .35s ease;
}

.menu-card-body {
    min-height: 105px;

    padding: 13px !important;
}

.menu-card-body h6 {
    font-family: var(--font-heading);

    color: #3b241c;

    font-size: 11px !important;
}

.menu-card-body p {
    font-size: 8px !important;

    line-height: 1.55 !important;

    color: #77706a !important;
}

.menu-card-badge {
    top: 9px;
    left: 9px;

    background: #a33a2f;

    border-radius: 3px;

    padding: 4px 7px;

    font-size: 7px;
}

section:has(.menu-highlight-card) .row.g-4 {
    max-width: 1050px;

    margin-left: auto;
    margin-right: auto;

    row-gap: 22px !important;
}

section:has(.menu-highlight-card) .col-md-6:nth-child(n+4) {
    display: none;
}

section:has(.menu-highlight-card) .btn-md-primary {
    margin-top: 4px;
}


/* =========================================================
   MENGAPA BERMITRA
   ========================================================= */

section:has(.why-item) {
    background: #f3efe8;

    padding-top: 65px !important;
    padding-bottom: 65px !important;
}

section:has(.why-item) .section-label {
    color: #8f2920;
}

section:has(.why-item) .section-title {
    font-size: 25px;
}

section:has(.why-item) .section-divider {
    margin-left: 0;
}

/* Figma hanya menampilkan 3 kartu sejajar (bukan grid 2x2 dari 4 item) */
section:has(.why-item) .col-lg-8 .row.g-3 {
    display: flex;
    flex-wrap: wrap;
}

section:has(.why-item) .col-lg-8 .row.g-3 > .col-md-6:nth-child(-n+3) {
    flex: 0 0 33.3333%;
    max-width: 33.3333%;
}

section:has(.why-item) .col-lg-8 .row.g-3 > .col-md-6:nth-child(4) {
    display: none;
}

section:has(.why-item) .why-item {
    height: 100%;

    padding: 19px !important;

    background: #fff;

    border: none;

    border-radius: 5px;

    box-shadow: 0 2px 8px rgba(50,30,20,0.05);

    transition: all .25s ease;
}

section:has(.why-item) .why-item:hover {
    background: #fff;

    border-color: transparent;

    box-shadow: 0 6px 15px rgba(50,30,20,0.08);

    transform: translateY(-3px);
}

section:has(.why-item) .why-num {
    min-width: auto;

    width: 25px;
    height: 25px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f1e4dc;

    border-radius: 50%;

    color: #8f2920;

    font-family: var(--font-body);

    font-size: 9px;
}

/* Angka asli disembunyikan (bukan dihapus dari HTML) dan diganti glyph ikon
   sesuai figma via ::before, per posisi kartu */
section:has(.why-item) .why-num {
    font-size: 0;
    position: relative;
}

section:has(.why-item) .why-num::before {
    font-size: 11px;
    line-height: 1;
}

section:has(.why-item) .why-item h6 {
    font-family: var(--font-heading);

    color: #3b241c;

    font-size: 11px !important;
}

section:has(.why-item) .why-item p {
    font-size: 8px !important;

    line-height: 1.6 !important;
}


/* =========================================================
   BUTTON
   ========================================================= */

.btn-md-primary {
    background: #8f2920;

    border: 1px solid #8f2920;

    color: #fff;

    border-radius: 3px;

    font-size: 9px;

    font-weight: 600;

    padding: 9px 18px;
}

.btn-md-primary:hover {
    background: #722018;

    border-color: #722018;

    color: #fff;
}


/* =========================================================
   CTA
   ========================================================= */

.cta-section {
    background: #3b241f !important;

    padding-top: 70px !important;
    padding-bottom: 70px !important;
}

.cta-section::before {
    background: none;
}

.cta-section .ornament-divider {
    color: #c69a50;

    font-size: 10px;

    letter-spacing: 5px;
}

.cta-section .section-label {
    color: #d2ad69 !important;

    font-size: 8px;
}

.cta-section .section-title {
    color: #fff !important;

    font-size: clamp(1.5rem, 3vw, 2rem) !important;
}

.cta-section p {
    max-width: 570px;

    margin-left: auto;
    margin-right: auto;

    font-size: 10px !important;

    line-height: 1.7 !important;
}

.cta-section .btn-md-gold {
    background: #e99a00;

    border-color: #e99a00;

    color: #fff;

    border-radius: 3px;
}

.cta-section .btn-whatsapp {
    background: transparent;

    border: 1px solid rgba(255,255,255,0.45);

    border-radius: 3px;

    color: #fff;
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 767.98px) {

    .hero-section {
        min-height: 600px;
        height: 600px;

        background-position: center;
    }

    .hero-title {
        font-size: 2.6rem;
    }

    .hero-subtitle {
        font-size: 12px;
    }

    section:has(.value-card) {
        padding-top: 55px !important;
        padding-bottom: 55px !important;
    }

    section:has(.value-card) .value-icon {
        height: 150px;
    }

    /* Di layar sempit, susunan bertumpuk kartu tengah dimatikan agar tetap rapi */
    section:has(.value-card) .col-md-6:nth-child(2) .value-icon {
        order: initial;
        height: 150px;
        margin-top: 0;
        margin-bottom: 15px;
    }

    section:has(.value-card) .col-md-6:nth-child(2) h5 {
        order: initial;
    }

    section:has(.value-card) .col-md-6:nth-child(2) p {
        order: initial;
    }

    section:has(.value-card) .row.g-4 {
        padding-bottom: 0;
    }

    section:has(.why-item) {
        padding-top: 55px !important;
        padding-bottom: 55px !important;
    }

    section:has(.why-item) .col-lg-5 {
        padding-right: 12px;
    }

    section:has(.why-item) .col-lg-8 .row.g-3 > .col-md-6:nth-child(-n+3) {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .menu-card-img-wrap {
        height: 180px !important;
    }

}

/* ================================
   UKURAN FONT HOMEPAGE
   ================================ */

.hero-title {
    font-size: 64px !important;
}

.hero-subtitle {
    font-size: 17px !important;
}

.hero-badge {
    font-size: 13px !important;
}

.hero-stat .num {
    font-size: 32px !important;
}

.hero-stat .label {
    font-size: 13px !important;
}


/* SECTION */

.section-label {
    font-size: 12px !important;
}

.section-title {
    font-size: 36px !important;
}

.text-md-muted {
    font-size: 15px !important;
}


/* VALUE CARD */

.value-card h5 {
    font-size: 18px !important;
}

.value-card p {
    font-size: 14px !important;
}


/* MENU */

.menu-card-body h6 {
    font-size: 17px !important;
}

.menu-card-body p {
    font-size: 14px !important;
}


/* WHY PARTNER */

.why-item h6 {
    font-size: 17px !important;
}

.why-item p {
    font-size: 14px !important;
}

.why-num {
    font-size: 36px !important;
}


/* BUTTON */

.btn-md-primary,
.btn-md-gold,
.btn-whatsapp {
    font-size: 14px !important;
}


/* CTA */

.cta-section .section-label {
    font-size: 12px !important;
}

.cta-section .section-title {
    font-size: 42px !important;
}

.cta-section p {
    font-size: 16px !important;
}

/* ================================
   SEJARAH / WARISAN
   ================================ */

section:has(.value-card) .value-card h5 {
    font-family: var(--font-heading);
    color: #3b241c;
    font-size: 20px !important;
    margin-bottom: 7px !important;
}

section:has(.value-card) .value-card p {
    font-size: 14px !important;
    line-height: 1.65 !important;
    max-width: 200px;
}


/* ================================
   MENGAPA BERMITRA
   ================================ */

section:has(.why-item) .why-item p {
    font-size: 15px !important;
    line-height: 1.7 !important;
}

section:has(.why-item) .why-item h6 {
    font-size: 18px !important;
    line-height: 1.4 !important;
}

.why-num {
    font-size: 38px !important;
}

/* Menyamakan posisi teks pada kartu sejarah */
section:has(.value-card) .value-icon {
    display: none !important;
}

section:has(.value-card) .value-image {
    width: 100%;
    height: 220px;
    overflow: hidden;
    border-radius: 14px;
    margin-bottom: 1.25rem;
}

section:has(.value-card) .value-card h5 {
    margin-top: 0 !important;
}

@endsection


@section('content')

{{-- =========================================================
     HERO
     ========================================================= --}}

<section class="hero-section">

    <div class="hero-aura aura-1"></div>
    <div class="hero-aura aura-2"></div>

    <div class="container py-5 position-relative">

        <div class="row align-items-center justify-content-center">
            
        <div class="col-lg-8 text-center">

                <div class="hero-badge mb-4">
                    <span>✦</span>
                    <span>Warisan Jawa Asli</span>
                </div>

                <h1 class="hero-title mb-3">
                    Rasa Jawa,<br>
                    <span class="highlight">Cara Mbah Darmo</span>
                </h1>

                <p class="hero-subtitle mb-4">
                    Rasakan kehangatan resep tradisional Jawa yang dihidupkan
                    dengan presisi waralaba modern. Sebuah warisan rasa,
                    dibangun untuk masa depan.
                </p>

                <div class="d-flex flex-wrap gap-3 mb-5">

                    <a href="{{ route('franchise.index') }}"
                       class="btn btn-md-gold px-4 py-3">
                        Mulai Perjalanan Anda
                    </a>

                    <a href="{{ route('menu.index') }}"
                       class="btn btn-md-outline px-4 py-3">
                        Lihat Menu
                    </a>

                </div>

            </div>

        </div>

    </div>

    <div class="scroll-indicator">

        <div class="scroll-dot"></div>

        <span>Scroll</span>

    </div>

</section>


{{-- =========================================================
     SEJARAH WARISAN
     ========================================================= --}}

<section class="py-6 py-md-5"
         style="padding-top:5rem; padding-bottom:5rem;">

    <div class="container">

        <div class="text-center mb-5 fade-in-up">

            <span class="section-label">
                Sebuah Warisan Rasa
            </span>

            <h2 class="section-title mt-2">
                Sebuah Warisan Rasa
            </h2>

            <div class="section-divider"></div>

            <p class="text-md-muted mx-auto mt-3"
               style="max-width:560px; font-size:1rem;">

                Dari warung sederhana hingga kerajaan waralaba modern,
                perjalanan kami berakar pada keaslian dan didorong oleh semangat.

            </p>

        </div>


        <div class="row g-4">

            @foreach([

    [
        '1985',
        'Warung Pertama',
        'Mbah Darmo membuka warung sederhana pertamanya di Yogyakarta dengan resep yang diwariskan dari generasi ke generasi.',
        'images/home/IMG_4493.jpg'
    ],

    [
        '2005',
        'Modernisasi',
        'Membakukan campuran rempah rahasia untuk memastikan kualitas yang konsisten tanpa kehilangan jiwa otentiknya.',
        'images/home/IMG_4614.jpg'
    ],

    [
        'Hari Ini',
        'Kehadiran Nasional',
        'Jaringan waralaba yang berkembang pesat membawa cita rasa Mbah Darmo ke berbagai kota di seluruh negeri.',
        'images/home/IMG_4628.jpg'
    ]

] as [$icon, $title, $desc, $image])

<div class="col-md-6 col-lg-4 fade-in-up">

    <div class="value-card h-100">

        {{-- TAMBAHAN GAMBAR --}}
        <div class="value-image">
            <img src="{{ asset($image) }}" alt="{{ $title }}">
        </div>

        <div class="value-icon">
            {{ $icon }}
        </div>

        <h5 class="mb-2">
            {{ $title }}
        </h5>

        <p class="text-md-muted mb-0">
            {{ $desc }}
        </p>

    </div>

</div>

@endforeach

        </div>


        <div class="text-center mt-4">

            <span style="
                color:#a33a2f;
                font-size:14px;
                font-weight:600;
            ">
                Baca Cerita Lengkapnya →
            </span>

        </div>

    </div>

</section>


{{-- =========================================================
     MENGAPA BERMITRA
     ========================================================= --}}

<section class="py-5">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-4 fade-in-up">

                <span class="section-label">
                    Kenapa Mbah Darmo?
                </span>

                <h2 class="section-title mt-2 mb-3">
                    Mengapa Bermitra Dengan Kami?
                </h2>

                <div class="section-divider"
                     style="margin-left:0;">
                </div>

                <p class="text-md-muted mt-3 mb-4">

                    Kami memadukan rasa nostalgia yang kaya dari masakan
                    tradisional Jawa dengan sistem bisnis modern yang sangat
                    dioptimalkan yang dirancang untuk profitabilitas dan skala.

                </p>

            </div>


            <div class="col-lg-8">

                <div class="row g-3">

                    @foreach([

                        [
                            '1',
                            'Rasa Asli',
                            'Produksi rempah terpusat memastikan setiap mangkok yang disajikan di seluruh gerai mempertahankan standar mengesankan.'
                        ],

                        [
                            '2',
                            'Sistem Terbukti',
                            'Panduan operasional siap pakai, pelatihan staf yang ketat, dan rantai pasokan yang efisien meminimalkan risiko dan memaksimalkan skala.'
                        ],

                        [
                            '3',
                            'ROI Tinggi',
                            'Struktur biaya yang dioptimalkan dan permintaan pasar yang tinggi memberikan pengembalian cepat bagi investor maupun wirausahawan pemula.'
                        ],

                        [
                            '4',
                            'Marketing & Digital Support',
                            'Dukungan penuh materi marketing digital dan akses database pelanggan regional Mbah Darmo.'
                        ]

                    ] as [$num, $title, $desc])

                    <div class="col-md-6 fade-in-up">

                        <div class="why-item">

                            <div class="why-num">
                                {{ $num }}
                            </div>

                            <div>

                                <h6 class="mb-1">
                                    {{ $title }}
                                </h6>

                                <p class="text-md-muted mb-0">
                                    {{ $desc }}
                                </p>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     CITA RASA WARISAN
     ========================================================= --}}

@if($featuredMenus->count() > 0)

<section class="py-5 bg-md-warm">

    <div class="container">

        <div class="text-center mb-5 fade-in-up">

            <span class="section-label">
                Hidangan Khas
            </span>

            <h2 class="section-title mt-2">
                Cita Rasa Warisan
            </h2>

            <div class="section-divider"></div>

        </div>


        <div class="row g-4">

            @foreach($featuredMenus->take(3) as $menu)

            <div class="col-md-6 col-lg-4 fade-in-up">

                <div class="menu-highlight-card">

                    <div class="menu-card-img-wrap">

                        @if($menu->image)

                            <img
                                src="{{ asset('storage/' . $menu->image) }}"
                                alt="{{ $menu->name }}"
                            >

                        @else

                            <div class="menu-card-img-placeholder">

                                @if(str_contains(strtolower($menu->name), 'mie'))
                                    🍜
                                @elseif(str_contains(strtolower($menu->name), 'kopi'))
                                    ☕
                                @elseif(str_contains(strtolower($menu->name), 'nasi'))
                                    🍚
                                @else
                                    🍽️
                                @endif

                            </div>

                        @endif

                        <span class="menu-card-badge">
                            {{ $menu->category->name }}
                        </span>

                    </div>


                    <div class="menu-card-body">

                        <h6 class="mb-1">
                            {{ $menu->name }}
                        </h6>

                        <p class="text-md-muted mb-2">

                            {{ Str::limit(
                                $menu->short_description_hover,
                                80
                            ) }}

                        </p>

                        <div class="d-flex justify-content-between align-items-center">

                            <span style="
                                color:#8f2920;
                                font-weight:600;
                                font-size:10px;
                            ">
                                {{ $menu->formatted_price }}
                            </span>

                            @if($menu->spice_level && $menu->spice_level !== 'mild')

                                <span style="
                                    font-size:9px;
                                ">

                                    @if($menu->spice_level === 'hot')
                                        🌶️🌶️
                                    @elseif($menu->spice_level === 'medium')
                                        🌶️
                                    @elseif($menu->spice_level === 'extra-hot')
                                        🌶️🌶️🌶️
                                    @endif

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>


        <div class="text-center mt-4 fade-in-up">

            <a href="{{ route('menu.index') }}"
               class="btn btn-md-primary px-5 py-3">

                Jelajahi Menu Lengkap

            </a>

        </div>

    </div>

</section>

@endif


{{-- =========================================================
     CTA FRANCHISE
     ========================================================= --}}

<section class="cta-section py-5 text-white"
         style="padding-top:5rem; padding-bottom:5rem;">

    <div class="container position-relative">

        <div class="row justify-content-center text-center">

            <div class="col-lg-7 fade-in-up">

                <div class="ornament-divider mb-4">
                    ✦ ✦ ✦
                </div>

                <span class="section-label">
                    Mulai Perjalanan Anda
                </span>

                <h2 class="section-title mt-2 mb-3">

                    Siap Membangun
                    <br>

                    <span style="
                        color:#d2ad69;
                        font-style:italic;
                    ">
                        Warisan Anda?
                    </span>

                </h2>

                <p>

                    Bergabunglah dengan keluarga Mbah Darmo.
                    Bawa cita rasa Jawa asli dan model bisnis
                    yang terbukti ke kota Anda.

                </p>

                <div class="d-flex gap-3 justify-content-center flex-wrap">

                    <a href="{{ route('franchise.index') }}"
                       class="btn btn-md-gold px-5 py-3">

                        Dapatkan Kit Waralaba

                    </a>

                    <a href="https://wa.me/6281383045066?text=Halo%20Tim%20Mbah%20Darmo,%20saya%20ingin%20konsultasi%20tentang%20peluang%20kemitraan"
                       class="btn btn-whatsapp px-5 py-3"
                       target="_blank">

                        Konsultasi via WhatsApp

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection