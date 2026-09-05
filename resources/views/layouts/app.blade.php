<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Warung Mbah Darmo – Cita Rasa Warisan, Kemitraan Terpercaya. Mie Gepeng Batok Arang legendaris dengan konsep kuliner heritage Jawa.')">
    <title>@yield('title', 'Warung Mbah Darmo') – Cita Rasa Warisan</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&family=Crimson+Text:ital,wght@0,400;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Mbah Darmo Design System -->
    <style>
        :root {
            --md-primary:      #800000;
            --md-primary-dark: #6B1D1D;
            --md-primary-light:#A03030;
            --md-bg:           #FDFBF7;
            --md-bg-warm:      #F8F4EE;
            --md-bg-card:      #FFFFFF;
            --md-secondary:    #706612;
            --md-gold:         #A18A43;
            --md-gold-light:   #C8AA68;
            --md-charcoal:     #2C2215;
            --md-text:         #3D2B1F;
            --md-text-muted:   #7A6555;
            --md-border:       #E8DDD0;
            --font-heading:    'Playfair Display', Georgia, serif;
            --font-body:       'Inter', system-ui, sans-serif;
            --font-accent:     'Crimson Text', Georgia, serif;
            --shadow-sm:       0 2px 8px rgba(128,0,0,0.08);
            --shadow-md:       0 4px 20px rgba(128,0,0,0.12);
            --shadow-lg:       0 8px 40px rgba(128,0,0,0.16);
            --radius-sm:       6px;
            --radius-md:       12px;
            --radius-lg:       20px;
            --transition:      all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            background-color: var(--md-bg);
            color: var(--md-text);
            line-height: 1.7;
        }

        h1, h2, h3, h4, h5 { font-family: var(--font-heading); color: var(--md-charcoal); }

        /* ── NAVBAR ── */
        /* ================================
   NAVBAR / HEADER
   ================================ */

/* ── NAVBAR ── */

.md-navbar {
    background: rgba(44, 34, 21, 0.55);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
    transition:
        transform 0.35s ease,
        background 0.3s ease,
        box-shadow 0.3s ease,
        border-color 0.3s ease;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.md-navbar.navbar-hidden {
    transform: translateY(-100%);
}

.md-navbar.scrolled {
    background: rgba(72, 52, 35, 0.58);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom-color: rgba(255, 255, 255, 0.16);
    box-shadow: 0 6px 25px rgba(44, 34, 21, 0.12);
}

.admin-login-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    margin-left: 0.75rem;
    border-radius: 50%;
    text-decoration: none;
    background: #800000;
    border: 1px solid #800000;
    color: #fff !important;
    transition: all 0.25s ease;
}

.admin-login-btn:hover {
    background: #6B1D1D;
    color: #fff !important;
    transform: translateY(-1px);
}

.admin-login-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}


/* Container Header */

.md-navbar .container {
    min-height: 88px;
    display: flex;
    align-items: center;
}


/* ================================
   LOGO
   ================================ */

.md-navbar .navbar-brand {
    font-family: var(--font-heading);
    font-size: 1.55rem;
    font-weight: 700;
    color: #ffffff !important;
    letter-spacing: -0.6px;
    text-decoration: none;
    white-space: nowrap;
}

.md-navbar .navbar-brand span {
    color: var(--md-gold-light);
}


/* ================================
   NAVIGATION
   ================================ */

.md-navbar .navbar-nav {
    align-items: center;
    gap: 4px !important;
}

.md-navbar .nav-link {
    font-family: var(--font-body);
    font-size: 0.82rem;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.82) !important;
    padding: 0.65rem 1rem !important;
    border-radius: 7px;
    transition: all 0.25s ease;
    letter-spacing: 0;
    text-decoration: none;
    white-space: nowrap;
}


/* Hover */

.md-navbar .nav-link:hover {
    color: #ffffff !important;
    background: rgba(255, 255, 255, 0.10);
}


/* Menu aktif */

.md-navbar .nav-link.active {
    color: var(--md-primary) !important;
    background: rgba(253, 251, 247, 0.95);
    font-weight: 600;
}


/* ================================
   BUTTON HUBUNGI KAMI
   ================================ */

.md-navbar .nav-link-cta {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    background: var(--md-primary) !important;
    color: #fff !important;
    border-radius: 7px !important;
    padding: 0.7rem 1.35rem !important;
    font-size: 0.78rem;
    font-weight: 600;
    margin-left: 1rem;
    box-shadow: 0 4px 12px rgba(128, 0, 0, 0.25);
}

.md-navbar .nav-link-cta:hover {
    background: var(--md-primary-dark) !important;
    color: #fff !important;
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(128, 0, 0, 0.35);
}


/* ================================
   WHATSAPP ICON
   ================================ */

.md-navbar .nav-link-cta i {
    font-size: 1rem;
}


/* ================================
   MOBILE TOGGLER
   ================================ */

.md-navbar .navbar-toggler {
    padding: 0.4rem 0.5rem;
    border: none !important;
    box-shadow: none !important;
}

.md-navbar .navbar-toggler:focus {
    box-shadow: none !important;
}

.md-navbar .navbar-toggler-icon {
    filter: brightness(0) invert(1);
}


/* ================================
   RESPONSIVE
   ================================ */

@media (max-width: 991.98px) {

    .md-navbar {
        min-height: 76px;
    }

    .md-navbar .container {
        min-height: 76px;
    }

    .md-navbar .navbar-collapse {
        padding: 1rem 0 1.2rem;
    }

    .md-navbar .navbar-nav {
        align-items: stretch;
        gap: 3px !important;
    }

    .md-navbar .nav-link {
        padding: 0.75rem 1rem !important;
    }

    .md-navbar .nav-link-cta {
        margin-left: 0;
        margin-top: 0.75rem;
        width: 100%;
    }
}



        /* ── BUTTONS ── */
        .btn-md-primary {
            background: var(--md-primary);
            border-color: var(--md-primary);
            color: #fff;
            font-family: var(--font-body);
            font-weight: 500;
            border-radius: 50px;
            padding: 0.65rem 1.8rem;
            transition: var(--transition);
            letter-spacing: 0.3px;
        }
        .btn-md-primary:hover {
            background: var(--md-primary-dark);
            border-color: var(--md-primary-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        .btn-md-gold {
            background: var(--md-gold);
            border-color: var(--md-gold);
            color: #fff;
            font-family: var(--font-body);
            font-weight: 500;
            border-radius: 50px;
            padding: 0.65rem 1.8rem;
            transition: var(--transition);
        }
        .btn-md-gold:hover {
            background: var(--md-secondary);
            border-color: var(--md-secondary);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        .btn-md-outline {
            background: transparent;
            border: 2px solid var(--md-primary);
            color: var(--md-primary);
            font-family: var(--font-body);
            font-weight: 500;
            border-radius: 50px;
            padding: 0.6rem 1.8rem;
            transition: var(--transition);
        }
        .btn-md-outline:hover {
            background: var(--md-primary);
            color: #fff;
            transform: translateY(-2px);
        }
        .btn-whatsapp {
            background: #25D366;
            border-color: #25D366;
            color: #fff;
            font-weight: 600;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            transition: var(--transition);
            display: inline-flex; align-items: center; gap: 0.5rem;
        }
        .btn-whatsapp:hover {
            background: #1EB556; color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(37,211,102,0.35);
        }

        /* ── SECTION HEADINGS ── */
        .section-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--md-gold);
            font-family: var(--font-body);
        }
        .section-title {
            font-family: var(--font-heading);
            font-size: clamp(1.8rem, 3vw, 2.8rem);
            color: var(--md-charcoal);
            line-height: 1.25;
        }
        .section-divider {
            width: 60px; height: 3px;
            background: linear-gradient(to right, var(--md-primary), var(--md-gold));
            border-radius: 2px; margin: 1rem auto;
        }

        /* ── CARDS ── */
        .md-card {
            background: var(--md-bg-card);
            border: 1px solid var(--md-border);
            border-radius: var(--radius-md);
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }
        .md-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(128,0,0,0.15);
        }

        /* ── FOOTER ── */
        .md-footer {
            background: var(--md-charcoal);
            color: rgba(255,255,255,0.8);
            padding: 4rem 0 2rem;
        }
        .md-footer h5 {
            font-family: var(--font-heading);
            color: #fff;
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
        }
        .md-footer a {
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 0.875rem;
            transition: var(--transition);
            display: block;
            margin-bottom: 0.4rem;
        }
        .md-footer a:hover { color: var(--md-gold-light); padding-left: 4px; }
        .md-footer .footer-brand {
            font-family: var(--font-heading);
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
        }
        .md-footer .footer-brand span { color: var(--md-gold-light); }
        .md-footer .footer-divider {
            border-color: rgba(255,255,255,0.1);
            margin: 2rem 0 1.5rem;
        }
        .md-footer .social-link {
            display: inline-flex; align-items: center; justify-content: center;
            width: 38px; height: 38px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
            color: rgba(255,255,255,0.7) !important;
            font-size: 1.1rem;
            transition: var(--transition);
            margin-right: 0.5rem;
            padding: 0 !important;
        }
        .md-footer .social-link:hover {
            background: var(--md-gold);
            color: #fff !important;
            transform: translateY(-2px);
        }

        /* ── UTILITIES ── */
        .bg-md-warm { background-color: var(--md-bg-warm); }
        .bg-md-primary { background-color: var(--md-primary); }
        .text-md-primary { color: var(--md-primary) !important; }
        .text-md-gold { color: var(--md-gold) !important; }
        .text-md-muted { color: var(--md-text-muted) !important; }
        .border-md { border-color: var(--md-border) !important; }
        .ornament-divider {
            text-align: center; color: var(--md-gold);
            font-size: 1.4rem; letter-spacing: 8px; opacity: 0.6;
        }

        /* ── SCROLL ANIMATIONS ── */
        .fade-in-up { opacity: 0; transform: translateY(30px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .fade-in-up.visible { opacity: 1; transform: translateY(0); }

        @yield('extra-styles')
    </style>

    @yield('head')
</head>
<body>

<!-- NAVBAR -->
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg md-navbar">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand" href="{{ route('home') }}">
            Warung <span>Mbah Darmo</span>
        </a>

        <!-- MOBILE TOGGLER -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMain"
            aria-controls="navbarMain"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAVIGATION -->
        <div class="collapse navbar-collapse" id="navbarMain">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}"
                    >
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('franchise.*') ? 'active' : '' }}"
                        href="{{ route('franchise.index') }}"
                    >
                        Kemitraan
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}"
                        href="{{ route('menu.index') }}"
                    >
                        Menu
                    </a>
                </li>


                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}"
                        href="{{ route('contact.index') }}"
                    >
                        Kontak
                    </a>
                </li>

            </ul>

            <!-- WHATSAPP -->
            <a
                href="https://wa.me/6281383045066?text=Halo%20Tim%20Mbah%20Darmo,%20saya%20ingin%20mengetahui%20lebih%20lanjut%20tentang%20kemitraan"
                class="nav-link nav-link-cta"
                target="_blank"
                rel="noopener"
            >
                <i class="bi bi-whatsapp"></i>
                Hubungi Kami
            </a>

            <a href="{{ url('/admin/login') }}" class="admin-login-btn" title="Login Admin">
                <span class="admin-login-icon">
                    <i class="bi bi-person-fill"></i>
                </span>
            </a>

        </div>
    </div>
</nav>

<!-- PROMO BANNER (if active) -->
@if(isset($activePromotions) && $activePromotions->count() > 0)
<div class="bg-md-primary text-white py-2 text-center small">
    <div class="container d-flex align-items-center justify-content-center gap-2 flex-wrap">
        <i class="bi bi-megaphone-fill"></i>
        @foreach($activePromotions->take(1) as $promo)
            <strong>{{ $promo->title }}</strong>
            @if($promo->description)
                – {{ Str::limit($promo->description, 80) }}
            @endif
        @endforeach
        @if($activePromotions->count() > 1)
            <span class="badge bg-light text-danger">+{{ $activePromotions->count() - 1 }} promo lainnya</span>
        @endif
    </div>
</div>
@endif

<!-- MAIN CONTENT -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="md-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-3">Warung <span>Mbah Darmo</span></div>
                <p class="small" style="color:rgba(255,255,255,0.6); line-height:1.8;">
                    Warisan cita rasa Jawa otentik sejak generasi pertama. Menghadirkan pengalaman kuliner yang kaya rempah dengan konsep heritage modern yang hangat dan berkarakter.
                </p>
                <div class="mt-3">
                    <a href="https://wa.me/6281383045066" class="social-link" target="_blank" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="social-link" title="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-link" title="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link" title="TikTok"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5>Navigasi</h5>
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('menu.index') }}">Menu Kami</a>
                <a href="{{ route('franchise.index') }}">Kemitraan</a>
                <a href="{{ route('contact.index') }}">Kontak</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Paket Kemitraan</h5>
                <a href="{{ route('franchise.show', 'express') }}">Express – Rp 99 Juta</a>
                <a href="{{ route('franchise.show', 'basic') }}">Basic – Rp 199 Juta</a>
                <a href="{{ route('franchise.show', 'signature') }}">Signature – Rp 379 Juta</a>
                <a href="{{ route('franchise.show', 'heritage') }}">Heritage – Rp 799 Juta</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Hubungi Kami</h5>
                <p class="small mb-2" style="color:rgba(255,255,255,0.6);">
                    <i class="bi bi-geo-alt me-2" style="color:var(--md-gold-light)"></i>
                    Kejawar, Arcawinangun, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53113
                </p>
                <p class="small mb-2" style="color:rgba(255,255,255,0.6);">
                    <i class="bi bi-envelope me-2" style="color:var(--md-gold-light)"></i>
                    info@mbahdarmo.com
                </p>
                <p class="small mb-2" style="color:rgba(255,255,255,0.6);">
                    <i class="bi bi-whatsapp me-2" style="color:var(--md-gold-light)"></i>
                    +62 813-8304-5066
                </p>
                <p class="small mb-3" style="color:rgba(255,255,255,0.6);">
                    <i class="bi bi-clock me-2" style="color:var(--md-gold-light)"></i>
                    Setiap hari, 07.00 – 22.00 WIB
                </p>
                <a href="https://wa.me/6281383045066" class="btn btn-whatsapp btn-sm" target="_blank">
                    <i class="bi bi-whatsapp"></i> Chat Sekarang
                </a>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small mb-0" style="color:rgba(255,255,255,0.4);">
                    &copy; {{ date('Y') }} Warung Mbah Darmo. Hak Cipta Dilindungi.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="small mb-0" style="color:rgba(255,255,255,0.4);">
                    Warisan Rasa · Kemitraan Terpercaya · Heritage Kuliner Jawa
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scroll Animation -->
<script>
const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -40px 0px' };
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);
document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
</script>
<script>
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.md-navbar');

        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

<script>
    let lastScrollY = window.scrollY;
    const navbar = document.querySelector('.md-navbar');

    window.addEventListener('scroll', function () {
        const currentScrollY = window.scrollY;

        // Kalau berada di paling atas, navbar selalu muncul
        if (currentScrollY <= 10) {
            navbar.classList.remove('navbar-hidden');
            lastScrollY = currentScrollY;
            return;
        }

        // Scroll ke bawah → sembunyikan navbar
        if (currentScrollY > lastScrollY) {
            navbar.classList.add('navbar-hidden');
        }

        // Scroll ke atas → tampilkan navbar
        else if (currentScrollY < lastScrollY) {
            navbar.classList.remove('navbar-hidden');
        }

        lastScrollY = currentScrollY;
    });
</script>

@yield('scripts')
</body>
</html>
