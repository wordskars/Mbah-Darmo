@extends('layouts.app')

@section('title', 'Paket Kemitraan Franchise')
@section('meta_description', 'Bergabung dengan franchise Warung Mbah Darmo. 4 paket kemitraan: EXPRESS Rp 99 Juta, BASIC Rp 199 Juta, SIGNATURE Rp 379 Juta, HERITAGE Rp 799 Juta.')

@section('extra-styles')
.franchise-hero {
    position: relative;
    min-height: 100vh;
    padding: 10rem 0 6rem;
    overflow: hidden;

    background-image:
        linear-gradient(
            to bottom,
            rgba(15, 10, 10, 0.35) 0%,
            rgba(15, 10, 10, 0.55) 100%
        ),
        url('{{ asset("images/kemitraan/franchise.png") }}');

    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;

    display: flex;
    align-items: center;
    margin-top: -101px;
    padding-top: calc(10rem + 88px);
}

.franchise-hero::after {
    display: none;
}

/* ── TIER CARDS ── */
.tier-card {
    background: #fff; border: 1px solid var(--md-border);
    border-radius: 20px; overflow: hidden;
    transition: var(--transition); position: relative;
    display: flex; flex-direction: column;
}
.tier-card:hover { transform: translateY(-10px); box-shadow: 0 20px 60px rgba(0,0,0,0.12); }
.tier-card.featured { border: 2px solid var(--md-primary); }
.tier-card.featured .tier-header { background: var(--md-primary); }
.tier-popular-badge {
    position: absolute; top: -1px; right: 1.5rem;
    background: var(--md-gold); color: #fff;
    padding: 0.4rem 1rem; border-radius: 0 0 10px 10px;
    font-size: 0.7rem; font-weight: 600; letter-spacing: 0.5px;
    text-transform: uppercase;
}
/* =================================
   NAVBAR DI ATAS HERO FRANCHISE
   ================================= */

body:has(.franchise-hero) .md-navbar {
    position: sticky;
    top: 0;
    z-index: 1000;
    background: rgba(20, 15, 12, 0.18);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.18);
    box-shadow: none;
}

/* Logo */
body:has(.franchise-hero) .md-navbar .navbar-brand {
    color: #fff !important;
}

body:has(.franchise-hero) .md-navbar .navbar-brand span {
    color: var(--md-gold-light);
}

/* Menu navbar */
body:has(.franchise-hero) .md-navbar .nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
}

/* Hover */
body:has(.franchise-hero) .md-navbar .nav-link:hover {
    color: #fff !important;
    background: rgba(255, 255, 255, 0.12);
}

/* Menu aktif */
body:has(.franchise-hero) .md-navbar .nav-link.active {
    color: var(--md-primary) !important;
    background: rgba(255, 255, 255, 0.92);
}

/* Tombol Hubungi Kami tetap */
body:has(.franchise-hero) .md-navbar .nav-link-cta {
    color: #fff !important;
}

.tier-header {
    padding: 2rem 1.75rem 1.5rem;
    background: var(--md-bg-warm);
    border-bottom: 1px solid var(--md-border);
}
.tier-name {
    font-family: var(--font-body);
    font-size: 0.7rem; 
    font-weight: 700;
    letter-spacing: 4px;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
}
.tier-price {
    font-family: var(--font-heading); font-size: 1.9rem; font-weight: 700;
    color: var(--md-charcoal); line-height: 1;
}
.tier-price span { font-size: 1rem; font-family: var(--font-body); font-weight: 400; color: var(--md-text-muted); }
.tier-body { padding: 1.75rem; flex-grow: 1; }
.tier-spec {
    display: flex; gap: 1rem; margin-bottom: 1.25rem; padding-bottom: 1.25rem;
    border-bottom: 1px solid var(--md-border);
}
.tier-spec-item { text-align: center; flex: 1; }
.tier-spec-item .val { font-family: var(--font-heading); font-size: 1.3rem; color: var(--md-charcoal); font-weight: 600; }
.tier-spec-item .lbl { font-size: 0.65rem; color: var(--md-text-muted); text-transform: uppercase; letter-spacing: 1px; }
.tier-desc { font-size: 0.875rem; color: var(--md-text-muted); line-height: 1.7; margin-bottom: 1.25rem; }
.tier-footer { padding: 1.5rem 1.75rem; border-top: 1px solid var(--md-border); }
@endsection

@section('content')

{{-- HERO --}}
<section class="franchise-hero text-white"
style="background-image: linear-gradient(to bottom, rgba(15, 10, 10, 0.55) 0%, rgba(15, 10, 10, 0.85) 100%), url('{{ asset('images/home/kemitraan/franchise.jpg') }}');">
    <div class="container text-center position-relative">
        <div class="fade-in-up">
            <span class="section-label" style="color:var(--md-gold-light);">Peluang Bisnis</span>
            <h1 class="section-title mt-2 mb-3" style="color:#fff;">Paket Kemitraan <span style="color:var(--md-gold-light); font-style:italic;">Warung Mbah Darmo</span></h1>
            <div class="section-divider"></div>
            <p style="color:rgba(255,255,255,0.65); max-width:560px; margin:1.5rem auto 2.5rem; font-size:1rem; line-height:1.8;">
                Pilih paket investasi yang sesuai dengan skala bisnis dan impian Anda. Dari booth sederhana hingga flagship restaurant eksklusif.
            </p>
            <div class="d-flex gap-4 justify-content-center flex-wrap">
                @foreach([['50+','Mitra Aktif'],['98%','Kepuasan Mitra'],['15+','Tahun Pengalaman']] as [$n,$l])
                <div class="text-center">
                    <div style="font-family:var(--font-heading); font-size:2rem; font-weight:700; color:var(--md-gold-light);">{{ $n }}</div>
                    <div style="font-size:0.75rem; color:rgba(255,255,255,0.5); letter-spacing:1px;">{{ $l }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- TIER CARDS --}}
<section class="py-5" style="padding-top:4rem; padding-bottom:5rem;">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach($packages as $pkg)
            <div class="col-md-6 col-xl-3 fade-in-up">
                <div class="tier-card h-100 {{ $pkg->slug === 'basic' ? 'featured' : '' }}">
                    @if($pkg->slug === 'basic')
                    <div class="tier-popular-badge">⭐ Terpopuler</div>
                    @endif
                    @if($pkg->slug === 'heritage')
                    <div class="tier-popular-badge" style="background:var(--md-charcoal);">👑 Premium</div>
                    @endif

                    <div class="tier-header" style="{{ $pkg->slug !== 'basic' ? 'background:var(--md-bg-warm);' : 'color:#fff;' }}">
    <div class="tier-name" style="color: {{ $pkg->slug === 'basic' ? '#fff' : ($pkg->color_accent ?? 'var(--md-primary)') }};">
        {{ $pkg->name }}
    </div>
    <div class="tier-price" style="{{ $pkg->slug === 'basic' ? 'color:#fff;' : '' }}">
        Rp {{ number_format($pkg->price / 1000000, 0) }}
        <span style="{{ $pkg->slug === 'basic' ? 'color:#fff;' : '' }}"> Juta</span>
    </div>
    <div class="mt-2" style="font-size:0.8rem; {{ $pkg->slug === 'basic' ? 'color:rgba(255,255,255,0.7);' : 'color:var(--md-text-muted);' }}">
        <i class="bi bi-arrow-repeat me-1"></i>ROI Est. {{ $pkg->roi_projection }}
    </div>
</div>

                    <div class="tier-body">
                        <div class="tier-spec">
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
                        <p class="tier-desc">{{ Str::limit($pkg->description, 120) }}</p>
                        <div style="font-size:0.8rem; color:var(--md-text-muted); margin-bottom:0.5rem;">
                            <i class="bi bi-cash-stack me-1" style="color:var(--md-gold);"></i>
                            Estimasi Omzet: <strong style="color:var(--md-charcoal);">{{ $pkg->monthly_revenue_estimate }}</strong>/bulan
                        </div>
                    </div>

                    <div class="tier-footer">
                        <a href="{{ route('franchise.show', $pkg->slug) }}"
                           class="btn w-100 py-2 {{ $pkg->slug === 'basic' ? 'btn-md-primary' : 'btn-md-outline' }}">
                            <i class="bi bi-arrow-right-circle me-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Comparison note --}}
        <div class="text-center mt-5 fade-in-up">
            <p class="text-md-muted mb-3" style="font-size:0.9rem;">
                <i class="bi bi-info-circle me-1"></i>
                Semua paket sudah mencakup SOP, training, materi marketing, dan dukungan operasional penuh.
            </p>
            <a href="https://wa.me/6281383045066?text=Halo%20Tim%20Mbah%20Darmo,%20saya%20ingin%20konsultasi%20paket%20kemitraan" class="btn btn-whatsapp px-5 py-3" target="_blank">
                <i class="bi bi-whatsapp"></i> Konsultasi Gratis via WhatsApp
            </a>
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section class="py-5 bg-md-warm">
    <div class="container">
        <div class="text-center mb-5 fade-in-up">
            <span class="section-label">Cara Bergabung</span>
            <h2 class="section-title mt-2">Proses Kemitraan Mudah & Transparan</h2>
            <div class="section-divider"></div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach([
                ['bi-chat-dots','1. Konsultasi','Hubungi tim kami via WhatsApp untuk diskusi awal tentang paket yang sesuai.'],
                ['bi-file-text','2. Perjanjian','Tanda tangani MoU dan perjanjian kemitraan resmi yang transparan.'],
                ['bi-tools','3. Setup & Training','Tim kami membantu setup gerai dan pelatihan SDM selama 2 minggu.'],
                ['bi-shop','4. Grand Opening','Buka gerai dengan dukungan marketing penuh dari tim pusat Mbah Darmo.'],
            ] as [$icon, $step, $desc])
            <div class="col-md-6 col-lg-3 text-center fade-in-up">
                <div class="value-icon mx-auto mb-3"><i class="bi {{ $icon }} fs-2"></i></div>
                <h6 style="font-family:var(--font-heading);">{{ $step }}</h6>
                <p class="text-md-muted mb-0" style="font-size:0.85rem;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
