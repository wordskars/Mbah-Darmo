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
        <div class="row g-5">

            {{-- LEFT: INFO --}}
            <div class="col-lg-6">

                {{-- WA CTA CARD --}}
                <div class="cta-wa-card mb-4 fade-in-up">
                    <div style="font-size:0.7rem; letter-spacing:3px; text-transform:uppercase; color:var(--md-gold-light); font-weight:600; margin-bottom:0.75rem;">Cara Tercepat</div>
                    <h2 style="font-family:var(--font-heading); font-size:1.8rem; color:#fff; margin-bottom:0.75rem;">
                        Chat Langsung via<br><span style="color:var(--md-gold-light);">WhatsApp</span>
                    </h2>
                    <p style="color:rgba(255,255,255,0.6); font-size:0.875rem; line-height:1.8; margin-bottom:2rem;">
                        Respons cepat dari tim kami, siap melayani pertanyaan umum, informasi menu, maupun konsultasi mendalam tentang paket kemitraan franchise.
                    </p>
                    <div class="d-flex flex-column gap-3">
                        <a href="https://wa.me/6281383045066?text=Halo%20Tim%20Mbah%20Darmo,%20saya%20ingin%20bertanya%20tentang%20produk%20dan%20layanan%20Anda"
                           class="btn btn-whatsapp py-3 fs-6" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp fs-5"></i>
                            <span>Hubungi Kami via WhatsApp</span>
                        </a>
                        <a href="https://wa.me/6281383045066?text=Halo%20Tim%20Mbah%20Darmo,%20saya%20tertarik%20untuk%20mendiskusikan%20peluang%20Kemitraan%20Franchise"
                           class="btn py-3" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:#fff; border-radius:50px;" target="_blank">
                            <i class="bi bi-shop me-2"></i>
                            Diskusi Kemitraan via WhatsApp
                        </a>
                    </div>
                    <div style="margin-top:1.5rem; font-size:0.75rem; color:rgba(255,255,255,0.4);">
                        <i class="bi bi-clock me-1"></i>Biasanya direspons dalam &lt; 1 jam di jam kerja
                    </div>
                </div>

                {{-- INFO CARDS --}}
                <div class="d-flex flex-column gap-3 fade-in-up">
                    <div class="info-card">
                        <div class="info-icon">📍</div>
                        <div>
                            <h6 style="font-family:var(--font-heading); margin-bottom:0.25rem;">Kantor Pusat</h6>
                            <p class="text-md-muted mb-1" style="font-size:0.875rem;">Jl. Heritage Kuliner No. 7, Sleman, Daerah Istimewa Yogyakarta 55281</p>
                            <a href="https://maps.google.com/?q=Yogyakarta" target="_blank" style="font-size:0.8rem; color:var(--md-primary); text-decoration:none;">
                                <i class="bi bi-box-arrow-up-right me-1"></i>Buka di Google Maps
                            </a>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">📧</div>
                        <div>
                            <h6 style="font-family:var(--font-heading); margin-bottom:0.25rem;">Email Resmi</h6>
                            <a href="mailto:info@mbahdarmo.com" style="color:var(--md-primary); text-decoration:none; font-size:0.9rem;">info@mbahdarmo.com</a><br>
                            <a href="mailto:franchise@mbahdarmo.com" style="color:var(--md-text-muted); text-decoration:none; font-size:0.8rem;">franchise@mbahdarmo.com</a>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">🕐</div>
                        <div>
                            <h6 style="font-family:var(--font-heading); margin-bottom:0.25rem;">Jam Operasional</h6>
                            <div style="font-size:0.875rem;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-md-muted">Senin – Jumat</span>
                                    <strong>08.00 – 17.00 WIB</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-md-muted">Sabtu</span>
                                    <strong>08.00 – 14.00 WIB</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-md-muted">Minggu & Libur</span>
                                    <span style="color:#aaa;">Tutup</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: MAP --}}
            <div class="col-lg-6 fade-in-up">
                <div class="mb-3">
                    <span class="section-label">Lokasi Kami</span>
                    <h2 class="section-title mt-1" style="font-size:1.6rem;">Kunjungi Kantor Pusat</h2>
                </div>
                <div class="maps-frame mb-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126015.68859893296!2d110.30516865!3d-7.79558175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5787bd5b6bc5%3A0x612dc4e9a6dc5943!2sYogyakarta!5e0!3m2!1sid!2sid!4v1693000000000"
                        width="100%" height="380" style="border:0; display:block;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi Warung Mbah Darmo Yogyakarta">
                    </iframe>
                </div>

                {{-- QUICK CONTACT NUMBERS --}}
                <div style="background:var(--md-bg-warm); border:1px solid var(--md-border); border-radius:14px; padding:1.5rem;">
                    <h6 style="font-family:var(--font-heading); margin-bottom:1rem;">Kontak Cepat</h6>
                    <div class="row g-3">
                        <div class="col-6">
                            <div style="font-size:0.7rem; color:var(--md-text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:0.25rem;">WhatsApp Umum</div>
                            <a href="https://wa.me/6281383045066" style="color:var(--md-primary); font-weight:600; text-decoration:none; font-size:0.9rem;">+62 813-8304-5066</a>
                        </div>
                        <div class="col-6">
                            <div style="font-size:0.7rem; color:var(--md-text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:0.25rem;">Franchise Inquiry</div>
                            <a href="https://wa.me/6281383045066" style="color:var(--md-primary); font-weight:600; text-decoration:none; font-size:0.9rem;">+62 813-8304-5066</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
