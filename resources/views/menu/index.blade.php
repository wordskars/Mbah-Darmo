@extends('layouts.app')

@section('title', 'Menu Kami')
@section('meta_description', 'Jelajahi katalog menu Warung Mbah Darmo — Mie Gepeng Batok Arang, Nasi Goreng Arang, Babat Gongso, Oseng Kikil, Kopi Manual Brew, dan Wedangan khas Jawa.')

@section('extra-styles')

/* =========================
   MENU HERO
========================= */

* {
    max-width: 100%;
}

.menu-hero {
    background-image: url('/images/home/menu/IMG_4608.jpg') !important;
    background-size: cover !important;
    background-position: center 45% !important;
    background-repeat: no-repeat !important;

    min-height: 460px;
    padding: 6rem 0 5rem;

    border-bottom: 1px solid var(--md-border);
    position: relative;
    overflow: hidden;
}

.menu-hero::before {
    display: none !important;
}

.menu-hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.42);
    z-index: 0;
}

.menu-hero .container {
    position: relative;
    z-index: 1;
}

.menu-hero .section-label {
    color: #f0d9a0;
}

.menu-hero .section-title {
    color: #fff;
}

.menu-hero .text-md-muted {
    color: rgba(255, 255, 255, 0.85) !important;
}


/* =========================
   FILTER
========================= */

.filter-bar {
    background: #fff;
    border: 1px solid var(--md-border);
    border-radius: 60px;
    padding: 0.5rem;
    display: flex;
    gap: 0.25rem;
    flex-wrap: wrap;
}

.filter-btn {
    border: none;
    background: transparent;
    padding: 0.5rem 1.2rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--md-text-muted);
    cursor: pointer;
    transition: var(--transition);
    white-space: nowrap;
}

.filter-btn:hover {
    color: var(--md-primary);
    background: rgba(128, 0, 0, 0.05);
}

.filter-btn.active {
    background: var(--md-primary);
    color: #fff;
}


/* =========================
   SEARCH
========================= */

.search-wrap {
    position: relative;
}

.search-input {
    border: 1px solid var(--md-border);
    border-radius: 50px;
    padding: 0.7rem 1rem 0.7rem 2.8rem;
    font-size: 0.875rem;
    width: 100%;
    background: var(--md-bg);
    color: var(--md-text);
    transition: var(--transition);
}

.search-input:focus {
    outline: none;
    border-color: var(--md-primary);
    box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.1);
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--md-text-muted);
}


/* =========================
   MENU CARD
========================= */

.menu-card {
    background: #fff;
    border: 1px solid var(--md-border);
    border-radius: 16px;
    overflow: hidden;
    transition: var(--transition);
    position: relative;
    cursor: pointer;
}

.menu-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(128, 0, 0, 0.15);
}


/* =========================
   MENU IMAGE
========================= */

.menu-card-img {
    height: 200px;
    overflow: hidden;
    position: relative;
    background: #f4eee5;
}

.menu-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}

.menu-card:hover .menu-card-img img {
    transform: scale(1.08);
}


/* =========================
   BADGES
========================= */

.cat-badge {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    background: rgba(253, 251, 247, 0.92);
    backdrop-filter: blur(8px);
    color: var(--md-primary);
    padding: 0.25rem 0.7rem;
    border-radius: 50px;
    font-size: 0.65rem;
    font-weight: 600;
    border: 1px solid rgba(128, 0, 0, 0.15);
}

.avail-dot {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #25D366;
    border: 2px solid #fff;
}

.avail-dot.unavail {
    background: #aaa;
}


/* =========================
   HOVER TOOLTIP
========================= */

.hover-tooltip {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(44, 34, 21, 0.97) 0%,
        rgba(44, 34, 21, 0.85) 50%,
        transparent 100%
    );

    display: flex;
    flex-direction: column;
    justify-content: flex-end;

    padding: 1.25rem;
    opacity: 0;
    transition: opacity 0.35s ease;
    pointer-events: none;
}

.menu-card:hover .hover-tooltip {
    opacity: 1;
}

.tooltip-title {
    font-family: var(--font-heading);
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.4rem;
}

.tooltip-desc {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.75rem;
    line-height: 1.6;
    margin-bottom: 0.5rem;
}

.tooltip-meta {
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

.tooltip-price {
    color: var(--md-gold-light);
    font-weight: 600;
    font-size: 0.875rem;
}

.spice-badge {
    background: rgba(255, 60, 60, 0.15);
    color: #ff9999;
    padding: 0.2rem 0.5rem;
    border-radius: 50px;
    font-size: 0.65rem;
}


/* =========================
   CARD BODY
========================= */

.menu-card-body {
    padding: 1.25rem;
}

.menu-card-title {
    font-family: var(--font-heading);
    font-size: 1rem;
    color: var(--md-charcoal);
    margin-bottom: 0.25rem;
}

.menu-card-price {
    color: var(--md-primary);
    font-weight: 600;
    font-size: 0.95rem;
}


/* =========================
   EMPTY STATE
========================= */

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--md-text-muted);
}

.empty-state .icon {
    font-size: 4rem;
    opacity: 0.3;
    margin-bottom: 1rem;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 767.98px) {

    .menu-hero {
        min-height: 400px;
        padding: 5rem 1rem 4rem;
        background-position: center center !important;
    }

    .menu-card-img {
        height: 210px;
    }

    .filter-bar {
        border-radius: 20px;
    }

}


/* =========================
   MENU IMAGE LIST
========================= */

@endsection


@section('content')

{{-- HERO --}}
<section class="menu-hero">
    <div class="container">
        <div class="text-center mb-4 fade-in-up">

            <span class="section-label">
                Katalog Digital
            </span>

            <h1 class="section-title mt-2">
                Menu Warung Mbah Darmo
            </h1>

            <div class="section-divider"></div>

            <p class="text-md-muted mt-3"
               style="max-width:520px; margin:auto; font-size:0.95rem;">
                Katalog menu visual kami — arahkan kursor ke setiap sajian untuk mengenal keunikan rasa, bahan utama, dan karakter aromanya.
            </p>

        </div>
    </div>
</section>


{{-- FILTER + SEARCH --}}
<section class="py-4"
         style="background:var(--md-bg); border-bottom:1px solid var(--md-border);">

    <div class="container">

        <div class="row align-items-center g-3">

            <div class="col-md-5">

                <div class="search-wrap">

                    <i class="bi bi-search search-icon"></i>

                    <input
                        type="text"
                        id="searchInput"
                        class="search-input"
                        placeholder="Cari menu (mis: mie gepeng, kopi...)"
                        value="{{ request('search') }}"
                    >

                </div>

            </div>


            <div class="col-md-7">

                <div class="filter-bar">

                    <button
                        class="filter-btn active"
                        data-cat="all">
                        Semua
                    </button>

                    @foreach($categories as $cat)

                        @if($cat->menus_count > 0)

                            <button
                                class="filter-btn"
                                data-cat="{{ $cat->slug }}">

                                {{ $cat->name }}

                                <span style="opacity:0.6; font-size:0.7rem;">
                                    ({{ $cat->menus_count }})
                                </span>

                            </button>

                        @endif

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</section>


{{-- MENU GRID --}}
<section class="py-5">

    <div class="container">

        <div id="menuGrid" class="row g-4">

            @php

                /*
                 * 20 FOTO MENU
                 *
                 * Foto IMG_4608.jpg tidak dimasukkan
                 * karena itu khusus foto HERO.
                 */

                $menuImages = [

                    'bakmiegorengayam.jpg',
                    'bakmiekuahayam.jpg',
                    'bakmiekuahkoyor.jpg',
                    'bihungorengayam.jpg',
                    'gulaijeroan.jpg',
                    'kopitubruk.jpg',
                    'krengsengan.jpg',
                    'kwetiaugorengayam.jpg',
                    'nasigorengayam.jpg',
                    'nasigorengkoyor.jpg',
                    'osengkoyor.jpg',
                    'satekambing.jpg',
                    'tengkleng.jpg',
                    'tongseng.jpg',
                    'wedangasem.jpg',
                    'wedangjahe.jpg',
                    'wedangjeruk.jpg',
                    'wedangronderempah.jpg',
                    'wedangsaraba.jpg',
                    'wedanguwuh.jpg',

                ];

            @endphp


            @forelse($menus as $index => $menu)

                <div
                    class="col-sm-6 col-lg-4 col-xl-3 menu-item fade-in-up"
                    data-cat="{{ $menu->category->slug }}"
                    data-name="{{ strtolower($menu->name) }}"
                >

                    <div class="menu-card h-100">

                        <div class="menu-card-img">

                            {{-- FOTO MENU --}}
                            @if(isset($menuImages[$index]))

                                <img
                                    src="{{ asset('images/home/menu/' . $menuImages[$index]) }}"
                                    alt="{{ $menu->name }}"
                                    loading="lazy"
                                >

                            @else

                                <div class="menu-card-img-placeholder">
                                    🍽️
                                </div>

                            @endif


                            {{-- CATEGORY --}}
                            <span class="cat-badge">
                                {{ $menu->category->name }}
                            </span>


                            {{-- AVAILABILITY --}}
                            <div
                                class="avail-dot {{ $menu->is_available ? '' : 'unavail' }}"
                                title="{{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}"
                            ></div>


                            {{-- HOVER TOOLTIP --}}
                            <div class="hover-tooltip">

                                <div class="tooltip-title">
                                    {{ $menu->name }}
                                </div>


                                @if($menu->short_description_hover)

                                    <div class="tooltip-desc">
                                        {{ $menu->short_description_hover }}
                                    </div>

                                @endif


                                <div class="tooltip-meta">

                                    <span class="tooltip-price">
                                        {{ $menu->formatted_price }}
                                    </span>


                                    @if($menu->spice_level && $menu->spice_level !== 'mild')

                                        <span class="spice-badge">

                                            @if($menu->spice_level === 'medium')
                                                🌶️ Medium
                                            @elseif($menu->spice_level === 'hot')
                                                🌶️🌶️ Pedas
                                            @elseif($menu->spice_level === 'extra-hot')
                                                🌶️🌶️🌶️ Extra Pedas
                                            @endif

                                        </span>

                                    @endif


                                    @if(!$menu->is_available)

                                        <span
                                            style="
                                                background:rgba(108,117,125,0.2);
                                                color:#aaa;
                                                padding:0.2rem 0.5rem;
                                                border-radius:50px;
                                                font-size:0.65rem;
                                            "
                                        >
                                            Habis
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- CARD BODY --}}
                        <div class="menu-card-body">

                            <div class="menu-card-title">
                                {{ $menu->name }}
                            </div>


                            <div class="d-flex justify-content-between align-items-center mt-1">

                                <span class="menu-card-price">
                                    {{ $menu->formatted_price }}
                                </span>


                                @if($menu->is_featured)

                                    <span
                                        style="
                                            background:rgba(161,138,67,0.1);
                                            color:var(--md-gold);
                                            padding:0.2rem 0.6rem;
                                            border-radius:50px;
                                            font-size:0.65rem;
                                            font-weight:600;
                                        "
                                    >
                                        ⭐ Unggulan
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-state">

                        <div class="icon">
                            🍽️
                        </div>

                        <h5>
                            Menu belum tersedia
                        </h5>

                        <p style="font-size:0.875rem;">
                            Katalog menu sedang dipersiapkan. Silakan cek kembali nanti.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- NO RESULTS --}}
        <div
            id="noResults"
            class="empty-state d-none"
        >

            <div class="icon">
                🔍
            </div>

            <h5>
                Menu tidak ditemukan
            </h5>

            <p style="font-size:0.875rem;">
                Coba kata kunci atau kategori yang lain.
            </p>

        </div>

    </div>

</section>


{{-- WHATSAPP CTA --}}
<section class="py-5 bg-md-warm">

    <div class="container text-center">

        <div class="fade-in-up">

            <p
                class="text-md-muted mb-3"
                style="font-size:0.95rem;"
            >
                Ada pertanyaan tentang menu atau ingin pesan untuk acara khusus?
            </p>

            <a
                href="https://wa.me/6281383045066?text=Halo%20Mbah%20Darmo,%20saya%20ingin%20bertanya%20tentang%20menu%20Anda"
                class="btn btn-whatsapp px-5 py-3"
                target="_blank"
                rel="noopener"
            >
                <i class="bi bi-whatsapp"></i>
                Tanya via WhatsApp
            </a>

        </div>

    </div>

</section>

@endsection


@section('scripts')

<script>

// =========================
// FILTER + SEARCH LOGIC
// =========================

const items = document.querySelectorAll('.menu-item');
const filterBtns = document.querySelectorAll('.filter-btn');
const searchInput = document.getElementById('searchInput');
const noResults = document.getElementById('noResults');

let activeCategory = 'all';


function filterMenus() {

    const q = searchInput.value.toLowerCase().trim();

    let count = 0;


    items.forEach(item => {

        const matchCat =
            activeCategory === 'all' ||
            item.dataset.cat === activeCategory;

        const matchSearch =
            q === '' ||
            item.dataset.name.includes(q);

        const show =
            matchCat &&
            matchSearch;


        item.style.display =
            show ? '' : 'none';


        if (show) {
            count++;
        }

    });


    noResults.classList.toggle(
        'd-none',
        count > 0
    );

}


filterBtns.forEach(btn => {

    btn.addEventListener('click', () => {

        filterBtns.forEach(b => {
            b.classList.remove('active');
        });


        btn.classList.add('active');


        activeCategory =
            btn.dataset.cat;


        filterMenus();

    });

});


searchInput.addEventListener(
    'input',
    filterMenus
);

</script>

@endsection