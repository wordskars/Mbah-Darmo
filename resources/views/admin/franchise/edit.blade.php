@extends('layouts.admin')
@section('title','Edit Paket Franchise')
@section('page-title','Edit Paket: ' . $franchise->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom" style="border-color:var(--md-border) !important;">
                <div>
                    <h5 class="mb-1" style="font-size:1.2rem;font-weight:700;">Edit Paket: {{ $franchise->name }}</h5>
                    <p class="text-muted mb-0" style="font-size:0.85rem;">Perbarui rincian harga investasi, kapasitas, atau deskripsi kemitraan.</p>
                </div>
                <a href="{{ route('admin.franchise.index') }}" class="btn btn-sm btn-md-outline">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.franchise.update', $franchise->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-md">Nama Paket <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-md" value="{{ old('name', $franchise->name) }}" required placeholder="cth: PREMIUM">
                        @error('name')<div class="text-danger mt-1" style="font-size:0.78rem;">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Harga Investasi (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control form-control-md" value="{{ old('price', $franchise->price) }}" required min="0">
                        @error('price')<div class="text-danger mt-1" style="font-size:0.78rem;">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-md">Kebutuhan Luas Ruang</label>
                        <input type="text" name="space_required" class="form-control form-control-md" value="{{ old('space_required', $franchise->space_required) }}" placeholder="30–50 m²">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-md">Kapasitas Tempat Duduk</label>
                        <input type="number" name="pax_capacity" class="form-control form-control-md" value="{{ old('pax_capacity', $franchise->pax_capacity) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-md">Jumlah SDM</label>
                        <input type="number" name="staff_count" class="form-control form-control-md" value="{{ old('staff_count', $franchise->staff_count) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Estimasi ROI / Balik Modal</label>
                        <input type="text" name="roi_projection" class="form-control form-control-md" value="{{ old('roi_projection', $franchise->roi_projection) }}" placeholder="18–24 bulan">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Estimasi Omzet / Bulan</label>
                        <input type="text" name="monthly_revenue_estimate" class="form-control form-control-md" value="{{ old('monthly_revenue_estimate', $franchise->monthly_revenue_estimate) }}" placeholder="Rp 65–95 Juta">
                    </div>
                    <div class="col-12">
                        <label class="form-label-md">Deskripsi & Fasilitas Paket <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control form-control-md" rows="4" required>{{ old('description', $franchise->description) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Warna Aksen Kartu</label>
                        <input type="color" name="color_accent" class="form-control form-control-md" value="{{ old('color_accent', $franchise->color_accent ?? '#A83226') }}" style="height:44px;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Urutan Tampilan</label>
                        <input type="number" name="sort_order" class="form-control form-control-md" value="{{ old('sort_order', $franchise->sort_order ?? 0) }}" min="0">
                    </div>
                    
                </div>

                <hr style="border-color:var(--md-border);margin:2rem 0;">
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{ route('admin.franchise.index') }}" class="btn btn-md-outline">Batal</a>
                    <button type="submit" class="btn btn-md-primary">
                        <i class="bi bi-check-lg me-1"></i> Perbarui Paket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection