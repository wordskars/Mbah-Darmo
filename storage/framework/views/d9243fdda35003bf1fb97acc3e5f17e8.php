<?php $__env->startSection('title', 'Kontak & Lokasi'); ?>
<?php $__env->startSection('meta_description', 'Hubungi Warung Mbah Darmo. Informasi alamat gerai pusat di Banyumas, jam operasional, layanan WhatsApp resmi, dan peta lokasi Google Maps.'); ?>

<?php $__env->startSection('extra-styles'); ?>
<style>
    /* =========================================================
       HERO KONTAK
       ========================================================= */
    .contact-hero {
        background-color: #1A100A;
        background-image: 
            linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.65) 100%),
            url('<?php echo e(asset("images/home/home.png")); ?>');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        min-height: 60vh;
        padding: 8.5rem 0 5rem;
        position: relative;
        text-align: center;
        color: #FFFFFF;
    }

    /* =========================================================
       INFO CARDS & WA CTA BOX
       ========================================================= */
    .cta-wa-box {
        background: linear-gradient(135deg, var(--md-wood) 0%, #1c0e08 100%);
        border-radius: var(--radius-lg);
        padding: 2.5rem;
        color: #FFFFFF;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .cta-wa-box::after {
        content: '';
        position: absolute;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(197, 148, 56, 0.12), transparent);
        right: -60px;
        bottom: -60px;
        pointer-events: none;
    }

    .info-card {
        background: #FFFFFF;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        transition: var(--transition);
        display: flex;
        gap: 1.25rem;
        align-items: flex-start;
        height: 100%;
        box-shadow: var(--shadow-subtle);
    }

    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: rgba(168, 50, 38, 0.25);
    }

    .info-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--md-bg-warm);
        color: var(--md-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
        border: 1px solid rgba(168, 50, 38, 0.15);
    }

    .info-card h6 {
        font-family: var(--font-heading);
        font-size: 1.1rem;
        color: var(--md-wood);
        margin-bottom: 0.35rem;
    }

    .info-card p {
        font-size: 0.88rem;
        color: var(--md-text-muted);
        line-height: 1.6;
        margin-bottom: 0;
    }

    .maps-frame-wrap {
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--md-border);
        box-shadow: var(--shadow-sm);
        height: 100%;
        min-height: 320px;
    }

    .maps-frame-wrap iframe {
        width: 100%;
        height: 100%;
        min-height: 320px;
        border: 0;
        display: block;
    }

    .section-tight {
        padding-top: 3.5rem;
        padding-bottom: 3.5rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="contact-hero text-white">
    <div class="container fade-in-up">
        <span class="section-label" style="color: var(--md-gold-light);">Hubungi Kami</span>
        <h1 class="section-title mt-1 mb-2" style="color: #FFFFFF; font-size: clamp(2.2rem, 4.2vw, 3.2rem); line-height: 1.25;">Kami Siap Melayani Anda</h1>
        <div class="section-divider"></div>
        <p class="mx-auto" style="max-width: 540px; font-size: 0.95rem; color: rgba(253, 248, 242, 0.85);">
            Punya pertanyaan mengenai menu tradisional kami atau ingin mendiskusikan peluang kemitraan franchise? Tim Warung Mbah Darmo siap membantu.
        </p>
    </div>
</section>



<section class="section-tight" style="background: var(--md-bg);">
    <div class="container">
        
        
        <div class="row g-4 align-items-stretch mb-4">
            
            
            <div class="col-lg-6 fade-in-up">
                <div class="cta-wa-box">
                    <div>
                        <span class="section-label" style="color: var(--md-gold-light);">Layanan Respon Cepat</span>
                        <h2 style="font-family: var(--font-heading); font-size: 1.85rem; color: #FFFFFF; margin-top: 0.25rem; margin-bottom: 1rem;">
                            Hubungi Langsung via <span style="color: var(--md-gold-light); font-style: italic; font-family: var(--font-serif-alt);">WhatsApp</span>
                        </h2>
                        <p style="color: rgba(253, 248, 242, 0.75); font-size: 0.92rem; line-height: 1.75; margin-bottom: 2rem;">
                            Dapatkan informasi lengkap mengenai menu, katering acara, hingga panduan awal kemitraan franchise langsung dari tim resmi kami.
                        </p>
                    </div>

                    <div>
                        <a href="https://wa.me/6281215142908?text=Halo%20Tim%20Warung%20Mbah%20Darmo,%20saya%20ingin%20bertanya%20informasi%20layanan%20dan%20kemitraan" 
                           class="btn-whatsapp py-3 px-4 w-100 justify-content-center fs-6" 
                           target="_blank" 
                           rel="noopener">
                            <i class="bi bi-whatsapp fs-5"></i>
                            <span>Chat WhatsApp Resmi Mbah Darmo</span>
                        </a>

                        <div class="d-flex align-items-center gap-2 mt-3 small" style="color: rgba(253, 248, 242, 0.6);">
                            <i class="bi bi-clock-history text-warning"></i>
                            <span>Respon cepat setiap hari pada jam operasional kerja</span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-6 fade-in-up">
                <div class="maps-frame-wrap">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.426236002619!2d109.25948737484039!3d-7.417989192592429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655ebe029e19ff%3A0xb86db80d4f8cc7da!2sWARUNG%20MBAH%20DARMO!5e0!3m2!1sid!2sid!4v1788622878579!5m2!1sid!2sid" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>
                </div>
            </div>

        </div>

        
        <div class="row g-4">
            
            
            <div class="col-md-6 col-lg-3 fade-in-up">
                <div class="info-card">
                    <div class="info-icon-wrap">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <h6>Alamat Gerai</h6>
                        <p>Kejawar, Arcawinangun, Kec. Purwokerto Tim., Kab. Banyumas, Jawa Tengah 53113</p>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6 col-lg-3 fade-in-up">
                <div class="info-card">
                    <div class="info-icon-wrap">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div>
                        <h6>Jam Operasional</h6>
                        <p>Senin – Minggu<br><strong>12.00 – 22.00 WIB</strong><br><span class="text-success small">● Buka Setiap Hari</span></p>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6 col-lg-3 fade-in-up">
                <div class="info-card">
                    <div class="info-icon-wrap">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div>
                        <h6>Telepon / WA</h6>
                        <p>
                            <a href="https://wa.me/6281215142908" style="color: var(--md-primary); font-weight: 700; text-decoration: none;">
                                +62 812-1514-2908
                            </a>
                            <br><span class="small text-muted">Layanan Konsumen &amp; Franchise</span>
                        </p>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6 col-lg-3 fade-in-up">
                <div class="info-card">
                    <div class="info-icon-wrap">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div>
                        <h6>Email Resmi</h6>
                        <p>
                            <a href="mailto:info@mbahdarmo.com" style="color: var(--md-primary); font-weight: 600; text-decoration: none;">
                                info@mbahdarmo.com
                            </a>
                            <br><span class="small text-muted">Kerjasama &amp; Bisnis</span>
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\CLONE DARMO\PT-Antasena\resources\views/contact/index.blade.php ENDPATH**/ ?>