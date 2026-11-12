@extends('layouts.app')

@section('title', 'Peluang Kemitraan Franchise')
@section('meta_description', 'Peluang kemitraan bisnis waralaba Warung Mbah Darmo. 4 pilihan paket investasi: Express Rp 99 Jt, Basic Rp 199 Jt, Signature Rp 379 Jt, Heritage Rp 799 Jt.')

@section('extra-styles')
<style>
    /* =========================================================
       HERO FRANCHISE (TEMA GELAP HANGAT)
       ========================================================= */
    .franchise-hero {
        position: relative;
        min-height: 60vh;
        padding: 8.5rem 0 5rem;
        background-color: #1A100A;
        background-image: 
            linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.65) 100%),
            url('{{ asset("images/home/kemitraan/franchise.jpg") }}');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        text-align: center;
        color: #FFFFFF;
    }

    .hero-stat-box {
        background: rgba(253, 248, 242, 0.08);
        border: 1px solid rgba(253, 248, 242, 0.15);
        border-radius: var(--radius-md);
        padding: 1rem 1.5rem;
        backdrop-filter: blur(6px);
    }

    .hero-stat-val {
        font-family: var(--font-heading);
        font-size: 2rem;
        font-weight: 700;
        color: var(--md-gold-light);
        line-height: 1.1;
    }

    .hero-stat-lbl {
        font-size: 0.75rem;
        color: rgba(253, 248, 242, 0.7);
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-top: 0.25rem;
    }

    /* =========================================================
       TIER COMPARISON CARDS
       ========================================================= */
    .tier-card {
        background: #FFFFFF;
        border: 2px solid var(--md-primary);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: var(--shadow-subtle);
    }

    .tier-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .tier-card.featured {
        border: 2px solid var(--md-primary);
    }

    .tier-popular-badge {
        position: absolute;
        top: 0;
        right: 1.5rem;
        background: var(--md-primary);
        color: #FFFFFF;
        padding: 0.35rem 0.9rem;
        border-radius: 0 0 10px 10px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 2px 8px rgba(168, 50, 38, 0.3);
        z-index: 2;
    }

    .tier-header {
        padding: 2rem 1.5rem 1.5rem;
        background: linear-gradient(135deg, var(--md-wood) 0%, #3d1c15 100%);
        border-bottom: 1px solid var(--md-border);
    }

    .tier-card.featured .tier-header {
        background: linear-gradient(135deg, var(--md-wood) 0%, #3d1c15 100%);
    }

    .tier-name {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--md-gold-light);
        margin-bottom: 0.4rem;
    }

    .tier-card.featured .tier-name {
        color: var(--md-gold-light);
    }

    .tier-price {
        font-family: var(--font-heading);
        font-size: 2.1rem;
        font-weight: 700;
        color: #FFFFFF;
        line-height: 1.1;
    }

    .tier-card.featured .tier-price {
        color: #FFFFFF;
    }

    .tier-price span {
        font-size: 1.1rem;
        font-family: var(--font-body);
        font-weight: 500;
        color: rgba(255, 255, 255, 0.75);
    }

    .tier-card.featured .tier-price span {
        color: rgba(255, 255, 255, 0.75);
    }

    .tier-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .tier-spec-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.5rem;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--md-border);
        text-align: center;
    }

    .tier-spec-item .val {
        font-family: var(--font-heading);
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--md-wood);
    }

    .tier-spec-item .lbl {
        font-size: 0.65rem;
        color: var(--md-text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .tier-desc {
        font-size: 0.88rem;
        color: var(--md-text-muted);
        line-height: 1.6;
        margin-bottom: 1.25rem;
        flex-grow: 1;
    }

    .tier-revenue-box {
        background: var(--md-bg-warm);
        border-radius: var(--radius-sm);
        padding: 0.75rem 1rem;
        font-size: 0.82rem;
        color: var(--md-text);
        margin-bottom: 1.25rem;
        border: 1px solid rgba(168, 50, 38, 0.1);
    }

    .tier-footer {
        padding: 1.25rem 1.5rem;
        border-top: 1px solid var(--md-border);
        background: #FFFFFF;
    }

    /* Section Spacing */
    .section-tight {
        padding-top: 3.5rem;
        padding-bottom: 3.5rem;
    }
</style>
@endsection

@section('content')

{{-- =========================================================
     1. HERO SECTION (INVESTASI & WARALABA)
     ========================================================= --}}
<section class="franchise-hero text-white">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-9 fade-in-up">
                
                <span class="section-label" style="color: var(--md-gold-light);">Peluang Investasi Kuliner Jawa</span>
                <h1 class="section-title mt-1 mb-3" style="color: #FFFFFF; font-size: clamp(2.2rem, 4.5vw, 3.5rem);">
                    Kemitraan Waralaba <span style="color: var(--md-gold-light); font-style: italic; font-family: var(--font-serif-alt);">Warung Mbah Darmo</span>
                </h1>
                
                <p style="color: rgba(253, 248, 242, 0.85); font-size: 1.05rem; line-height: 1.75; max-width: 620px; margin: 0 auto 2.25rem;">
                    Buka gerai kuliner tradisional Jawa dengan sistem bisnis modern teruji, supply chain bumbu terpusat, dan bimbingan operasional komprehensif.
                </p>

                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <div class="hero-stat-box">
                        <div class="hero-stat-val">50+</div>
                        <div class="hero-stat-lbl">Gerai Mitra Aktif</div>
                    </div>
                    <div class="hero-stat-box">
                        <div class="hero-stat-val">98%</div>
                        <div class="hero-stat-lbl">Kepuasan Mitra</div>
                    </div>
                    <div class="hero-stat-box">
                        <div class="hero-stat-val">100%</div>
                        <div class="hero-stat-lbl">SOP Terstandarisasi</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


{{-- =========================================================
     2. SECTION MENGAPA BERMITRA (4 POIN KEUNGGULAN BISNIS)
     ========================================================= --}}
<section class="section-tight" style="background: var(--md-bg);">
    <div class="container">
        
        <div class="text-center mb-4 fade-in-up">
            <span class="section-label">Keunggulan Bisnis</span>
            <h2 class="section-title">Mengapa Bermitra Dengan Kami?</h2>
            <div class="section-divider"></div>
            <p class="text-md-muted mx-auto" style="max-width: 560px; font-size: 0.95rem;">
                Empat fondasi utama yang menjamin keunggulan dan kepastian operasional bisnis waralaba Anda.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach([
                [
                    'bi-graph-up-arrow',
                    'ROI Cepat & Terukur',
                    'Struktur biaya yang efisien dengan margin bahan baku optimal menghadirkan potensi perputaran modal yang cepat dan sehat.'
                ],
                [
                    'bi-shield-check',
                    'Sistem Manajemen Teruji',
                    'SOP operasional dapur terstandarisasi, resep rahasia bumbu terpusat, dan integrasi software POS kasir modern siap pakai.'
                ],
                [
                    'bi-people-fill',
                    'Pendampingan Komprehensif',
                    'Pelatihan intensif bagi juru masak dan staf pelayanan, serta audit berkala dari tim manajemen pusat Mbah Darmo.'
                ],
                [
                    'bi-award-fill',
                    'Brand Heritage yang Kuat',
                    'Memiliki basis pencinta kuliner setia di berbagai kota, didukung materi promosi digital dan strategi pemasaran berkala.'
                ]
            ] as [$icon, $title, $desc])
            <div class="col-md-6 col-lg-3 fade-in-up">
                <div class="p-4 bg-white rounded-4 border h-100 text-center shadow-sm">
                    <div class="d-inline-flex align-items-center justify-content-center mb-3 rounded-circle" style="width: 54px; height: 54px; background: var(--md-bg-warm); color: var(--md-primary); font-size: 1.5rem; border: 1px solid rgba(168,50,38,0.15);">
                        <i class="bi {{ $icon }}"></i>
                    </div>
                    <h5 style="font-family: var(--font-heading); font-size: 1.15rem; color: var(--md-wood); margin-bottom: 0.5rem;">{{ $title }}</h5>
                    <p class="text-md-muted small mb-0" style="line-height: 1.6;">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>


{{-- =========================================================
     3. SECTION PAKET KEMITRAAN (TIER CARDS)
     ========================================================= --}}
<section class="section-tight" style="background: var(--md-bg-warm); border-top: 1px solid var(--md-border); border-bottom: 1px solid var(--md-border);">
    <div class="container">
        
        <div class="text-center mb-4 fade-in-up">
            <span class="section-label">Pilihan Paket</span>
            <h2 class="section-title">Paket Investasi Kemitraan</h2>
            <div class="section-divider"></div>
            <p class="text-md-muted mx-auto" style="max-width: 580px; font-size: 0.95rem;">
                Tersedia berbagai pilihan skala gerai yang dapat disesuaikan dengan luas lokasi dan target omzet Anda.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($packages as $pkg)
            <div class="col-md-6 col-xl-3 fade-in-up">
                <div class="tier-card featured">
                    @if($pkg->slug === 'basic')
                        <div class="tier-popular-badge">⭐ Paling Diminati</div>
                    @elseif($pkg->slug === 'heritage')
                        <div class="tier-popular-badge" style="background: var(--md-gold); color: #fff;">👑 Flagship</div>
                    @endif

                    <div class="tier-header">
                        <div class="tier-name">{{ $pkg->name }}</div>
                        <div class="tier-price">
                            Rp {{ number_format($pkg->price / 1000000, 0) }}
                            <span>Juta</span>
                        </div>
                        <div class="mt-2 small" style="color: rgba(255, 255, 255, 0.8);">
                            <i class="bi bi-arrow-repeat me-1"></i>Payback: {{ $pkg->roi_projection }}
                        </div>
                    </div>

                    <div class="tier-body">
                        <div class="tier-spec-grid">
                            <div class="tier-spec-item">
                                <div class="val">{{ $pkg->space_required }}</div>
                                <div class="lbl">Luas</div>
                            </div>
                            <div class="tier-spec-item">
                                <div class="val">{{ $pkg->pax_capacity }}</div>
                                <div class="lbl">Pax</div>
                            </div>
                            <div class="tier-spec-item">
                                <div class="val">{{ $pkg->staff_count }}</div>
                                <div class="lbl">SDM</div>
                            </div>
                        </div>

                        <p class="tier-desc">
                            {{ Str::limit($pkg->description, 110) }}
                        </p>

                        <div class="tier-revenue-box">
                            <i class="bi bi-cash-stack text-warning me-1"></i>
                            Est. Omzet: <strong>{{ $pkg->monthly_revenue_estimate }}</strong>/bln
                        </div>
                    </div>

                    <div class="tier-footer">
                        <a href="{{ route('franchise.show', $pkg->slug) }}" 
                           class="btn w-100 btn-terracotta">
                            <span>Lihat Rincian Paket</span>
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5 fade-in-up">
            <p class="text-md-muted mb-3" style="font-size: 0.92rem;">
                <i class="bi bi-info-circle-fill text-primary me-1"></i>
                Seluruh paket telah mencakup peralatan dapur standar, seragam, modul pelatihan, sistem POS, dan marketing launch kit.
            </p>
            <a href="https://wa.me/6281215142908?text=Halo%20Tim%20Warung%20Mbah%20Darmo,%20saya%20tertarik%20konsultasi%20paket%20kemitraan" 
               class="btn-whatsapp" 
               target="_blank" 
               rel="noopener">
                <i class="bi bi-whatsapp"></i>
                <span>Konsultasi Paket via WhatsApp</span>
            </a>
        </div>

    </div>
</section>


{{-- =========================================================
     4. SECTION CARA BERGABUNG (4 LANGKAH MUDAH)
     ========================================================= --}}
<section class="section-tight" style="background: var(--md-bg);">
    <div class="container">
        
        <div class="text-center mb-4 fade-in-up">
            <span class="section-label">Alur Kemitraan</span>
            <h2 class="section-title">4 Langkah Mudah Menjadi Mitra</h2>
            <div class="section-divider"></div>
            <p class="text-md-muted mx-auto" style="max-width: 520px; font-size: 0.95rem;">
                Proses transparan dan terarah dari konsultasi awal hingga pembukaan gerai resmi Anda.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach([
                ['bi-chat-dots-fill', '1. Konsultasi Awal', 'Diskusi santai via WhatsApp mengenai rencana lokasi, pemilihan paket, dan proyeksi bisnis.'],
                ['bi-file-earmark-check-fill', '2. Penandatanganan MoU', 'Pemberian draft perjanjian resmi, legalitas jelas, dan kesepakatan komitmen kemitraan.'],
                ['bi-gear-fill', '3. Setup Gerai & Training', 'Renovasi lokasi sesuai standar tata letak Mbah Darmo dan pelatihan menyeluruh untuk staf Anda.'],
                ['bi-shop-window', '4. Grand Opening', 'Pembukaan resmi gerai Anda dengan sokongan penuh promosi serta kampanye marketing pusat.']
            ] as [$icon, $step, $desc])
            <div class="col-md-6 col-lg-3 fade-in-up">
                <div class="p-4 bg-white rounded-4 border h-100 text-center shadow-sm">
                    <div class="d-inline-flex align-items-center justify-content-center mb-3 rounded-circle" style="width: 52px; height: 52px; background: var(--md-bg-warm); color: var(--md-primary); font-size: 1.4rem; border: 1px solid rgba(168,50,38,0.15);">
                        <i class="bi {{ $icon }}"></i>
                    </div>
                    <h6 style="font-family: var(--font-heading); font-size: 1.1rem; color: var(--md-wood); margin-bottom: 0.35rem;">{{ $step }}</h6>
                    <p class="text-md-muted small mb-0" style="line-height: 1.6;">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection
