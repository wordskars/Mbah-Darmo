<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') – Admin Warung Mbah Darmo</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;0,700;1,600&family=Playfair+Display:ital,wght@0,600;0,700;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            /* Warung Mbah Darmo Official Color System */
            --md-wood:         #2C1B13;  /* Deep Wood Brown */
            --md-wood-dark:    #1E120C;  /* Darker Wood */
            --md-wood-light:   #3D271D;  /* Lighter Wood Hover */
            --md-terracotta:   #A83226;  /* Terracotta Red Accent */
            --md-terracotta-h: #8F281E;  /* Terracotta Hover */
            --md-gold:         #D4AF37;  /* Muted Gold */
            --md-gold-light:   #F3E5AB;  /* Gold Light */
            --md-bg-cream:     #F7F4EF;  /* Warm Cream / Off-White */
            --md-bg-card:      #FFFFFF;  /* Pure White Container */
            --md-border:       #EAE5DD;  /* Subtle Thin Border */
            --md-border-dark:  #D8D0C5;  
            --md-text-dark:    #2C1B13;  /* Primary Text */
            --md-text-body:    #4A3B32;  /* Body Text */
            --md-text-muted:   #8C7A6B;  /* Muted Text */

            /* Badge Status Colors */
            --badge-sage-bg:   #EAF3EC;
            --badge-sage-text: #2B5332;
            --badge-sage-brd:  #CDE2D1;

            --badge-amber-bg:  #FEF3E2;
            --badge-amber-text:#92400E;
            --badge-amber-brd: #FCD39D;

            --badge-red-bg:    #FDF2F0;
            --badge-red-text:  #861D13;
            --badge-red-brd:   #FAC7C3;

            --badge-gold-bg:   #FDF9EC;
            --badge-gold-text: #8A6D1C;
            --badge-gold-brd:  #F2E4B8;

            /* Dimensions & Typography */
            --sidebar-width:   260px;
            --font-heading:    'Playfair Display', 'Cormorant Garamond', Georgia, serif;
            --font-body:       'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            --shadow-card:     0 4px 20px -2px rgba(44, 27, 19, 0.05), 0 2px 6px -1px rgba(44, 27, 19, 0.03);
            --shadow-card-hover: 0 10px 25px -4px rgba(44, 27, 19, 0.08), 0 4px 10px -2px rgba(44, 27, 19, 0.04);
            --transition-smooth: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; }
        body {
            font-family: var(--font-body);
            background-color: var(--md-bg-cream);
            color: var(--md-text-body);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            color: var(--md-text-dark);
            letter-spacing: -0.01em;
        }

        /* ── SIDEBAR ── */
        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--md-wood);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            transition: var(--transition-smooth);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 4px 0 24px rgba(26, 15, 10, 0.15);
        }

        .sidebar-brand {
            padding: 1.6rem 1.25rem 1.4rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: var(--md-wood-dark);
            text-align: center;
        }

        .sidebar-brand-img {
            max-height: 52px;
            width: auto;
            max-width: 85%;
            object-fit: contain;
            filter: drop-shadow(0 2px 6px rgba(0,0,0,0.4));
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        .sidebar-brand-sub {
            color: var(--md-gold);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            display: block;
            opacity: 0.9;
        }

        .sidebar-nav-wrap {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 0.75rem;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.15) transparent;
        }

        .sidebar-nav-wrap::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-nav-wrap::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
        }

        .sidebar-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(237, 229, 216, 0.45);
            padding: 0.75rem 0.75rem 0.35rem;
            margin-top: 0.25rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.85rem;
            color: #EDE5D8 !important;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
            transition: var(--transition-smooth);
            margin-bottom: 2px;
            position: relative;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            width: 22px;
            color: #C59438;
            transition: var(--transition-smooth);
            text-align: center;
        }

        .sidebar-link:hover {
            background: var(--md-wood-light);
            color: #FFFFFF !important;
            transform: translateX(2px);
        }

        .sidebar-link:hover i {
            color: var(--md-gold);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, var(--md-terracotta), #7C241B);
            color: #FFFFFF !important;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(168, 50, 38, 0.35);
        }

        .sidebar-link.active i {
            color: #FFFFFF;
        }

        .sidebar-footer {
            padding: 0.85rem 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: var(--md-wood-dark);
        }

        /* ── MAIN LAYOUT ── */
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--transition-smooth);
        }

        /* ── TOPBAR ── */
        .admin-topbar {
            background: var(--md-bg-card);
            border-bottom: 1px solid var(--md-border);
            padding: 0.9rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 4px rgba(44, 27, 19, 0.04);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .breadcrumb-admin {
            margin: 0;
            font-size: 0.8rem;
            color: var(--md-text-muted);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .breadcrumb-admin a {
            color: var(--md-text-muted);
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .breadcrumb-admin a:hover {
            color: var(--md-terracotta);
        }

        .admin-topbar .page-title {
            font-family: var(--font-heading);
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--md-text-dark);
            margin: 0;
            line-height: 1.2;
        }

        .admin-profile-pill {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            background: var(--md-bg-cream);
            border: 1px solid var(--md-border);
            padding: 0.4rem 0.85rem;
            border-radius: 50px;
            font-size: 0.825rem;
            font-weight: 600;
            color: var(--md-text-dark);
        }

        .admin-avatar {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, var(--md-terracotta), var(--md-wood));
            color: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .admin-content {
            padding: 2rem 1.75rem;
            flex: 1;
        }

        /* ── CARDS ── */
        .form-card, .stat-card {
            background: var(--md-bg-card);
            border: 1px solid var(--md-border);
            border-radius: 14px;
            padding: 1.75rem;
            box-shadow: var(--shadow-card);
            transition: var(--transition-smooth);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--md-terracotta), var(--md-gold));
            border-radius: 4px 0 0 4px;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-card-hover);
            border-color: #DDD4C7;
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            background: rgba(168, 50, 38, 0.08);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            color: var(--md-terracotta);
            flex-shrink: 0;
        }

        /* ── BUTTONS ── */
        .btn-md-primary {
            background-color: var(--md-terracotta);
            color: #FFFFFF !important;
            border: 1px solid var(--md-terracotta);
            border-radius: 8px;
            padding: 0.55rem 1.15rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-md-primary:hover {
            background-color: var(--md-terracotta-h);
            border-color: var(--md-terracotta-h);
            color: #FFFFFF !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(168, 50, 38, 0.25);
        }

        .btn-md-outline {
            background-color: transparent;
            color: var(--md-text-dark) !important;
            border: 1px solid var(--md-border-dark);
            border-radius: 8px;
            padding: 0.55rem 1.15rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-md-outline:hover {
            background-color: var(--md-bg-cream);
            border-color: var(--md-terracotta);
            color: var(--md-terracotta) !important;
        }

        .btn-action-icon {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            border: 1px solid transparent;
        }

        .btn-action-edit {
            background: var(--md-bg-cream);
            border-color: var(--md-border);
            color: var(--md-text-dark);
        }

        .btn-action-edit:hover {
            background: #EFE9DE;
            color: var(--md-terracotta);
            border-color: var(--md-border-dark);
        }

        .btn-action-delete {
            background: var(--badge-red-bg);
            border-color: var(--badge-red-brd);
            color: var(--badge-red-text);
        }

        .btn-action-delete:hover {
            background: #FCE0DC;
            color: #70130A;
        }

        /* ── TABLES ── */
        .table-md {
            width: 100%;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-md th {
            font-size: 0.72rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--md-text-muted);
            font-weight: 700;
            padding: 0.85rem 1rem;
            border-bottom: 2px solid var(--md-border);
            background: #FAF8F5;
            white-space: nowrap;
        }

        .table-md th:first-child {
            border-top-left-radius: 8px;
        }
        .table-md th:last-child {
            border-top-right-radius: 8px;
        }

        .table-md td {
            vertical-align: middle;
            font-size: 0.875rem;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--md-border);
            color: var(--md-text-body);
        }

        .table-md tbody tr {
            transition: var(--transition-smooth);
        }

        .table-md tbody tr:hover {
            background-color: #FAF8F5;
        }

        .table-md tbody tr:last-child td {
            border-bottom: none;
        }

        /* ── BADGES ── */
        .badge-active {
            background-color: var(--badge-sage-bg);
            color: var(--badge-sage-text);
            border: 1px solid var(--badge-sage-brd);
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.35em 0.8em;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .badge-inactive {
            background-color: var(--badge-red-bg);
            color: var(--badge-red-text);
            border: 1px solid var(--badge-red-brd);
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.35em 0.8em;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .badge-amber {
            background-color: var(--badge-amber-bg);
            color: var(--badge-amber-text);
            border: 1px solid var(--badge-amber-brd);
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.35em 0.8em;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .badge-ai {
            background-color: var(--badge-gold-bg);
            color: var(--badge-gold-text);
            border: 1px solid var(--badge-gold-brd);
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.35em 0.8em;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* ── FORMS ── */
        .form-label-md {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--md-text-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.45rem;
            display: block;
        }

        .form-control-md, .form-control {
            border: 1px solid var(--md-border);
            border-radius: 8px;
            padding: 0.65rem 0.95rem;
            font-size: 0.875rem;
            color: var(--md-text-dark);
            background-color: #FAF8F5;
            transition: var(--transition-smooth);
        }

        .form-control-md:focus, .form-control:focus, .form-select:focus {
            border-color: var(--md-terracotta);
            box-shadow: 0 0 0 3px rgba(168, 50, 38, 0.12);
            background-color: #FFFFFF;
            outline: none;
        }

        .form-check-input:checked {
            background-color: var(--md-terracotta);
            border-color: var(--md-terracotta);
        }

        /* ── ALERTS ── */
        .alert-success-md {
            background-color: var(--badge-sage-bg);
            border: 1px solid var(--badge-sage-brd);
            color: var(--badge-sage-text);
            border-radius: 10px;
            padding: 0.85rem 1.25rem;
            font-size: 0.875rem;
        }

        .alert-error-md {
            background-color: var(--badge-red-bg);
            border: 1px solid var(--badge-red-brd);
            color: var(--badge-red-text);
            border-radius: 10px;
            padding: 0.85rem 1.25rem;
            font-size: 0.875rem;
        }

        /* ── PAGINATION ── */
        .pagination .page-link {
            color: var(--md-text-dark);
            border-color: var(--md-border);
            padding: 0.45rem 0.85rem;
            font-size: 0.825rem;
            font-weight: 500;
            border-radius: 6px;
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--md-terracotta);
            border-color: var(--md-terracotta);
            color: #FFFFFF;
        }

        .pagination .page-link:hover {
            background-color: var(--md-bg-cream);
            color: var(--md-terracotta);
        }

        /* ── RESPONSIVENESS & MOBILE DRAWER ── */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(26, 15, 10, 0.5);
            backdrop-filter: blur(2px);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
        }

        .sidebar-backdrop.show {
            display: block;
            opacity: 1;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .admin-topbar {
                padding: 0.75rem 1rem;
            }
            .admin-content {
                padding: 1.25rem 1rem;
            }
        }
    </style>
    @yield('extra-styles')
</head>
<body>

<!-- MOBILE SIDEBAR BACKDROP -->
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<!-- SIDEBAR -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none d-block">
            <img src="{{ asset('images/logo-white.png') }}" alt="Logo Warung Mbah Darmo" class="sidebar-brand-img">
            <small class="sidebar-brand-sub">Panel Administrator</small>
        </a>
    </div>

    <div class="sidebar-nav-wrap">
        <nav class="sidebar-nav">
            <div class="sidebar-section-label">Ringkasan Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <div class="sidebar-section-label">Manajemen Konten</div>
            <a href="{{ route('admin.menus.index') }}" class="sidebar-link {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                <i class="bi bi-journal-bookmark-fill"></i>
                <span>Data Menu</span>
            </a>
            <a href="{{ route('admin.franchise.index') }}" class="sidebar-link {{ request()->routeIs('admin.franchise.*') ? 'active' : '' }}">
                <i class="bi bi-shop-window"></i>
                <span>Paket Franchise</span>
            </a>
            <a href="{{ route('admin.promotions.index') }}" class="sidebar-link {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                <i class="bi bi-megaphone-fill"></i>
                <span>Promo & Banner</span>
            </a>

            <div class="sidebar-section-label">Laporan Bisnis</div>
            <a href="{{ route('admin.sales.index') }}" class="sidebar-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i>
                <span>Laporan Penjualan</span>
            </a>

            <div class="sidebar-section-label">Kecerdasan Buatan</div>
            <a href="{{ route('admin.ai-assistant.index') }}" class="sidebar-link {{ request()->routeIs('admin.ai-assistant.*') ? 'active' : '' }}">
                <i class="bi bi-stars"></i>
                <span>AI Promo Assistant</span>
            </a>

            <div class="sidebar-section-label">Tautan & Sesi</div>
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-box-arrow-up-right"></i>
                <span>Lihat Website Publik</span>
            </a>
        </nav>
    </div>

    <div class="sidebar-footer">
        <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start p-2" style="cursor:pointer; color: #FAC7C3 !important;">
                <i class="bi bi-box-arrow-left text-danger"></i>
                <span class="text-danger fw-semibold">Keluar (Logout)</span>
            </button>
        </form>
    </div>
</aside>

<!-- MAIN -->
<div class="admin-main">
    <!-- TOPBAR -->
    <header class="admin-topbar">
        <div class="topbar-left">
            <button type="button" class="btn btn-sm d-lg-none p-1 border-0" id="sidebarToggle" aria-label="Toggle Sidebar">
                <i class="bi bi-list fs-3" style="color: var(--md-wood);"></i>
            </button>
            <div>
                <nav class="breadcrumb-admin" aria-label="breadcrumb">
                    <span>Admin Panel</span>
                    <i class="bi bi-chevron-right" style="font-size:0.65rem;"></i>
                    <span class="text-dark fw-semibold">@yield('page-title', 'Dashboard')</span>
                </nav>
                <h1 class="page-title mt-1">@yield('page-title', 'Dashboard')</h1>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-md-outline d-none d-sm-inline-flex">
                <i class="bi bi-globe me-1"></i> Web Publik
            </a>
            <div class="admin-profile-pill">
                <div class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="d-none d-md-block">
                    <span class="d-block lh-1" style="font-size: 0.825rem;">{{ auth()->user()->name }}</span>
                    <span class="d-block text-muted" style="font-size: 0.68rem;">Administrator</span>
                </div>
            </div>
        </div>
    </header>

    <!-- FLASH MESSAGES -->
    @if(session('success') || session('error'))
    <div class="admin-content pb-0 pt-3">
        @if(session('success'))
            <div class="alert alert-success-md d-flex align-items-center gap-2 mb-0 shadow-sm">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error-md d-flex align-items-center gap-2 mb-0 shadow-sm">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif
    </div>
    @endif

    <!-- CONTENT -->
    <main class="admin-content">
        @yield('content')
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('adminSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        if (toggleBtn && sidebar && backdrop) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('show');
            });

            backdrop.addEventListener('click', function() {
                sidebar.classList.remove('show');
                backdrop.classList.remove('show');
            });
        }
    });
</script>
@yield('scripts')
</body>
</html>
