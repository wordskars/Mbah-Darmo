@extends('layouts.admin')
@section('title','Buat Promo')
@section('page-title','Buat Promo Baru')
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
<div class="form-card">
<form action="{{ route('admin.promotions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-12"><label class="form-label-md">Judul Promo *</label><input type="text" name="title" class="form-control form-control-md" value="{{ old('title') }}" required placeholder="cth: Beli Mie Gepeng + Gratis Mendoan 50%"></div>
        <div class="col-12"><label class="form-label-md">Deskripsi Promo</label><textarea name="description" class="form-control form-control-md" rows="4" placeholder="Detail penawaran promo...">{{ old('description') }}</textarea></div>
        <div class="col-md-6">
            <label class="form-label-md">Tipe Diskon</label>
            <select name="discount_type" class="form-control form-control-md">
                <option value="">Pilih Tipe</option>
                <option value="percentage" {{ old('discount_type')==='percentage' ? 'selected':'' }}>Persentase (%)</option>
                <option value="fixed" {{ old('discount_type')==='fixed' ? 'selected':'' }}>Nominal Tetap (Rp)</option>
                <option value="bundling" {{ old('discount_type')==='bundling' ? 'selected':'' }}>Bundling</option>
            </select>
        </div>
        <div class="col-md-6"><label class="form-label-md">Nilai Diskon</label><input type="text" name="discount_value" class="form-control form-control-md" value="{{ old('discount_value') }}" placeholder="cth: 50 atau 15000"></div>
        <div class="col-md-6"><label class="form-label-md">Banner Gambar (opsional)</label><input type="file" name="banner_image" class="form-control form-control-md" accept="image/*"></div>
        <div class="col-md-6"><label class="form-label-md">Berlaku Hingga</label><input type="date" name="valid_until" class="form-control form-control-md" value="{{ old('valid_until') }}"></div>
        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active',true) ? 'checked':'' }}>
                <label class="form-check-label" for="is_active" style="font-size:0.875rem;">Aktifkan Promo (tampil di halaman publik)</label>
            </div>
        </div>
    </div>
    <hr style="border-color:var(--md-border);margin:2rem 0;">
    <div class="d-flex gap-3 justify-content-end">
        <a href="{{ route('admin.promotions.index') }}" class="btn btn-md-outline">Batal</a>
        <button type="submit" class="btn btn-md-primary"><i class="bi bi-check-lg me-1"></i>Simpan Promo</button>
    </div>
</form>
</div>
</div></div>
@endsection
