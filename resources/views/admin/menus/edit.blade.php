@extends('layouts.admin')
@section('title','Edit Menu')
@section('page-title','Edit Menu: ' . $menu->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom" style="border-color:var(--md-border) !important;">
                <div>
                    <h5 class="mb-1" style="font-size:1.2rem;font-weight:700;">Perbarui Menu: {{ $menu->name }}</h5>
                    <p class="text-muted mb-0" style="font-size:0.85rem;">Edit rincian hidangan, harga, ketersediaan, atau perbarui foto.</p>
                </div>
                <a href="{{ route('admin.menus.index') }}" class="btn btn-sm btn-md-outline">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label-md">Nama Menu <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-md" value="{{ old('name', $menu->name) }}" required>
                        @error('name')<div class="text-danger mt-1" style="font-size:0.78rem;">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-md">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select form-control-md" required>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $menu->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="text-danger mt-1" style="font-size:0.78rem;">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control form-control-md" value="{{ old('price', $menu->price) }}" required min="0">
                        @error('price')<div class="text-danger mt-1" style="font-size:0.78rem;">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Tingkat Kepedasan</label>
                        <select name="spice_level" class="form-select form-control-md">
                            @foreach(['mild'=>'🌿 Tidak Pedas (Mild)','medium'=>'🌶️ Sedang (Medium)','hot'=>'🌶️🌶️ Pedas (Hot)','extra-hot'=>'🌶️🌶️🌶️ Extra Pedas'] as $val => $lbl)
                            <option value="{{ $val }}" {{ old('spice_level', $menu->spice_level) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label-md">Deskripsi Ringkas (Tooltip Hover)</label>
                        <textarea name="short_description_hover" class="form-control form-control-md" rows="3" maxlength="500">{{ old('short_description_hover', $menu->short_description_hover) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label-md">Deskripsi Lengkap Hidangan</label>
                        <textarea name="description" class="form-control form-control-md" rows="4">{{ old('description', $menu->description) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label-md">Foto Menu</label>
                        @if($menu->image)
                        <div class="d-flex align-items-center gap-3 mb-3 p-2 rounded-3" style="background:var(--md-bg-cream);border:1px solid var(--md-border);max-width:360px;">
                            <img src="{{ Str::startsWith($menu->image, ['http://', 'https://']) ? $menu->image : asset('storage/'.$menu->image) }}" style="width:64px;height:64px;border-radius:8px;object-fit:cover;" alt="current">
                            <div>
                                <div class="fw-semibold" style="font-size:0.825rem;">Foto Terpasang Saat Ini</div>
                                <div class="text-muted" style="font-size:0.75rem;">Unggah file baru di bawah jika ingin mengganti.</div>
                            </div>
                        </div>
                        @endif
                        <input type="file" name="image" class="form-control form-control-md" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:var(--md-bg-cream);border:1px solid var(--md-border);">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_available" style="font-size:0.875rem;">Status Menu Tersedia</label>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size:0.75rem;">Aktifkan jika hidangan siap dipesan di warung.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:var(--md-bg-cream);border:1px solid var(--md-border);">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $menu->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_featured" style="font-size:0.875rem;">Highlight di Beranda</label>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size:0.75rem;">Tampilkan di bagian hidangan unggulan halaman depan.</small>
                        </div>
                    </div>
                </div>
                <hr style="border-color:var(--md-border); margin:2rem 0;">
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-md-outline">Batal</a>
                    <button type="submit" class="btn btn-md-primary">
                        <i class="bi bi-check-lg me-1"></i> Perbarui Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
