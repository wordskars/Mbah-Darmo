<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Warung Mbah Darmo – Cita Rasa Warisan Jawa Otentik. Bakmie Jawa Arang, Sate Rempah, dan peluang kemitraan franchise kuliner heritage terpercaya.')">
    <title>@yield('title', 'Warung Mbah Darmo') – Rasa Jawa, Cara Mbah Darmo</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Global Styling System -->
    <style>
        :root {
            /* ── PALET WARNA RESMI ── */
            --md-primary:       #A83226; /* Terracotta Red */
            --md-primary-dark:  #8A2218;
            --md-primary-light: #C44335;
            --md-wood:          #2C1B13; /* Deep Wood Brown */
            --md-wood-dark:     #1E120C;
            --md-wood-light:    #4A3225;
            --md-bg:            #FDF8F2; /* Warm Cream / Beige */
            --md-bg-warm:       #F7EFE4;
            --md-bg-card:       #FFFFFF;
            --md-charcoal:      #1A1A1A; /* Dark Slate / Charcoal */
            --md-gold:          #C59438; /* Antique Warm Gold */
            --md-gold-light:    #DFC47B;
            --md-text:          #2C1B13;
            --md-text-muted:    #6D5C52;
            --md-border:        #EAE0D3;

            /* ── TIPOGRAFI ── */
            --font-heading:     'Playfair Display', 'Cormorant Garamond', Georgia, serif;
            --font-serif-alt:   'Cormorant Garamond', Georgia, serif;
            --font-body:        'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;

            /* ── ELEVASI & TRANSISI ── */
            --shadow-subtle:    0 2px 10px rgba(44, 27, 19, 0.05);
            --shadow-sm:        0 4px 16px rgba(44, 27, 19, 0.08);
            --shadow-md:        0 8px 26px rgba(44, 27, 19, 0.12);
            --shadow-lg:        0 16px 40px rgba(44, 27, 19, 0.16);
            --radius-sm:        8px;
            --radius-md:        14px;
            --radius-lg:        20px;
            --radius-pill:      50px;
            --transition:       all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--md-bg);
            color: var(--md-text);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            color: var(--md-wood);
            font-weight: 700;
            letter-spacing: -0.01em;
            text-shadow: none !important;
        }

        /* ── NAVBAR (100% TRANSPARENT FLOATING AT TOP, SEAMLESS BLEND) ── */
        .md-navbar {
            background: transparent !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1030;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: none !important;
            will-change: transform;
            transform: translateY(0);
        }

        .md-navbar.navbar-hidden {
            transform: translateY(-100%) !important;
            box-shadow: none !important;
        }

        .md-navbar.scrolled {
            background: rgba(22, 14, 10, 0.95) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.35) !important;
        }

        .md-navbar .container-fluid {
            min-height: 72px;
        }

        /* Official White Logo (High contrast on dark background) */
        .navbar-brand-wrap {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            padding: 0;
            margin: 0;
            transition: opacity 0.2s ease;
        }

        .navbar-brand-wrap:hover {
            opacity: 0.9;
        }

        .navbar-brand-logo {
            height: 48px;
            max-height: 50px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .md-navbar .navbar-nav {
            gap: 8px;
            align-items: center;
        }

        @media (min-width: 992px) {
            .md-navbar .container-fluid {
                position: relative;
            }
            .md-navbar .navbar-nav.center-nav {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                margin: 0 !important;
            }
        }

        .md-navbar .nav-link {
            font-size: 0.92rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 0.45rem 1rem !important;
            position: relative;
            transition: var(--transition);
            text-decoration: none;
            letter-spacing: 0.2px;
        }

        .md-navbar .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--md-gold);
            border-radius: 2px;
            transition: width 0.25s ease;
        }

        .md-navbar .nav-link:hover {
            color: #FFFFFF !important;
        }

        .md-navbar .nav-link:hover::after {
            width: 50%;
        }

        .md-navbar .nav-link.active {
            color: #FFFFFF !important;
            font-weight: 600;
        }

        .md-navbar .nav-link.active::after {
            width: 50%;
            background: var(--md-gold);
        }

        /* Right CTA */
        .navbar-cta-btn {
            background: var(--md-primary);
            color: #FFFFFF !important;
            font-size: 0.86rem;
            font-weight: 600;
            padding: 0.62rem 1.45rem;
            border-radius: var(--radius-pill);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 4px 14px rgba(168, 50, 38, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .navbar-cta-btn:hover {
            background: var(--md-primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(168, 50, 38, 0.45);
            color: #FFFFFF !important;
        }

        .navbar-admin-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.85) !important;
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: var(--transition);
            margin-left: 8px;
            text-decoration: none;
            font-size: 1.05rem;
        }

        .navbar-admin-icon:hover {
            background: rgba(255, 255, 255, 0.22);
            color: #FFFFFF !important;
            transform: translateY(-2px);
            border-color: var(--md-gold-light);
        }

        /* ── BUTTONS ── */
        .btn-terracotta {
            background: var(--md-primary);
            border: 1px solid var(--md-primary);
            color: #FFFFFF !important;
            font-family: var(--font-body);
            font-weight: 600;
            border-radius: var(--radius-pill);
            padding: 0.75rem 2rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(168, 50, 38, 0.28);
        }

        .btn-terracotta:hover {
            background: var(--md-primary-dark);
            border-color: var(--md-primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(168, 50, 38, 0.4);
            color: #FFFFFF !important;
        }

        .btn-ghost-cream {
            background: rgba(253, 248, 242, 0.12);
            border: 1.5px solid rgba(253, 248, 242, 0.75);
            color: #FFFFFF !important;
            font-family: var(--font-body);
            font-weight: 600;
            border-radius: var(--radius-pill);
            padding: 0.75rem 2rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            backdrop-filter: blur(6px);
        }

        .btn-ghost-cream:hover {
            background: rgba(253, 248, 242, 0.25);
            border-color: #FFFFFF;
            color: #FFFFFF !important;
            transform: translateY(-2px);
        }

        .btn-outline-terracotta {
            background: transparent;
            border: 1.5px solid var(--md-primary);
            color: var(--md-primary) !important;
            font-family: var(--font-body);
            font-weight: 600;
            border-radius: var(--radius-pill);
            padding: 0.65rem 1.75rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-outline-terracotta:hover {
            background: var(--md-primary);
            color: #FFFFFF !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(168, 50, 38, 0.25);
        }

        .btn-whatsapp {
            background: #25D366;
            border: 1px solid #25D366;
            color: #FFFFFF !important;
            font-family: var(--font-body);
            font-weight: 600;
            border-radius: var(--radius-pill);
            padding: 0.75rem 2rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(37, 211, 102, 0.28);
        }

        .btn-whatsapp:hover {
            background: #1EBE5D;
            border-color: #1EBE5D;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.38);
            color: #FFFFFF !important;
        }

        /* ── SECTION HEADERS & LABELS ── */
        .section-label {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--md-primary);
            font-family: var(--font-body);
            margin-bottom: 0.35rem;
        }

        .section-title {
            font-family: var(--font-heading);
            font-size: clamp(1.85rem, 3.2vw, 2.6rem);
            color: var(--md-wood);
            line-height: 1.25;
            margin-bottom: 0.5rem;
        }

        .section-divider {
            width: 48px;
            height: 3px;
            background: var(--md-primary);
            border-radius: 2px;
            margin: 0.75rem auto 0.95rem;
        }

        .section-divider.start {
            margin: 0.75rem 0 0.95rem;
        }

        /* ── FOOTER ── */
        .md-footer {
            background: var(--md-wood);
            color: rgba(253, 248, 242, 0.75);
            padding: 4.5rem 0 2rem;
            border-top: 3px solid var(--md-primary);
        }

        .md-footer h5 {
            font-family: var(--font-heading);
            color: #FFFFFF;
            font-size: 1.15rem;
            margin-bottom: 1.25rem;
            position: relative;
        }

        .md-footer h5::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 28px;
            height: 2px;
            background: var(--md-gold);
        }

        .md-footer a {
            color: rgba(253, 248, 242, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
            display: block;
            margin-bottom: 0.5rem;
        }

        .md-footer a:hover {
            color: var(--md-gold-light);
            padding-left: 5px;
        }

        .md-footer .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 1rem;
            transition: var(--transition);
            margin-right: 0.5rem;
            padding: 0 !important;
        }

        .md-footer .social-link:hover {
            background: var(--md-primary);
            border-color: var(--md-primary);
            color: #FFFFFF !important;
            transform: translateY(-2px);
            padding-left: 0 !important;
        }

        .md-footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 3rem;
            padding-top: 1.5rem;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Scroll Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 991.98px) {
            .md-navbar .navbar-collapse {
                background: rgba(30, 18, 12, 0.98);
                border-radius: var(--radius-md);
                padding: 1.25rem;
                margin-top: 0.75rem;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .md-navbar .navbar-nav {
                align-items: flex-start;
                gap: 4px;
            }

            .md-navbar .nav-link {
                width: 100%;
                padding: 0.6rem 0.8rem !important;
            }

            .navbar-cta-btn {
                width: 100%;
                justify-content: center;
                margin-top: 0.75rem;
            }
        }
    </style>
    @yield('extra-styles')
    @yield('head')
</head>
<body>

    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-expand-lg md-navbar">
        <div class="container-fluid px-3 px-md-4 px-xl-5">
            <!-- BRAND LOGO (HANYA SATU LOGO PUTIH HIGH-CONTRAST TANPA DUPLIKASI TEKS) -->
            <a class="navbar-brand-wrap" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-white.png') }}" alt="Warung Mbah Darmo" class="navbar-brand-logo">
            </a>

            <!-- MOBILE TOGGLER -->
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2 text-white"></i>
            </button>

            <!-- NAVIGATION LINKS (DITENGAHKAN SECARA PRESISI) -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto center-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('franchise.*') ? 'active' : '' }}" href="{{ route('franchise.index') }}">
                            Kemitraan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}" href="{{ route('menu.index') }}">
                            Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">
                            Kontak
                        </a>
                    </li>
                </ul>

                <!-- RIGHT CTA BUTTON & AKUN/LOGIN (POJOK KANAN DENGAN MARGIN RAPI) -->
                <div class="d-flex align-items-center mt-3 mt-lg-0 ms-lg-auto">
                    <a href="https://wa.me/6281215142908?text=Halo%20Tim%20Warung%20Mbah%20Darmo,%20saya%20ingin%20bertanya%20informasi%20menu%20dan%20kemitraan" 
                       class="navbar-cta-btn" 
                       target="_blank" 
                       rel="noopener">
                        <i class="bi bi-whatsapp"></i>
                        <span>Hubungi Kami</span>
                    </a>

                    <a href="{{ url('/admin/login') }}" class="navbar-admin-icon ms-2" title="Login Akun Admin / Mitra">
                        <i class="bi bi-person-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="md-footer">
        <div class="container">
            <div class="row g-4">
                <!-- BRAND INFO -->
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('home') }}" class="d-inline-block mb-3">
                        <img src="{{ asset('images/logo-white.png') }}" alt="Warung Mbah Darmo" height="46">
                    </a>
                    <p style="font-size:0.9rem; line-height:1.75; color:rgba(253,248,242,0.7);">
                        Menghadirkan kehangatan dan kekayaan rempah kuliner tradisional Jawa sejak 1985. Diramu dengan resep autentik dan dioperasikan dengan standar waralaba modern terpercaya.
                    </p>
                    <div class="d-flex align-items-center mt-3">
                        <a href="https://wa.me/6281215142908" class="social-link" target="_blank" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <a href="https://instagram.com" class="social-link" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://facebook.com" class="social-link" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://tiktok.com" class="social-link" target="_blank" title="TikTok"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>

                <!-- QUICK LINKS -->
                <div class="col-lg-2 col-md-6">
                    <h5>Navigasi</h5>
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="{{ route('menu.index') }}">Katalog Menu</a>
                    <a href="{{ route('franchise.index') }}">Peluang Kemitraan</a>
                    <a href="{{ route('contact.index') }}">Kontak &amp; Lokasi</a>
                </div>

                <!-- FRANCHISE PACKAGES -->
                <div class="col-lg-3 col-md-6">
                    <h5>Paket Kemitraan</h5>
                    <a href="{{ route('franchise.show', 'express') }}">Paket Express – Rp 99 Jt</a>
                    <a href="{{ route('franchise.show', 'basic') }}">Paket Basic – Rp 199 Jt</a>
                    <a href="{{ route('franchise.show', 'signature') }}">Paket Signature – Rp 379 Jt</a>
                    <a href="{{ route('franchise.show', 'heritage') }}">Paket Heritage – Rp 799 Jt</a>
                </div>

                <!-- CONTACT & LOCATION -->
                <div class="col-lg-3 col-md-6">
                    <h5>Lokasi &amp; Kontak</h5>
                    <p class="small mb-2" style="color:rgba(253,248,242,0.7);">
                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                        Kejawar, Arcawinangun, Kec. Purwokerto Tim., Kab. Banyumas, Jawa Tengah 53113
                    </p>
                    <p class="small mb-2" style="color:rgba(253,248,242,0.7);">
                        <i class="bi bi-clock-fill text-warning me-2"></i>
                        Setiap Hari: 12.00 – 22.00 WIB
                    </p>
                    <p class="small mb-3" style="color:rgba(253,248,242,0.7);">
                        <i class="bi bi-envelope-fill text-info me-2"></i>
                        info@mbahdarmo.com
                    </p>
                    <a href="https://wa.me/6281215142908" class="btn btn-whatsapp btn-sm px-3 py-2" target="_blank" rel="noopener">
                        <i class="bi bi-whatsapp"></i> Chat WhatsApp
                    </a>
                </div>
            </div>

            <!-- COPYRIGHT -->
            <div class="md-footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        &copy; {{ date('Y') }} Warung Mbah Darmo. Hak Cipta Dilindungi.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Warisan Rasa Jawa · Kemitraan Waralaba Terpercaya
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scroll & Transition Script -->
    <script>
        let lastScrollTop = 0;
        const navbar = document.querySelector('.md-navbar');
        const navCollapse = document.getElementById('navbarMain');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            // At top of page
            if (currentScroll <= 15) {
                navbar.classList.remove('navbar-hidden');
                navbar.classList.remove('scrolled');
                lastScrollTop = currentScroll;
                return;
            }

            navbar.classList.add('scrolled');

            // Do not hide if mobile menu is currently expanded
            if (navCollapse && navCollapse.classList.contains('show')) {
                lastScrollTop = currentScroll;
                return;
            }

            // Scroll Down with threshold -> HIDE navbar smoothly
            if (currentScroll > lastScrollTop + 6 && currentScroll > 70) {
                navbar.classList.add('navbar-hidden');
            } 
            // Scroll Up -> SHOW navbar
            else if (currentScroll < lastScrollTop - 4) {
                navbar.classList.remove('navbar-hidden');
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        }, { passive: true });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
    </script>
    @yield('scripts')
</body>
</html>
