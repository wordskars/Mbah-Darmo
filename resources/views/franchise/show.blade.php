@extends('layouts.app')

@section('title', 'Paket ' . $package->name . ' – Kemitraan Mbah Darmo')
@section('meta_description', 'Detail paket franchise ' . $package->name . ' Warung Mbah Darmo – ' . Str::limit($package->description, 120))

@section('extra-styles')
<style>
/* 1. Paksa layout utama naik penuh ke paling atas menutupi navbar */
main {
    padding-top: 0 !important;
    margin-top: 0 !important;
}

/* 2. Hero Section ditarik ke paling atas & diperpanjang ke bawah */
.pkg-hero {
    background: linear-gradient(135deg, var(--md-charcoal) 0%, #2a1010 100%);
    /* Padding Atas 10rem (agar konten berada tepat di bawah Navbar Transparan) 
       Padding Bawah 8rem (agar ruang di bawah box Total Investasi sangat lega) */
    padding: 10rem 0 8rem !important; 
    position: relative; 
    overflow: hidden;
    margin-top: -80px; /* Menarik background hero masuk ke belakang navbar transparan */
    width: 100%;
}

.pkg-hero::before {
    content: ''; 
    position: absolute; 
    inset: 0;
    background: radial-gradient(ellipse at 80% 50%, rgba(161,138,67,0.12) 0%, transparent 70%);
}

.pkg-nav-pills { display: flex; gap: 0.5rem; flex-wrap: wrap; }
.pkg-pill {
    padding: 0.4rem 1.1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 500;
    text-decoration: none; transition: var(--transition);
    border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.5);
}
.pkg-pill:hover { color: #fff; border-color: rgba(255,255,255,0.35); }
.pkg-pill.active { background: var(--md-gold); color: #fff; border-color: var(--md-gold); }

/* CONTENT SECTIONS */
.detail-section { padding: 4rem 0; border-bottom: 1px solid var(--md-border); }
.detail-section:last-child { border-bottom: none; }

/* HIGHLIGHTS */
.highlight-list li {
    padding: 0.6rem 0; display: flex; align-items: flex-start; gap: 0.75rem;
    font-size: 0.9rem; border-bottom: 1px solid rgba(232,221,208,0.5);
}
.highlight-list li:last-child { border: none; }
.highlight-list li::before {
    content: '✓'; color: var(--md-gold); font-weight: 700; flex-shrink: 0; margin-top: 1px;
}

/* MENU LIST */
.menu-list-item {
    display: flex; align-items: center; gap: 0.75rem;
    padding: 0.65rem 1rem; border-radius: 8px; margin-bottom: 0.5rem;
    background: var(--md-bg-warm); border: 1px solid var(--md-border);
    font-size: 0.875rem;
}
.menu-list-item::before { content: '🍽️'; font-size: 1.1rem; }

/* FINANCIAL CHART */
.fin-bar-wrap { margin-bottom: 1rem; }
.fin-label { display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 0.35rem; }
.fin-bar { height: 10px; border-radius: 50px; background: var(--md-border); overflow: hidden; }
.fin-bar-fill { height: 100%; border-radius: 50px; transition: width 1.2s ease; }

/* STAT BOX */
.stat-box {
    background: #fff; border: 1px solid var(--md-border);
    border-radius: 14px; padding: 1.5rem; text-align: center;
}
.stat-box .val { font-family: var(--font-heading); font-size: 1.6rem; font-weight: 700; color: var(--md-charcoal); }
.stat-box .lbl { font-size: 0.75rem; color: var(--md-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-top: 0.25rem; }

/* CTA BOX */
.cta-sticky-box {
    background: #fff; border: 1px solid var(--md-border);
    border-radius: 18px; padding: 2rem;
    position: sticky; top: 90px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
}
</style>
@endsection

@section('content')

{{-- HERO --}}
{{-- HERO --}}
<section class="pkg-hero text-white" 
         style="background: linear-gradient(rgba(26, 20, 20, 0.75), rgba(42, 16, 16, 0.88)), 
                     url('{{ $package->hero_image_url }}') center/cover no-repeat;">
    <div class="container position-relative">
        {{-- Breadcrumb --}}
        <nav class="mb-4" style="font-size:0.8rem;">
            <a href="{{ route('franchise.index') }}" style="color:rgba(255,255,255,0.4); text-decoration:none;">Kemitraan</a>
            <span style="color:rgba(255,255,255,0.25); margin:0 0.5rem;">/</span>
            <span style="color:var(--md-gold-light);">Paket {{ $package->name }}</span>
        </nav>

        {{-- Package nav pills --}}
        <div class="pkg-nav-pills mb-4">
            @foreach($packages as $pkg)
            <a href="{{ route('franchise.show', $pkg->slug) }}"
               class="pkg-pill {{ $pkg->slug === $package->slug ? 'active' : '' }}">
                {{ $pkg->name }}
            </a>
            @endforeach
        </div>

        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span style="font-size:0.7rem; letter-spacing:3px; text-transform:uppercase; color:var(--md-gold-light); font-weight:600;">Paket Kemitraan</span>
                <h1 class="section-title mt-1 mb-3" style="color:#fff; font-size:clamp(2rem,4vw,3.5rem);">
                    Paket <span style="color:var(--md-gold-light); font-style:italic;">{{ $package->name }}</span>
                </h1>
                <p style="color:rgba(255,255,255,0.65); font-size:1rem; line-height:1.8; max-width:560px;">
                    {{ $package->description }}
                </p>
            </div>
            <div class="col-lg-5">
                <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); border-radius:16px; padding:2rem;">
                    <div style="font-size:0.7rem; letter-spacing:2px; color:rgba(255,255,255,0.4); text-transform:uppercase; margin-bottom:0.5rem;">Total Investasi</div>
                    <div style="font-family:var(--font-heading); font-size:2.5rem; font-weight:700; color:#fff;">
                        {{ $package->formatted_price }}
                    </div>
                    <div class="row g-3 mt-3">
                        @foreach([
                            [$package->space_required,'Luas Ruang'],
                            [$package->pax_capacity . ' Pax','Kapasitas'],
                            [$package->staff_count . ' Orang','SDM'],
                            [$package->roi_projection,'ROI Est.'],
                        ] as [$val,$lbl])
                        <div class="col-6">
                            <div style="background:rgba(255,255,255,0.04); border-radius:8px; padding:0.75rem; border:1px solid rgba(255,255,255,0.07);">
                                <div style="font-weight:600; color:#fff; font-size:0.875rem;">{{ $val }}</div>
                                <div style="font-size:0.65rem; color:rgba(255,255,255,0.4); letter-spacing:1px; text-transform:uppercase;">{{ $lbl }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            {{-- LEFT: CONTENT --}}
            <div class="col-lg-8">

                {{-- KEUNGGULAN PAKET --}}
                @if(is_array($package->highlights) && count($package->highlights) > 0)
                <div class="detail-section">
                    <span class="section-label">Yang Anda Dapatkan</span>
                    <h2 class="section-title mt-1 mb-4" style="font-size:1.6rem;">Keunggulan Paket {{ $package->name }}</h2>
                    <ul class="highlight-list list-unstyled mb-0">
                        @foreach($package->highlights as $h)
                        <li>{{ $h }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- SUMMARY STATS --}}
                <div class="detail-section">
                    <span class="section-label">Proyeksi Bisnis</span>
                    <h2 class="section-title mt-1 mb-4" style="font-size:1.6rem;">Estimasi Keuangan & Performa</h2>
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <div class="val">{{ $package->monthly_revenue_estimate }}</div>
                                <div class="lbl">Omzet/Bulan</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <div class="val">{{ $package->roi_projection }}</div>
                                <div class="lbl">Payback Period</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <div class="val">{{ $package->pax_capacity }}</div>
                                <div class="lbl">Kapasitas Pax</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <div class="val">{{ $package->staff_count }}</div>
                                <div class="lbl">SDM Dibutuhkan</div>
                            </div>
                        </div>
                    </div>

                    {{-- FINANCIAL BREAKDOWN --}}
                    @if($package->financial_breakdown)
                    <h5 class="mb-4" style="font-family:var(--font-heading); font-size:1.1rem;">Struktur Biaya Operasional</h5>
                    @php $breakdown = $package->financial_breakdown; @endphp
                    @foreach([
                        ['hpp','HPP (Bahan Baku)','#E74C3C'],
                        ['tenaga','Tenaga Kerja','#3498DB'],
                        ['sewa','Biaya Sewa','#F39C12'],
                        ['royalti','Royalti Mbah Darmo','#800000'],
                        ['lainnya','Operasional Lainnya','#95A5A6'],
                        ['profit','Keuntungan Bersih','#27AE60'],
                    ] as [$key,$label,$color])
                    @if(isset($breakdown[$key]))
                    <div class="fin-bar-wrap">
                        <div class="fin-label">
                            <span style="color:var(--md-text); font-weight:500;">{{ $label }}</span>
                            <span style="color:{{ $color }}; font-weight:700;">{{ $breakdown[$key] }}%</span>
                        </div>
                        <div class="fin-bar">
                            <div class="fin-bar-fill" style="width:{{ $breakdown[$key] }}%; background:{{ $color }};"></div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>

                @php
    $menuList = is_string($package->menu_list) 
        ? json_decode($package->menu_list, true) 
        : $package->menu_list;
@endphp

                {{-- MENU LIST --}}
                @if(is_array($menuList) && count($menuList) > 0)
                <div class="detail-section">
                <span class="section-label">Menu Inti</span>
                <h2 class="section-title mt-1 mb-4" style="font-size:1.6rem;">SKU Menu Paket {{ $package->name }}</h2>
                <div class="row g-2">
                @foreach($menuList as $item)
                <div class="col-md-6">
                <div class="menu-list-item">{{ $item }}</div>
                </div>
                @endforeach
        </div>
    </div>
@endif

                {{-- GALLERY PLACEHOLDER --}}
                <div class="detail-section">
                    <span class="section-label">Galeri Tata Letak</span>
                    <h2 class="section-title mt-1 mb-4" style="font-size:1.6rem;">Store Layout & Render Gerai</h2>
                    <div class="row g-3">
                        @foreach(['Interior Dining','Coffee Bar','Kitchen Area','Fasad Eksterior','Area Kasir','Signage'] as $i => $label)
                        <div class="col-6 col-md-4">
                            <div style="background:linear-gradient(135deg, var(--md-bg-warm), #E0D0B8); border-radius:12px; aspect-ratio:4/3; display:flex; flex-direction:column; align-items:center; justify-content:center; border:1px dashed var(--md-border); color:var(--md-text-muted); font-size:0.8rem; text-align:center; gap:0.5rem;">
                                <i class="bi bi-image fs-2" style="opacity:0.3;"></i>
                                {{ $label }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-md-muted mt-3" style="font-size:0.8rem;"><i class="bi bi-info-circle me-1"></i>Render tata letak lengkap akan dikirimkan setelah konsultasi dengan tim desain kami.</p>
                </div>

            </div>

            {{-- RIGHT: STICKY CTA --}}
            <div class="col-lg-4">
                <div class="cta-sticky-box">
                    <div style="font-size:0.7rem; letter-spacing:2px; text-transform:uppercase; color:var(--md-text-muted); margin-bottom:0.5rem;">Total Investasi</div>
                    <div style="font-family:var(--font-heading); font-size:2rem; font-weight:700; color:var(--md-charcoal); margin-bottom:0.25rem;">{{ $package->formatted_price }}</div>
                    <div style="font-size:0.8rem; color:var(--md-text-muted); margin-bottom:1.5rem;">
                        <i class="bi bi-arrow-repeat me-1" style="color:var(--md-gold);"></i>Payback {{ $package->roi_projection }}
                    </div>

                    <div class="d-grid gap-3 mb-4">
                        <a href="{{ $package->whatsapp_url }}"
                           class="btn btn-whatsapp py-3" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp"></i>
                            Bergabung via WhatsApp
                        </a>
                        <a href="https://wa.me/6281383045066?text=Halo%20Tim%20Mbah%20Darmo,%20saya%20ingin%20konsultasi%20paket%20{{ urlencode($package->name) }}"
                           class="btn btn-md-outline py-2" target="_blank">
                            <i class="bi bi-chat-dots me-1"></i> Konsultasi Dulu
                        </a>
                    </div>

                    <hr style="border-color:var(--md-border);">

                    <ul class="list-unstyled mb-0" style="font-size:0.8rem; color:var(--md-text-muted);">
                        <li class="d-flex gap-2 mb-2"><i class="bi bi-check-circle-fill" style="color:#25D366; flex-shrink:0;"></i>Konsultasi gratis, tanpa komitmen</li>
                        <li class="d-flex gap-2 mb-2"><i class="bi bi-check-circle-fill" style="color:#25D366; flex-shrink:0;"></i>Perjanjian resmi & transparan</li>
                        <li class="d-flex gap-2 mb-2"><i class="bi bi-check-circle-fill" style="color:#25D366; flex-shrink:0;"></i>Training & pendampingan penuh</li>
                        <li class="d-flex gap-2"><i class="bi bi-check-circle-fill" style="color:#25D366; flex-shrink:0;"></i>Support tim Mbah Darmo 24/7</li>
                    </ul>

                    <div class="mt-4 text-center">
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-telephone-fill" style="color:var(--md-gold);"></i>
                            <a href="tel:+6281383045066" style="color:var(--md-text); text-decoration:none; font-size:0.875rem; font-weight:500;">+62 813-8304-5066</a>
                        </div>
                        <div style="font-size:0.75rem; color:var(--md-text-muted); margin-top:0.25rem;">Senin–Sabtu, 08.00–17.00 WIB</div>
                    </div>
                </div>

                {{-- OTHER PACKAGES --}}
                <div class="mt-4">
                    <div style="font-size:0.75rem; font-weight:600; letter-spacing:1px; text-transform:uppercase; color:var(--md-text-muted); margin-bottom:0.75rem;">Paket Lainnya</div>
                    @foreach($packages as $pkg)
                    @if($pkg->slug !== $package->slug)
                    <a href="{{ route('franchise.show', $pkg->slug) }}"
                       style="display:flex; justify-content:space-between; align-items:center; padding:0.75rem 1rem; background:#fff; border:1px solid var(--md-border); border-radius:10px; text-decoration:none; color:var(--md-text); margin-bottom:0.5rem; transition:var(--transition); font-size:0.875rem;"
                       onmouseover="this.style.borderColor='var(--md-primary)'; this.style.color='var(--md-primary)';"
                       onmouseout="this.style.borderColor='var(--md-border)'; this.style.color='var(--md-text)';">
                        <span>Paket {{ $pkg->name }}</span>
                        <span style="font-weight:600; color:var(--md-gold);">Rp {{ number_format($pkg->price/1000000,0) }}Jt</span>
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
// Animate financial bars on scroll
const barFills = document.querySelectorAll('.fin-bar-fill');
const barObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // bars already have inline width, just trigger repaint
            entry.target.style.opacity = '1';
        }
    });
}, { threshold: 0.1 });
barFills.forEach(bar => { bar.style.opacity = '0'; bar.style.transition += ', opacity 0.5s ease'; barObserver.observe(bar); });
setTimeout(() => barFills.forEach(b => b.style.opacity = '1'), 300);
</script>
@endsection
