<?php $__env->startSection('title','Data Menu'); ?>
<?php $__env->startSection('page-title','Data Menu Katalog'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:0.875rem;">Kelola seluruh item hidangan dan minuman yang tampil pada katalog menu publik.</p>
    </div>
    <a href="<?php echo e(route('admin.menus.create')); ?>" class="btn btn-md-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Menu Baru
    </a>
</div>

<div class="form-card">
    <div class="table-responsive">
        <table class="table table-md mb-0">
            <thead>
                <tr>
                    <th style="min-width: 260px;">Menu Hidangan</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status Stok</th>
                    <th>Unggulan</th>
                    <th style="width: 110px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:48px;height:48px;border-radius:10px;overflow:hidden;background:#FAF8F5;border:1px solid var(--md-border);display:flex;align-items:center;justify-content:center;font-size:1.35rem;flex-shrink:0;">
                                <?php if($menu->image): ?>
                                    <img
                                        src="<?php echo e(Str::startsWith($menu->image, ['http://', 'https://']) ? $menu->image : asset('storage/' . $menu->image)); ?>"
                                        style="width:100%;height:100%;object-fit:cover;"
                                        alt="<?php echo e($menu->name); ?>"
                                    >
                                <?php else: ?>
                                    <span style="opacity: 0.7;">🍲</span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:0.9rem;color:var(--md-text-dark);">
                                    <?php echo e($menu->name); ?>

                                </div>
                                <div style="font-size:0.75rem;color:var(--md-text-muted);max-width:320px;" class="text-truncate">
                                    <?php echo e($menu->short_description_hover); ?>

                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge-ai">
                            <?php echo e($menu->category->name ?? 'Umum'); ?>

                        </span>
                    </td>
                    <td style="font-weight:700;color:var(--md-terracotta);font-size:0.925rem;">
                        <?php echo e($menu->formatted_price); ?>

                    </td>
                    <td>
                        <?php if($menu->is_available): ?>
                            <span class="badge-active">
                                <i class="bi bi-check-circle-fill" style="font-size:0.65rem;"></i> Tersedia
                            </span>
                        <?php else: ?>
                            <span class="badge-inactive">
                                <i class="bi bi-x-circle-fill" style="font-size:0.65rem;"></i> Habis
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($menu->is_featured): ?>
                            <span class="badge-amber">
                                <i class="bi bi-star-fill" style="font-size:0.65rem;"></i> Unggulan
                            </span>
                        <?php else: ?>
                            <span class="text-muted" style="font-size:0.8rem;">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end gap-1">
                            <a
                                href="<?php echo e(route('admin.menus.edit', $menu)); ?>"
                                class="btn-action-icon btn-action-edit text-decoration-none"
                                title="Edit Menu"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form
                                action="<?php echo e(route('admin.menus.destroy', $menu)); ?>"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu <?php echo e($menu->name); ?>?')"
                                class="m-0"
                            >
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button
                                    type="submit"
                                    class="btn-action-icon btn-action-delete border-0"
                                    title="Hapus Menu"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <div class="mb-2 fs-3">🍲</div>
                        <p class="mb-2">Belum ada data menu yang terdaftar.</p>
                        <a href="<?php echo e(route('admin.menus.create')); ?>" class="btn btn-sm btn-md-primary">
                            Tambah Menu Sekarang
                        </a>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($menus->hasPages()): ?>
    <div class="mt-4 pt-3 border-top d-flex justify-content-center" style="border-color:var(--md-border) !important;">
        <nav aria-label="Navigasi halaman">
            <ul class="pagination mb-0">
                
                <?php if($menus->onFirstPage()): ?>
                    <li class="page-item disabled">
                        <span class="page-link">‹ Sebelumnya</span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($menus->previousPageUrl()); ?>">‹ Sebelumnya</a>
                    </li>
                <?php endif; ?>

                
                <?php for($page = 1; $page <= $menus->lastPage(); $page++): ?>
                    <?php if($page == $menus->currentPage()): ?>
                        <li class="page-item active">
                            <span class="page-link"><?php echo e($page); ?></span>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo e($menus->url($page)); ?>"><?php echo e($page); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>

                
                <?php if($menus->hasMorePages()): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($menus->nextPageUrl()); ?>">Selanjutnya ›</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link">Selanjutnya ›</span>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\CLONE DARMO\PT-Antasena\resources\views/admin/menus/index.blade.php ENDPATH**/ ?>