@extends('layouts.admin')
@section('title','Promo & Banner')
@section('page-title','Promo & Banner Publik')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:0.875rem;">Promo yang berstatus aktif akan muncul sebagai banner promo menarik di website publik.</p>
    </div>
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-md-primary">
        <i class="bi bi-plus-lg me-1"></i> Buat Promo Baru
    </a>
</div>

<div class="form-card">
    <div class="table-responsive">
        <table class="table table-md mb-0">
            <thead>
                <tr>
                    <th style="min-width: 240px;">Judul & Info Promo</th>
                    <th>Tipe Diskon</th>
                    <th>Asal Konten</th>
                    <th>Status</th>
                    <th>Masa Berlaku</th>
                    <th style="width: 110px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($promotions as $promo)
                <tr>
                    <td>
                        <div style="font-weight:600;font-size:0.9rem;color:var(--md-text-dark);">
                            {{ $promo->title }}
                        </div>
                        <div style="font-size:0.75rem;color:var(--md-text-muted);max-width:320px;" class="text-truncate">
                            {{ $promo->description ?: 'Tidak ada deskripsi rincian.' }}
                        </div>
                    </td>
                    <td>
                        <span class="badge-ai">
                            {{ ucfirst($promo->discount_type ?? 'Spesial') }}
                        </span>
                    </td>
                    <td>
                        @if($promo->source === 'ai_generated')
                            <span class="badge-ai">
                                <i class="bi bi-stars text-warning" style="font-size:0.7rem;"></i> AI Generated
                            </span>
                        @else
                            <span class="badge-amber">
                                <i class="bi bi-pen" style="font-size:0.65rem;"></i> Manual
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($promo->is_active)
                            <span class="badge-active">
                                <i class="bi bi-check-circle-fill" style="font-size:0.65rem;"></i> Aktif
                            </span>
                        @else
                            <span class="badge-inactive">
                                <i class="bi bi-pause-circle-fill" style="font-size:0.65rem;"></i> Nonaktif
                            </span>
                        @endif
                    </td>
                    <td style="font-size:0.825rem;">
                        @if($promo->valid_until)
                            <i class="bi bi-calendar3 me-1 text-muted"></i> {{ $promo->valid_until->format('d M Y') }}
                        @else
                            <span class="text-muted">— Selamanya —</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-end gap-1">
                            <a
                                href="{{ route('admin.promotions.edit', $promo) }}"
                                class="btn-action-icon btn-action-edit text-decoration-none"
                                title="Edit Promo"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form
                                action="{{ route('admin.promotions.destroy', $promo) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus promo ini?')"
                                class="m-0"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn-action-icon btn-action-delete border-0"
                                    title="Hapus Promo"
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
                        <div class="mb-2 fs-3">📢</div>
                        <p class="mb-2">Belum ada promo terdaftar.</p>
                        <a href="{{ route('admin.promotions.create') }}" class="btn btn-sm btn-md-primary">
                            Buat Promo Sekarang
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($promotions->hasPages())
    <div class="mt-4 pt-3 border-top d-flex justify-content-center" style="border-color:var(--md-border) !important;">
        {{ $promotions->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
