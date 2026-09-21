@extends('layouts.admin')
@section('title','Edit Promo')
@section('page-title','Edit Promo')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom" style="border-color:var(--md-border) !important;">
                <div>
                    <h5 class="mb-1" style="font-size:1.2rem;font-weight:700;">Edit Promo: {{ $promotion->title }}</h5>
                    <p class="text-muted mb-0" style="font-size:0.85rem;">Perbarui rincian promo, persentase diskon, atau masa aktif.</p>
                </div>
                <a href="{{ route('admin.promotions.index') }}" class="btn btn-sm btn-md-outline">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.promotions.update', $promotion) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-md">Judul Promo <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-md" value="{{ old('title', $promotion->title) }}" required>
                        @error('title')<div class="text-danger mt-1" style="font-size:0.78rem;">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-md">Deskripsi Promo</label>
                        <textarea name="description" class="form-control form-control-md" rows="4">{{ old('description', $promotion->description) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Tipe Diskon</label>
                        <select name="discount_type" class="form-select form-control-md">
                            <option value="">Pilih Tipe Diskon</option>
                            @foreach(['percentage'=>'Persentase (%)','fixed'=>'Nominal Tetap (Rp)','bundling'=>'Bundling / Paket'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('discount_type', $promotion->discount_type)===$v ? 'selected':'' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Nilai Diskon</label>
                        <input type="text" name="discount_value" class="form-control form-control-md" value="{{ old('discount_value', $promotion->discount_value) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Banner Gambar</label>
                        @if($promotion->banner_image)
                        <div class="mb-2 p-2 rounded-3" style="background:var(--md-bg-cream);border:1px solid var(--md-border);max-width:240px;">
                            <img src="{{ asset('storage/'.$promotion->banner_image) }}" style="max-height:70px;width:100%;object-fit:cover;border-radius:6px;" alt="banner">
                        </div>
                        @endif
                        <input type="file" name="banner_image" class="form-control form-control-md" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Berlaku Hingga</label>
                        <input type="date" name="valid_until" class="form-control form-control-md" value="{{ old('valid_until', $promotion->valid_until?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-12">
                        <div class="p-3 rounded-3" style="background:var(--md-bg-cream);border:1px solid var(--md-border);">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $promotion->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active" style="font-size:0.875rem;">Status Promo Aktif</label>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size:0.75rem;">Banner promo akan ditampilkan di halaman beranda.</small>
                        </div>
                    </div>
                </div>

                <hr style="border-color:var(--md-border);margin:2rem 0;">
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{ route('admin.promotions.index') }}" class="btn btn-md-outline">Batal</a>
                    <button type="submit" class="btn btn-md-primary">
                        <i class="bi bi-check-lg me-1"></i> Perbarui Promo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
