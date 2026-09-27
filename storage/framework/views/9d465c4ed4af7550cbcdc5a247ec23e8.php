<?php $__env->startSection('title','Laporan Penjualan'); ?>
<?php $__env->startSection('page-title','Laporan & Catatan Penjualan'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4 mb-4">
    <!-- Stat 1: Total Revenue -->
    <div class="col-md-4">
        <div class="stat-card h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);font-weight:700;margin-bottom:0.35rem;">Total Revenue</div>
                        <div style="font-family:var(--font-heading);font-size:1.8rem;font-weight:700;color:var(--md-text-dark);line-height:1;">
                            Rp <?php echo e(number_format($totalRevenue/1000000,1)); ?>Jt
                        </div>
                    </div>
                    <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
                </div>
            </div>
            <div class="pt-2 border-top text-muted" style="border-color:var(--md-border) !important; font-size:0.78rem;">
                <i class="bi bi-calendar-event me-1"></i> Periode <?php echo e($period); ?> hari terakhir
            </div>
        </div>
    </div>

    <!-- Stat 2: Total Qty -->
    <div class="col-md-4">
        <div class="stat-card h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);font-weight:700;margin-bottom:0.35rem;">Total Porsi Terjual</div>
                        <div style="font-family:var(--font-heading);font-size:1.8rem;font-weight:700;color:var(--md-text-dark);line-height:1;">
                            <?php echo e(number_format($totalQty)); ?> <span style="font-size:1rem;font-weight:500;color:var(--md-text-muted);">porsi</span>
                        </div>
                    </div>
                    <div class="stat-icon"><i class="bi bi-bag-check-fill"></i></div>
                </div>
            </div>
            <div class="pt-2 border-top text-muted" style="border-color:var(--md-border) !important; font-size:0.78rem;">
                <i class="bi bi-calendar-event me-1"></i> Periode <?php echo e($period); ?> hari terakhir
            </div>
        </div>
    </div>

    <!-- Stat 3: Quick Transaction Form -->
    <div class="col-md-4">
        <div class="form-card h-100 p-3 p-xl-4">
            <form action="<?php echo e(route('admin.sales.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span style="font-size:0.75rem;letter-spacing:1px;text-transform:uppercase;color:var(--md-text-dark);font-weight:700;">Input Penjualan</span>
                    <i class="bi bi-pencil-square text-muted"></i>
                </div>
                <select name="menu_id" class="form-select form-control-md mb-2" required style="font-size:0.825rem;padding:0.45rem 0.75rem;">
                    <option value="">Pilih Menu Hidangan...</option>
                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($m->id); ?>"><?php echo e($m->name); ?> (<?php echo e($m->formatted_price); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <input type="number" name="quantity_sold" class="form-control form-control-md" placeholder="Qty Porsi" min="1" required style="font-size:0.825rem;padding:0.45rem 0.75rem;">
                    </div>
                    <div class="col-6">
                        <input type="date" name="transaction_date" class="form-control form-control-md" value="<?php echo e(date('Y-m-d')); ?>" required style="font-size:0.825rem;padding:0.45rem 0.75rem;">
                    </div>
                </div>
                <button type="submit" class="btn btn-md-primary w-100" style="padding:0.45rem;font-size:0.825rem;">
                    <i class="bi bi-plus-circle me-1"></i> Catat Transaksi
                </button>
            </form>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Top 5 Products This Period -->
    <div class="col-lg-5">
        <div class="form-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom" style="border-color:var(--md-border) !important;">
                <h5 style="margin:0;font-size:1.15rem;font-weight:700;">Top Produk Periode Ini</h5>
                <span class="badge-ai"><?php echo e($period); ?> Hari</span>
            </div>
            
            <div class="d-flex flex-column gap-3 mt-2">
                <?php $__empty_1 = true; $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="d-flex align-items-center gap-3 p-2 rounded-3" style="background:#FAF8F5;border:1px solid var(--md-border);">
                    <span style="width:28px;height:28px;background:<?php echo e($i===0 ? 'var(--badge-amber-bg)' : ($i===1 ? '#F0EBE3' : '#F7F4EF')); ?>;border:1px solid <?php echo e($i===0 ? 'var(--badge-amber-brd)' : 'var(--md-border)'); ?>;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:<?php echo e($i===0 ? 'var(--badge-amber-text)':'var(--md-text-dark)'); ?>;flex-shrink:0;">
                        <?php echo e($i+1); ?>

                    </span>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:0.875rem;font-weight:600;color:var(--md-text-dark);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            <?php echo e($p->name); ?>

                        </div>
                        <div style="font-size:0.75rem;color:var(--md-text-muted);">
                            <?php echo e(number_format($p->total_sold)); ?> porsi · <span style="color:var(--md-terracotta);font-weight:600;">Rp <?php echo e(number_format($p->total_revenue/1000,0)); ?>K</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-4 text-muted" style="font-size:0.85rem;">
                    Belum ada data penjualan pada rentang periode ini.
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Transaction History -->
    <div class="col-lg-7">
        <div class="form-card h-100">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-3 pb-2 border-bottom" style="border-color:var(--md-border) !important;">
                <h5 style="margin:0;font-size:1.15rem;font-weight:700;">Riwayat Transaksi Penjualan</h5>
                <div class="d-flex gap-1">
                    <?php $__currentLoopData = [7,30,90]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.sales.index', ['period'=>$p])); ?>" 
                       class="btn btn-sm <?php echo e($period==$p ? 'btn-md-primary' : 'btn-md-outline'); ?>" 
                       style="border-radius:50px;font-size:0.75rem;padding:0.25rem 0.8rem;">
                       <?php echo e($p); ?> Hari
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-md mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Menu</th>
                            <th style="text-align:center;">Qty</th>
                            <th style="text-align:right;">Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td style="font-size:0.825rem;color:var(--md-text-muted);white-space:nowrap;">
                                <i class="bi bi-clock-history me-1"></i> <?php echo e($t->transaction_date->format('d M Y')); ?>

                            </td>
                            <td style="font-size:0.875rem;font-weight:500;color:var(--md-text-dark);">
                                <?php echo e(Str::limit($t->menu->name ?? 'Menu Terhapus', 28)); ?>

                            </td>
                            <td style="font-weight:700;text-align:center;font-size:0.875rem;">
                                <?php echo e($t->quantity_sold); ?>

                            </td>
                            <td style="font-weight:700;color:var(--md-terracotta);text-align:right;font-size:0.875rem;white-space:nowrap;">
                                Rp <?php echo e(number_format($t->revenue, 0, ',', '.')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted" style="font-size:0.875rem;">
                                <div class="mb-2 fs-3">🧾</div>
                                Belum ada riwayat transaksi pada rentang waktu ini.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($transactions->hasPages()): ?>
            <div class="mt-4 pt-3 border-top d-flex justify-content-center" style="border-color:var(--md-border) !important;">
                <?php echo e($transactions->links('pagination::bootstrap-5')); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\_AI\PT-Antasena\resources\views/admin/sales/index.blade.php ENDPATH**/ ?>