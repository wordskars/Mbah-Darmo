@extends('layouts.admin')
@section('title','AI Promo Assistant — Warung Mbah Darmo')
@section('page-title','AI Promo Assistant')

@section('extra-styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --red:       #C0392B;
    --red-dark:  #922B21;
    --red-light: #FDEDEC;
    --gold:      #D4AF37;
    --gold-bg:   #FDF9EE;
    --border:    #E8E0D5;
    --bg:        #F8F5F0;
    --card:      #FFFFFF;
    --text:      #2C1B13;
    --muted:     #8C7A6B;
    --success:   #1A8A4A;
    --radius:    14px;
    --shadow:    0 2px 12px rgba(44,27,19,.08);
    --shadow-lg: 0 8px 32px rgba(44,27,19,.12);
}

* { box-sizing: border-box; }

body { background: var(--bg); font-family: 'Plus Jakarta Sans', sans-serif; }

/* ── Page layout ── */
.ai-layout {
    display: grid;
    grid-template-columns: 320px 1fr;
    grid-template-rows: auto;
    gap: 1.25rem;
    align-items: start;
}
@media(max-width:991px) { .ai-layout { grid-template-columns:1fr; } }

/* ── Cards ── */
.ai-card {
    background: var(--card);
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}
.ai-card-header {
    padding: .875rem 1.25rem;
    border-bottom: 1.5px solid var(--border);
    display: flex;
    align-items: center;
    gap: .5rem;
    background: linear-gradient(135deg,#FFFAF5,#FFF8F0);
}
.ai-card-header h6 { margin:0; font-size:.85rem; font-weight:700; color:var(--text); }
.ai-card-body { padding: 1.25rem; }

/* ── Left sidebar ── */
.sidebar { display:flex; flex-direction:column; gap:1.25rem; }

/* ── Product checkbox ── */
.product-check-item {
    display: flex;
    align-items: center;
    gap: .625rem;
    padding: .625rem .75rem;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    cursor: pointer;
    transition: all .18s;
    background: #FAFAF9;
}
.product-check-item:hover { border-color: var(--red); background: var(--red-light); }
.product-check-item.selected { border-color: var(--red); background: var(--red-light); }
.product-check-item input[type=checkbox] { display:none; }
.product-check-item .check-icon {
    width: 18px; height: 18px;
    border: 2px solid var(--border);
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all .18s;
    font-size: .65rem;
    color: transparent;
}
.product-check-item.selected .check-icon {
    background: var(--red);
    border-color: var(--red);
    color: white;
}
.product-check-name { font-size: .82rem; font-weight: 600; color: var(--text); flex: 1; min-width:0; }
.product-check-price { font-size: .75rem; font-weight: 700; color: var(--red); white-space: nowrap; }
.product-rank-badge {
    width: 20px; height: 20px;
    border-radius: 50%;
    background: var(--red);
    color: white;
    font-size: .65rem;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

/* ── Generate button ── */
.btn-generate {
    background: linear-gradient(135deg, var(--red) 0%, var(--red-dark) 100%);
    color: white;
    border: none;
    border-radius: 12px;
    padding: .875rem 1.5rem;
    font-weight: 700;
    font-size: .95rem;
    width: 100%;
    cursor: pointer;
    transition: all .2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    box-shadow: 0 4px 16px rgba(192,57,43,.35);
    letter-spacing: .01em;
}
.btn-generate:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(192,57,43,.4); }
.btn-generate:disabled { opacity: .65; transform: none; cursor: not-allowed; }
.btn-generate .spinner {
    width: 18px; height: 18px;
    border: 2.5px solid rgba(255,255,255,.4);
    border-top-color: white;
    border-radius: 50%;
    animation: spin .75s linear infinite;
    display: none;
}
.btn-generate.loading .spinner { display: block; }
.btn-generate.loading .btn-text { display: none; }

@keyframes spin { to { transform: rotate(360deg); } }

/* ── Result area ── */
.result-area { display: flex; flex-direction: column; gap: 1.25rem; }

/* ── Poster display ── */
.poster-wrapper {
    position: relative;
    width: 100%;
    aspect-ratio: 4/5;
    border-radius: 12px;
    overflow: hidden;
    background: #1a0505;
    box-shadow: var(--shadow-lg);
}
.poster-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: opacity .5s;
}
.poster-placeholder {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg,#1a0505,#3d0c0c);
    color: rgba(255,255,255,.5);
    gap: .75rem;
}
.poster-placeholder.hidden { display: none; }
.poster-actions {
    display: flex;
    gap: .5rem;
    padding: .75rem;
    background: linear-gradient(180deg, transparent, rgba(0,0,0,.6));
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    transition: opacity .2s;
    opacity: 0;
}
.poster-wrapper:hover .poster-actions { opacity: 1; }
.poster-actions a, .poster-actions button {
    flex: 1;
    padding: .5rem;
    border-radius: 8px;
    font-size: .75rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .35rem;
    transition: all .15s;
}
.btn-poster-download { background: rgba(255,255,255,.2); color: white; text-decoration: none; }
.btn-poster-download:hover { background: rgba(255,255,255,.35); color: white; }
.btn-poster-publish { background: var(--red); color: white; }
.btn-poster-publish:hover { background: var(--red-dark); }

/* ── Strategy text ── */
.strategy-box {
    background: var(--gold-bg);
    border: 1.5px solid #E8D87A;
    border-radius: 12px;
    padding: 1rem 1.125rem;
}
.strategy-line {
    display: flex;
    gap: .625rem;
    margin-bottom: .5rem;
    align-items: flex-start;
}
.strategy-line:last-child { margin-bottom: 0; }
.strategy-label {
    font-size: .7rem;
    font-weight: 800;
    color: var(--red);
    background: var(--red-light);
    border: 1px solid #FAC7C3;
    border-radius: 4px;
    padding: .15rem .45rem;
    white-space: nowrap;
    margin-top: 1px;
}
.strategy-content {
    font-size: .85rem;
    color: var(--text);
    line-height: 1.55;
}

/* ── Empty state ── */
.empty-state {
    text-align: center;
    padding: 3rem 1.5rem;
    color: var(--muted);
}
.empty-state .empty-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: .4;
}

/* ── History cards ── */
.history-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 1rem;
}
.history-card {
    background: var(--card);
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    transition: all .2s;
    cursor: pointer;
}
.history-card:hover { border-color: var(--red); transform: translateY(-2px); box-shadow: var(--shadow-lg); }
.history-card-img {
    width: 100%;
    aspect-ratio: 4/5;
    object-fit: cover;
    background: #1a0505;
    display: block;
}
.history-card-body { padding: .75rem; }
.history-card-title { font-size: .8rem; font-weight: 700; color: var(--text); margin-bottom: .25rem; line-height: 1.3; }
.history-card-meta { font-size: .7rem; color: var(--muted); }
.history-card-badge {
    display: inline-flex;
    align-items: center;
    gap: .25rem;
    font-size: .65rem;
    font-weight: 700;
    padding: .2rem .5rem;
    border-radius: 20px;
    margin-top: .375rem;
}

/* ── Ratio selector ── */
.ratio-btn-group {
    display: flex;
    gap: .5rem;
    width: 100%;
}
.ratio-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .4rem;
    padding: .625rem .75rem;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    background: #FAFAF9;
    font-size: .82rem;
    font-weight: 700;
    color: var(--muted);
    cursor: pointer;
    transition: all .18s ease;
    user-select: none;
}
.ratio-btn:hover {
    border-color: var(--red);
    color: var(--red);
    background: var(--red-light);
}
.ratio-btn.active {
    border-color: var(--red);
    background: var(--red-light);
    color: var(--red);
    box-shadow: 0 2px 8px rgba(192, 57, 43, .15);
}
.ratio-btn input[type="radio"] {
    display: none;
}

/* ── Result header ── */
.result-title-badge {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: .5rem;
    margin-bottom: .75rem;
}
.result-promo-title {
    font-size: 1.05rem;
    font-weight: 800;
    color: var(--text);
    line-height: 1.25;
}

/* ── Template preview ── */
.template-thumb {
    width: 100%;
    aspect-ratio: 16/7;
    object-fit: cover;
    border-radius: 8px;
    border: 2px dashed var(--gold);
    margin-bottom: .625rem;
    display: block;
}

/* ── Select-all toggle ── */
.select-all-link { font-size:.75rem; color:var(--red); cursor:pointer; font-weight:600; text-decoration:none; }
.select-all-link:hover { text-decoration:underline; }

/* ── Loading overlay ── */
.ai-overlay {
    position: fixed;
    inset: 0;
    z-index: 1060;
    background: rgba(44,27,19,.7);
    backdrop-filter: blur(6px);
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}
.ai-overlay.active { display: flex; }
.ai-overlay-spinner {
    width: 56px; height: 56px;
    border: 5px solid rgba(255,255,255,.2);
    border-top-color: var(--gold);
    border-radius: 50%;
    animation: spin .8s linear infinite;
}
.ai-overlay-steps { text-align: center; color: white; max-width: 420px; }
.ai-overlay-steps h5 { font-weight:800; margin-bottom: .5rem; }
.step-item {
    display: flex;
    align-items: center;
    gap: .5rem;
    font-size: .85rem;
    color: rgba(255,255,255,.7);
    padding: .25rem 0;
    transition: color .3s;
}
.step-item.active { color: var(--gold); font-weight: 600; }
.step-item .step-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,.3);
    flex-shrink: 0;
}
.step-item.active .step-dot { background: var(--gold); }

/* ── Alert flash ── */
.flash-alert {
    position: fixed;
    top: 1.25rem;
    right: 1.25rem;
    z-index: 2000;
    min-width: 280px;
    max-width: 400px;
    border-radius: 12px;
    padding: .875rem 1.125rem;
    font-size: .875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: .625rem;
    box-shadow: 0 8px 32px rgba(0,0,0,.2);
    animation: slideIn .3s ease;
}
@keyframes slideIn { from { transform:translateX(100%); opacity:0; } to { transform:translateX(0); opacity:1; } }
.flash-success { background: #ECFDF5; border: 1.5px solid #6EE7B7; color: #064E3B; }
.flash-error   { background: #FEF2F2; border: 1.5px solid #FCA5A5; color: #7F1D1D; }
</style>
@endsection

@section('content')

{{-- ── Loading Overlay ── --}}
<div class="ai-overlay" id="aiOverlay">
    <div class="ai-overlay-spinner"></div>
    <div class="ai-overlay-steps">
        <h5>🤖 AI sedang bekerja...</h5>
        <div class="step-item active" id="step1"><div class="step-dot"></div> Menyusun strategi promo via Groq AI</div>
        <div class="step-item" id="step2"><div class="step-dot"></div> Building image prompt dengan logo & background merah</div>
        <div class="step-item" id="step3"><div class="step-dot"></div> Generating poster via Wavespeed z-image/turbo</div>
        <div class="step-item" id="step4"><div class="step-dot"></div> Menyimpan ke history</div>
    </div>
</div>

{{-- Flash messages --}}
@if(session('success'))
<div class="flash-alert flash-success" id="flashMsg">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="flash-alert flash-error" id="flashMsg">
    <i class="bi bi-x-circle-fill"></i> {{ session('error') }}
</div>
@endif

{{-- ── Page header ── --}}
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div>
        <h4 class="fw-800 mb-0" style="color:var(--text); font-size:1.25rem;">
            🔥 AI Promo Poster Generator
        </h4>
        <small class="text-muted">Groq → strategi teks &nbsp;·&nbsp; Wavespeed z-image/turbo → poster merah anti-gravity</small>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold" style="font-size:.75rem;">
            <i class="bi bi-image me-1"></i> Wavespeed z-image/turbo
        </span>
        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-semibold" style="font-size:.75rem;">
            <i class="bi bi-stars me-1"></i> Groq Strategy AI
        </span>
    </div>
</div>

{{-- ── Main layout ── --}}
<div class="ai-layout">

    {{-- ════════ LEFT SIDEBAR ════════ --}}
    <div class="sidebar">

        {{-- Bottom 5 selector --}}
        <div class="ai-card">
            <div class="ai-card-header">
                <i class="bi bi-fire text-danger"></i>
                <h6>Pilih Produk untuk Poster</h6>
                <span class="badge bg-danger text-white ms-auto" style="font-size:.65rem;">Bottom 5</span>
            </div>
            <div class="ai-card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="text-muted" style="font-size:.75rem;">Centang produk yang ingin dipromosikan</small>
                    <a class="select-all-link" onclick="toggleSelectAll()" id="selectAllBtn">Pilih Semua</a>
                </div>

                <div class="d-flex flex-column gap-2" id="productList">
                    @forelse($bottom5 as $index => $item)
                        <label class="product-check-item" data-name="{{ $item->name }}">
                            <input type="checkbox" name="selected_products[]" value="{{ $item->name }}">
                            <span class="product-rank-badge">{{ $index + 1 }}</span>
                            <span class="check-icon"><i class="bi bi-check2"></i></span>
                            <span class="product-check-name">{{ $item->name }}</span>
                            <span class="product-check-price">Rp {{ number_format($item->price ?? 0, 0, ',', '.') }}</span>
                        </label>
                    @empty
                        <div class="text-center py-3 text-muted" style="font-size:.82rem;">
                            <i class="bi bi-database-x fs-4 d-block mb-2 opacity-50"></i>
                            Belum ada data transaksi 30 hari terakhir
                        </div>
                    @endforelse
                </div>

                {{-- ── Pilihan Konsep Desain & Komposisi ── --}}
                <div class="mt-3 pt-2 border-top">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="fw-bold mb-0" style="font-size:.8rem; color:var(--text);">
                            <i class="bi bi-palette-fill text-danger me-1"></i> Konsep Desain Poster
                        </label>
                        <span class="badge bg-secondary-subtle text-secondary" style="font-size:.62rem;">6 Opsi Variasi</span>
                    </div>
                    <select class="form-select form-select-sm" id="visualStrategySelect" style="font-size:.78rem; border-color:var(--border); border-radius:8px; background-color:#FAFAF9;">
                        <option value="random" selected>🎲 Acak Otomatis (Berganti Tiap Generate)</option>
                        <option value="variasi_1">🪂 Variasi 1: Floating Minimalist</option>
                        <option value="variasi_2">📐 Variasi 2: Top-Down Artisanal (Flat Lay)</option>
                        <option value="variasi_3">💡 Variasi 3: Spotlight Dramatic (Chiaroscuro)</option>
                        <option value="variasi_4">🌶️ Variasi 4: Kebyar Bumbu & Tekstur</option>
                        <option value="variasi_5">🎨 Variasi 5: Modern Graphic & Simplicity</option>
                        <option value="original">📷 Orisinil (Classic Studio Framing)</option>
                    </select>
                    <small class="text-muted d-block mt-1" style="font-size:.68rem;">
                        Pilih gaya spesifik atau biarkan acak agar desain selalu bervariasi setiap kali generate.
                    </small>
                </div>

                {{-- ── Label Diskon Informatif ── --}}
                <div class="mt-3 pt-2 border-top">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="fw-bold mb-0" style="font-size:.8rem; color:var(--text);">
                            <i class="bi bi-tag-fill text-danger me-1"></i> Label Diskon di Atas Makanan
                        </label>
                        <span class="badge bg-danger-subtle text-danger" style="font-size:.62rem;">Informatif</span>
                    </div>
                    <div class="d-flex flex-wrap gap-1 mb-2" id="discountQuickPills">
                        <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 discount-pill active" onclick="setDiscountQuick('')" style="font-size:.7rem; border-radius:6px;">Tanpa Label</button>
                        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 discount-pill" onclick="setDiscountQuick('45%')" style="font-size:.7rem; border-radius:6px;">45%</button>
                        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 discount-pill" onclick="setDiscountQuick('50%')" style="font-size:.7rem; border-radius:6px;">50%</button>
                        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 discount-pill" onclick="setDiscountQuick('30%')" style="font-size:.7rem; border-radius:6px;">30%</button>
                        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 discount-pill" onclick="setDiscountQuick('20%')" style="font-size:.7rem; border-radius:6px;">20%</button>
                        <button type="button" class="btn btn-sm btn-outline-warning text-dark py-0 px-2 discount-pill" onclick="setDiscountQuick('auto')" style="font-size:.7rem; border-radius:6px;">✨ Auto AI</button>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text" style="background:#FAFAF9; font-size:.72rem; color:var(--muted);">Teks Label:</span>
                        <input type="text" class="form-control" id="customDiscountInput" placeholder="Contoh: 45% atau DISKON 45%" style="font-size:.75rem;">
                    </div>
                    <small class="text-muted d-block mt-1" style="font-size:.68rem;">
                        Label diskon akan muncul secara rapi dan proporsional tepat di atas makanan.
                    </small>
                </div>

                <button class="btn-generate mt-3" id="btnGenerate" onclick="doGenerate()">
                    <div class="spinner"></div>
                    <span class="btn-text"><i class="bi bi-stars"></i> Generate Poster Sekarang</span>
                </button>

                <p class="text-muted text-center mb-0 mt-2" style="font-size:.7rem;">
                    <i class="bi bi-shield-check text-success me-1"></i>Logo Mbah Darmo + background merah selalu disertakan
                </p>
            </div>
        </div>

        {{-- Top 5 info card --}}
        <div class="ai-card">
            <div class="ai-card-header">
                <i class="bi bi-trophy-fill text-success"></i>
                <h6>Top 5 Terlaris (30 hari)</h6>
            </div>
            <div class="ai-card-body" style="padding:.875rem;">
                <div class="d-flex flex-column gap-1">
                    @forelse($top5 as $i => $item)
                        <div class="d-flex align-items-center gap-2 py-1 px-2 rounded" style="background:{{ $i===0 ? '#ECFDF5' : '#FAFAF9' }}; border:1px solid {{ $i===0 ? '#6EE7B7' : 'var(--border)' }}">
                            <span style="width:18px;height:18px;border-radius:50%;background:{{ $i===0 ? '#059669' : '#9CA3AF' }};color:white;font-size:.6rem;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">{{ $i+1 }}</span>
                            <span style="font-size:.78rem;font-weight:600;flex:1;min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $item->name }}">{{ $item->name }}</span>
                            <span style="font-size:.72rem;color:var(--success);font-weight:700;white-space:nowrap;">{{ number_format($item->total_sold) }}x</span>
                        </div>
                    @empty
                        <p class="text-muted text-center mb-0" style="font-size:.78rem;">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
    {{-- end sidebar --}}

    {{-- ════════ RIGHT — RESULT AREA ════════ --}}
    <div class="result-area">

        {{-- Result panel --}}
        <div class="ai-card">
            <div class="ai-card-header">
                <i class="bi bi-grid-1x2-fill text-danger"></i>
                <h6>Hasil Generate</h6>
                <span class="badge bg-secondary-subtle text-secondary ms-auto" id="generationBadge" style="font-size:.65rem; display:none;">
                    <i class="bi bi-clock me-1"></i> <span id="generationTime"></span>
                </span>
            </div>

            {{-- Empty state (before generate) --}}
            <div class="empty-state" id="emptyState">
                <div class="empty-icon">🎨</div>
                <h6 style="font-weight:700; color:var(--text);">Siap Generate Poster Promo</h6>
                <p style="font-size:.85rem; max-width:320px; margin:0 auto;">
                    Pilih produk bottom 5, lalu klik <strong>"Generate Poster Sekarang"</strong> untuk membuat poster anti-gravity berlatar merah otomatis.
                </p>
                <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill" style="font-size:.75rem;"><i class="bi bi-circle-fill me-1"></i> Latar merah otomatis</span>
                    <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill" style="font-size:.75rem;"><i class="bi bi-star-fill me-1"></i> Logo pojok kiri atas</span>
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill" style="font-size:.75rem;"><i class="bi bi-save me-1"></i> Auto-simpan ke history</span>
                </div>
            </div>

            {{-- Result content (after generate) --}}
            <div id="resultContent" style="display:none;">
                <div style="padding:1.25rem; display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;" class="result-grid-inner">

                    {{-- Poster --}}
                    <div>
                        <div class="result-title-badge mb-2">
                            <span style="font-size:.78rem; font-weight:700; color:var(--muted);">🖼️ POSTER AI</span>
                            <div class="d-flex gap-1 flex-wrap align-items-center">
                                <span class="badge bg-danger text-white" style="font-size:.65rem;" id="layoutBadge"></span>
                                <span class="badge bg-warning-subtle text-dark border border-warning-subtle" style="font-size:.65rem; display:none;" id="variationBadge"></span>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle" style="font-size:.65rem; display:none;" id="discountBadge"></span>
                            </div>
                        </div>
                        <div class="poster-wrapper" id="posterWrapper">
                            <div class="poster-placeholder" id="posterPlaceholder">
                                <i class="bi bi-image fs-2"></i>
                                <span style="font-size:.8rem;">Generating...</span>
                            </div>
                            <img src="" alt="Poster Promo" id="posterImg" style="opacity:0;" onload="this.style.opacity=1;document.getElementById('posterPlaceholder').classList.add('hidden');">
                            <div class="poster-actions">
                                <a href="#" id="btnDownloadPoster" download="poster-mbah-darmo.jpg" target="_blank" class="btn-poster-download">
                                    <i class="bi bi-download"></i> Download
                                </a>
                                <button onclick="publishPromo()" class="btn-poster-publish" id="btnPublish">
                                    <i class="bi bi-send"></i> Publish
                                </button>
                            </div>
                        </div>
                        {{-- Products used --}}
                        <div class="mt-2" id="productsUsedSection">
                            <p style="font-size:.7rem; color:var(--muted); margin-bottom:.375rem;">Produk dalam poster:</p>
                            <div id="productsUsedList" class="d-flex flex-wrap gap-1"></div>
                        </div>
                    </div>

                    {{-- Strategy --}}
                    <div>
                        <div class="result-title-badge mb-2">
                            <span style="font-size:.78rem; font-weight:700; color:var(--muted);">📋 STRATEGI PROMO</span>
                            <button onclick="copyStrategy()" class="btn btn-sm btn-outline-secondary" style="font-size:.7rem; border-radius:6px; padding:.2rem .5rem;" id="btnCopy">
                                <i class="bi bi-clipboard me-1"></i> <span id="copyLabel">Salin</span>
                            </button>
                        </div>
                        <div class="result-promo-title mb-3" id="judulPromoDisplay"></div>
                        <div class="strategy-box" id="strategyBox">
                            {{-- Lines injected by JS --}}
                        </div>
                        <div class="mt-3 p-2 rounded" style="background:#F8F5F0; border:1.5px solid var(--border); font-size:.75rem; color:var(--muted);">
                            <i class="bi bi-info-circle me-1"></i> Strategi selalu berbeda setiap klik Generate — dijamin unik oleh AI.
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    {{-- end result --}}

</div>
{{-- end ai-layout --}}

{{-- ── History Section ── --}}
<div class="ai-card mt-4" id="historySection">
    <div class="ai-card-header">
        <i class="bi bi-clock-history text-danger"></i>
        <h6>History Generate</h6>
        <span class="badge bg-secondary-subtle text-secondary ms-auto" style="font-size:.65rem;" id="historyCount">
            {{ $lastPromos->count() }} entri
        </span>
    </div>
    <div style="padding:1.25rem;">
        @if($lastPromos->isEmpty())
            <div class="empty-state" style="padding:2rem;">
                <div class="empty-icon" style="font-size:2rem;">📭</div>
                <p style="font-size:.85rem; margin:0;">Belum ada history. Mulai generate poster pertama kamu!</p>
            </div>
        @else
            <div class="history-grid" id="historyGrid">
                @foreach($lastPromos as $promo)
                    <div class="history-card" onclick="viewHistory({{ $promo->id }}, '{{ addslashes($promo->title) }}', `{{ addslashes($promo->ai_strategy_text ?? '') }}`, '{{ $promo->banner_image ?? '' }}')">
                        @if($promo->banner_image)
                            <img src="{{ $promo->banner_image }}" alt="{{ $promo->title }}" class="history-card-img" onerror="this.style.display='none'">
                        @else
                            <div style="width:100%;aspect-ratio:1/1;background:linear-gradient(135deg,#1a0505,#3d0c0c);display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-image text-white opacity-25 fs-3"></i>
                            </div>
                        @endif
                        <div class="history-card-body">
                            <div class="history-card-title">{{ $promo->title }}</div>
                            <div class="history-card-meta">{{ $promo->created_at->format('d M Y, H:i') }}</div>
                            <span class="history-card-badge {{ $promo->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                <i class="bi bi-{{ $promo->is_active ? 'check-circle-fill' : 'clock' }}"></i>
                                {{ $promo->is_active ? 'Aktif' : 'Draft' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- ── History Detail Modal ── --}}
<div class="modal fade" id="historyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="border-radius:18px; border:1.5px solid var(--border); overflow:hidden;">
            <div class="modal-header" style="background:linear-gradient(135deg,#FFFAF5,#FFF8F0); border-bottom:1.5px solid var(--border);">
                <h5 class="modal-title fw-bold" id="historyModalTitle" style="font-size:1rem;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div style="display:grid; grid-template-columns:1fr 1fr; min-height:400px;">
                    <div style="background:#1a0505; display:flex; align-items:center; justify-content:center; padding:1rem;">
                        <img id="historyModalImg" src="" alt="" style="max-width:100%; max-height:500px; border-radius:12px; object-fit:contain;">
                    </div>
                    <div style="padding:1.5rem; overflow-y:auto; max-height:520px;">
                        <h6 class="fw-bold mb-3" style="color:var(--red);">📋 Strategi Promo</h6>
                        <div id="historyModalStrategy" style="font-size:.875rem; line-height:1.7; white-space:pre-wrap; color:var(--text);"></div>
                        <div class="d-flex gap-2 mt-4">
                            <button class="btn btn-sm btn-danger" onclick="publishFromHistory()" id="historyPublishBtn" style="border-radius:8px;">
                                <i class="bi bi-send me-1"></i> Publish Promo Ini
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:8px;">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
@media(max-width:767px) {
    .result-grid-inner { grid-template-columns: 1fr !important; }
}
</style>
<script>
// ── State ────────────────────────────────────────────────────────────────────
let currentPromotionId = null;
let historyModalPromoId = null;
let lastUsedVariation = null;

// ── Quick Discount Helper ────────────────────────────────────────────────────
function setDiscountQuick(val) {
    const input = document.getElementById('customDiscountInput');
    if (!input) return;
    input.value = (val === 'auto') ? 'auto' : val;
    document.querySelectorAll('#discountQuickPills .discount-pill').forEach(btn => {
        btn.classList.remove('active');
    });
    if (window.event && window.event.target) {
        window.event.target.classList.add('active');
    }
}

// ── Checkbox logic ───────────────────────────────────────────────────────────
document.querySelectorAll('.product-check-item').forEach(item => {
    item.addEventListener('click', () => {
        const cb = item.querySelector('input[type=checkbox]');
        cb.checked = !cb.checked;
        item.classList.toggle('selected', cb.checked);
    });
});

function toggleSelectAll() {
    const items = document.querySelectorAll('.product-check-item');
    const allSelected = Array.from(items).every(i => i.classList.contains('selected'));
    const btn = document.getElementById('selectAllBtn');
    items.forEach(item => {
        const cb = item.querySelector('input[type=checkbox]');
        if (allSelected) {
            cb.checked = false;
            item.classList.remove('selected');
            btn.textContent = 'Pilih Semua';
        } else {
            cb.checked = true;
            item.classList.add('selected');
            btn.textContent = 'Hapus Semua';
        }
    });
}

function selectRatio(val) {
    document.querySelectorAll('.ratio-btn').forEach(btn => btn.classList.remove('active'));
    if (val === 'story') {
        document.getElementById('ratioStoryLabel').classList.add('active');
        const radio = document.querySelector('input[name=aspect_ratio][value=story]');
        if (radio) radio.checked = true;
    } else {
        document.getElementById('ratioFeedsLabel').classList.add('active');
        const radio = document.querySelector('input[name=aspect_ratio][value=feeds]');
        if (radio) radio.checked = true;
    }
}

// ── Step animation ───────────────────────────────────────────────────────────
let stepTimer = null;
function animateSteps() {
    const steps = ['step1','step2','step3','step4'];
    let i = 0;
    document.getElementById('step1').classList.add('active');
    stepTimer = setInterval(() => {
        if (i < steps.length - 1) {
            document.getElementById(steps[i]).classList.remove('active');
            i++;
            document.getElementById(steps[i]).classList.add('active');
        }
    }, 4000);
}
function resetSteps() {
    clearInterval(stepTimer);
    ['step1','step2','step3','step4'].forEach((s,i) => {
        document.getElementById(s).classList.toggle('active', i === 0);
    });
}

// ── Overlay ──────────────────────────────────────────────────────────────────
function showOverlay()  { document.getElementById('aiOverlay').classList.add('active'); animateSteps(); }
function hideOverlay()  { document.getElementById('aiOverlay').classList.remove('active'); resetSteps(); }

// ── Generate ─────────────────────────────────────────────────────────────────
async function doGenerate() {
    const btn = document.getElementById('btnGenerate');
    const selected = Array.from(document.querySelectorAll('.product-check-item.selected input[type=checkbox]'))
                         .map(cb => cb.value);

    if (selected.length === 0) {
        showFlash('Pilih minimal 1 produk untuk di-generate!', 'error');
        return;
    }

    const visualStrategy = document.getElementById('visualStrategySelect')?.value || 'random';
    const discountLabel = document.getElementById('customDiscountInput')?.value.trim() || '';

    btn.disabled = true;
    btn.classList.add('loading');
    showOverlay();

    try {
        const res = await fetch("{{ route('admin.ai-assistant.generate') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                selected_products: selected,
                aspect_ratio: 'feeds',
                visual_strategy: visualStrategy,
                last_variation: lastUsedVariation,
                discount_label: discountLabel,
            }),
        });

        const data = await res.json();

        if (res.ok && data.status === 'success') {
            if (data.visual_variation_key) {
                lastUsedVariation = data.visual_variation_key;
            }
            renderResult(data);
            addToHistoryGrid(data);
            showFlash('✅ Poster berhasil digenerate & tersimpan di history!', 'success');
        } else {
            showFlash('❌ ' + (data.message || 'Terjadi kesalahan.'), 'error');
        }
    } catch (err) {
        console.error(err);
        showFlash('❌ Koneksi gagal atau timeout. Coba lagi.', 'error');
    } finally {
        btn.disabled = false;
        btn.classList.remove('loading');
        hideOverlay();
    }
}

// ── Render result ────────────────────────────────────────────────────
function renderResult(data) {
    currentPromotionId = data.promotion_id;

    // Show result, hide empty state
    document.getElementById('emptyState').style.display = 'none';
    document.getElementById('resultContent').style.display = 'block';

    // Generation time badge
    document.getElementById('generationBadge').style.display = 'inline-flex';
    document.getElementById('generationTime').textContent = data.created_at;

    // Poster aspect ratio update
    const posterWrapper = document.getElementById('posterWrapper');
    if (posterWrapper) {
        posterWrapper.style.aspectRatio = (data.aspect_ratio === 'story') ? '9/16' : '4/5';
    }

    // Poster
    const img = document.getElementById('posterImg');
    const placeholder = document.getElementById('posterPlaceholder');
    placeholder.classList.remove('hidden');
    img.style.opacity = 0;
    if (data.banner_url) {
        img.src = data.banner_url;
        document.getElementById('btnDownloadPoster').href = data.banner_url;
    }

    // Layout & variation badges
    document.getElementById('layoutBadge').textContent = data.strategy_type ?? '';

    const varBadge = document.getElementById('variationBadge');
    if (varBadge) {
        if (data.visual_variation_short) {
            varBadge.textContent = '🎨 ' + data.visual_variation_short;
            varBadge.style.display = 'inline-block';
        } else {
            varBadge.style.display = 'none';
        }
    }

    const discBadge = document.getElementById('discountBadge');
    if (discBadge) {
        if (data.discount_label) {
            discBadge.textContent = '🏷️ ' + data.discount_label;
            discBadge.style.display = 'inline-block';
        } else {
            discBadge.style.display = 'none';
        }
    }

    // Judul
    document.getElementById('judulPromoDisplay').textContent = data.judul_promo ?? '';

    // Strategy text — parse & render
    renderStrategy(data.strategy_text ?? '');

    // Products used
    const list = document.getElementById('productsUsedList');
    list.innerHTML = (data.selected_products ?? []).map(p =>
        `<span class="badge bg-danger-subtle text-danger border border-danger-subtle" style="font-size:.7rem;">${p.name}</span>`
    ).join('');

    // Sync publish
    document.getElementById('btnPublish').onclick = publishPromo;
}

function renderStrategy(text) {
    const box = document.getElementById('strategyBox');
    const labels = ['HEADLINE','JUDUL','STRATEGI','COPYWRITING','DISKON','CTA'];
    const emojis = { 'HEADLINE':'🎯','JUDUL':'🏷️','STRATEGI':'📌','COPYWRITING':'✍️','DISKON':'🔥','CTA':'🚀' };
    let html = '';
    const lines = text.split('\n').filter(l => l.trim());

    if (lines.length === 0) { box.innerHTML = `<p class="mb-0" style="font-size:.85rem;">${text}</p>`; return; }

    lines.forEach(line => {
        let matched = false;
        labels.forEach(label => {
            if (line.toUpperCase().startsWith(label + ':')) {
                const content = line.slice(label.length + 1).trim();
                html += `<div class="strategy-line">
                    <span class="strategy-label">${emojis[label] || ''} ${label}</span>
                    <span class="strategy-content">${content}</span>
                </div>`;
                matched = true;
            }
        });
        if (!matched && line.trim()) {
            html += `<div class="strategy-line"><span class="strategy-content" style="color:var(--muted);">${line}</span></div>`;
        }
    });
    box.innerHTML = html;
}

// ── Add to history grid ───────────────────────────────────────────────────────
function addToHistoryGrid(data) {
    const grid = document.getElementById('historyGrid');
    const section = document.getElementById('historySection');

    // Remove empty state if present
    const emptyDiv = section.querySelector('.empty-state');
    if (emptyDiv) emptyDiv.remove();

    // Create grid if not exist
    let gridEl = document.getElementById('historyGrid');
    if (!gridEl) {
        gridEl = document.createElement('div');
        gridEl.className = 'history-grid';
        gridEl.id = 'historyGrid';
        section.querySelector('[style*="padding"]').appendChild(gridEl);
    }

    const stratText = (data.strategy_text ?? '').replace(/`/g, '\\`').replace(/\\/g, '\\\\');
    const card = document.createElement('div');
    card.className = 'history-card';
    card.innerHTML = `
        ${data.banner_url
            ? `<img src="${data.banner_url}" alt="${data.judul_promo}" class="history-card-img" onerror="this.style.display='none'">`
            : `<div style="width:100%;aspect-ratio:1/1;background:linear-gradient(135deg,#1a0505,#3d0c0c);display:flex;align-items:center;justify-content:center;"><i class="bi bi-image text-white opacity-25 fs-3"></i></div>`
        }
        <div class="history-card-body">
            <div class="history-card-title">${data.judul_promo ?? '—'}</div>
            <div class="history-card-meta">${data.created_at}</div>
            <span class="history-card-badge bg-secondary-subtle text-secondary"><i class="bi bi-clock"></i> Draft</span>
        </div>
    `;
    card.onclick = () => viewHistory(data.promotion_id, data.judul_promo, data.strategy_text, data.banner_url);
    gridEl.prepend(card);

    // Update count
    const countBadge = document.getElementById('historyCount');
    if (countBadge) {
        const current = parseInt(countBadge.textContent) || 0;
        countBadge.textContent = (current + 1) + ' entri';
    }
}

// ── View history modal ────────────────────────────────────────────────────────
function viewHistory(id, title, strategy, bannerUrl) {
    historyModalPromoId = id;
    document.getElementById('historyModalTitle').textContent = title;
    document.getElementById('historyModalStrategy').textContent = strategy ?? '—';

    const img = document.getElementById('historyModalImg');
    if (bannerUrl) {
        img.src = bannerUrl;
        img.style.display = 'block';
    } else {
        img.style.display = 'none';
    }

    new bootstrap.Modal(document.getElementById('historyModal')).show();
}

// ── Publish ───────────────────────────────────────────────────────────────────
function publishPromo() {
    if (!currentPromotionId) return;
    doPublish(currentPromotionId, document.getElementById('btnPublish'));
}

function publishFromHistory() {
    if (!historyModalPromoId) return;
    doPublish(historyModalPromoId, document.getElementById('historyPublishBtn'));
}

async function doPublish(promoId, btn) {
    if (!confirm('Publish promo ini ke website publik?')) return;
    const origText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Memproses...';
    try {
        const res = await fetch("{{ route('admin.ai-assistant.publish') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ promotion_id: promoId }),
        });
        const data = await res.json();
        if (res.ok && data.status === 'success') {
            showFlash('✅ Promo berhasil dipublikasikan!', 'success');
            btn.innerHTML = '<i class="bi bi-check2-circle me-1"></i> Sudah Dipublish';
        } else {
            showFlash('❌ Gagal publish.', 'error');
            btn.innerHTML = origText;
            btn.disabled = false;
        }
    } catch (e) {
        showFlash('❌ Gagal koneksi.', 'error');
        btn.innerHTML = origText;
        btn.disabled = false;
    }
}

// ── Copy strategy ─────────────────────────────────────────────────────────────
function copyStrategy() {
    const box = document.getElementById('strategyBox');
    if (!box) return;
    navigator.clipboard.writeText(box.innerText).then(() => {
        const label = document.getElementById('copyLabel');
        label.textContent = 'Tersalin!';
        setTimeout(() => label.textContent = 'Salin', 2000);
    });
}

// ── Flash message ─────────────────────────────────────────────────────────────
function showFlash(msg, type = 'success') {
    const el = document.createElement('div');
    el.className = `flash-alert flash-${type}`;
    el.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'x-circle-fill'}"></i> ${msg}`;
    document.body.appendChild(el);
    setTimeout(() => el.remove(), 4000);
}

// ── Auto-dismiss session flash ────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const f = document.getElementById('flashMsg');
    if (f) setTimeout(() => f.remove(), 4000);
});
</script>
@endsection