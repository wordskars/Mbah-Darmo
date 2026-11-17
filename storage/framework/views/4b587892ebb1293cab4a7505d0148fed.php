<?php $__env->startSection('title', 'Rincian Paket ' . $package->name . ' – Kemitraan Warung Mbah Darmo'); ?>
<?php $__env->startSection('meta_description', 'Rincian lengkap paket franchise ' . $package->name . ' Warung Mbah Darmo. Fasilitas, proyeksi keuangan, daftar menu, dan estimasi ROI.'); ?>

<?php $__env->startSection('extra-styles'); ?>
<style>
    /* =========================================================
       DETAIL HERO
       ========================================================= */
    .pkg-hero {
        background-color: #1A100A;
        background-image: 
            linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.65) 100%),
            url('<?php echo e(asset("images/home/kemitraan/franchise.jpg")); ?>');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        min-height: 60vh;
        padding: 8.5rem 0 5rem;
        position: relative;
        color: #FFFFFF;
    }

    .pkg-breadcrumb {
        font-size: 0.82rem;
        margin-bottom: 1.25rem;
    }

    .pkg-breadcrumb a {
        color: rgba(253, 248, 242, 0.6);
        text-decoration: none;
        transition: var(--transition);
    }

    .pkg-breadcrumb a:hover {
        color: var(--md-gold-light);
    }

    .pkg-nav-pills {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .pkg-pill {
        padding: 0.45rem 1.2rem;
        border-radius: var(--radius-pill);
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.7);
        background: rgba(255, 255, 255, 0.05);
    }

    .pkg-pill:hover {
        color: #FFFFFF;
        border-color: rgba(255, 255, 255, 0.45);
        background: rgba(255, 255, 255, 0.12);
    }

    .pkg-pill.active {
        background: var(--md-primary);
        color: #FFFFFF;
        border-color: var(--md-primary);
        box-shadow: 0 4px 12px rgba(168, 50, 38, 0.35);
    }

    /* =========================================================
       CONTENT SECTIONS
       ========================================================= */
    .detail-section {
        padding: 2.25rem 0;
        border-bottom: 1px solid var(--md-border);
    }

    .detail-section:last-child {
        border-bottom: none;
    }

    /* HIGHLIGHTS */
    .highlight-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 0.75rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .highlight-list li {
        background: var(--md-bg);
        border: 1px solid var(--md-border);
        border-radius: var(--radius-sm);
        padding: 0.85rem 1.15rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        font-size: 0.9rem;
        color: var(--md-text);
    }

    .highlight-list li::before {
        content: '✓';
        color: var(--md-primary);
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
    }

    /* STAT BOX */
    .stat-box {
        background: #FFFFFF;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-md);
        padding: 1.25rem 1rem;
        text-align: center;
        box-shadow: var(--shadow-subtle);
    }

    .stat-box .val {
        font-family: var(--font-heading);
        font-size: 1.45rem;
        font-weight: 700;
        color: var(--md-wood);
    }

    .stat-box .lbl {
        font-size: 0.7rem;
        color: var(--md-text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 0.25rem;
    }

    /* FINANCIAL BREAKDOWN BARS */
    .fin-bar-wrap {
        margin-bottom: 1rem;
    }

    .fin-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 0.35rem;
    }

    .fin-bar {
        height: 10px;
        border-radius: var(--radius-pill);
        background: var(--md-border);
        overflow: hidden;
    }

    .fin-bar-fill {
        height: 100%;
        border-radius: var(--radius-pill);
        transition: width 1s ease;
    }

    /* MENU LIST ITEMS */
    .menu-sku-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: var(--radius-sm);
        background: var(--md-bg);
        border: 1px solid var(--md-border);
        font-size: 0.88rem;
        color: var(--md-text);
    }

    .menu-sku-item::before {
        content: '🍲';
        font-size: 1.1rem;
    }

    /* =========================================================
       TOTAL INVESTASI CARD (STATIS / NORMAL FLOW)
       ========================================================= */
    .investment-card {
        background: #FFFFFF;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-sm);
        position: relative; /* STATIS - TIDAK STICKY */
    }

    .investment-card-header {
        border-bottom: 1px solid var(--md-border);
        padding-bottom: 1.25rem;
        margin-bottom: 1.25rem;
    }

    .investment-card-price {
        font-family: var(--font-heading);
        font-size: 2.3rem;
        font-weight: 700;
        color: var(--md-wood);
        line-height: 1.1;
    }

    .other-pkg-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        background: var(--md-bg);
        border: 1px solid var(--md-border);
        border-radius: var(--radius-sm);
        text-decoration: none;
        color: var(--md-text);
        margin-bottom: 0.5rem;
        transition: var(--transition);
        font-size: 0.88rem;
    }

    .other-pkg-link:hover {
        border-color: var(--md-primary);
        color: var(--md-primary);
        background: #FFFFFF;
        transform: translateX(3px);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="pkg-hero text-white">
    <div class="container position-relative">
        
        
        <div class="pkg-breadcrumb">
            <a href="<?php echo e(route('franchise.index')); ?>">Kemitraan</a>
            <span class="mx-2 text-white-50">/</span>
            <span style="color: var(--md-gold-light);">Paket <?php echo e($package->name); ?></span>
        </div>

        
        <div class="pkg-nav-pills">
            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('franchise.show', $pkg->slug)); ?>" class="pkg-pill <?php echo e($pkg->slug === $package->slug ? 'active' : ''); ?>">
                Paket <?php echo e($pkg->name); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="section-label" style="color: var(--md-gold-light);">Rincian Paket Kemitraan</span>
                <h1 class="section-title mt-1 mb-3" style="color: #FFFFFF; font-size: clamp(2.2rem, 4vw, 3.2rem);">
                    Paket <span style="color: var(--md-gold-light); font-style: italic; font-family: var(--font-serif-alt);"><?php echo e($package->name); ?></span>
                </h1>
                <p style="color: rgba(253, 248, 242, 0.85); font-size: 1rem; line-height: 1.8; max-width: 620px;">
                    <?php echo e($package->description); ?>

                </p>
            </div>

            <div class="col-lg-4">
                <div style="background: rgba(253, 248, 242, 0.08); border: 1px solid rgba(253, 248, 242, 0.18); border-radius: var(--radius-md); padding: 1.5rem; backdrop-filter: blur(6px);">
                    <div style="font-size: 0.72rem; letter-spacing: 2px; color: var(--md-gold-light); text-transform: uppercase; margin-bottom: 0.25rem;">Total Nilai Investasi</div>
                    <div class="investment-card-price" style="color: #FFFFFF;">
                        <?php echo e($package->formatted_price); ?>

                    </div>
                    <div class="mt-2 small" style="color: rgba(253, 248, 242, 0.75);">
                        <i class="bi bi-arrow-repeat me-1 text-warning"></i>Estimasi Payback: <strong><?php echo e($package->roi_projection); ?></strong>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>



<section class="py-5" style="background: var(--md-bg);">
    <div class="container">
        <div class="row g-5">
            
            
            <div class="col-lg-8">
                
                
                <div class="detail-section pt-0">
                    <span class="section-label">Spesifikasi Gerai</span>
                    <h2 class="section-title mt-1 mb-4" style="font-size: 1.65rem;">Kapasitas &amp; Operasional</h2>
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <div class="val"><?php echo e($package->space_required); ?></div>
                                <div class="lbl">Luas Ruang</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <div class="val"><?php echo e($package->pax_capacity); ?></div>
                                <div class="lbl">Kapasitas Pax</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <div class="val"><?php echo e($package->staff_count); ?> Org</div>
                                <div class="lbl">Kebutuhan SDM</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <div class="val"><?php echo e($package->monthly_revenue_estimate); ?></div>
                                <div class="lbl">Est. Omzet/Bln</div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <?php if(is_array($package->highlights) && count($package->highlights) > 0): ?>
                <div class="detail-section">
                    <span class="section-label">Fasilitas Termasuk</span>
                    <h2 class="section-title mt-1 mb-4" style="font-size: 1.65rem;">Yang Anda Dapatkan</h2>
                    <ul class="highlight-list">
                        <?php $__currentLoopData = $package->highlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($h); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                
                

                
                <?php
                    $menuList = is_string($package->menu_list) 
                        ? json_decode($package->menu_list, true) 
                        : $package->menu_list;
                ?>
                <?php if(is_array($menuList) && count($menuList) > 0): ?>
                <div class="detail-section">
                    <span class="section-label">Katalog Menu Gerai</span>
                    <h2 class="section-title mt-1 mb-4" style="font-size: 1.65rem;">Menu yang Disajikan di Paket <?php echo e($package->name); ?></h2>
                    <div class="row g-2">
                        <?php $__currentLoopData = $menuList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6">
                            <div class="menu-sku-item"><?php echo e($item); ?></div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                
                

            </div>

            
            <div class="col-lg-4">
                <div class="investment-card">
                    <div class="investment-card-header">
                        <div style="font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; color: var(--md-primary); font-weight: 700; margin-bottom: 0.35rem;">
                            Paket <?php echo e($package->name); ?>

                        </div>
                        <div class="investment-card-price"><?php echo e($package->formatted_price); ?></div>
                        <div class="small text-md-muted mt-1">
                            <i class="bi bi-clock-history me-1"></i>Estimasi Balik Modal: <strong><?php echo e($package->roi_projection); ?></strong>
                        </div>
                    </div>

                    
                    <div class="d-grid mb-4">
                        <a href="<?php echo e($package->whatsapp_url); ?>" 
                           class="btn-whatsapp py-3 justify-content-center" 
                           target="_blank" 
                           rel="noopener">
                            <i class="bi bi-whatsapp fs-5"></i>
                            <span>Gabung via WhatsApp</span>
                        </a>
                    </div>

                    <div style="background: var(--md-bg-warm); border-radius: var(--radius-sm); padding: 1.25rem; margin-bottom: 1.5rem; border: 1px solid var(--md-border);">
                        <ul class="list-unstyled mb-0 small" style="color: var(--md-text); line-height: 1.9;">
                            <li class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Konsultasi gratis &amp; tanpa komitmen</span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Perjanjian kemitraan resmi &amp; legal</span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Pelatihan komprehensif seluruh staf</span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Dukungan marketing &amp; bumbu terpusat</span>
                            </li>
                        </ul>
                    </div>

                    <div class="text-center pt-2">
                        <div class="small text-md-muted">Layanan Konsultasi Franchise:</div>
                        <a href="tel:6281215142908" style="color: var(--md-wood); font-weight: 700; text-decoration: none; font-size: 1rem;">
                            <i class="bi bi-telephone-fill text-danger me-1"></i>+62 812-1514-2908
                        </a>
                    </div>
                </div>

                
                <div class="mt-4">
                    <div style="font-size: 0.8rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--md-wood); margin-bottom: 0.75rem;">
                        Pilihan Paket Lainnya
                    </div>
                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($pkg->slug !== $package->slug): ?>
                        <a href="<?php echo e(route('franchise.show', $pkg->slug)); ?>" class="other-pkg-link">
                            <span style="font-weight: 600;">Paket <?php echo e($pkg->name); ?></span>
                            <span style="color: var(--md-primary); font-weight: 700;">Rp <?php echo e(number_format($pkg->price / 1000000, 0)); ?> Jt</span>
                        </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\CLONE DARMO\PT-Antasena\resources\views/franchise/show.blade.php ENDPATH**/ ?>