@extends('layouts.admin')
@section('title','Edit Paket Franchise')
@section('page-title','Edit Paket: ' . $franchise->name)
@section('content')
<div class="row justify-content-center"><div class="col-lg-8">
<div class="form-card">
<form action="{{ route('admin.franchise.update', $franchise) }}" method="POST">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-md-6"><label class="form-label-md">Nama Paket</label><input type="text" name="name" class="form-control form-control-md" value="{{ old('name',$franchise->name) }}" required></div>
        <div class="col-md-6"><label class="form-label-md">Harga Investasi (Rp)</label><input type="number" name="price" class="form-control form-control-md" value="{{ old('price',$franchise->price) }}" required></div>
        <div class="col-md-4"><label class="form-label-md">Luas Ruang</label><input type="text" name="space_required" class="form-control form-control-md" value="{{ old('space_required',$franchise->space_required) }}" placeholder="cth: 30–50 m²"></div>
        <div class="col-md-4"><label class="form-label-md">Kapasitas Pax</label><input type="number" name="pax_capacity" class="form-control form-control-md" value="{{ old('pax_capacity',$franchise->pax_capacity) }}"></div>
        <div class="col-md-4"><label class="form-label-md">Jumlah SDM</label><input type="number" name="staff_count" class="form-control form-control-md" value="{{ old('staff_count',$franchise->staff_count) }}"></div>
        <div class="col-md-6"><label class="form-label-md">ROI / Payback Estimate</label><input type="text" name="roi_projection" class="form-control form-control-md" value="{{ old('roi_projection',$franchise->roi_projection) }}" placeholder="cth: 18–24 bulan"></div>
        <div class="col-md-6"><label class="form-label-md">Estimasi Omzet/Bulan</label><input type="text" name="monthly_revenue_estimate" class="form-control form-control-md" value="{{ old('monthly_revenue_estimate',$franchise->monthly_revenue_estimate) }}" placeholder="cth: Rp 65–95 Juta"></div>
        <div class="col-12"><label class="form-label-md">Deskripsi Paket</label><textarea name="description" class="form-control form-control-md" rows="4">{{ old('description',$franchise->description) }}</textarea></div>
        <div class="col-md-6"><label class="form-label-md">Warna Aksen (Hex)</label><input type="color" name="color_accent" class="form-control form-control-md" value="{{ old('color_accent',$franchise->color_accent ?? '#800000') }}" style="height:44px;"></div>
        <div class="col-md-6"><label class="form-label-md">Urutan Tampil</label><input type="number" name="sort_order" class="form-control form-control-md" value="{{ old('sort_order',$franchise->sort_order) }}" min="0"></div>
    </div>
    <hr style="border-color:var(--md-border);margin:2rem 0;">
    <div class="d-flex gap-3 justify-content-end">
        <a href="{{ route('admin.franchise.index') }}" class="btn btn-md-outline">Batal</a>
        <button type="submit" class="btn btn-md-primary"><i class="bi bi-check-lg me-1"></i>Update Paket</button>
    </div>
</form>
</div>
</div></div>
@endsection
