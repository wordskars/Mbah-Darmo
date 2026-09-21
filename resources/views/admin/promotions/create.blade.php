@extends('layouts.admin')
@section('title','Buat Promo')
@section('page-title','Buat Promo Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom" style="border-color:var(--md-border) !important;">
                <div>
                    <h5 class="mb-1" style="font-size:1.2rem;font-weight:700;">Formulir Promo Baru</h5>
                    <p class="text-muted mb-0" style="font-size:0.85rem;">Buat penawaran diskon atau paket hemat untuk pelanggan warung.</p>
                </div>
                <a href="{{ route('admin.promotions.index') }}" class="btn btn-sm btn-md-outline">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.promotions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-md">Judul Promo <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-md" value="{{ old('title') }}" required placeholder="cth: Paket Kenyang Mie Gepeng + Es Dawet Hemat 30%">
                        @error('title')<div class="text-danger mt-1" style="font-size:0.78rem;">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-md">Deskripsi Promo</label>
                        <textarea name="description" class="form-control form-control-md" rows="4" placeholder="Detail syarat & ketentuan atau keuntungan penawaran promo...">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Tipe Diskon</label>
                        <select name="discount_type" class="form-select form-control-md">
                            <option value="">Pilih Tipe Diskon</option>
                            <option value="percentage" {{ old('discount_type')==='percentage' ? 'selected':'' }}>Persentase (%)</option>
                            <option value="fixed" {{ old('discount_type')==='fixed' ? 'selected':'' }}>Nominal Tetap (Rp)</option>
                            <option value="bundling" {{ old('discount_type')==='bundling' ? 'selected':'' }}>Bundling / Paket</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Nilai Diskon</label>
                        <input type="text" name="discount_value" class="form-control form-control-md" value="{{ old('discount_value') }}" placeholder="cth: 30 atau 15000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Banner Gambar (Opsional)</label>
                        <input type="file" name="banner_image" class="form-control form-control-md" accept="image/*">
                        <small class="text-muted d-block mt-1">Format JPG, PNG, WEBP (Maks. 2MB)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Berlaku Hingga</label>
                        <input type="date" name="valid_until" class="form-control form-control-md" value="{{ old('valid_until') }}">
                        <small class="text-muted d-block mt-1">Biarkan kosong jika berlaku seterusnya</small>
                    </div>
                    <div class="col-12">
                        <div class="p-3 rounded-3" style="background:var(--md-bg-cream);border:1px solid var(--md-border);">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active" style="font-size:0.875rem;">Aktifkan Promo Langsung ke Publik</label>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size:0.75rem;">Banner promo akan langsung muncul di halaman beranda.</small>
                        </div>
                    </div>
                </div>

                <hr style="border-color:var(--md-border);margin:2rem 0;">
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{ route('admin.promotions.index') }}" class="btn btn-md-outline">Batal</a>
                    <button type="submit" class="btn btn-md-primary">
                        <i class="bi bi-check-lg me-1"></i> Simpan Promo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
