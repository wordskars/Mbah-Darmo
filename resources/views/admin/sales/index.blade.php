@extends('layouts.admin')
@section('title','Laporan Penjualan')
@section('page-title','Laporan & Input Penjualan')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4"><div class="stat-card"><div class="d-flex justify-content-between align-items-start mb-2"><div><div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);">Total Revenue</div><div style="font-family:var(--font-heading);font-size:1.6rem;font-weight:700;">Rp {{ number_format($totalRevenue/1000000,1) }}Jt</div></div><div class="stat-icon"><i class="bi bi-cash-stack"></i></div></div><div style="font-size:0.75rem;color:var(--md-text-muted);">{{ $period }} hari terakhir</div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="d-flex justify-content-between align-items-start mb-2"><div><div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);">Total Porsi Terjual</div><div style="font-family:var(--font-heading);font-size:1.6rem;font-weight:700;">{{ number_format($totalQty) }}</div></div><div class="stat-icon"><i class="bi bi-bag-check"></i></div></div><div style="font-size:0.75rem;color:var(--md-text-muted);">{{ $period }} hari terakhir</div></div></div>
    <div class="col-md-4">
        <div class="form-card h-100">
            <form action="{{ route('admin.sales.store') }}" method="POST">
                @csrf
                <div style="font-size:0.7rem;letter-spacing:1.5px;text-transform:uppercase;color:var(--md-text-muted);margin-bottom:0.75rem;">Input Transaksi Baru</div>
                <select name="menu_id" class="form-control form-control-md mb-2" required>
                    <option value="">Pilih Menu</option>
                    @foreach($menus as $m)
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
                <div class="row g-2 mb-2">
                    <div class="col-6"><input type="number" name="quantity_sold" class="form-control form-control-md" placeholder="Qty" min="1" required></div>
                    <div class="col-6"><input type="date" name="transaction_date" class="form-control form-control-md" value="{{ date('Y-m-d') }}" required></div>
                </div>
                <button type="submit" class="btn btn-md-primary w-100"><i class="bi bi-plus-circle me-1"></i>Catat Transaksi</button>
            </form>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="form-card">
            <h5 style="font-family:var(--font-heading);margin-bottom:1.25rem;font-size:1.1rem;">Top Produk Periode Ini</h5>
            @foreach($topProducts as $i => $p)
            <div class="d-flex align-items-center gap-3 mb-3">
                <span style="width:24px;height:24px;background:{{ $i===0 ? 'var(--md-gold)' : ($i===1 ? 'rgba(128,0,0,0.1)' : 'var(--md-bg-warm)') }};border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:{{ $i===0 ? '#fff':'var(--md-text)' }};flex-shrink:0;">{{ $i+1 }}</span>
                <div style="flex:1;min-width:0;"><div style="font-size:0.825rem;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $p->name }}</div><div style="font-size:0.72rem;color:var(--md-text-muted);">{{ number_format($p->total_sold) }} porsi · Rp {{ number_format($p->total_revenue/1000,0) }}K</div></div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-7">
        <div class="form-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 style="font-family:var(--font-heading);margin:0;font-size:1.1rem;">Riwayat Transaksi</h5>
                <div class="d-flex gap-2">
                    @foreach([7,30,90] as $p)
                    <a href="{{ route('admin.sales.index', ['period'=>$p]) }}" class="btn btn-sm {{ $period==$p ? 'btn-md-primary' : '' }}" style="{{ $period!=$p ? 'background:var(--md-bg-warm);border:1px solid var(--md-border);border-radius:50px;color:var(--md-text);' : 'border-radius:50px;' }} font-size:0.75rem;padding:0.3rem 0.8rem;">{{ $p }}H</a>
                    @endforeach
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-md mb-0">
                    <thead><tr><th>Tanggal</th><th>Menu</th><th>Qty</th><th>Revenue</th></tr></thead>
                    <tbody>
                        @forelse($transactions as $t)
                        <tr>
                            <td style="font-size:0.8rem;">{{ $t->transaction_date->format('d M Y') }}</td>
                            <td style="font-size:0.825rem;">{{ Str::limit($t->menu->name, 30) }}</td>
                            <td style="font-weight:600;">{{ $t->quantity_sold }}</td>
                            <td style="font-size:0.8rem;color:var(--md-primary);">Rp {{ number_format($t->revenue/1000,0) }}K</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4 text-md-muted" style="font-size:0.875rem;">Belum ada transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transactions->hasPages())
            <div class="mt-3">{{ $transactions->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
