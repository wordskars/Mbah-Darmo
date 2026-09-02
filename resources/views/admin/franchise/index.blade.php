@extends('layouts.admin')
@section('title','Paket Franchise')
@section('page-title','Paket Kemitraan Franchise')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <p class="text-md-muted mb-0" style="font-size:0.875rem;">Kelola data paket kemitraan franchise Mbah Darmo.</p>
    <a href="{{ route('admin.franchise.create') }}" class="btn btn-md-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Paket</a>
</div>
<div class="form-card">
    <div class="table-responsive">
        <table class="table table-md mb-0">
            <thead>
                <tr><th>Paket</th><th>Harga Investasi</th><th>Luas</th><th>Kapasitas</th><th>ROI Est.</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($packages as $pkg)
                <tr>
                    <td>
                        <div style="font-weight:600;color:var(--md-charcoal);">{{ $pkg->name }}</div>
                        <div style="font-size:0.75rem;color:var(--md-text-muted);">{{ $pkg->monthly_revenue_estimate }}/bln est.</div>
                    </td>
                    <td style="font-weight:700;color:var(--md-primary);">{{ $pkg->formatted_price }}</td>
                    <td style="font-size:0.875rem;">{{ $pkg->space_required }}</td>
                    <td style="font-size:0.875rem;">{{ $pkg->pax_capacity }} pax</td>
                    <td><span class="badge-active">{{ $pkg->roi_projection }}</span></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('franchise.show', $pkg->slug) }}" target="_blank" class="btn btn-sm" style="background:rgba(161,138,67,0.1);border:1px solid rgba(161,138,67,0.2);color:var(--md-gold);border-radius:8px;padding:0.3rem 0.7rem;font-size:0.75rem;" title="Lihat Publik"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.franchise.edit', $pkg) }}" class="btn btn-sm" style="background:var(--md-bg-warm);border:1px solid var(--md-border);color:var(--md-text);border-radius:8px;padding:0.3rem 0.7rem;font-size:0.75rem;"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.franchise.destroy', $pkg) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background:rgba(128,0,0,0.08);border:1px solid rgba(128,0,0,0.15);color:var(--md-primary);border-radius:8px;padding:0.3rem 0.7rem;font-size:0.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-md-muted">Belum ada paket franchise.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
