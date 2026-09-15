@extends('layouts.admin')
@section('title','AI Promo Assistant')
@section('page-title','AI Promo Strategy Assistant')

@section('extra-styles')
<style>
:root {
    --ai-primary: #800000;
    --ai-primary-light: #991B1B;
    --ai-gold: #A18A43;
    --ai-gold-light: #F4EEDF;
    --ai-border: #E5DFD5;
    --ai-border-dark: #C8BCAC;
    --ai-bg-card: #FFFFFF;
    --ai-bg-subtle: #FAF7F2;
    --ai-bg-chat-user: #FFF1F0;
    --ai-border-chat-user: #F8D0CD;
    --ai-bg-chat-ai: #FFFFFF;
    --ai-border-chat-ai: #E5DFD5;
    --ai-text-main: #2C2215;
    --ai-text-muted: #6C5B4E;
}

/* ========================================================= */
/* TAMPILAN AWAL (STATE: DASHBOARD AWAL SEBELUM GENERATE)   */
/* ========================================================= */
.initial-hero-card {
    background: linear-gradient(135deg, #FFFFFF 0%, #FAF6EE 100%);
    border: 1.5px solid var(--ai-border);
    border-radius: 20px;
    padding: 2.25rem;
    box-shadow: 0 10px 30px rgba(44, 34, 21, 0.05);
    position: relative;
    overflow: hidden;
    margin-bottom: 1.75rem;
}

.initial-hero-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    background: linear-gradient(to bottom, var(--ai-primary), var(--ai-gold));
}

.btn-hero-generate {
    background: linear-gradient(135deg, #800000 0%, #A52A2A 100%);
    color: #FFFFFF !important;
    border: 1px solid #6B1D1D;
    border-radius: 14px;
    font-weight: 700;
    font-size: 1.05rem;
    padding: 0.9rem 2.25rem;
    display: inline-flex;
    align-items: center;
    gap: 0.65rem;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 6px 20px rgba(128, 0, 0, 0.25);
    cursor: pointer;
}

.btn-hero-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(128, 0, 0, 0.35);
    background: linear-gradient(135deg, #6B1D1D 0%, #800000 100%);
}

.stat-box-card {
    background: #FFFFFF;
    border: 1.5px solid var(--ai-border);
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 16px rgba(44, 34, 21, 0.03);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.stat-box-card.top-selling {
    border-top: 4px solid #198754;
}

.stat-box-card.bottom-selling {
    border-top: 4px solid #DC3545;
}

.ranking-badge {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.75rem;
}

.custom-prompt-initial-box {
    background: #FFFFFF;
    border: 1.5px solid var(--ai-border-dark);
    border-radius: 12px;
    padding: 0.6rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    max-width: 700px;
    margin-top: 1.25rem;
}

.custom-prompt-initial-box:focus-within {
    border-color: var(--ai-primary);
    box-shadow: 0 0 0 4px rgba(128, 0, 0, 0.1);
}

.custom-prompt-initial-box input {
    border: none;
    background: transparent;
    width: 100%;
    outline: none;
    font-size: 0.9rem;
    color: var(--ai-text-main);
}

/* ========================================================= */
/* TAMPILAN KEDUA: WORKSPACE CHAT AKTIF SETELAH GENERATE    */
/* ========================================================= */
.ai-workspace-wrapper {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 1.25rem;
    height: calc(100vh - 175px);
    min-height: 600px;
}

@media (max-width: 992px) {
    .ai-workspace-wrapper {
        grid-template-columns: 1fr;
        height: auto;
    }
}

.ai-left-panel {
    background: var(--ai-bg-card);
    border: 1.5px solid var(--ai-border);
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(44, 34, 21, 0.04);
    display: flex;
    flex-direction: column;
    padding: 1.15rem;
    overflow: hidden;
}

.ai-workspace-card {
    background: var(--ai-bg-card);
    border: 1.5px solid var(--ai-border);
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(44, 34, 21, 0.04);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
}

.ai-workspace-header {
    padding: 1rem 1.5rem;
    background: #FFFFFF;
    border-bottom: 1.5px solid var(--ai-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chat-messages-area {
    flex: 1;
    min-height: 0;
    padding: 1.5rem;
    background: var(--ai-bg-subtle);
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.chat-bubble-row {
    display: flex;
    gap: 0.85rem;
    max-width: 95%;
}

.chat-bubble-row.user-side {
    align-self: flex-end;
    flex-direction: row-reverse;
}

.chat-bubble-row.ai-side {
    align-self: flex-start;
    width: 100%;
}

.avatar-badge {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.avatar-badge.ai {
    background: var(--ai-primary);
    color: #FFF;
    box-shadow: 0 2px 6px rgba(128,0,0,0.25);
}

.avatar-badge.user {
    background: var(--ai-gold);
    color: #FFF;
    box-shadow: 0 2px 6px rgba(161,138,67,0.25);
}

.bubble-content-card {
    padding: 1.25rem 1.5rem;
    border-radius: 14px;
    font-size: 0.9rem;
    line-height: 1.65;
    position: relative;
}

.bubble-content-card.user {
    background: var(--ai-bg-chat-user);
    border: 1.5px solid var(--ai-border-chat-user);
    color: #4A1A17;
    border-top-right-radius: 4px;
}

.bubble-content-card.ai {
    background: var(--ai-bg-chat-ai);
    border: 1.5px solid var(--ai-border-chat-ai);
    color: var(--ai-text-main);
    border-top-left-radius: 4px;
    box-shadow: 0 2px 10px rgba(44, 34, 21, 0.03);
    width: 100%;
}

/* Gambar AI Banner Visual Card */
.promo-visual-preview-box {
    background: #FAF6F0;
    border: 1.5px solid #EADBCA;
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 1.25rem;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
}

.promo-visual-preview-box img {
    width: 100%;
    max-height: 340px;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}

.promo-visual-preview-box:hover img {
    transform: scale(1.02);
}

/* Chat Input Bar (Bottom) */
.ai-prompt-bottom-bar {
    background: #FFFFFF;
    border-top: 1.5px solid var(--ai-border);
    padding: 0.9rem 1.25rem;
    flex-shrink: 0;
}

.quick-prompts-bar {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    overflow-x: auto;
    padding-bottom: 0.5rem;
    margin-bottom: 0.5rem;
}

.quick-prompt-chip {
    background: var(--ai-bg-subtle);
    border: 1px solid var(--ai-border);
    border-radius: 20px;
    padding: 0.25rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--ai-text-main);
    white-space: nowrap;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quick-prompt-chip:hover {
    background: #FFF0EE;
    border-color: #F8C3BF;
    color: var(--ai-primary);
}

.prompt-input-interactive-box {
    background: #FFFFFF;
    border: 2px solid var(--ai-border-dark);
    border-radius: 12px;
    padding: 0.45rem 0.6rem 0.45rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.25s ease;
}

.prompt-input-interactive-box:focus-within {
    border-color: var(--ai-primary);
    box-shadow: 0 0 0 4px rgba(128, 0, 0, 0.1);
}

.prompt-input-interactive-box input {
    border: none;
    background: transparent;
    width: 100%;
    outline: none;
    font-size: 0.9rem;
    color: var(--ai-text-main);
}

.btn-prompt-send {
    background: var(--ai-primary);
    color: #FFFFFF;
    border: none;
    padding: 0.55rem 1.2rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    cursor: pointer;
    white-space: nowrap;
}

.btn-prompt-send:hover {
    background: #6B1D1D;
}

/* Loading Overlay */
.ai-generating-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(6px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.ai-generating-overlay.active {
    display: flex;
}

.spinner-glow {
    width: 60px;
    height: 60px;
    border: 4px solid rgba(128, 0, 0, 0.15);
    border-top-color: var(--ai-primary);
    border-radius: 50%;
    animation: spinOverlay 1s linear infinite;
}

@keyframes spinOverlay {
    to { transform: rotate(360deg); }
}
</style>
@endsection

@section('content')

<!-- Loading Overlay Fullscreen -->
<div class="ai-generating-overlay" id="generatingOverlay">
    <div class="spinner-glow mb-3"></div>
    <h4 class="fw-bold mb-1" style="color: var(--ai-primary); font-family: var(--font-heading);">
        AI Sedang Bekerja...
    </h4>
    <p class="text-muted mb-0" style="font-size: 0.9rem;">
        Menganalisis 30 hari data transaksi, merancang narasi bundling promosi, dan me-render visual promo otomatis
    </p>
</div>

@if(!isset($aiText))
<!-- ========================================================================= -->
<!-- 1. TAMPILAN AWAL (SEBELUM GENERATE DITEKAN): DATA STATS & GENERATE HERO    -->
<!-- ========================================================================= -->

<!-- Hero Action Card -->
<div class="initial-hero-card">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 rounded-pill fw-semibold">
                    <i class="bi bi-stars me-1"></i> AI-Powered Promotion Engine
                </span>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                    <i class="bi bi-shield-check me-1"></i> Guardrail Warung Mbah Darmo Aktif
                </span>
            </div>
            <h2 class="fw-bold mb-2" style="color: var(--ai-text-main);">
                Generate Strategi & Visual Promosi Berbasis Data Riil
            </h2>
            <p class="text-muted mb-3" style="font-size: 0.95rem; max-width: 650px; line-height: 1.6;">
                Sistem akan secara cerdas membedah transaksi 30 hari terakhir dari database <code class="text-danger">sales_transactions</code>, mengombinasikan menu terlaris dengan produk kurang laku, merancang narasi copywriting promosi, serta men-generate desain visual promo siap tayang.
            </p>

            <form action="{{ route('admin.ai-assistant.generate') }}" method="POST" onsubmit="showGenerating()">
                @csrf
                <div class="custom-prompt-initial-box mb-3">
                    <i class="bi bi-pencil-square text-danger fs-5"></i>
                    <input 
                        type="text" 
                        name="custom_prompt" 
                        placeholder="Opsional: Sampaikan instruksi khusus (contoh: Buatkan diskon paket sarapan hemat Mie Batok & Es Teh)..."
                    >
                </div>

                <div class="d-flex flex-wrap align-items-center gap-3">
                    <button type="submit" class="btn btn-hero-generate">
                        <i class="bi bi-stars fs-5"></i>
                        <span>Generate Strategy Baru Sekarang</span>
                    </button>
                    <small class="text-muted">
                        <i class="bi bi-clock-history me-1"></i> Estimasi waktu proses: ~5-15 detik
                    </small>
                </div>
            </form>
        </div>

        <div class="col-lg-4 text-center d-none d-lg-block">
            <div class="p-3 bg-white rounded-4 border shadow-sm mx-auto" style="max-width: 280px; border-color: var(--ai-border) !important;">
                <div class="rounded-3 p-3 mb-2" style="background: var(--ai-bg-subtle);">
                    <i class="bi bi-magic fs-1 text-danger"></i>
                </div>
                <h6 class="fw-bold mb-1 text-dark">Otomasi Cerdas 1-Klik</h6>
                <small class="text-muted">Bundling menu + copywriting + banner visual Flux AI gratis.</small>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Data Penjualan (Top 5 vs Bottom 5) -->
<div class="row g-3 mb-4">
    <!-- Top 5 Produk Terlaris -->
    <div class="col-lg-6">
        <div class="stat-box-card top-selling">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-0 text-success">
                        <i class="bi bi-trophy-fill me-1"></i> TOP 5 Produk Terlaris
                    </h5>
                    <small class="text-muted">Paling diminati pelanggan 30 hari terakhir</small>
                </div>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">
                    Best Sellers
                </span>
            </div>

            <div class="d-flex flex-column gap-2 mt-auto">
                @forelse($top5 as $index => $item)
                    <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light border">
                        <div class="d-flex align-items-center gap-2">
                            <span class="ranking-badge bg-success text-white">{{ $index + 1 }}</span>
                            <span class="fw-semibold text-dark" style="font-size: 0.875rem;">{{ $item->name }}</span>
                        </div>
                        <span class="badge bg-white text-success border border-success fw-bold px-3 py-2" style="font-size: 0.8rem;">
                            {{ number_format($item->total_sold) }} Terjual
                        </span>
                    </div>
                @empty
                    <div class="text-muted text-center py-3">Belum ada data transaksi penjualan</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Bottom 5 Produk Kurang Laku -->
    <div class="col-lg-6">
        <div class="stat-box-card bottom-selling">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-0 text-danger">
                        <i class="bi bi-fire me-1"></i> BOTTOM 5 Produk Kurang Laku
                    </h5>
                    <small class="text-muted">Menu lambat terjual yang butuh dorongan promosi</small>
                </div>
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill">
                    Target Bundling
                </span>
            </div>

            <div class="d-flex flex-column gap-2 mt-auto">
                @forelse($bottom5 as $index => $item)
                    <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light border">
                        <div class="d-flex align-items-center gap-2">
                            <span class="ranking-badge bg-danger text-white">{{ $index + 1 }}</span>
                            <span class="fw-semibold text-dark" style="font-size: 0.875rem;">{{ $item->name }}</span>
                        </div>
                        <span class="badge bg-white text-danger border border-danger fw-bold px-3 py-2" style="font-size: 0.8rem;">
                            {{ number_format($item->total_sold) }} Terjual
                        </span>
                    </div>
                @empty
                    <div class="text-muted text-center py-3">Belum ada data transaksi penjualan</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Riwayat Promo Tersimpan -->
<div class="card border-0 shadow-sm rounded-4 p-4" style="background: #FFFFFF; border: 1.5px solid var(--ai-border) !important;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-0" style="color: var(--ai-text-main);">
                <i class="bi bi-clock-history text-danger me-1"></i> Riwayat Strategi Promo Tersimpan
            </h5>
            <small class="text-muted">Daftar strategi AI yang telah diterbitkan sebelumnya</small>
        </div>
        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
            {{ count($lastPromos) }} Total Riwayat
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="font-size: 0.8rem;">JUDUL PROMO</th>
                    <th style="font-size: 0.8rem;">TIPE DISKON</th>
                    <th style="font-size: 0.8rem;">TANGGAL DIBUAT</th>
                    <th style="font-size: 0.8rem;">STATUS</th>
                    <th style="font-size: 0.8rem;" class="text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lastPromos as $p)
                    <tr>
                        <td class="fw-bold text-dark">{{ $p->title }}</td>
                        <td>
                            <span class="badge bg-secondary-subtle text-secondary border">
                                {{ ucfirst($p->discount_type ?? 'bundling') }}
                            </span>
                        </td>
                        <td class="text-muted" style="font-size: 0.85rem;">{{ $p->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            @if($p->is_active)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Aktif</span>
                            @else
                                <span class="badge bg-light text-muted border">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-dark" onclick="openPromoDetail(`{{ addslashes($p->title) }}`, `{{ addslashes($p->ai_strategy_text) }}`)">
                                <i class="bi bi-eye me-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Belum ada riwayat strategi yang diterbitkan. Klik tombol "Generate Strategy Baru" di atas untuk memulai!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@else

<!-- ========================================================================= -->
<!-- 2. TAMPILAN KEDUA (SETELAH GENERATE DITEKAN): WORKSPACE & CHAT AKTIF     -->
<!-- ========================================================================= -->
<div class="ai-workspace-wrapper">

    <!-- PANEL KIRI: DATA PENJUALAN & RIWAYAT -->
    <div class="ai-left-panel">
        
        <div class="mb-3">
            <a href="{{ route('admin.ai-assistant.index') }}" class="btn btn-outline-secondary btn-sm w-100 mb-2 fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Menu Awal
            </a>

            <form action="{{ route('admin.ai-assistant.generate') }}" method="POST" onsubmit="showGenerating()">
                @csrf
                <button type="submit" class="btn btn-hero-generate w-100 py-2 justify-content-center" style="font-size: 0.85rem; border-radius: 10px;">
                    <i class="bi bi-stars me-1"></i> Generate Ulang
                </button>
            </form>
        </div>

        <!-- Mini Stat Bottom 5 -->
        <div class="p-2 mb-3 rounded" style="background: #FFF5F5; border: 1.5px solid #FCD2CE;">
            <div class="fw-bold text-danger mb-1" style="font-size: 0.75rem;">
                🔥 Target Promo (Bottom 5)
            </div>
            @foreach($bottom5->take(4) as $item)
                <div class="d-flex justify-content-between align-items-center mb-1 bg-white p-1 rounded border border-danger-subtle" style="font-size: 0.725rem;">
                    <span class="text-truncate" style="max-width: 140px;">{{ $item->name }}</span>
                    <span class="badge bg-danger text-white">{{ number_format($item->total_sold) }}</span>
                </div>
            @endforeach
        </div>

        <!-- Riwayat Promo Scroll -->
        <div class="d-flex flex-column flex-grow-1 overflow-hidden">
            <div class="fw-bold text-muted mb-2" style="font-size: 0.75rem; text-transform: uppercase;">
                <i class="bi bi-clock-history me-1"></i> Riwayat Strategi
            </div>
            <div class="d-flex flex-column gap-2 overflow-y-auto pe-1" style="flex: 1;">
                @forelse($lastPromos as $p)
                    <div class="p-2 bg-white rounded border" style="cursor: pointer;" onclick="openPromoDetail(`{{ addslashes($p->title) }}`, `{{ addslashes($p->ai_strategy_text) }}`)">
                        <div class="fw-semibold text-truncate text-dark" style="font-size: 0.8rem;">{{ $p->title }}</div>
                        <small class="text-muted" style="font-size: 0.7rem;">{{ $p->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <small class="text-muted text-center py-2">Belum ada riwayat.</small>
                @endforelse
            </div>
        </div>

    </div>

    <!-- PANEL KANAN: WORKSPACE & CHAT AREA -->
    <div class="ai-workspace-card">
        
        <!-- Header -->
        <div class="ai-workspace-header">
            <div>
                <h5 class="mb-0 fw-bold" style="color: var(--ai-text-main); font-size: 1.1rem;">
                    <i class="bi bi-stars text-danger me-1"></i> AI Promo Strategy & Consultation Workspace
                </h5>
                <small class="text-muted" style="font-size: 0.75rem;">
                    Konsultasi strategi, bundling menu, copywriting, & visual promosi Warung Mbah Darmo
                </small>
            </div>
            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-semibold" style="font-size: 0.75rem;">
                <i class="bi bi-check-circle-fill me-1"></i> AI Ready & Guarded
            </span>
        </div>

        <!-- Messages Area -->
        <div class="chat-messages-area" id="chatMessages">
            
            <!-- User Query Bubble -->
            <div class="chat-bubble-row user-side">
                <div class="avatar-badge user">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="bubble-content-card user">
                    <strong>Instruksi / Permintaan Analisis:</strong><br>
                    {{ $userQueryText ?? 'Analisis data transaksi terbaru dan buatkan opsi strategi bundling promo otomatis.' }}
                </div>
            </div>

            <!-- AI Output Bubble with Pollinations.ai Image & Strategy -->
            <div class="chat-bubble-row ai-side">
                <div class="avatar-badge ai">
                    <i class="bi bi-stars"></i>
                </div>
                <div class="bubble-content-card ai">
                    
                    <!-- Visual Rekomendasi Banner Promo (Flux AI) -->
                    @if(isset($promoImageUrl))
                    <div class="promo-visual-preview-box">
                        <div class="p-2 bg-white d-flex justify-content-between align-items-center border-bottom">
                            <span class="badge bg-danger text-white" style="font-size: 0.75rem;">
                                <i class="bi bi-image-fill me-1"></i> AI Generated Promo Visual (Flux Engine)
                            </span>
                            <a href="{{ $promoImageUrl }}" target="_blank" class="btn btn-sm btn-light border py-0 px-2" style="font-size: 0.75rem;">
                                <i class="bi bi-arrows-fullscreen me-1"></i> Buka Ukuran Penuh
                            </a>
                        </div>
                        <img src="{{ $promoImageUrl }}" alt="AI Promo Visual Warung Mbah Darmo" loading="lazy" onerror="this.onerror=null; this.src='https://picsum.photos/800/600?food';">
                        <div class="p-2 bg-white border-top">
                            <small class="text-muted d-block" style="font-size: 0.75rem;">
                                💡 Visual AI di-generate otomatis sesuai kombinasi menu terlaris & promo Warung Mbah Darmo.
                            </small>
                        </div>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                            <i class="bi bi-file-text-fill me-1"></i> Rekomendasi Strategi Promosi
                        </span>
                        <small class="text-muted">{{ date('d M Y, H:i') }}</small>
                    </div>

                    <!-- Teks Strategi dari Gemini -->
                    <div id="aiFormattedResult" style="white-space: pre-wrap; font-size: 0.9rem; line-height: 1.65;">{{ $aiText }}</div>

                    <!-- Actions -->
                    <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
                        <button type="button" class="btn btn-sm btn-outline-dark fw-semibold" onclick="copyAiText()">
                            <i class="bi bi-clipboard me-1"></i> <span id="copyBtnText">Salin Teks</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#publishModal" style="background: var(--ai-primary);">
                            <i class="bi bi-megaphone-fill me-1"></i> Terbitkan Sebagai Promo Aktif
                        </button>
                    </div>

                </div>
            </div>

        </div>

        <!-- Chat Input Bar (Interactive Chat Form) -->
        <div class="ai-prompt-bottom-bar">
            
            <!-- Quick Chips -->
            <div class="quick-prompts-bar">
                <span class="text-muted fw-semibold me-1" style="font-size: 0.75rem;">
                    <i class="bi bi-lightbulb-fill text-warning me-1"></i>Saran Revisi / Tanya:
                </span>
                <button type="button" class="quick-prompt-chip" onclick="fillPrompt('Fokuskan bundling untuk promo jam makan siang kantor dengan diskon 15%')">
                    🍱 Promo Makan Siang Kantor
                </button>
                <button type="button" class="quick-prompt-chip" onclick="fillPrompt('Buatkan narasi promo khusus postingan Instagram & WhatsApp Story yang singkat dan menggugah selera')">
                    📱 Copywriting IG & WA Story
                </button>
                <button type="button" class="quick-prompt-chip" onclick="fillPrompt('Bagaimana cara menghitung margin profit dari bundling Mie Gepeng dan Wedang Uwuh di atas?')">
                    📊 Konsultasi Margin Profit
                </button>
                <button type="button" class="quick-prompt-chip" onclick="fillPrompt('Buatkan promo bundling khusus akhir pekan (Sabtu & Minggu)')">
                    🔥 Promo Weekend Warung
                </button>
            </div>

            <!-- Interactive Form -->
            <form action="{{ route('admin.ai-assistant.generate') }}" method="POST" onsubmit="showGenerating()" class="m-0">
                @csrf
                <div class="prompt-input-interactive-box" id="promptBoxContainer">
                    <i class="bi bi-chat-dots-fill text-danger fs-5" style="flex-shrink: 0;"></i>
                    <input 
                        type="text" 
                        id="customPromptInput"
                        name="custom_prompt" 
                        placeholder="Tanyakan atau instruksikan revisi seputar promosi & menu Warung Mbah Darmo di sini..."
                        autocomplete="off"
                        required
                    >
                    <button type="submit" class="btn-prompt-send">
                        <i class="bi bi-send-fill"></i>
                        <span>Kirim Pesan</span>
                    </button>
                </div>
            </form>

            <div class="d-flex justify-content-between align-items-center mt-2 px-1">
                <small class="text-muted" style="font-size: 0.725rem;">
                    🛡️ <strong>Guardrail Aktif:</strong> AI hanya melayani konsultasi menu, penjualan, resep, dan strategi bisnis Warung Mbah Darmo.
                </small>
                <small class="text-muted" style="font-size: 0.725rem;">
                    Model: <strong>Gemini Flash</strong>
                </small>
            </div>

        </div>

    </div>

</div>

<!-- Modal Publish Promo -->
<div class="modal fade" id="publishModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 18px; border: 1.5px solid var(--ai-border);">
      <div class="modal-header border-bottom">
        <h5 class="modal-title fw-bold" style="color: var(--ai-text-main);">
            <i class="bi bi-megaphone-fill text-danger me-2"></i>Terbitkan Sebagai Promo Aktif
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.ai-assistant.publish') }}" method="POST">
          @csrf
          <div class="modal-body p-4">
            <input type="hidden" name="ai_strategy_text" value="{{ $aiText }}">
            <input type="hidden" name="banner_image" value="{{ $promoImageUrl ?? '' }}">
            
            <div class="alert alert-light border mb-3 p-2 d-flex align-items-center gap-2" style="font-size: 0.8rem;">
                <i class="bi bi-info-circle-fill text-primary fs-5"></i>
                <span>Promo ini akan langsung aktif dan ditampilkan ke pelanggan di website publik Warung Mbah Darmo.</span>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold" style="font-size:0.85rem;">Judul Promo *</label>
                <input type="text" name="title" class="form-control" required placeholder="cth: 🔥 Paket Bundling Berkah Mbah Darmo" value="Promo Spesial Mbah Darmo">
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold" style="font-size:0.85rem;">Tipe Diskon</label>
                    <select name="discount_type" class="form-select">
                        <option value="bundling" selected>Paket Bundling</option>
                        <option value="percentage">Persentase (%)</option>
                        <option value="fixed">Potongan Tetap (Rp)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold" style="font-size:0.85rem;">Berlaku Hingga</label>
                    <input type="date" name="valid_until" class="form-control" value="{{ date('Y-m-d', strtotime('+30 days')) }}">
                </div>
            </div>
          </div>
          <div class="modal-footer border-top">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn text-white px-4 fw-semibold" style="background: var(--ai-primary); border-radius: 8px;">
                <i class="bi bi-check2-circle me-1"></i> Terbitkan Sekarang
            </button>
          </div>
      </form>
    </div>
  </div>
</div>
@endif

<!-- Modal Detail Riwayat -->
<div class="modal fade" id="historyDetailModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 18px; border: 1.5px solid var(--ai-border);">
      <div class="modal-header border-bottom">
        <h5 class="modal-title fw-bold" id="historyModalTitle">Detail Riwayat Strategi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div id="historyModalContent" style="white-space: pre-wrap; font-size: 0.9rem; line-height: 1.6;"></div>
      </div>
      <div class="modal-footer border-top">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
function showGenerating() {
    document.getElementById('generatingOverlay').classList.add('active');
}

function fillPrompt(text) {
    const input = document.getElementById('customPromptInput');
    if (input) {
        input.value = text;
        input.focus();
    }
}

function copyAiText() {
    const el = document.getElementById('aiFormattedResult');
    if (!el) return;
    navigator.clipboard.writeText(el.innerText).then(() => {
        const btnText = document.getElementById('copyBtnText');
        btnText.innerText = 'Tersalin!';
        setTimeout(() => {
            btnText.innerText = 'Salin Teks';
        }, 2000);
    });
}

function openPromoDetail(title, text) {
    document.getElementById('historyModalTitle').innerText = title;
    document.getElementById('historyModalContent').innerText = text;
    const modal = new bootstrap.Modal(document.getElementById('historyDetailModal'));
    modal.show();
}

document.addEventListener('DOMContentLoaded', () => {
    const chatContainer = document.getElementById('chatMessages');
    if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
});
</script>
@endsection