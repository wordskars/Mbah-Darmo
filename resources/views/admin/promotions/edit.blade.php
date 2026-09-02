@extends('layouts.admin')
@section('title','Edit Promo')
@section('page-title','Edit Promo')
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
<div class="form-card">
<form action="{{ route('admin.promotions.update', $promotion) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-12"><label class="form-label-md">Judul Promo *</label><input type="text" name="title" class="form-control form-control-md" value="{{ old('title',$promotion->title) }}" required></div>
        <div class="col-12"><label class="form-label-md">Deskripsi</label><textarea name="description" class="form-control form-control-md" rows="4">{{ old('description',$promotion->description) }}</textarea></div>
        <div class="col-md-6">
            <label class="form-label-md">Tipe Diskon</label>
            <select name="discount_type" class="form-control form-control-md">
                <option value="">Pilih Tipe</option>
                @foreach(['percentage'=>'Persentase','fixed'=>'Nominal Tetap','bundling'=>'Bundling'] as $v=>$l)
                <option value="{{ $v }}" {{ old('discount_type',$promotion->discount_type)===$v ? 'selected':'' }}>{{ $l }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6"><label class="form-label-md">Nilai Diskon</label><input type="text" name="discount_value" class="form-control form-control-md" value="{{ old('discount_value',$promotion->discount_value) }}"></div>
        <div class="col-md-6">
            <label class="form-label-md">Banner Gambar</label>
            @if($promotion->banner_image)
            <div class="mb-2"><img src="{{ asset('storage/'.$promotion->banner_image) }}" style="height:60px;border-radius:6px;object-fit:cover;"></div>
            @endif
            <input type="file" name="banner_image" class="form-control form-control-md" accept="image/*">
        </div>
        <div class="col-md-6"><label class="form-label-md">Berlaku Hingga</label><input type="date" name="valid_until" class="form-control form-control-md" value="{{ old('valid_until', $promotion->valid_until?->format('Y-m-d')) }}"></div>
        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active',$promotion->is_active) ? 'checked':'' }}>
                <label class="form-check-label" for="is_active" style="font-size:0.875rem;">Aktifkan Promo</label>
            </div>
        </div>
    </div>
    <hr style="border-color:var(--md-border);margin:2rem 0;">
    <div class="d-flex gap-3 justify-content-end">
        <a href="{{ route('admin.promotions.index') }}" class="btn btn-md-outline">Batal</a>
        <button type="submit" class="btn btn-md-primary"><i class="bi bi-check-lg me-1"></i>Update Promo</button>
    </div>
</form>
</div>
</div></div>
@endsection
