@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Warung Mbah Darmo – Cita Rasa Warisan Jawa Otentik. Bakmie Jawa Arang legendaris, Sate Rempah, dan peluang kemitraan franchise kuliner heritage terpercaya.')

@section('extra-styles')
<style>
    /* =========================================================
       HERO SECTION (WARM JAVANESE INTERIOR WITH DARK OVERLAY)
       ========================================================= */
    .hero-section {
        min-height: 88vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8.5rem 0 6rem;
        background-color: #1A100A;
        background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.65) 100%), url('{{ asset("images/home/home.png") }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }

    /* Utility classes for responsive image sizing */
    .w-full { width: 100% !important; }
    .h-48 { height: 12rem !important; }
    .object-cover { object-fit: cover !important; }
    .rounded-lg { border-radius: 0.5rem !important; }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(253, 248, 242, 0.12);
        border: 1px solid rgba(253, 248, 242, 0.35);
        color: rgba(255, 255, 255, 0.95);
        padding: 5px 16px;
        border-radius: var(--radius-pill);
        font-size: 0.76rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(8px);
    }

    .hero-title {
        font-family: var(--font-heading);
        font-size: clamp(2.4rem, 5vw, 3.8rem);
        color: #FFFFFF !important;
        line-height: 1.18;
        font-weight: 700;
        margin-bottom: 1.25rem;
        text-shadow: none !important;
    }

    .hero-title .highlight {
        color: #FFFFFF !important;
        font-style: normal;
    }

    .hero-subtitle {
        max-width: 620px;
        color: rgba(255, 255, 255, 0.92) !important;
        font-family: var(--font-body);
        font-size: clamp(0.95rem, 1.15vw, 1.05rem);
        line-height: 1.75;
        margin: 0 auto 2.25rem;
        font-weight: 400;
    }

    /* =========================================================
       SECTION 1: SEBUAH WARISAN RASA (3 KOLOM)
       ========================================================= */
    .history-card {
        background: #FFFFFF;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        height: 100%;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-subtle);
    }

    .history-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: rgba(168, 50, 38, 0.25);
    }

    .history-image-wrap {
        width: 100%;
        height: 12rem;
        overflow: hidden;
        border-radius: 0.5rem;
        margin-bottom: 1.25rem;
        background: var(--md-bg-warm);
    }

    .history-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        display: block;
    }

    .history-card:hover .history-image-wrap img {
        transform: scale(1.05);
    }

    .history-card h5 {
        font-family: var(--font-heading);
        font-size: 1.25rem;
        color: var(--md-wood);
        margin-bottom: 0.5rem;
    }

    .history-card p {
        font-size: 0.9rem;
        color: var(--md-text-muted);
        line-height: 1.65;
        margin-bottom: 0;
    }

    /* =========================================================
       SECTION 2: MENGAPA BERMITRA (SPLIT 2 KOLOM)
       ========================================================= */
    .why-partner-card {
        background: #FFFFFF;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-md);
        padding: 1.35rem 1.25rem;
        transition: var(--transition);
        display: flex;
        gap: 1.25rem;
        align-items: flex-start;
        box-shadow: var(--shadow-subtle);
    }

    .why-partner-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: rgba(168, 50, 38, 0.25);
    }

    .why-partner-num {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--md-bg-warm);
        color: var(--md-primary);
        font-family: var(--font-heading);
        font-size: 1.35rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid rgba(168, 50, 38, 0.15);
    }

    .why-partner-card h6 {
        font-family: var(--font-heading);
        font-size: 1.1rem;
        color: var(--md-wood);
        margin-bottom: 0.25rem;
    }

    .why-partner-card p {
        font-size: 0.88rem;
        color: var(--md-text-muted);
        line-height: 1.55;
        margin-bottom: 0;
    }

    /* =========================================================
       SECTION 3: MENU FAVORIT (VIEW-ONLY CATALOG)
       ========================================================= */
    .menu-fav-card {
        background: #FFFFFF;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-md);
        overflow: hidden;
        height: 100%;
        transition: var(--transition);
        box-shadow: var(--shadow-subtle);
        display: flex;
        flex-direction: column;
    }

    .menu-fav-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: rgba(168, 50, 38, 0.25);
    }

    .menu-fav-img-wrap {
        height: 195px;
        overflow: hidden;
        position: relative;
        background: var(--md-bg-warm);
    }

    .menu-fav-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        display: block;
    }

    .menu-fav-card:hover .menu-fav-img-wrap img {
        transform: scale(1.06);
    }

    .menu-fav-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(44, 27, 19, 0.85);
        backdrop-filter: blur(4px);
        color: var(--md-gold-light);
        font-size: 0.7rem;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: var(--radius-pill);
    }

    .menu-fav-body {
        padding: 1.25rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .menu-fav-body h6 {
        font-family: var(--font-heading);
        font-size: 1.15rem;
        color: var(--md-wood);
        margin-bottom: 0.35rem;
    }

    .menu-fav-price {
        color: var(--md-primary);
        font-weight: 700;
        font-size: 1.05rem;
    }

    /* =========================================================
       SECTION 4: PROMO AKTIF (RESPONSIF & SELARAS HERITAGE)
       ========================================================= */
    .promotion-section {
        background: linear-gradient(180deg, #FDF8F2 0%, var(--md-bg-warm) 100%);
        border-top: 1px solid var(--md-border);
        border-bottom: 1px solid var(--md-border);
        position: relative;
    }

    /* Showcase Wide Card (1 Promo Aktif) */
    .promo-showcase-card {
        background: #FFFFFF;
        border: 1.5px solid rgba(168, 50, 38, 0.2);
        border-radius: var(--radius-lg);
        box-shadow: 0 12px 36px rgba(44, 27, 19, 0.08);
        overflow: hidden;
        transition: var(--transition);
    }
    .promo-showcase-card:hover {
        box-shadow: 0 18px 48px rgba(44, 27, 19, 0.12);
        border-color: rgba(168, 50, 38, 0.35);
    }

    .promo-badge-live {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #FDEDEC;
        color: var(--md-primary);
        border: 1px solid rgba(168, 50, 38, 0.2);
        padding: 4px 12px;
        border-radius: var(--radius-pill);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .promo-pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--md-primary);
        display: inline-block;
        animation: promoPulse 1.8s infinite;
    }
    @keyframes promoPulse {
        0% { transform: scale(0.9); opacity: 0.8; box-shadow: 0 0 0 0 rgba(192, 57, 43, 0.7); }
        70% { transform: scale(1.1); opacity: 1; box-shadow: 0 0 0 6px rgba(192, 57, 43, 0); }
        100% { transform: scale(0.9); opacity: 0.8; }
    }

    .promo-badge-discount {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: linear-gradient(135deg, #FFF6D6 0%, #FFEBA3 100%);
        color: #8C6200;
        border: 1px solid #F5D77F;
        padding: 4px 14px;
        border-radius: var(--radius-pill);
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .promo-badge-validity {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: var(--md-text-muted);
        font-size: 0.75rem;
        font-weight: 500;
    }

    .promo-featured-title {
        font-family: var(--font-heading);
        font-size: clamp(1.5rem, 2.6vw, 2.2rem);
        color: var(--md-wood);
        line-height: 1.25;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .promo-headline-tag {
        color: var(--md-primary);
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 0.35rem;
    }

    .promo-copywriting-lead {
        font-size: clamp(0.92rem, 1.1vw, 1.02rem);
        color: var(--md-text);
        line-height: 1.7;
        font-style: italic;
        margin-bottom: 1.25rem;
        background: #FAF6F0;
        padding: 0.85rem 1.15rem;
        border-left: 3.5px solid var(--md-primary);
        border-radius: 0 8px 8px 0;
    }

    .promo-strategy-box {
        font-size: 0.85rem;
        color: var(--md-text-muted);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .promo-poster-frame {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 320px;
        max-height: 460px;
        border-radius: 14px;
        overflow: hidden;
        background: var(--md-bg-warm);
        box-shadow: 0 8px 24px rgba(44, 27, 19, 0.12);
        border: 1px solid var(--md-border);
    }
    .promo-poster-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        transition: transform 0.5s ease;
        display: block;
    }
    .promo-showcase-card:hover .promo-poster-frame img {
        transform: scale(1.03);
    }
    .promo-poster-ribbon {
        position: absolute;
        top: 14px;
        right: 14px;
        background: linear-gradient(135deg, #C0392B, #922B21);
        color: #FFFFFF;
        padding: 6px 14px;
        border-radius: var(--radius-pill);
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(192, 57, 43, 0.4);
        border: 1.5px solid rgba(255, 255, 255, 0.3);
    }

    /* Grid cards for multiple promos */
    .promotion-card {
        background: #FFFFFF;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-md);
        overflow: hidden;
        height: 100%;
        box-shadow: var(--shadow-subtle);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }
    .promotion-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: rgba(168, 50, 38, 0.25);
    }
    .promotion-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }
    .promotion-card:hover .promotion-image {
        transform: scale(1.05);
    }
    .promotion-placeholder {
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--md-primary-dark), var(--md-primary));
        color: #FFFFFF;
        text-align: center;
        padding: 2rem;
    }
    .promotion-body {
        padding: 1.35rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .promotion-body h5 {
        font-size: 1.15rem;
        color: var(--md-wood);
        font-family: var(--font-heading);
        margin-bottom: 0.45rem;
    }

    /* =========================================================
       SECTION 5: TESTIMONIAL CARDS
       ========================================================= */
    .testi-card {
        background: #FFFFFF;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-md);
        padding: 1.35rem 1.25rem;
        height: 100%;
        transition: var(--transition);
        box-shadow: var(--shadow-subtle);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .testi-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: rgba(168, 50, 38, 0.2);
    }

    .testi-stars {
        color: #F5A623;
        font-size: 0.82rem;
        margin-bottom: 0.6rem;
    }

    .testi-text {
        font-size: 0.88rem;
        color: var(--md-text);
        line-height: 1.6;
        font-style: italic;
        margin-bottom: 1rem;
    }

    .testi-author-info h6 {
        font-family: var(--font-heading);
        font-size: 0.95rem;
        color: var(--md-wood);
        margin-bottom: 0.1rem;
    }

    .testi-author-info span {
        font-size: 0.75rem;
        color: var(--md-text-muted);
    }

    /* =========================================================
       SECTION 6: BANNER CTA (DEEP WOOD BROWN BACKGROUND)
       ========================================================= */
    .cta-banner-section {
        background: #2C1B13;
        padding: 4.5rem 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: #FFFFFF;
        text-align: center;
    }

    .cta-subheading {
        color: var(--md-gold-light);
        font-size: 0.8rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: inline-block;
    }

    .cta-title {
        font-family: var(--font-heading);
        font-size: clamp(2rem, 4vw, 3rem);
        color: #FFFFFF;
        margin-bottom: 1rem;
    }

    .cta-desc {
        color: rgba(253, 248, 242, 0.85);
        font-size: 1.05rem;
        line-height: 1.8;
        max-width: 620px;
        margin: 0 auto 2rem;
    }

    /* Uniform Section Spacing */
    .section-tight {
        padding-top: 3.25rem;
        padding-bottom: 3.25rem;
    }
</style>
@endsection

@section('content')

{{-- =========================================================
     A. HERO SECTION (OVERLAY GELAP HALUS, TANPA FLOATER)
     ========================================================= --}}
<section class="hero-section text-center text-white">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-lg-9 fade-in-up">
                
                <div class="hero-badge">
                    <span>WARISAN JAWA ASLI</span>
                </div>

                <h1 class="hero-title" style="color: #FFFFFF !important; font-size: clamp(2.4rem, 4.8vw, 3.8rem); line-height: 1.25; margin-bottom: 1.25rem;">
                    Rasa Jawa, Cara Mbah Darmo
                </h1>

                <p class="hero-subtitle" style="color: rgba(255, 255, 255, 0.92) !important;">
                    Rasakan kehangatan resep tradisional Jawa yang dihidupkan dengan presisi waralaba modern. Sebuah warisan rasa, dibangun untuk masa depan.
                </p>

                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ route('franchise.index') }}" class="btn-terracotta">
                        <span>Mulai Perjalanan Anda</span>
                    </a>

                    <a href="{{ route('menu.index') }}" class="btn-ghost-cream">
                        <span>Lihat Menu</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>


{{-- =========================================================
     B. SECTION SEBUAH WARISAN RASA (3 GRID GAMBAR RAPI)
     ========================================================= --}}
<section class="section-tight" style="background: #FDF8F2;">
    <div class="container">
        
        <div class="text-center mb-4 fade-in-up">
            <span class="section-label">Sebuah Warisan Rasa</span>
            <h2 class="section-title">Perjalanan Cita Rasa Otentik</h2>
            <div class="section-divider"></div>
            <p class="text-md-muted mx-auto" style="max-width: 580px; font-size: 0.95rem;">
                Dari warung sederhana hingga kerajaan waralaba modern, perjalanan kami berakar pada keaslian dan didorong oleh semangat.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach([
                [
                    'Warung Pertama',
                    'Mbah Darmo membuka warung sederhana pertamanya di Yogyakarta dengan resep yang diwariskan dari generasi ke generasi.',
                    'images/home/IMG_4493.jpg'
                ],
                [
                    'Modernisasi',
                    'Membakukan campuran rempah rahasia untuk memastikan kualitas yang konsisten tanpa kehilangan jiwa otentiknya.',
                    'images/home/IMG_4614.jpg'
                ],
                [
                    'Kehadiran Nasional',
                    'Jaringan waralaba yang berkembang pesat membawa cita rasa Mbah Darmo ke berbagai kota di seluruh negeri.',
                    'images/home/IMG_4628.jpg'
                ]
            ] as [$title, $desc, $image])
            <div class="col-md-6 col-lg-4 fade-in-up">
                <div class="history-card">
                    <div class="history-image-wrap mb-3">
                        <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full h-48 object-cover rounded-lg" loading="lazy">
                    </div>
                    <h5>{{ $title }}</h5>
                    <p>{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4 fade-in-up">
            <a href="{{ route('franchise.index') }}" style="color: var(--md-primary); font-size: 0.95rem; font-weight: 700; text-decoration: none;">
                Baca Cerita Lengkapnya &rarr;
            </a>
        </div>

    </div>
</section>


{{-- =========================================================
     C. SECTION MENGAPA BERMITRA DENGAN KAMI? (SPLIT 2 KOLOM)
     ========================================================= --}}
<section class="section-tight" style="background: var(--md-bg-warm); border-top: 1px solid var(--md-border); border-bottom: 1px solid var(--md-border);">
    <div class="container">
        
        <div class="row align-items-center g-4">
            
            {{-- KOLOM KIRI: DESKRIPSI BISNIS --}}
            <div class="col-lg-4 fade-in-up">
                <span class="section-label">Kenapa Mbah Darmo?</span>
                <h2 class="section-title">Mengapa Bermitra Dengan Kami?</h2>
                <div class="section-divider start"></div>
                <p class="text-md-muted mb-4" style="font-size: 0.95rem;">
                    Kami memadukan rasa nostalgia yang kaya dari masakan tradisional Jawa dengan sistem bisnis modern yang sangat dioptimalkan yang dirancang untuk profitabilitas dan skala.
                </p>
                <a href="{{ route('franchise.index') }}" class="btn-terracotta">
                    <i class="bi bi-arrow-right-circle"></i>
                    <span>Pelajari Kemitraan</span>
                </a>
            </div>

            {{-- KOLOM KANAN: 3 CARD PUTIH BERNOMOR --}}
            <div class="col-lg-8">
                <div class="d-flex flex-column gap-3">
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
                        ]
                    ] as [$num, $title, $desc])
                    <div class="fade-in-up">
                        <div class="why-partner-card">
                            <div class="why-partner-num">{{ $num }}</div>
                            <div>
                                <h6>{{ $title }}</h6>
                                <p>{{ $desc }}</p>
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
     D. SECTION PROMO AKTIF (HANYA MUNCUL JIKA STATUS PROMO AKTIF)
     ========================================================= --}}
@if(isset($activePromotions) && $activePromotions->count() > 0)
<section class="section-tight promotion-section">
    <div class="container">
        
        <div class="text-center mb-4 fade-in-up">
            <span class="section-label">Penawaran Istimewa</span>
            <h2 class="section-title">Promo Spesial Warung Mbah Darmo</h2>
            <div class="section-divider"></div>
            <p class="text-md-muted mx-auto" style="max-width: 580px; font-size: 0.95rem;">
                Nikmati perpaduan cita rasa autentik heritage Jawa dengan penawaran hemat istimewa hari ini.
            </p>
        </div>

        @if($activePromotions->count() === 1)
            {{-- TAMPILAN SHOWCASE HERO CARD (JIKA HANYA 1 PROMO AKTIF) --}}
            @php $singlePromo = $activePromotions->first(); @endphp
            <div class="row justify-content-center">
                <div class="col-lg-11 fade-in-up">
                    <article class="promo-showcase-card p-3 p-md-4 p-lg-5">
                        <div class="row g-4 align-items-center">
                            
                            {{-- KOLOM KIRI: DETAIL PROMO, COPYWRITING & TOMBOL CTA --}}
                            <div class="col-lg-7 order-2 order-lg-1">
                                <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                                    <span class="promo-badge-live">
                                        <span class="promo-pulse-dot"></span> Promo Aktif
                                    </span>
                                    @if($singlePromo->formatted_discount)
                                        <span class="promo-badge-discount">
                                            <i class="bi bi-tag-fill me-1"></i> {{ $singlePromo->formatted_discount }}
                                        </span>
                                    @endif
                                    @if($singlePromo->valid_until)
                                        <span class="promo-badge-validity">
                                            <i class="bi bi-clock-history me-1"></i> Berlaku s/d {{ $singlePromo->valid_until->translatedFormat('d F Y') }}
                                        </span>
                                    @endif
                                </div>

                                @if($singlePromo->headline)
                                    <span class="promo-headline-tag">{{ $singlePromo->headline }}</span>
                                @endif

                                <h3 class="promo-featured-title">{{ $singlePromo->clean_title }}</h3>

                                <div class="promo-copywriting-lead">
                                    "{{ $singlePromo->copywriting }}"
                                </div>

                                @if($singlePromo->strategy_preview)
                                    <div class="promo-strategy-box">
                                        <i class="bi bi-patch-check-fill text-danger mt-1 fs-6 flex-shrink-0"></i>
                                        <span>{{ $singlePromo->strategy_preview }}</span>
                                    </div>
                                @endif

                                <div class="d-flex flex-wrap gap-3 align-items-center pt-3 border-top">
                                    <a href="https://wa.me/6281215142908?text={{ urlencode('Halo Warung Mbah Darmo, saya ingin pesan promo: ' . $singlePromo->clean_title . ' (' . ($singlePromo->formatted_discount ?? 'Promo Aktif') . ')') }}"
                                       target="_blank"
                                       rel="noopener"
                                       class="btn-terracotta">
                                        <i class="bi bi-whatsapp fs-5"></i>
                                        <span>{{ $singlePromo->cta_text ?: 'Pesan Sekarang' }}</span>
                                    </a>

                                    <a href="{{ route('menu.index') }}" class="btn btn-outline-terracotta">
                                        <i class="bi bi-grid-fill me-1"></i>
                                        <span>Lihat Menu Lengkap</span>
                                    </a>
                                </div>
                            </div>

                            {{-- KOLOM KANAN: GAMBAR BANNER / POSTER VISUAL --}}
                            <div class="col-lg-5 order-1 order-lg-2">
                                <div class="promo-poster-frame">
                                    @if($singlePromo->banner_url)
                                        <img src="{{ $singlePromo->banner_url }}"
                                             alt="{{ $singlePromo->clean_title }}"
                                             loading="lazy"
                                             onerror="this.onerror=null;this.src='{{ asset('images/home/home.png') }}';">
                                    @else
                                        <div class="promotion-placeholder h-100">
                                            <div>
                                                <i class="bi bi-stars fs-1 text-warning mb-2"></i>
                                                <h5 class="text-white">{{ $singlePromo->clean_title }}</h5>
                                                @if($singlePromo->formatted_discount)
                                                    <span class="badge bg-warning text-dark fw-bold mt-2">{{ $singlePromo->formatted_discount }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    @if($singlePromo->formatted_discount)
                                        <div class="promo-poster-ribbon">
                                            <i class="bi bi-tag-fill me-1"></i> {{ $singlePromo->formatted_discount }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </article>
                </div>
            </div>
        @else
            {{-- TAMPILAN GRID MULTI-PROMO (JIKA LEBIH DARI 1 PROMO AKTIF) --}}
            <div class="row g-4 justify-content-center">
                @foreach($activePromotions as $promo)
                <div class="col-md-6 col-lg-4 fade-in-up">
                    <article class="promotion-card">
                        <div class="position-relative overflow-hidden" style="height: 220px; background: var(--md-bg-warm);">
                            @if($promo->banner_url)
                                <img
                                    src="{{ $promo->banner_url }}"
                                    alt="{{ $promo->clean_title }}"
                                    class="promotion-image"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ asset('images/home/home.png') }}';"
                                >
                            @else
                                <div class="promotion-placeholder">
                                    <div>
                                        <i class="bi bi-stars"></i>
                                        <strong>{{ $promo->clean_title }}</strong>
                                    </div>
                                </div>
                            @endif

                            @if($promo->formatted_discount)
                                <div class="promo-poster-ribbon" style="top:10px; right:10px; font-size:0.7rem; padding:4px 10px;">
                                    {{ $promo->formatted_discount }}
                                </div>
                            @endif
                        </div>

                        <div class="promotion-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="promo-badge-live" style="font-size:0.65rem; padding:2px 8px;">
                                    <span class="promo-pulse-dot" style="width:6px; height:6px;"></span> Promo Aktif
                                </span>
                                @if($promo->valid_until)
                                    <small class="text-md-muted" style="font-size:0.72rem;">
                                        <i class="bi bi-clock-history me-1"></i> s/d {{ $promo->valid_until->translatedFormat('d M Y') }}
                                    </small>
                                @endif
                            </div>

                            <h5>{{ $promo->clean_title }}</h5>

                            <p class="text-md-muted small mb-3 fst-italic" style="line-height: 1.55;">
                                "{{ Str::limit($promo->copywriting, 120) }}"
                            </p>

                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between gap-2">
                                <a href="https://wa.me/6281215142908?text={{ urlencode('Halo Warung Mbah Darmo, saya ingin pesan promo: ' . $promo->clean_title . ' (' . ($promo->formatted_discount ?? 'Promo Aktif') . ')') }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="btn btn-terracotta btn-sm py-1 px-3 d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-whatsapp"></i>
                                    <span>{{ $promo->cta_text ?: 'Pesan' }}</span>
                                </a>

                                <a href="{{ route('menu.index') }}" class="btn btn-outline-terracotta btn-sm py-1 px-3">
                                    Menu
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
@endif


{{-- =========================================================
     D. SECTION MENU FAVORIT (VIEW-ONLY DENGAN GAMBAR AUTENTIK)
     ========================================================= --}}
@if(isset($featuredMenus) && $featuredMenus->count() > 0)
<section class="section-tight" style="background: #FDF8F2;">
    <div class="container">
        
        <div class="text-center mb-4 fade-in-up">
            <span class="section-label">Hidangan Khas</span>
            <h2 class="section-title">Cita Rasa Warisan</h2>
            <div class="section-divider"></div>
            <p class="text-md-muted mx-auto" style="max-width: 540px; font-size: 0.95rem;">
                Menu andalan yang paling digemari para penikmat kuliner di Warung Mbah Darmo.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($featuredMenus->take(3) as $menu)
            <div class="col-md-6 col-lg-4 fade-in-up">
                <div class="menu-fav-card">
                    <div class="menu-fav-img-wrap">
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/home/menu/IMG_4608.jpg') }}';">
                        <span class="menu-fav-badge">{{ $menu->category->name }}</span>
                    </div>

                    <div class="menu-fav-body">
                        <div>
                            <h6>{{ $menu->name }}</h6>
                            <p class="text-md-muted small mb-3">
                                {{ Str::limit($menu->short_description_hover ?? $menu->description ?? 'Sajian khas olahan rempah pilihan khas racikan Mbah Darmo.', 85) }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <span class="menu-fav-price">{{ $menu->formatted_price }}</span>
                            <a href="{{ route('menu.index') }}" class="btn btn-outline-terracotta btn-sm py-1 px-3">
                                <span>Lihat Menu</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4 fade-in-up">
            <a href="{{ route('menu.index') }}" class="btn-terracotta">
                <i class="bi bi-grid-fill"></i>
                <span>Jelajahi Menu Lengkap</span>
            </a>
        </div>

    </div>
</section>
@endif


{{-- =========================================================
     E. SECTION ULASAN / TESTIMONI (RAPAT & HARMONIS)
     ========================================================= --}}
<section class="section-tight" style="background: var(--md-bg-warm); border-top: 1px solid var(--md-border);">
    <div class="container">
        
        <div class="text-center mb-4 fade-in-up">
            <span class="section-label">Kata Mereka</span>
            <h2 class="section-title">Ulasan Pelanggan &amp; Mitra</h2>
            <div class="section-divider"></div>
            <p class="text-md-muted mx-auto" style="max-width: 520px; font-size: 0.95rem;">
                Kepuasan dan kehangatan yang dirasakan para penikmat hidangan serta mitra bisnis kami.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach([
                [
                    'Rasa mie gepeng batok arangnya benar-benar otentik, smoky dan bumbunya meresap sempurna. Selalu jadi pilihan utama saat kumpul bersama keluarga.',
                    'Bambang Sugiarto',
                    'Pelanggan Setia · Purwokerto',
                    5
                ],
                [
                    'Sistem franchise Mbah Darmo sangat jelas dan terstruktur. Bimbingan dari tim pusat membuat outlet kami langsung ramai sejak bulan pertama.',
                    'Hendra Kurniawan',
                    'Mitra Franchise Paket Basic · Yogyakarta',
                    5
                ],
                [
                    'Sate kambingnya empuk dan wedang rempahnya sangat menghangatkan. Suasana warung dengan ornamen kayu jawanya bikin betah berlama-lama.',
                    'Ratna Dewi',
                    'Pencinta Kuliner Nusantara',
                    5
                ]
            ] as [$text, $name, $role, $stars])
            <div class="col-md-6 col-lg-4 fade-in-up">
                <div class="testi-card">
                    <div>
                        <div class="testi-stars">
                            @for($i = 0; $i < $stars; $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>
                        <p class="testi-text">"{{ $text }}"</p>
                    </div>
                    <div class="testi-author-info pt-2 border-top">
                        <h6>{{ $name }}</h6>
                        <span>{{ $role }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>


{{-- =========================================================
     F. SECTION BANNER CTA (DEEP WOOD BROWN BACKGROUND)
     ========================================================= --}}
<section class="cta-banner-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 fade-in-up">
                
                <span class="cta-subheading">MULAI PERJALANAN ANDA</span>
                <h2 class="cta-title">Siap Membangun Warisan Anda?</h2>
                
                <p class="cta-desc">
                    Bergabunglah dengan keluarga Mbah Darmo. Bawa cita rasa Jawa asli dan model bisnis yang terbukti ke kota Anda.
                </p>

                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('franchise.index') }}" class="btn-terracotta">
                        <i class="bi bi-briefcase-fill"></i>
                        <span>Dapatkan Kit Waralaba</span>
                    </a>

                    <a href="https://wa.me/6281215142908?text=Halo%20Tim%20Warung%20Mbah%20Darmo,%20saya%20tertarik%20konsultasi%20peluang%20kemitraan" 
                       class="btn-ghost-cream" 
                       target="_blank" 
                       rel="noopener">
                        <i class="bi bi-whatsapp"></i>
                        <span>Konsultasi via WhatsApp</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection