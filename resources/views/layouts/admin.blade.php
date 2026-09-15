<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') – Admin Warung Mbah Darmo</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --md-primary:      #800000;
            --md-primary-dark: #6B1D1D;
            --md-bg:           #FDFBF7;
            --md-bg-warm:      #F8F4EE;
            --md-gold:         #A18A43;
            --md-gold-light:   #C8AA68;
            --md-charcoal:     #2C2215;
            --md-text:         #3D2B1F;
            --md-text-muted:   #7A6555;
            --md-border:       #E8DDD0;
            --sidebar-width:   260px;
            --font-heading:    'Playfair Display', serif;
            --font-body:       'Inter', sans-serif;
            --transition:      all 0.3s ease;
        }
        * { box-sizing: border-box; }
        body { font-family: var(--font-body); background: #F2EDE6; color: var(--md-text); }
        h1,h2,h3,h4,h5 { font-family: var(--font-heading); }

        /* ── SIDEBAR ── */
        .admin-sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--md-charcoal);
            position: fixed; top: 0; left: 0; z-index: 1050;
            overflow-y: auto;
            transition: var(--transition);
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-brand h5 {
            font-family: var(--font-heading);
            color: #fff; font-size: 1.1rem; margin: 0;
        }
        .sidebar-brand span { color: var(--md-gold-light); }
        .sidebar-brand small { color: rgba(255,255,255,0.45); font-size: 0.7rem; font-family: var(--font-body); }
        .sidebar-nav { padding: 1rem 0; }
        .sidebar-section-label {
            font-size: 0.65rem; font-weight: 600; letter-spacing: 2px;
            text-transform: uppercase; color: rgba(255,255,255,0.3);
            padding: 0.75rem 1.25rem 0.25rem;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 1.25rem;
            color: rgba(255,255,255,0.65) !important;
            text-decoration: none; font-size: 0.875rem; font-weight: 400;
            border-radius: 0; transition: var(--transition);
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.9) !important;
            border-left-color: var(--md-gold);
        }
        .sidebar-link.active {
            background: rgba(128,0,0,0.3);
            color: #fff !important;
            border-left-color: var(--md-gold);
            font-weight: 500;
        }
        .sidebar-link i { font-size: 1rem; width: 20px; }

        /* ── MAIN CONTENT ── */
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid var(--md-border);
            padding: 1rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .admin-topbar .page-title { font-family: var(--font-heading); font-size: 1.35rem; color: var(--md-charcoal); margin: 0; }
        .admin-content { padding: 2rem 1.5rem; }

        /* ── STAT CARDS ── */
        .stat-card {
            background: #fff;
            border: 1px solid var(--md-border);
            border-radius: 12px;
            padding: 1.5rem;
            transition: var(--transition);
            position: relative; overflow: hidden;
        }
        .stat-card::before {
            content: ''; position: absolute; top: 0; left: 0;
            width: 4px; height: 100%;
            background: linear-gradient(to bottom, var(--md-primary), var(--md-gold));
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
        .stat-icon {
            width: 48px; height: 48px;
            background: rgba(128,0,0,0.08);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: var(--md-primary);
        }

        /* ── ALERTS ── */
        .alert-success-md { background: rgba(25,135,84,0.08); border: 1px solid rgba(25,135,84,0.2); color: #0f6d43; border-radius: 10px; }
        .alert-error-md   { background: rgba(128,0,0,0.06); border: 1px solid rgba(128,0,0,0.2); color: var(--md-primary-dark); border-radius: 10px; }

        /* ── TABLES ── */
        .table-md th { font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase; color: var(--md-text-muted); font-weight: 600; border-bottom: 2px solid var(--md-border); }
        .table-md td { vertical-align: middle; font-size: 0.875rem; border-color: var(--md-border); }
        .table-md tbody tr:hover { background: var(--md-bg-warm); }

        /* ── FORM CARDS ── */
        .form-card { background: #fff; border: 1px solid var(--md-border); border-radius: 14px; padding: 2rem; }
        .form-label-md { font-size: 0.8rem; font-weight: 600; color: var(--md-text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.4rem; }
        .form-control-md {
            border: 1px solid var(--md-border); border-radius: 8px;
            padding: 0.65rem 0.9rem; font-size: 0.875rem; color: var(--md-text);
            background: var(--md-bg); transition: var(--transition);
        }
        .form-control-md:focus { border-color: var(--md-primary); box-shadow: 0 0 0 3px rgba(128,0,0,0.1); background: #fff; }

        /* ── BADGES ── */
        .badge-active   { background: rgba(25,135,84,0.1); color: #0f6d43; border-radius: 50px; font-size: 0.7rem; padding: 0.3em 0.7em; }
        .badge-inactive { background: rgba(108,117,125,0.1); color: #495057; border-radius: 50px; font-size: 0.7rem; padding: 0.3em 0.7em; }
        .badge-ai       { background: rgba(128,0,0,0.08); color: var(--md-primary); border-radius: 50px; font-size: 0.7rem; padding: 0.3em 0.7em; }

        @yield('extra-styles')
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h5>Warung <span>Mbah Darmo</span></h5>
        <small>ADMIN PANEL</small>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>

        <div class="sidebar-section-label">Pengelolaan</div>
        <a href="{{ route('admin.menus.index') }}" class="sidebar-link {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
            <i class="bi bi-journal-bookmark"></i> Data Menu
        </a>
        <a href="{{ route('admin.franchise.index') }}" class="sidebar-link {{ request()->routeIs('admin.franchise.*') ? 'active' : '' }}">
            <i class="bi bi-shop"></i> Paket Franchise
        </a>
        <a href="{{ route('admin.promotions.index') }}" class="sidebar-link {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i> Promo & Banner
        </a>

        <div class="sidebar-section-label">Penjualan</div>
        <a href="{{ route('admin.sales.index') }}" class="sidebar-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i> Laporan Penjualan
        </a>

        <div class="sidebar-section-label">AI Feature</div>
        <a href="{{ route('admin.ai-assistant.index') }}" class="sidebar-link {{ request()->routeIs('admin.ai-assistant.*') ? 'active' : '' }}">
            <i class="bi bi-stars"></i> AI Promo Assistant
        </a>

        <div class="sidebar-section-label">Akun</div>
        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> Lihat Public Site
        </a>
        <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start" style="cursor:pointer;">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </nav>
</aside>

<!-- MAIN -->
<div class="admin-main">
    <!-- TOPBAR -->
    <div class="admin-topbar">
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
        <div class="d-flex align-items-center gap-3">
            <span class="badge" style="background:rgba(128,0,0,0.1); color:var(--md-primary); border-radius:50px; padding:0.4rem 0.9rem; font-size:0.8rem;">
                <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
            </span>
        </div>
    </div>

    <!-- FLASH MESSAGES -->
    @if(session('success') || session('error'))
    <div class="admin-content pb-0 pt-3">
        @if(session('success'))
            <div class="alert alert-success-md d-flex align-items-center gap-2 mb-0">
                <i class="bi bi-check-circle-fill fs-5"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error-md d-flex align-items-center gap-2 mb-0">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i> {{ session('error') }}
            </div>
        @endif
    </div>
    @endif

    <!-- CONTENT -->
    <div class="admin-content">
        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
