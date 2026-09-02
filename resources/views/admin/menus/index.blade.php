@extends('layouts.admin')
@section('title','Data Menu')
@section('page-title','Data Menu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-md-muted mb-0" style="font-size:0.875rem;">Kelola semua item menu yang tampil di katalog publik.</p>
    </div>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-md-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Menu
    </a>
</div>

<div class="form-card">
    <div class="table-responsive">
        <table class="table table-md mb-0">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Unggulan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:44px;height:44px;border-radius:8px;overflow:hidden;background:var(--md-bg-warm);display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;">
                                @if($menu->image)
                                    <img src="{{ asset('storage/'.$menu->image) }}" style="width:100%;height:100%;object-fit:cover;" alt="">
                                @else
                                    @if(str_contains(strtolower($menu->name),'mie')) 🍜
                                    @elseif(str_contains(strtolower($menu->name),'kopi')) ☕
                                    @elseif(str_contains(strtolower($menu->name),'nasi')) 🍚
                                    @else 🍽️
                                    @endif
                                @endif
                            </div>
                            <div>
                                <div style="font-weight:500;font-size:0.875rem;">{{ $menu->name }}</div>
                                <div style="font-size:0.75rem;color:var(--md-text-muted);">{{ Str::limit($menu->short_description_hover, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge-ai">{{ $menu->category->name }}</span></td>
                    <td style="font-weight:600;color:var(--md-primary);">{{ $menu->formatted_price }}</td>
                    <td>
                        @if($menu->is_available)
                            <span class="badge-active"><i class="bi bi-circle-fill me-1" style="font-size:0.5rem;"></i>Tersedia</span>
                        @else
                            <span class="badge-inactive">Habis</span>
                        @endif
                    </td>
                    <td>
                        @if($menu->is_featured)
                            <span class="badge-ai">⭐ Unggulan</span>
                        @else
                            <span class="text-md-muted" style="font-size:0.8rem;">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm" style="background:var(--md-bg-warm);border:1px solid var(--md-border);color:var(--md-text);border-radius:8px;padding:0.3rem 0.7rem;font-size:0.75rem;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Hapus menu ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background:rgba(128,0,0,0.08);border:1px solid rgba(128,0,0,0.15);color:var(--md-primary);border-radius:8px;padding:0.3rem 0.7rem;font-size:0.75rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-md-muted">Belum ada menu. <a href="{{ route('admin.menus.create') }}">Tambah sekarang →</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($menus->hasPages())
    <div class="mt-4">{{ $menus->links() }}</div>
    @endif
</div>
@endsection
