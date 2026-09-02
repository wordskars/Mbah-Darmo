@extends('layouts.admin')
@section('title','AI Promo Assistant')
@section('page-title','AI Promo Strategy Assistant')

@section('extra-styles')
<style>
.ai-hero {
    background: linear-gradient(135deg, var(--md-charcoal) 0%, #1a0a0a 100%);
    border-radius: 18px; padding: 2.5rem; color: #fff; position: relative; overflow: hidden; margin-bottom: 2rem;
}
.ai-hero::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at 80% 50%, rgba(128,0,0,0.15) 0%, transparent 60%);
}
.ai-hero::after {
    content: '✦'; position: absolute; right: 2rem; top: 1.5rem;
    font-size: 5rem; color: rgba(161,138,67,0.06); line-height: 1;
}
.data-table-card {
    background: #fff; border: 1px solid var(--md-border);
    border-radius: 14px; overflow: hidden;
}
.data-table-card .header {
    padding: 1rem 1.25rem; border-bottom: 1px solid var(--md-border);
    display: flex; align-items: center; gap: 0.75rem;
}
.rank-1 { background: linear-gradient(135deg, var(--md-gold), #C8AA68); color:#fff; }
.rank-2 { background: rgba(128,0,0,0.08); color: var(--md-primary); }
.rank-other { background: var(--md-bg-warm); color: var(--md-text-muted); }
.rank-num { width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.72rem;font-weight:700;flex-shrink:0; }

/* AI OUTPUT CARD */
.ai-output {
    background: linear-gradient(to bottom right, #fff, var(--md-bg-warm));
    border: 1px solid rgba(128,0,0,0.15);
    border-radius: 18px; padding: 2rem;
    white-space: pre-wrap; font-size: 0.875rem; line-height: 1.8;
    color: var(--md-text); position: relative;
}
.ai-output-badge {
    display: inline-flex; align-items: center; gap: 0.4rem;
    background: rgba(128,0,0,0.08); color: var(--md-primary);
    padding: 0.35rem 0.9rem; border-radius: 50px; font-size: 0.72rem;
    font-weight: 600; margin-bottom: 1rem; border: 1px solid rgba(128,0,0,0.12);
}
.generating-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(44,34,21,0.6); z-index: 9999;
    align-items: center; justify-content: center; flex-direction: column;
    backdrop-filter: blur(6px);
}
.generating-overlay.active { display: flex; }
.spin-icon { font-size: 3rem; animation: spin 1.5s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
</style>
@endsection

@section('content')

{{-- AI HERO --}}
<div class="ai-hero position-relative">
    <div class="position-relative">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div style="width:52px;height:52px;background:rgba(161,138,67,0.15);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;border:1px solid rgba(161,138,67,0.25);">✨</div>
            <div>
                <h2 style="font-family:var(--font-heading);color:#fff;margin:0;font-size:1.4rem;">AI Promo Strategy Assistant</h2>
                <div style="color:rgba(255,255,255,0.5);font-size:0.8rem;">Powered by Google Gemini · Analisis Data Penjualan Otomatis</div>
            </div>
        </div>
        <p style="color:rgba(255,255,255,0.65);font-size:0.875rem;line-height:1.8;max-width:700px;margin-bottom:1.5rem;">
            Sistem AI akan menganalisis <strong style="color:rgba(255,255,255,0.9);">Top 5 & Bottom 5 produk</strong> dari data penjualan 30 hari terakhir, lalu menghasilkan strategi bundling, diskon silang, dan narasi promosi yang siap diterbitkan ke halaman publik.
        </p>
        <form action="{{ route('admin.ai-assistant.generate') }}" method="POST" id="generateForm">
            @csrf
            <button type="submit" class="btn px-5 py-3" style="background:var(--md-gold);color:#fff;border-radius:50px;font-weight:600;border:none;font-size:0.95rem;" onclick="showGenerating()">
                <i class="bi bi-stars me-2"></i>Generate AI Promo Strategy
            </button>
        </form>
    </div>
</div>

{{-- GENERATING OVERLAY --}}
<div class="generating-overlay" id="generatingOverlay">
    <div class="text-center text-white">
        <div class="spin-icon mb-3">⚙️</div>
        <h5 style="font-family:'Playfair Display',serif;">Menganalisis Data Penjualan...</h5>
        <p style="color:rgba(255,255,255,0.6);font-size:0.875rem;">Gemini AI sedang merangkai strategi promo terbaik untuk Anda</p>
    </div>
</div>

<div class="row g-4">
    {{-- TOP 5 & BOTTOM 5 --}}
    <div class="col-lg-5">
        <div class="data-table-card mb-4">
            <div class="header">
                <i class="bi bi-graph-up-arrow" style="color:var(--md-gold);font-size:1.1rem;"></i>
                <div><div style="font-weight:600;font-size:0.875rem;">Top 5 Produk Terlaris</div><div style="font-size:0.72rem;color:var(--md-text-muted);">30 hari terakhir</div></div>
            </div>
            <div class="p-3">
                @forelse($top5 as $i => $item)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rank-num {{ $i===0 ? 'rank-1' : ($i===1 ? 'rank-2' : 'rank-other') }}">{{ $i+1 }}</div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:0.825rem;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->name }}</div>
                        <div style="font-size:0.72rem;color:var(--md-text-muted);">{{ number_format($item->total_sold) }} porsi terjual</div>
                    </div>
                    @if($i===0)<span style="background:rgba(161,138,67,0.1);color:var(--md-gold);padding:0.2rem 0.5rem;border-radius:50px;font-size:0.65rem;font-weight:600;">⭐ Best</span>@endif
                </div>
                @empty
                <p class="text-md-muted text-center py-3" style="font-size:0.825rem;">Belum ada data transaksi.</p>
                @endforelse
            </div>
        </div>

        <div class="data-table-card">
            <div class="header">
                <i class="bi bi-graph-down-arrow" style="color:var(--md-primary);font-size:1.1rem;"></i>
                <div><div style="font-weight:600;font-size:0.875rem;">Bottom 5 — Perlu Promosi</div><div style="font-size:0.72rem;color:var(--md-text-muted);">Target untuk strategi bundling</div></div>
            </div>
            <div class="p-3">
                @forelse($bottom5 as $i => $item)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rank-num rank-other">{{ $i+1 }}</div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:0.825rem;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->name }}</div>
                        <div style="font-size:0.72rem;color:var(--md-text-muted);">{{ number_format($item->total_sold) }} porsi terjual</div>
                    </div>
                    <span style="background:rgba(128,0,0,0.08);color:var(--md-primary);padding:0.2rem 0.5rem;border-radius:50px;font-size:0.65rem;">Boost!</span>
                </div>
                @empty
                <p class="text-md-muted text-center py-3" style="font-size:0.825rem;">Belum ada data.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- AI OUTPUT --}}
    <div class="col-lg-7">
        @if(isset($aiText))
        <div class="mb-3">
            <div class="ai-output-badge"><i class="bi bi-stars"></i>Strategi AI Berhasil Digenerate</div>
            <div class="ai-output" id="aiOutputText">{{ $aiText }}</div>
        </div>

        {{-- PUBLISH FORM --}}
        <div class="form-card" style="border:2px solid rgba(128,0,0,0.12);">
            <h5 style="font-family:var(--font-heading);margin-bottom:1rem;font-size:1.1rem;">
                <i class="bi bi-megaphone me-2" style="color:var(--md-gold);"></i>Terbitkan Sebagai Promo Aktif
            </h5>
            <p style="font-size:0.825rem;color:var(--md-text-muted);margin-bottom:1.25rem;">
                Promo ini akan langsung tersimpan ke database dan tampil sebagai banner di halaman utama publik.
            </p>
            <form action="{{ route('admin.ai-assistant.publish') }}" method="POST">
                @csrf
                <input type="hidden" name="ai_strategy_text" value="{{ $aiText }}">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-md">Judul Promo *</label>
                        <input type="text" name="title" class="form-control form-control-md" required
                               placeholder="cth: 🔥 Bundling Spesial Mbah Darmo — Hemat 50%!">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Tipe Diskon</label>
                        <select name="discount_type" class="form-control form-control-md">
                            <option value="bundling">Bundling</option>
                            <option value="percentage">Persentase (%)</option>
                            <option value="fixed">Nominal Tetap (Rp)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-md">Berlaku Hingga</label>
                        <input type="date" name="valid_until" class="form-control form-control-md"
                               value="{{ date('Y-m-d', strtotime('+30 days')) }}">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-md-primary px-4 py-2">
                        <i class="bi bi-megaphone me-2"></i>Terbitkan Sebagai Promo Baru
                    </button>
                </div>
            </form>
        </div>
        @else
        {{-- PLACEHOLDER STATE --}}
        <div style="background:var(--md-bg-warm);border:2px dashed var(--md-border);border-radius:18px;padding:4rem 2rem;text-align:center;">
            <div style="font-size:4rem;margin-bottom:1rem;opacity:0.4;">🤖</div>
            <h5 style="font-family:var(--font-heading);color:var(--md-text-muted);">Belum Ada Strategi AI</h5>
            <p style="font-size:0.875rem;color:var(--md-text-muted);max-width:350px;margin:auto 0.5rem;">
                Klik tombol <strong>"Generate AI Promo Strategy"</strong> di atas untuk menghasilkan rekomendasi bundling & promo otomatis dari Gemini AI.
            </p>
        </div>
        @endif

        {{-- PREVIOUSLY GENERATED PROMOS --}}
        @if($lastPromos->count() > 0)
        <div class="form-card mt-4">
            <h5 style="font-family:var(--font-heading);margin-bottom:1rem;font-size:1rem;">Riwayat Promo AI Sebelumnya</h5>
            @foreach($lastPromos as $p)
            <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="border-color:var(--md-border)!important;font-size:0.8rem;">
                <div>
                    <div style="font-weight:500;">{{ $p->title }}</div>
                    <div style="color:var(--md-text-muted);font-size:0.72rem;">{{ $p->created_at->diffForHumans() }}</div>
                </div>
                <span class="{{ $p->is_active ? 'badge-active':'badge-inactive' }}">{{ $p->is_active ? 'Aktif':'Nonaktif' }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
function showGenerating() {
    setTimeout(() => {
        document.getElementById('generatingOverlay').classList.add('active');
    }, 100);
}
</script>
@endsection
