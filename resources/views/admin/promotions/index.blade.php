@extends('layouts.admin')
@section('title','Promo & Banner')
@section('page-title','Promo & Banner Publik')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <p class="text-md-muted mb-0" style="font-size:0.875rem;">Promo aktif akan tampil sebagai banner di halaman utama publik.</p>
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-md-primary"><i class="bi bi-plus-lg me-1"></i>Buat Promo</a>
</div>
<div class="form-card">
    <div class="table-responsive">
        <table class="table table-md mb-0">
            <thead>
                <tr><th>Promo</th><th>Tipe Diskon</th><th>Sumber</th><th>Status</th><th>Berlaku Hingga</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($promotions as $promo)
                <tr>
                    <td>
                        <div style="font-weight:500;font-size:0.875rem;">{{ $promo->title }}</div>
                        <div style="font-size:0.75rem;color:var(--md-text-muted);">{{ Str::limit($promo->description, 60) }}</div>
                    </td>
                    <td><span class="badge-ai">{{ ucfirst($promo->discount_type ?? '-') }}</span></td>
                    <td>
                        @if($promo->source === 'ai_generated')
                            <span class="badge-ai"><i class="bi bi-stars me-1"></i>AI Generated</span>
                        @else
                            <span class="badge-inactive">Manual</span>
                        @endif
                    </td>
                    <td>
                        @if($promo->is_active)
                            <span class="badge-active">● Aktif</span>
                        @else
                            <span class="badge-inactive">Nonaktif</span>
                        @endif
                    </td>
                    <td style="font-size:0.8rem;">{{ $promo->valid_until ? $promo->valid_until->format('d M Y') : '—' }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.promotions.edit', $promo) }}" class="btn btn-sm" style="background:var(--md-bg-warm);border:1px solid var(--md-border);border-radius:8px;padding:0.3rem 0.7rem;font-size:0.75rem;"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.promotions.destroy', $promo) }}" method="POST" onsubmit="return confirm('Hapus promo ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background:rgba(128,0,0,0.08);border:1px solid rgba(128,0,0,0.15);color:var(--md-primary);border-radius:8px;padding:0.3rem 0.7rem;font-size:0.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-md-muted">Belum ada promo. <a href="{{ route('admin.promotions.create') }}">Buat sekarang →</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($promotions->hasPages())
    <div class="mt-4">{{ $promotions->links() }}</div>
    @endif
</div>
@endsection
