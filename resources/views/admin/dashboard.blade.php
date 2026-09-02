@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard Overview')

@section('extra-styles')
<style>
.revenue-badge { background:rgba(39,174,96,0.1); color:#1a7a43; border-radius:50px; padding:0.3rem 0.75rem; font-size:0.75rem; font-weight:600; }
.chart-bar-wrap { display:flex; flex-direction:column; gap:0.6rem; }
.chart-row { display:flex; align-items:center; gap:0.75rem; font-size:0.8rem; }
.chart-label { width:150px; color:var(--md-text-muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; flex-shrink:0; }
.chart-bar-bg { flex:1; background:var(--md-bg-warm); border-radius:50px; height:10px; }
.chart-bar-fg { height:100%; border-radius:50px; background:linear-gradient(to right, var(--md-primary), var(--md-gold)); transition:width 1s ease; }
.chart-val { width:60px; text-align:right; font-weight:600; color:var(--md-charcoal); }
</style>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <!-- STAT CARDS -->
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);margin-bottom:0.25rem;">Total Menu</div>
                    <div style="font-family:var(--font-heading);font-size:2rem;font-weight:700;color:var(--md-charcoal);">{{ $totalMenus }}</div>
                </div>
                <div class="stat-icon"><i class="bi bi-journal-bookmark"></i></div>
            </div>
            <a href="{{ route('admin.menus.index') }}" style="font-size:0.75rem;color:var(--md-primary);text-decoration:none;">Kelola Menu <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);margin-bottom:0.25rem;">Promo Aktif</div>
                    <div style="font-family:var(--font-heading);font-size:2rem;font-weight:700;color:var(--md-charcoal);">{{ $totalPromos }}</div>
                </div>
                <div class="stat-icon"><i class="bi bi-megaphone"></i></div>
            </div>
            <a href="{{ route('admin.promotions.index') }}" style="font-size:0.75rem;color:var(--md-primary);text-decoration:none;">Kelola Promo <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);margin-bottom:0.25rem;">Total Transaksi</div>
                    <div style="font-family:var(--font-heading);font-size:2rem;font-weight:700;color:var(--md-charcoal);">{{ number_format($totalTransactions) }}</div>
                </div>
                <div class="stat-icon"><i class="bi bi-receipt"></i></div>
            </div>
            <a href="{{ route('admin.sales.index') }}" style="font-size:0.75rem;color:var(--md-primary);text-decoration:none;">Lihat Laporan <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);margin-bottom:0.25rem;">Revenue 30 Hari</div>
                    <div style="font-family:var(--font-heading);font-size:1.5rem;font-weight:700;color:var(--md-charcoal);">Rp {{ number_format($recentRevenue/1000000,1) }}Jt</div>
                </div>
                <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
            </div>
            @if($topProduct)
            <span class="badge-active">⭐ Top: {{ Str::limit($topProduct->name, 20) }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- TOP 5 PRODUCTS -->
    <div class="col-lg-7">
        <div class="form-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 style="font-family:var(--font-heading);margin:0;font-size:1.1rem;">Top Produk — 30 Hari Terakhir</h5>
                <a href="{{ route('admin.ai-assistant.index') }}" class="btn btn-sm" style="background:rgba(128,0,0,0.08);color:var(--md-primary);border-radius:50px;font-size:0.75rem;padding:0.3rem 0.9rem;">
                    <i class="bi bi-stars me-1"></i>AI Strategy
                </a>
            </div>
            @php $maxSold = $topMenus->max('total_sold') ?: 1; @endphp
            <div class="chart-bar-wrap">
                @forelse($topMenus as $i => $menu)
                <div class="chart-row">
                    <div class="chart-label" title="{{ $menu->name }}">{{ $i+1 }}. {{ $menu->name }}</div>
                    <div class="chart-bar-bg">
                        <div class="chart-bar-fg" style="width:{{ ($menu->total_sold / $maxSold) * 100 }}%"></div>
                    </div>
                    <div class="chart-val">{{ number_format($menu->total_sold) }}</div>
                </div>
                @empty
                <p class="text-md-muted text-center py-3" style="font-size:0.875rem;">Belum ada data penjualan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- QUICK ACTIONS -->
    <div class="col-lg-5">
        <div class="form-card mb-4">
            <h5 style="font-family:var(--font-heading);margin-bottom:1.25rem;font-size:1.1rem;">Aksi Cepat</h5>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.menus.create') }}" class="btn btn-md-primary text-start px-3">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Menu Baru
                </a>
                <a href="{{ route('admin.promotions.create') }}" class="btn btn-md-outline text-start px-3">
                    <i class="bi bi-megaphone me-2"></i> Buat Promo Baru
                </a>
                <a href="{{ route('admin.sales.index') }}" class="btn text-start px-3" style="background:var(--md-bg-warm);border:1px solid var(--md-border);color:var(--md-text);border-radius:50px;">
                    <i class="bi bi-plus-circle me-2"></i> Input Transaksi
                </a>
                <a href="{{ route('admin.ai-assistant.index') }}" class="btn text-start px-3" style="background:linear-gradient(135deg,rgba(128,0,0,0.08),rgba(161,138,67,0.08));border:1px solid rgba(128,0,0,0.15);color:var(--md-primary);border-radius:50px;">
                    <i class="bi bi-stars me-2"></i> AI Promo Generator
                </a>
            </div>
        </div>

        <!-- RECENT WEEKLY SALES -->
        <div class="form-card">
            <h5 style="font-family:var(--font-heading);margin-bottom:1.25rem;font-size:1.1rem;">Penjualan 7 Hari Terakhir</h5>
            @forelse($weeklySales as $day)
            <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="border-color:var(--md-border) !important;font-size:0.8rem;">
                <span class="text-md-muted">{{ \Carbon\Carbon::parse($day->date)->isoFormat('ddd, D MMM') }}</span>
                <div class="d-flex gap-3">
                    <span>{{ number_format($day->total_qty) }} porsi</span>
                    <span class="revenue-badge">Rp {{ number_format($day->total_revenue/1000,0) }}K</span>
                </div>
            </div>
            @empty
            <p class="text-md-muted text-center py-3" style="font-size:0.875rem;">Belum ada data.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
