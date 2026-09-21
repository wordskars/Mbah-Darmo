@extends('layouts.admin')
@section('title','Paket Franchise')
@section('page-title','Paket Kemitraan Franchise')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:0.875rem;">Kelola rincian paket investasi kemitraan waralaba Warung Mbah Darmo.</p>
    </div>
    <a href="{{ route('admin.franchise.create') }}" class="btn btn-md-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Paket Baru
    </a>
</div>

<div class="form-card">
    <div class="table-responsive">
        <table class="table table-md mb-0">
            <thead>
                <tr>
                    <th style="min-width: 180px;">Nama Paket</th>
                    <th>Investasi</th>
                    <th>Kebutuhan Luas</th>
                    <th>Kapasitas</th>
                    <th>Proyeksi ROI</th>
                    <th style="width: 130px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($packages as $pkg)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <span class="d-inline-block rounded-circle" style="width:10px;height:10px;background:{{ $pkg->color_accent ?? 'var(--md-terracotta)' }};"></span>
                            <div>
                                <div style="font-weight:700;color:var(--md-text-dark);font-size:0.925rem;">
                                    {{ $pkg->name }}
                                </div>
                                <div style="font-size:0.75rem;color:var(--md-text-muted);">
                                    {{ $pkg->monthly_revenue_estimate }}/bln est.
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="font-weight:700;color:var(--md-terracotta);font-size:0.925rem;">
                        {{ $pkg->formatted_price }}
                    </td>
                    <td style="font-size:0.875rem;">
                        <i class="bi bi-aspect-ratio me-1 text-muted"></i> {{ $pkg->space_required }}
                    </td>
                    <td style="font-size:0.875rem;">
                        <i class="bi bi-people me-1 text-muted"></i> {{ $pkg->pax_capacity }} pax
                    </td>
                    <td>
                        <span class="badge-active">
                            <i class="bi bi-clock-history" style="font-size:0.65rem;"></i> {{ $pkg->roi_projection }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end gap-1">
                            <a
                                href="{{ route('franchise.show', $pkg->slug) }}"
                                target="_blank"
                                class="btn-action-icon btn-action-edit text-decoration-none"
                                title="Lihat Tampilan Publik"
                            >
                                <i class="bi bi-eye"></i>
                            </a>

                            <a
                                href="{{ route('admin.franchise.edit', $pkg) }}"
                                class="btn-action-icon btn-action-edit text-decoration-none"
                                title="Edit Paket"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form
                                action="{{ route('admin.franchise.destroy', $pkg) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket {{ $pkg->name }}?')"
                                class="m-0"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn-action-icon btn-action-delete border-0"
                                    title="Hapus Paket"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <div class="mb-2 fs-3">🏪</div>
                        <p class="mb-2">Belum ada paket kemitraan franchise terdaftar.</p>
                        <a href="{{ route('admin.franchise.create') }}" class="btn btn-sm btn-md-primary">
                            Tambah Paket Sekarang
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
