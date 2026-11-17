<?php $__env->startSection('title', 'Katalog Menu Digital'); ?>
<?php $__env->startSection('meta_description', 'Katalog menu digital Warung Mbah Darmo — Bakmie Jawa Arang, Mie Gepeng Batok, Sate Kambing Rempah, Babat Gongso, Wedang Jahe, dan aneka sajian khas Jawa.'); ?>

<?php $__env->startSection('extra-styles'); ?>
<style>
    /* =========================================================
       MENU HERO
       ========================================================= */
    .menu-hero {
        background-color: #1A100A;
        background-image: 
            linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.65) 100%),
            url('<?php echo e(asset("images/home/menu/IMG_4608.jpg")); ?>');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 60vh;
        padding: 8.5rem 0 5rem;
        position: relative;
        text-align: center;
        color: #FFFFFF;
    }

    /* =========================================================
       FILTER & SEARCH BAR (NON-STICKY)
       ========================================================= */
    .menu-filter-section {
        background: #FFFFFF;
        border-bottom: 1px solid var(--md-border);
        padding: 1.25rem 0;
        position: relative;
        z-index: 10;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    }

    .filter-tabs {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-btn {
        border: 1px solid var(--md-border);
        background: var(--md-bg);
        padding: 0.45rem 1.15rem;
        border-radius: var(--radius-pill);
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--md-text);
        cursor: pointer;
        transition: var(--transition);
        white-space: nowrap;
    }

    .filter-btn:hover {
        background: var(--md-bg-warm);
        border-color: var(--md-primary);
        color: var(--md-primary);
    }

    .filter-btn.active {
        background: var(--md-primary);
        border-color: var(--md-primary);
        color: #FFFFFF;
        box-shadow: 0 4px 12px rgba(168, 50, 38, 0.25);
    }

    .search-input-wrap {
        position: relative;
    }

    .search-input-wrap .search-icon {
        position: absolute;
        left: 1.1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--md-text-muted);
        font-size: 0.95rem;
    }

    .search-input {
        width: 100%;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-pill);
        padding: 0.55rem 1.25rem 0.55rem 2.6rem;
        font-size: 0.88rem;
        background: var(--md-bg);
        color: var(--md-text);
        transition: var(--transition);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--md-primary);
        background: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(168, 50, 38, 0.12);
    }

    /* =========================================================
       MENU CARDS (PURELY CATALOG VIEW-ONLY)
       ========================================================= */
    .menu-card {
        background: #FFFFFF;
        border: 1px solid var(--md-border);
        border-radius: var(--radius-md);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-subtle);
    }

    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: rgba(168, 50, 38, 0.25);
    }

    .menu-card-img-box {
        height: 200px;
        position: relative;
        background: var(--md-bg-warm);
        overflow: hidden;
    }

    .menu-card-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .menu-card:hover .menu-card-img-box img {
        transform: scale(1.06);
    }

    .cat-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(44, 27, 19, 0.85);
        backdrop-filter: blur(4px);
        color: var(--md-gold-light);
        padding: 3px 10px;
        border-radius: var(--radius-pill);
        font-size: 0.7rem;
        font-weight: 600;
        z-index: 2;
    }

    .featured-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--md-primary);
        color: #FFFFFF;
        padding: 3px 10px;
        border-radius: var(--radius-pill);
        font-size: 0.68rem;
        font-weight: 700;
        z-index: 2;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    .menu-card-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }

    .menu-card-title {
        font-family: var(--font-heading);
        font-size: 1.15rem;
        color: var(--md-wood);
        font-weight: 700;
        margin-bottom: 0.35rem;
    }

    .menu-card-desc {
        font-size: 0.85rem;
        color: var(--md-text-muted);
        line-height: 1.6;
        margin-bottom: 1rem;
        flex-grow: 1;
    }

    .menu-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 0.75rem;
        border-top: 1px solid var(--md-border);
    }

    .menu-card-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--md-primary);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 1rem;
        color: var(--md-text-muted);
    }

    .empty-state i {
        font-size: 3.5rem;
        color: var(--md-border);
        margin-bottom: 1rem;
        display: inline-block;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="menu-hero text-white">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-8 fade-in-up">
                
                <span class="section-label" style="color: var(--md-gold-light);">Daftar Sajian Tradisional</span>
                <h1 class="section-title mt-1 mb-3" style="color: #FFFFFF; font-size: clamp(2.2rem, 4vw, 3.2rem);">
                    Katalog Menu <span style="color: var(--md-gold-light); font-style: italic; font-family: var(--font-serif-alt);">Warung Mbah Darmo</span>
                </h1>
                
                <p style="color: rgba(253, 248, 242, 0.85); font-size: 1rem; line-height: 1.75; max-width: 580px; margin: 0 auto;">
                    Katalog visual hidangan khas Jawa legendaris. Dimasak dengan tungku arang tradisional dan resep rempah warisan leluhur sejak 1985.
                </p>

            </div>
        </div>
    </div>
</section>



<section class="menu-filter-section">
    <div class="container">
        <div class="row align-items-center g-3">
            
            
            <div class="col-lg-4 col-md-5">
                <div class="search-input-wrap">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari sajian (contoh: bakmie, sate, wedang...)" value="<?php echo e(request('search')); ?>">
                </div>
            </div>

            
            <div class="col-lg-8 col-md-7">
                <div class="filter-tabs">
                    <button type="button" class="filter-btn active" data-cat="all">
                        Semua Menu
                    </button>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($cat->menus_count > 0): ?>
                        <button type="button" class="filter-btn" data-cat="<?php echo e($cat->slug); ?>">
                            <?php echo e($cat->name); ?> (<?php echo e($cat->menus_count); ?>)
                        </button>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>
    </div>
</section>



<section class="py-5" style="background: var(--md-bg);">
    <div class="container">
        
        <div id="menuGrid" class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-sm-6 col-lg-4 col-xl-3 menu-item fade-in-up" 
                 data-cat="<?php echo e($menu->category->slug); ?>" 
                 data-name="<?php echo e(strtolower($menu->name)); ?> <?php echo e(strtolower($menu->description ?? '')); ?>">
                
                <div class="menu-card">
                    <div class="menu-card-img-box">
                        <img src="<?php echo e($menu->image_url); ?>" 
                             alt="<?php echo e($menu->name); ?>" 
                             class="w-full h-48 object-cover" 
                             loading="lazy" 
                             onerror="this.onerror=null;this.src='<?php echo e(asset('images/home/menu/IMG_4608.jpg')); ?>';">

                        <span class="cat-badge"><?php echo e($menu->category->name); ?></span>

                        <?php if($menu->is_featured): ?>
                            <span class="featured-badge">⭐ Favorit</span>
                        <?php endif; ?>
                    </div>

                    <div class="menu-card-body">
                        <div>
                            <h5 class="menu-card-title"><?php echo e($menu->name); ?></h5>
                            <p class="menu-card-desc">
                                <?php echo e($menu->short_description_hover ?? $menu->description ?? 'Hidangan istimewa racikan bumbu rempah otentik Warung Mbah Darmo.'); ?>

                            </p>
                        </div>

                        <div class="menu-card-footer">
                            <span class="menu-card-price"><?php echo e($menu->formatted_price); ?></span>

                            <?php if($menu->spice_level && $menu->spice_level !== 'mild'): ?>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle small">
                                    <?php if($menu->spice_level === 'hot'): ?> 🌶️🌶️ Pedas
                                    <?php elseif($menu->spice_level === 'medium'): ?> 🌶️ Sedang
                                    <?php elseif($menu->spice_level === 'extra-hot'): ?> 🌶️🌶️🌶️ Ekstra
                                    <?php endif; ?>
                                </span>
                            <?php else: ?>
                                <span class="badge bg-light text-muted border small">Gurih Nikmat</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-journal-x"></i>
                    <h4>Belum Ada Menu</h4>
                    <p>Daftar menu sedang diperbarui. Silakan kunjungi kembali nanti.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div id="noResults" class="empty-state d-none">
            <i class="bi bi-search"></i>
            <h4>Menu Tidak Ditemukan</h4>
            <p>Silakan coba kata kunci lain atau pilih kategori yang berbeda.</p>
        </div>

    </div>
</section>



<section class="py-5" style="background: var(--md-bg-warm); border-top: 1px solid var(--md-border);">
    <div class="container text-center">
        <div class="fade-in-up">
            <h4 style="font-family: var(--font-heading); color: var(--md-wood); margin-bottom: 0.5rem;">
                Ingin Menikmati Hidangan Mbah Darmo di Acara Anda?
            </h4>
            <p class="text-md-muted mb-4" style="font-size: 0.95rem; max-width: 520px; margin: 0 auto 1.5rem;">
                Kami melayani pesanan katering, prasmanan, dan nasi boks untuk acara keluarga, kantor, maupun perayaan khusus.
            </p>
            <a href="https://wa.me/6281215142908?text=Halo%20Warung%20Mbah%20Darmo,%20saya%20ingin%20bertanya%20mengenai%20pesanan%20katering%20menu" 
               class="btn-whatsapp" 
               target="_blank" 
               rel="noopener">
                <i class="bi bi-whatsapp"></i>
                <span>Hubungi Layanan Katering via WhatsApp</span>
            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // FILTER & SEARCH LOGIC
    const items = document.querySelectorAll('.menu-item');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const searchInput = document.getElementById('searchInput');
    const noResults = document.getElementById('noResults');
    let activeCategory = 'all';

    function filterMenus() {
        const query = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        items.forEach(item => {
            const matchCategory = (activeCategory === 'all' || item.dataset.cat === activeCategory);
            const matchSearch = (query === '' || item.dataset.name.includes(query));
            const shouldShow = matchCategory && matchSearch;

            item.style.display = shouldShow ? '' : 'none';
            if (shouldShow) visibleCount++;
        });

        if (noResults) {
            noResults.classList.toggle('d-none', visibleCount > 0);
        }
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeCategory = btn.dataset.cat;
            filterMenus();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', filterMenus);
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\CLONE DARMO\PT-Antasena\resources\views/menu/index.blade.php ENDPATH**/ ?>