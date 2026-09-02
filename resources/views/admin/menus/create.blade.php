@extends('layouts.admin')
@section('title','Tambah Menu')
@section('page-title','Tambah Menu Baru')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-card">
    <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-md-8">
                <label class="form-label-md">Nama Menu *</label>
                <input type="text" name="name" class="form-control form-control-md" value="{{ old('name') }}" required placeholder="cth: Mie Gepeng Batok Arang Original">
                @error('name')<div class="text-danger mt-1" style="font-size:0.78rem;">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label-md">Kategori *</label>
                <select name="category_id" class="form-control form-control-md" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label-md">Harga (Rp) *</label>
                <input type="number" name="price" class="form-control form-control-md" value="{{ old('price') }}" required placeholder="28000" min="0">
            </div>
            <div class="col-md-6">
                <label class="form-label-md">Tingkat Kepedasan</label>
                <select name="spice_level" class="form-control form-control-md">
                    <option value="mild" {{ old('spice_level') === 'mild' ? 'selected' : '' }}>🌿 Tidak Pedas (Mild)</option>
                    <option value="medium" {{ old('spice_level') === 'medium' ? 'selected' : '' }}>🌶️ Sedang (Medium)</option>
                    <option value="hot" {{ old('spice_level') === 'hot' ? 'selected' : '' }}>🌶️🌶️ Pedas (Hot)</option>
                    <option value="extra-hot" {{ old('spice_level') === 'extra-hot' ? 'selected' : '' }}>🌶️🌶️🌶️ Extra Pedas</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label-md">Deskripsi Hover (Tooltip) *</label>
                <textarea name="short_description_hover" class="form-control form-control-md" rows="3" placeholder="Deskripsi singkat yang muncul saat hover di halaman menu (max 500 karakter)" maxlength="500">{{ old('short_description_hover') }}</textarea>
                <div style="font-size:0.72rem;color:var(--md-text-muted);margin-top:0.25rem;">Tampil sebagai tooltip overlay di halaman Menu publik.</div>
            </div>
            <div class="col-12">
                <label class="form-label-md">Deskripsi Lengkap</label>
                <textarea name="description" class="form-control form-control-md" rows="4" placeholder="Deskripsi lengkap menu (opsional)">{{ old('description') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label-md">Foto Menu</label>
                <input type="file" name="image" class="form-control form-control-md" accept="image/*">
                <div style="font-size:0.72rem;color:var(--md-text-muted);margin-top:0.25rem;">Format: JPG, PNG, WEBP. Maks. 2MB.</div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_available" style="font-size:0.875rem;">Menu Tersedia</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured" style="font-size:0.875rem;">Tampilkan di Highlight Beranda</label>
                </div>
            </div>
        </div>
        <hr style="border-color:var(--md-border); margin:2rem 0;">
        <div class="d-flex gap-3 justify-content-end">
            <a href="{{ route('admin.menus.index') }}" class="btn btn-md-outline">Batal</a>
            <button type="submit" class="btn btn-md-primary"><i class="bi bi-check-lg me-1"></i>Simpan Menu</button>
        </div>
    </form>
</div>
</div>
</div>
@endsection
