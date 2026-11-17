<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('page-title','Dashboard Overview'); ?>

<?php $__env->startSection('extra-styles'); ?>
<style>
.revenue-badge {
    background: var(--badge-sage-bg);
    color: var(--badge-sage-text);
    border: 1px solid var(--badge-sage-brd);
    border-radius: 50px;
    padding: 0.25rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
}
.chart-bar-wrap {
    display: flex;
    flex-direction: column;
    gap: 0.9rem;
}
.chart-row {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    font-size: 0.85rem;
}
.chart-rank {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: var(--md-bg-cream);
    border: 1px solid var(--md-border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--md-text-muted);
    flex-shrink: 0;
}
.chart-row:first-child .chart-rank {
    background: #FEF3E2;
    border-color: #FCD39D;
    color: #92400E;
}
.chart-label {
    width: 160px;
    color: var(--md-text-dark);
    font-weight: 500;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    flex-shrink: 0;
}
.chart-bar-bg {
    flex: 1;
    background: #EFEAE3;
    border-radius: 50px;
    height: 10px;
    overflow: hidden;
}
.chart-bar-fg {
    height: 100%;
    border-radius: 50px;
    background: linear-gradient(90deg, var(--md-terracotta), var(--md-gold));
    transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}
.chart-val {
    width: 70px;
    text-align: right;
    font-weight: 700;
    color: var(--md-text-dark);
    font-size: 0.825rem;
}
.quick-action-btn {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    border: 1px solid var(--md-border);
    background: #FAF8F5;
    color: var(--md-text-dark);
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    transition: var(--transition-smooth);
}
.quick-action-btn:hover {
    background: #FFFFFF;
    border-color: var(--md-terracotta);
    color: var(--md-terracotta);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(44, 27, 19, 0.06);
}
.quick-action-btn i {
    font-size: 1.15rem;
    margin-right: 0.75rem;
    color: var(--md-terracotta);
}
.quick-action-btn.ai-btn {
    background: linear-gradient(135deg, rgba(168, 50, 38, 0.05), rgba(212, 175, 55, 0.1));
    border-color: rgba(212, 175, 55, 0.4);
}
.quick-action-btn.ai-btn:hover {
    border-color: var(--md-gold);
    color: #8A6D1C;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4 mb-4">
    <!-- STAT CARDS -->
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);font-weight:700;margin-bottom:0.35rem;">Total Menu</div>
                        <div style="font-family:var(--font-heading);font-size:2.2rem;font-weight:700;color:var(--md-text-dark);line-height:1;"><?php echo e($totalMenus); ?></div>
                    </div>
                    <div class="stat-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                </div>
            </div>
            <div class="pt-2 border-top" style="border-color:var(--md-border) !important;">
                <a href="<?php echo e(route('admin.menus.index')); ?>" class="d-flex align-items-center justify-content-between text-decoration-none" style="font-size:0.8rem;color:var(--md-terracotta);font-weight:600;">
                    <span>Kelola Menu</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);font-weight:700;margin-bottom:0.35rem;">Promo Aktif</div>
                        <div style="font-family:var(--font-heading);font-size:2.2rem;font-weight:700;color:var(--md-text-dark);line-height:1;"><?php echo e($totalPromos); ?></div>
                    </div>
                    <div class="stat-icon"><i class="bi bi-megaphone-fill"></i></div>
                </div>
            </div>
            <div class="pt-2 border-top" style="border-color:var(--md-border) !important;">
                <a href="<?php echo e(route('admin.promotions.index')); ?>" class="d-flex align-items-center justify-content-between text-decoration-none" style="font-size:0.8rem;color:var(--md-terracotta);font-weight:600;">
                    <span>Kelola Promo</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);font-weight:700;margin-bottom:0.35rem;">Total Transaksi</div>
                        <div style="font-family:var(--font-heading);font-size:2.2rem;font-weight:700;color:var(--md-text-dark);line-height:1;"><?php echo e(number_format($totalTransactions)); ?></div>
                    </div>
                    <div class="stat-icon"><i class="bi bi-receipt-cutoff"></i></div>
                </div>
            </div>
            <div class="pt-2 border-top" style="border-color:var(--md-border) !important;">
                <a href="<?php echo e(route('admin.sales.index')); ?>" class="d-flex align-items-center justify-content-between text-decoration-none" style="font-size:0.8rem;color:var(--md-terracotta);font-weight:600;">
                    <span>Lihat Laporan</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);font-weight:700;margin-bottom:0.35rem;">Revenue 30 Hari</div>
                        <div style="font-family:var(--font-heading);font-size:1.8rem;font-weight:700;color:var(--md-text-dark);line-height:1;">Rp <?php echo e(number_format($recentRevenue/1000000,1)); ?>Jt</div>
                    </div>
                    <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
                </div>
            </div>
            <div class="pt-2 border-top" style="border-color:var(--md-border) !important;">
                <?php if($topProduct): ?>
                <span class="badge-active text-truncate d-inline-block mw-100">
                    <i class="bi bi-star-fill text-warning"></i> Top: <?php echo e(Str::limit($topProduct->name, 20)); ?>

                </span>
                <?php else: ?>
                <span style="font-size:0.8rem;color:var(--md-text-muted);">Data 30 hari terakhir</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- TOP 5 PRODUCTS -->
    <div class="col-lg-7">
        <div class="form-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom" style="border-color:var(--md-border) !important;">
                <div>
                    <h5 style="margin:0;font-size:1.15rem;font-weight:700;">Top Produk — 30 Hari Terakhir</h5>
                    <p class="mb-0 text-muted" style="font-size:0.8rem;">Porsi terlaris yang dipesan pelanggan</p>
                </div>
                <a href="<?php echo e(route('admin.ai-assistant.index')); ?>" class="btn btn-sm btn-md-outline" style="border-radius:50px;font-size:0.78rem;padding:0.35rem 0.85rem;">
                    <i class="bi bi-stars me-1 text-warning"></i>AI Strategy
                </a>
            </div>

            <?php $maxSold = $topMenus->max('total_sold') ?: 1; ?>
            <div class="chart-bar-wrap">
                <?php $__empty_1 = true; $__currentLoopData = $topMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="chart-row">
                    <div class="chart-rank"><?php echo e($i+1); ?></div>
                    <div class="chart-label" title="<?php echo e($menu->name); ?>"><?php echo e($menu->name); ?></div>
                    <div class="chart-bar-bg">
                        <div class="chart-bar-fg" style="width:<?php echo e(($menu->total_sold / $maxSold) * 100); ?>%"></div>
                    </div>
                    <div class="chart-val"><?php echo e(number_format($menu->total_sold)); ?> <span class="text-muted fw-normal" style="font-size:0.75rem;">porsi</span></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-5">
                    <div class="mb-2 fs-3">📊</div>
                    <p class="text-muted mb-0" style="font-size:0.875rem;">Belum ada riwayat penjualan 30 hari ini.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- QUICK ACTIONS & RECENT ACTIVITY -->
    <div class="col-lg-5">
        <div class="form-card mb-4">
            <h5 style="margin-bottom:1.25rem;font-size:1.15rem;font-weight:700;">Aksi Cepat</h5>
            <div class="d-grid gap-2">
                <a href="<?php echo e(route('admin.menus.create')); ?>" class="quick-action-btn">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span>Tambah Menu Baru</span>
                </a>
                <a href="<?php echo e(route('admin.promotions.create')); ?>" class="quick-action-btn">
                    <i class="bi bi-megaphone-fill"></i>
                    <span>Buat Promo Banner</span>
                </a>
                <a href="<?php echo e(route('admin.sales.index')); ?>" class="quick-action-btn">
                    <i class="bi bi-receipt"></i>
                    <span>Input Catatan Transaksi</span>
                </a>
                <a href="<?php echo e(route('admin.ai-assistant.index')); ?>" class="quick-action-btn ai-btn">
                    <i class="bi bi-stars" style="color:var(--md-gold);"></i>
                    <span>AI Copywriting & Strategy</span>
                </a>
            </div>
        </div>

        <!-- RECENT WEEKLY SALES -->
        <div class="form-card">
            <h5 style="margin-bottom:1rem;font-size:1.15rem;font-weight:700;">Penjualan 7 Hari Terakhir</h5>
            <?php $__empty_1 = true; $__currentLoopData = $weeklySales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="border-color:var(--md-border) !important;font-size:0.825rem;">
                <span class="text-dark fw-medium"><?php echo e(\Carbon\Carbon::parse($day->date)->isoFormat('ddd, D MMM')); ?></span>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted"><?php echo e(number_format($day->total_qty)); ?> porsi</span>
                    <span class="revenue-badge">Rp <?php echo e(number_format($day->total_revenue/1000,0)); ?>K</span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-4 text-muted" style="font-size:0.85rem;">Belum ada data penjualan pekan ini.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\CLONE DARMO\PT-Antasena\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>