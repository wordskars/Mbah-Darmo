@extends('layouts.app')

@section('title', 'Kontak Kami')
@section('meta_description', 'Hubungi Warung Mbah Darmo via WhatsApp. Kantor pusat di Yogyakarta. Konsultasi kemitraan franchise dan informasi menu tersedia 7 hari seminggu.')

@section('extra-styles')
<style>
.contact-hero {
    background: linear-gradient(135deg, var(--md-bg-warm), #EDE0CE);
    padding: 5rem 0 3rem; border-bottom: 1px solid var(--md-border);
}
.info-card {
    background: #fff; border: 1px solid var(--md-border);
    border-radius: 16px; padding: 2rem; transition: var(--transition);
    display: flex; gap: 1.25rem; align-items: flex-start;
}
.info-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }
.info-icon {
    width: 52px; height: 52px; border-radius: 12px; flex-shrink: 0;
    background: linear-gradient(135deg, rgba(128,0,0,0.08), rgba(161,138,67,0.1));
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; border: 1px solid rgba(161,138,67,0.2);
}
.cta-wa-card {
    background: linear-gradient(135deg, var(--md-charcoal), #1a0a0a);
    border-radius: 20px; padding: 3rem; color: #fff;
    position: relative; overflow: hidden;
}
.cta-wa-card::before {
    content: ''; position: absolute;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(161,138,67,0.1), transparent);
    right: -80px; bottom: -80px;
}

/* Efek Hover Kustom Tombol Kedua */
.btn-whatsapp-secondary {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #fff;
    border-radius: 50px;
    transition: var(--transition, all 0.3s ease);
}

.btn-whatsapp-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.maps-frame { border-radius: 16px; overflow: hidden; border: 1px solid var(--md-border); height: 100%; min-height: 250px; }
.maps-frame iframe { width: 100%; height: 100%; border: 0; display: block; }
.maps-frame { border-radius: 16px; overflow: hidden; border: 1px solid var(--md-border); }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="contact-hero">
    <div class="container text-center fade-in-up">
        <span class="section-label">Hubungi Kami</span>
        <h1 class="section-title mt-2">Kami Siap Membantu Anda</h1>
        <div class="section-divider"></div>
        <p class="text-md-muted mt-3" style="max-width:500px; margin:auto; font-size:0.95rem;">
            Punya pertanyaan tentang menu, ingin konsultasi kemitraan, atau sekadar ingin menyapa? Tim Mbah Darmo siap hadir untuk Anda.
        </p>
    </div>
</section>

{{-- MAIN --}}
<section class="py-5">
    <div class="container">
        
        {{-- BARIS 1: BOX WA (KIRI) & BOX MAPS (KANAN) --}}
        <div class="row g-4 align-items-stretch mb-4">
            
            {{-- BOX WA (KIRI) --}}
            <div class="col-lg-6 fade-in-up">
                <div class="cta-wa-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div style="font-size:0.7rem; letter-spacing:3px; text-transform:uppercase; color:var(--md-gold-light); font-weight:600; margin-bottom:0.75rem;">Cara Tercepat</div>
                        <h2 style="font-family:var(--font-heading); font-size:1.8rem; color:#fff; margin-bottom:0.75rem;">
                            Chat Langsung via<br><span style="color:var(--md-gold-light);">WhatsApp</span>
                        </h2>
                        <p style="color:rgba(255,255,255,0.6); font-size:0.875rem; line-height:1.8; margin-bottom:2rem;">
                            Respons cepat dari tim kami, siap melayani pertanyaan umum, informasi menu, maupun konsultasi mendalam tentang paket kemitraan franchise.
                        </p>
                    </div>

                    <div>
                        <div class="d-flex flex-column gap-3">
                            <a href="https://wa.me/6281383045066?text=Halo%20Tim%20Mbah%20Darmo,%20saya%20ingin%20bertanya%20tentang%20produk%20dan%20layanan%20Anda"
                               class="btn btn-whatsapp py-3 fs-6 d-flex align-items-center justify-content-start px-4 text-start" target="_blank" rel="noopener">
                                <i class="bi bi-whatsapp fs-5 me-2"></i>
                                <span>Hubungi Kami via WhatsApp</span>
                            </a>
                            <a href="https://wa.me/6281383045066?text=Halo%20Tim%20Mbah%20Darmo,%20saya%20tertarik%20untuk%20mendiskusikan%20peluang%20Kemitraan%20Franchise"
                               class="btn btn-whatsapp-secondary py-3 fs-6 d-flex align-items-center justify-content-start px-4 text-start" target="_blank" rel="noopener">
                                <i class="bi bi-shop fs-5 me-2"></i>
                                <span>Diskusi Kemitraan via WhatsApp</span>
                            </a>
                        </div>
                        <div style="margin-top:1.5rem; font-size:0.75rem; color:rgba(255,255,255,0.4);">
                            <i class="bi bi-clock me-1"></i>Biasanya direspons dalam &lt; 1 jam di jam kerja
                        </div>
                    </div>
                </div>
            </div>

            {{-- BOX MAPS (KANAN) --}}
            <div class="col-lg-6 fade-in-up">
                <div class="d-flex flex-column h-100">
                    <div class="mb-3">
                        <span class="section-label">Lokasi Kami</span>
                        <h2 class="section-title mt-1" style="font-size:1.6rem;">Kunjungi Kantor Pusat</h2>
                    </div>
                    <div class="maps-frame flex-grow-1">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.426236002619!2d109.25948737484039!3d-7.417989192592429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655ebe029e19ff%3A0xb86db80d4f8cc7da!2sWARUNG%20MBAH%20DARMO!5e0!3m2!1sid!2sid!4v1788622878579!5m2!1sid!2sid" 
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>

        {{-- BARIS 2: GRID 2 BARIS PRESISI --}}
<div class="d-flex flex-column gap-3">

    {{-- SUB-BARIS ATAS (Kantor Pusat vs Kontak Cepat) --}}
    <div class="row g-3 align-items-stretch">
        <div class="col-lg-6 fade-in-up">
            <div class="info-card h-100 align-items-center">
                <div class="info-icon">📍</div>
                <div class="w-100">
                    <h6 style="font-family:var(--font-heading); margin-bottom:0.25rem;">Kantor Pusat & Email</h6>
                    <p class="text-md-muted mb-2" style="font-size:0.875rem;">Kejawar, Arcawinangun, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53113</p>
                    <div class="pt-2 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <a href="mailto:info@mbahdarmo.com" style="color:var(--md-primary); text-decoration:none; font-size:0.85rem;">
                            <i class="bi bi-envelope me-1"></i>info@mbahdarmo.com
                        </a>
                        <a href="https://maps.app.goo.gl/GSHsEJMSYSwyXXrF8" target="_blank" style="font-size:0.8rem; color:var(--md-primary); text-decoration:none;">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 fade-in-up">
            <div class="info-card h-100 align-items-center">
                <div class="info-icon">📞</div>
                <div class="w-100">
                    <h6 style="font-family:var(--font-heading); margin-bottom:0.5rem;">Kontak Cepat</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <div style="font-size:0.7rem; color:var(--md-text-muted); text-transform:uppercase; letter-spacing:0.5px;">WhatsApp Umum</div>
                            <a href="https://wa.me/6281383045066" style="color:var(--md-primary); font-weight:600; text-decoration:none; font-size:0.875rem;">+62 813-8304-5066</a>
                        </div>
                        <div class="col-6">
                            <div style="font-size:0.7rem; color:var(--md-text-muted); text-transform:uppercase; letter-spacing:0.5px;">Franchise Inquiry</div>
                            <a href="https://wa.me/6281383045066" style="color:var(--md-primary); font-weight:600; text-decoration:none; font-size:0.875rem;">+62 813-8304-5066</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SUB-BARIS BAWAH (Jam Operasional vs Layanan Konsultasi) --}}
    <div class="row g-3 align-items-stretch">
        <div class="col-lg-6 fade-in-up">
            <div class="info-card h-100 align-items-center">
                <div class="info-icon">🕐</div>
                <div class="w-100">
                    <h6 style="font-family:var(--font-heading); margin-bottom:0.25rem;">Jam Operasional</h6>
                    <div style="font-size:0.875rem;" class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <span class="text-md-muted me-2">Senin – Minggu</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size:0.75rem; font-weight:500;">
                                Buka Setiap Hari
                            </span>
                        </div>
                        <strong>12.00 – 22.00 WIB</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 fade-in-up">
            <div class="info-card h-100 align-items-center">
                <div class="info-icon">💬</div>
                <div class="w-100">
                    <h6 style="font-family:var(--font-heading); margin-bottom:0.25rem;">Layanan Konsultasi</h6>
                    <p class="text-md-muted mb-0" style="font-size:0.85rem;">
                        Respon cepat & ramah untuk pertanyaan menu, reservasi tempat, hingga diskusi kemitraan.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

    </div>
</section>

@endsection
