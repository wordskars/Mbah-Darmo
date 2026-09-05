@extends('layouts.admin')
@section('title','Tambah Paket Franchise')
@section('page-title','Tambah Paket Franchise Baru')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card">
            {{-- TAMBAHKAN enctype="multipart/form-data" DI SINI --}}
            <form action="{{ route('admin.franchise.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-md">Nama Paket *</label>
                        <input type="text" name="name" class="form-control form-control-md" value="{{ old('name') }}" required placeholder="cth: PREMIUM">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Harga Investasi (Rp) *</label>
                        <input type="number" name="price" class="form-control form-control-md" value="{{ old('price') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-md">Luas Ruang</label>
                        <input type="text" name="space_required" class="form-control form-control-md" value="{{ old('space_required') }}" placeholder="30–50 m²">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-md">Kapasitas Pax</label>
                        <input type="number" name="pax_capacity" class="form-control form-control-md" value="{{ old('pax_capacity') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-md">Jumlah SDM</label>
                        <input type="number" name="staff_count" class="form-control form-control-md" value="{{ old('staff_count') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">ROI / Payback</label>
                        <input type="text" name="roi_projection" class="form-control form-control-md" value="{{ old('roi_projection') }}" placeholder="18–24 bulan">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Estimasi Omzet/Bulan</label>
                        <input type="text" name="monthly_revenue_estimate" class="form-control form-control-md" value="{{ old('monthly_revenue_estimate') }}" placeholder="Rp 65–95 Juta">
                    </div>
                    <div class="col-12">
                        <label class="form-label-md">Deskripsi *</label>
                        <textarea name="description" class="form-control form-control-md" rows="4" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Warna Aksen</label>
                        <input type="color" name="color_accent" class="form-control form-control-md" value="{{ old('color_accent','#800000') }}" style="height:44px;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Urutan Tampil</label>
                        <input type="number" name="sort_order" class="form-control form-control-md" value="{{ old('sort_order',0) }}" min="0">
                    </div>
                    
                    {{-- INPUT HERO IMAGE --}}
                    <div class="col-12 mb-3">
                        <label for="hero_image" class="form-label-md">Hero Background Image</label>
                        <input type="file" class="form-control form-control-md" id="hero_image" name="hero_image" accept="image/*">
                        <small class="text-muted d-block mt-1">Rekomendasi ukuran: 1920x1080px (Max: 2MB)</small>

                        @if(isset($package) && $package->hero_image)
                        <div class="mt-2">
                            <p class="mb-1">Gambar saat ini:</p>
                            <img src="{{ $package->hero_image_url }}" alt="Hero Preview" style="max-height: 100px; border-radius: 8px;">
                        </div>
                        @endif
                    </div>
                </div>

                <hr style="border-color:var(--md-border);margin:2rem 0;">
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{ route('admin.franchise.index') }}" class="btn btn-md-outline">Batal</a>
                    <button type="submit" class="btn btn-md-primary"><i class="bi bi-check-lg me-1"></i>Simpan Paket</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection