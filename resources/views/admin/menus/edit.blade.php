@extends('layouts.admin')
@section('title','Edit Menu')
@section('page-title','Edit Menu: ' . $menu->name)

@section('content')
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-card">
    <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-4">
            <div class="col-md-8">
                <label class="form-label-md">Nama Menu *</label>
                <input type="text" name="name" class="form-control form-control-md" value="{{ old('name', $menu->name) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label-md">Kategori *</label>
                <select name="category_id" class="form-control form-control-md" required>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $menu->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label-md">Harga (Rp) *</label>
                <input type="number" name="price" class="form-control form-control-md" value="{{ old('price', $menu->price) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-md">Tingkat Kepedasan</label>
                <select name="spice_level" class="form-control form-control-md">
                    @foreach(['mild'=>'🌿 Tidak Pedas','medium'=>'🌶️ Sedang','hot'=>'🌶️🌶️ Pedas','extra-hot'=>'🌶️🌶️🌶️ Extra Pedas'] as $val => $lbl)
                    <option value="{{ $val }}" {{ old('spice_level', $menu->spice_level) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label-md">Deskripsi Hover</label>
                <textarea name="short_description_hover" class="form-control form-control-md" rows="3" maxlength="500">{{ old('short_description_hover', $menu->short_description_hover) }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label-md">Deskripsi Lengkap</label>
                <textarea name="description" class="form-control form-control-md" rows="4">{{ old('description', $menu->description) }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label-md">Foto Menu (Kosongkan jika tidak diganti)</label>
                @if($menu->image)
                <div class="mb-2">
                    <img src="{{ Str::startsWith($menu->image, ['http://', 'https://']) ? $menu->image : asset('storage/'.$menu->image) }}" style="height:80px;border-radius:8px;object-fit:cover;" alt="current">
                    <div style="font-size:0.75rem;color:var(--md-text-muted);margin-top:0.25rem;">Foto saat ini</div>
                </div>
                @endif
                <input type="file" name="image" class="form-control form-control-md" accept="image/*">
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_available" style="font-size:0.875rem;">Menu Tersedia</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $menu->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured" style="font-size:0.875rem;">Tampilkan di Highlight Beranda</label>
                </div>
            </div>
        </div>
        <hr style="border-color:var(--md-border); margin:2rem 0;">
        <div class="d-flex gap-3 justify-content-end">
            <a href="{{ route('admin.menus.index') }}" class="btn btn-md-outline">Batal</a>
            <button type="submit" class="btn btn-md-primary"><i class="bi bi-check-lg me-1"></i>Update Menu</button>
        </div>
    </form>
</div>
</div>
</div>
@endsection
