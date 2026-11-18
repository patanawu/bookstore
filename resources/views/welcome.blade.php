@php
    $featuredBooks = \App\Models\Book::with(['author', 'genre'])
        ->orderByDesc('id')
        ->take(6)
        ->get();

    $genres = \App\Models\Genre::orderBy('name')->take(8)->get();

    $heroBook = $featuredBooks->first();

    $coverUrl = function ($book) {
        if (!$book || !$book->cover_photo) {
            return null;
        }

        return \Illuminate\Support\Str::startsWith(
            $book->cover_photo,
            ['http://', 'https://']
        )
            ? $book->cover_photo
            : asset('storage/' . ltrim($book->cover_photo, '/'));
    };
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#090909">
    <meta name="description" content="BookStore - Temukan buku favoritmu dan mulai petualangan membaca.">
    <title>BookStore &mdash; Your Next Chapter</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --red: #ed1025;
            --red-dark: #a90013;
            --black: #090909;
            --panel: #141414;
            --white: #f8f7f2;
            --muted: #aaa7a3;
            --line: rgba(255,255,255,.13);
            --heading: 'Barlow Condensed', Impact, sans-serif;
            --body: 'Inter', Arial, sans-serif;
        }

        * { box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        body {
            margin: 0;
            background: var(--black);
            color: var(--white);
            font-family: var(--body);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -2;
            pointer-events: none;
            opacity: .16;
            background-image:
                radial-gradient(#fff 0.7px, transparent 0.7px);
            background-size: 22px 22px;
        }

        a { color: inherit; text-decoration: none; }
        button { font: inherit; }

        .container {
            width: min(1180px, calc(100% - 48px));
            margin: auto;
        }

        .top-line {
            height: 5px;
            background: var(--red);
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(9,9,9,.93);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
        }

        .nav-inner {
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: var(--heading);
            font-size: 31px;
            font-weight: 900;
            letter-spacing: -1px;
            transform: skew(-7deg);
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            background: var(--red);
            color: white;
            font-family: var(--heading);
            font-size: 25px;
            clip-path: polygon(15% 0,100% 0,85% 100%,0 85%);
        }

        .brand span:last-child {
            color: var(--red);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 27px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-links a {
            transition: color .2s;
        }

        .nav-links a:hover { color: var(--red); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 21px;
            border: 0;
            cursor: pointer;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 1px;
            text-transform: uppercase;
            clip-path: polygon(0 0,100% 0,100% 78%,91% 100%,0 100%);
            transition: transform .2s, background .2s;
        }

        .btn:hover { transform: translateY(-3px) skew(-2deg); }

        .btn-red {
            background: var(--red);
            color: white;
        }

        .btn-red:hover { background: #ff263a; }

        .btn-outline {
            border: 1px solid white;
            color: white;
            background: transparent;
            clip-path: none;
        }

        .btn-outline:hover {
            background: white;
            color: black;
        }

        .menu-toggle {
            display: none;
            background: var(--red);
            border: 0;
            color: white;
            padding: 10px 13px;
            font-weight: 900;
            cursor: pointer;
        }

        /* HERO */
        .hero {
            min-height: 680px;
            position: relative;
            display: flex;
            align-items: center;
            isolation: isolate;
            overflow: hidden;
            border-bottom: 1px solid var(--line);
        }

        .hero::before {
            content: "";
            position: absolute;
            z-index: -1;
            width: 70%;
            height: 115%;
            right: -17%;
            top: -5%;
            background: var(--red);
            clip-path: polygon(23% 0,100% 12%,83% 30%,100% 48%,78% 61%,95% 79%,48% 100%,37% 78%,0 66%,19% 48%,0 30%);
            transform: rotate(-7deg);
        }

        .hero::after {
            content: "\2605";
            position: absolute;
            right: 7%;
            top: 12%;
            color: white;
            font-size: 65px;
            transform: rotate(15deg);
            text-shadow: 5px 5px 0 var(--black);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            align-items: center;
            gap: 40px;
            padding-top: 70px;
            padding-bottom: 80px;
        }

        .eyebrow {
            display: inline-block;
            padding: 8px 13px;
            background: white;
            color: black;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 2px;
            transform: skew(-9deg) rotate(-2deg);
        }

        .hero h1 {
            margin: 24px 0 15px;
            font-family: var(--heading);
            font-size: clamp(68px, 9vw, 126px);
            font-weight: 900;
            line-height: .78;
            letter-spacing: -4px;
            text-transform: uppercase;
            font-style: italic;
            text-shadow: 5px 5px 0 var(--red);
        }

        .hero h1 span {
            display: block;
            color: var(--red);
            -webkit-text-stroke: 1px white;
            text-shadow: 5px 5px 0 white;
        }

        .hero-copy {
            max-width: 480px;
            color: #c8c5c2;
            font-size: 14px;
            line-height: 1.9;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .hero-note {
            margin-top: 35px;
            color: #777;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 3px;
        }

        .hero-art {
            min-height: 460px;
            position: relative;
            display: grid;
            place-items: center;
        }

        .hero-burst {
            position: absolute;
            width: min(430px, 90%);
            aspect-ratio: 1;
            background: var(--black);
            border: 7px solid white;
            clip-path: polygon(50% 0,60% 14%,78% 4%,78% 23%,100% 25%,86% 43%,100% 59%,80% 68%,91% 91%,65% 83%,50% 100%,37% 83%,11% 94%,19% 68%,0 56%,17% 40%,5% 19%,33% 23%);
            transform: rotate(-8deg);
            box-shadow: 15px 15px 0 rgba(0,0,0,.4);
        }

        .hero-cover {
            position: relative;
            z-index: 2;
            width: min(260px, 62%);
            height: 355px;
            object-fit: cover;
            background: #222;
            border: 7px solid white;
            box-shadow: 17px 18px 0 var(--black), 25px 26px 0 var(--red);
            transform: rotate(7deg);
            transition: transform .4s;
        }

        .hero-cover:hover { transform: rotate(0) scale(1.04); }

        .hero-placeholder {
            position: relative;
            z-index: 2;
            width: 245px;
            height: 330px;
            display: grid;
            place-items: center;
            background: var(--panel);
            border: 7px solid white;
            box-shadow: 17px 18px 0 var(--black), 25px 26px 0 var(--red);
            transform: rotate(7deg);
            font-family: var(--heading);
            font-size: 50px;
            font-weight: 900;
            text-align: center;
        }

        .hero-sticker {
            position: absolute;
            z-index: 3;
            right: 2%;
            bottom: 12%;
            padding: 13px 20px;
            background: var(--red);
            border: 3px solid white;
            color: white;
            font-family: var(--heading);
            font-size: 27px;
            font-weight: 900;
            transform: rotate(-8deg);
            box-shadow: 5px 5px 0 black;
        }

        .hero-star {
            position: absolute;
            color: white;
            font-size: 38px;
        }

        .star-one { left: 4%; top: 14%; }
        .star-two { right: 6%; top: 4%; font-size: 24px; }

        /* TICKER */
        .ticker {
            overflow: hidden;
            background: var(--red);
            border-top: 3px solid white;
            border-bottom: 3px solid white;
            transform: rotate(-1deg) scale(1.02);
        }

        .ticker-track {
            display: flex;
            width: max-content;
            gap: 35px;
            padding: 13px 0;
            animation: ticker 28s linear infinite;
            font-family: var(--heading);
            font-size: 25px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .ticker-track span:nth-child(even) { color: black; }

        @keyframes ticker {
            to { transform: translateX(-50%); }
        }

        /* SECTION */
        .section {
            position: relative;
            padding: 105px 0;
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 42px;
        }

        .section-kicker {
            color: var(--red);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .section-title {
            margin: 8px 0 0;
            font-family: var(--heading);
            font-size: clamp(44px, 7vw, 76px);
            line-height: .9;
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
        }

        .section-title span { color: var(--red); }

        .section-description {
            max-width: 390px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        /* BOOKS */
        .books-section {
            background:
                linear-gradient(120deg, transparent 0 72%, rgba(237,16,37,.08) 72% 74%, transparent 74%);
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .book-card {
            position: relative;
            padding: 17px;
            background: #171717;
            border: 1px solid #393939;
            transition: transform .25s, border-color .25s;
            clip-path: polygon(0 0,100% 0,100% 94%,93% 100%,0 100%);
        }

        .book-card:nth-child(2n) { transform: translateY(22px) rotate(1deg); }
        .book-card:nth-child(3n) { transform: rotate(-1deg); }
        .book-card:hover {
            transform: translateY(-9px) rotate(0);
            border-color: var(--red);
        }

        .book-image-wrap {
            height: 265px;
            display: grid;
            place-items: center;
            overflow: hidden;
            background: #242424;
            border: 2px solid #333;
            position: relative;
        }

        .book-image-wrap::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: linear-gradient(145deg, transparent 55%, rgba(237,16,37,.2));
        }

        .book-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 12px;
            transition: transform .4s;
        }

        .book-card:hover .book-image { transform: scale(1.07) rotate(-2deg); }

        .book-no {
            position: absolute;
            z-index: 2;
            top: 12px;
            left: 12px;
            background: var(--red);
            color: white;
            padding: 6px 10px;
            font-family: var(--heading);
            font-size: 19px;
            font-weight: 900;
            transform: skew(-8deg);
        }

        .book-info { padding: 18px 5px 5px; }

        .book-genre {
            color: var(--red);
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .book-title {
            min-height: 52px;
            margin: 8px 0;
            font-family: var(--heading);
            font-size: 25px;
            font-weight: 800;
            text-transform: uppercase;
            line-height: 1.05;
        }

        .book-author {
            color: #999;
            font-size: 11px;
        }

        .book-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 17px;
            padding-top: 13px;
            border-top: 1px solid var(--line);
        }

        .book-price {
            color: white;
            font-size: 14px;
            font-weight: 800;
        }

        .book-arrow {
            display: grid;
            place-items: center;
            width: 36px;
            height: 32px;
            background: var(--red);
            font-size: 19px;
            font-weight: 900;
            transition: background .2s;
        }

        .book-arrow:hover { background: white; color: black; }

        .empty-books {
            grid-column: 1 / -1;
            padding: 55px 20px;
            border: 1px dashed #555;
            color: #aaa;
            text-align: center;
        }

        /* GENRES */
        .genre-section {
            background: var(--red);
            color: white;
            clip-path: polygon(0 4%,100% 0,100% 96%,0 100%);
        }

        .genre-section .section-kicker { color: #1a0000; }
        .genre-section .section-title span { color: black; }

        .genre-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .genre-card {
            min-height: 105px;
            padding: 20px;
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 10px;
            background: #111;
            border: 2px solid white;
            transform: skew(-3deg);
            transition: transform .2s, background .2s;
        }

        .genre-card:hover {
            background: white;
            color: black;
            transform: skew(-3deg) translateY(-6px);
        }

        .genre-card strong {
            font-family: var(--heading);
            font-size: 25px;
            text-transform: uppercase;
            line-height: 1;
        }

        .genre-card span {
            font-size: 23px;
            font-weight: 900;
        }

        /* PROMO */
        .promo-section {
            padding: 100px 0;
        }

        .promo-panel {
            position: relative;
            overflow: hidden;
            padding: 65px;
            background: #151515;
            border: 3px solid white;
            box-shadow: 12px 12px 0 var(--red);
            clip-path: polygon(0 0,97% 0,100% 12%,100% 100%,3% 100%,0 88%);
        }

        .promo-panel::after {
            content: "BOOK";
            position: absolute;
            right: -10px;
            bottom: -55px;
            color: rgba(237,16,37,.15);
            font-family: var(--heading);
            font-size: 190px;
            font-weight: 900;
            transform: rotate(-12deg);
            pointer-events: none;
        }

        .promo-content {
            position: relative;
            z-index: 1;
            max-width: 650px;
        }

        .promo-panel h2 {
            margin: 13px 0;
            font-family: var(--heading);
            font-size: clamp(45px, 7vw, 75px);
            line-height: .9;
            text-transform: uppercase;
            font-style: italic;
        }

        .promo-panel h2 span { color: var(--red); }

        .promo-panel p {
            max-width: 510px;
            color: #aaa;
            font-size: 13px;
            line-height: 1.9;
        }

        /* FOOTER */
        footer {
            padding: 55px 0 25px;
            background: #050505;
            border-top: 5px solid var(--red);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 40px;
            padding-bottom: 40px;
        }

        .footer-about {
            max-width: 350px;
            color: #888;
            font-size: 12px;
            line-height: 1.9;
        }

        .footer-heading {
            margin-bottom: 17px;
            font-family: var(--heading);
            font-size: 22px;
            text-transform: uppercase;
        }

        .footer-links {
            display: grid;
            gap: 12px;
            color: #999;
            font-size: 12px;
        }

        .footer-links a:hover { color: var(--red); }

        .copyright {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding-top: 22px;
            border-top: 1px solid var(--line);
            color: #666;
            font-size: 10px;
        }

        .flash {
            margin: 15px auto;
            padding: 13px 18px;
            background: #123d24;
            border-left: 4px solid #35d477;
            color: white;
            font-size: 13px;
        }

        .reveal {
            opacity: 0;
            transform: translateY(25px);
            transition: opacity .65s ease, transform .65s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 900px) {
            .nav-links { gap: 14px; font-size: 10px; }
            .nav-actions .btn { padding: 11px 13px; }
            .hero-grid { grid-template-columns: 1fr  .85fr; }
            .hero h1 { font-size: clamp(65px, 10vw, 95px); }
            .book-grid { grid-template-columns: repeat(2, 1fr); }
            .genre-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 680px) {
            .container { width: min(100% - 32px, 520px); }
            .nav-inner { min-height: 67px; }
            .brand { font-size: 27px; }
            .menu-toggle { display: block; }
            .nav-links {
                display: none;
                position: absolute;
                top: 67px;
                left: 0;
                right: 0;
                padding: 20px 24px;
                background: #101010;
                border-bottom: 2px solid var(--red);
                flex-direction: column;
                align-items: stretch;
                gap: 0;
            }
            .nav-links.open { display: flex; }
            .nav-links a { padding: 14px 0; border-bottom: 1px solid var(--line); }
            .nav-actions .btn-outline { display: none; }
            .nav-actions .btn { padding: 10px 12px; font-size: 9px; }
            .hero { min-height: auto; }
            .hero::before { width: 100%; height: 48%; top: auto; bottom: -8%; right: -30%; }
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 10px;
                padding-top: 65px;
                padding-bottom: 65px;
            }
            .hero h1 { font-size: clamp(68px, 17vw, 100px); }
            .hero-copy { font-size: 12px; }
            .hero-art { min-height: 370px; }
            .hero-cover { width: 205px; height: 285px; }
            .hero-placeholder { width: 205px; height: 285px; }
            .hero-burst { width: 330px; }
            .hero-sticker { right: 2%; bottom: 7%; }
            .section { padding: 75px 0; }
            .section-heading { align-items: start; flex-direction: column; margin-bottom: 28px; }
            .section-description { font-size: 11px; }
            .book-grid { gap: 13px; }
            .book-card { padding: 9px; }
            .book-image-wrap { height: 190px; }
            .book-title { font-size: 21px; min-height: 45px; }
            .book-price { font-size: 11px; }
            .book-author { font-size: 9px; }
            .genre-grid { gap: 9px; }
            .genre-card { min-height: 85px; padding: 13px; }
            .genre-card strong { font-size: 21px; }
            .promo-panel { padding: 38px 24px; }
            .promo-panel::after { font-size: 100px; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 28px; }
            .footer-grid > div:first-child { grid-column: 1 / -1; }
            .copyright { flex-direction: column; }
        }

        @media (max-width: 380px) {
            .book-grid { grid-template-columns: 1fr; }
            .book-image-wrap { height: 260px; }
            .hero-buttons .btn { padding: 12px 14px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>
    <div class="top-line"></div>

    <header class="navbar">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark">B</span>
                <span>BOOK<span>STORE</span></span>
            </a>

            <nav class="nav-links" id="navLinks">
                <a href="{{ route('home') }}">Home</a>
                <a href="#koleksi">Koleksi</a>
                <a href="#genre">Genre</a>
                <a href="{{ route('catalog.index') }}">Katalog</a>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('orders.index') }}">Pesanan</a>
                        <a href="{{ route('cart.index') }}">Keranjang</a>
                    @endif
                @endauth
            </nav>

            <div class="nav-actions">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a class="btn btn-outline" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-red" type="submit">Logout</button>
                        </form>
                    @else
                        <a class="btn btn-outline" href="{{ route('cart.index') }}">Keranjang</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-red" type="submit">Logout</button>
                        </form>
                    @endif
                @else
                    <a class="btn btn-outline" href="{{ route('login') }}">Masuk</a>
                    <a class="btn btn-red" href="{{ route('register') }}">Daftar</a>
                @endauth

                <button class="menu-toggle" id="menuToggle" type="button" aria-label="Buka menu">&#9776;</button>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="container">
            <div class="flash">{{ session('success') }}</div>
        </div>
    @endif

    <main>
        <section class="hero">
            <div class="container hero-grid">
                <div class="hero-content">
                    <span class="eyebrow">WELCOME TO YOUR NEXT CHAPTER</span>

                    <h1>
                        READ
                        <span>YOUR</span>
                        STORY.
                    </h1>

                    <p class="hero-copy">
                        Setiap buku punya dunia untuk dijelajahi.
                        Temukan cerita, pengetahuan, dan inspirasi
                        yang menunggu untuk menjadi bagian dari perjalananmu.
                    </p>

                    <div class="hero-buttons">
                        <a href="{{ route('catalog.index') }}" class="btn btn-red">
                            Jelajahi Buku <span>&#8599;</span>
                        </a>
                        <a href="#koleksi" class="btn btn-outline">Lihat Koleksi</a>
                    </div>

                    <div class="hero-note">TURN THE PAGE. CHANGE THE WORLD. &#9733;</div>
                </div>

                <div class="hero-art">
                    <div class="hero-burst"></div>
                    <span class="hero-star star-one">&#10022;</span>
                    <span class="hero-star star-two">&#9733;</span>

                    @if($heroBook && $coverUrl($heroBook))
                        <img
                            class="hero-cover"
                            src="{{ $coverUrl($heroBook) }}"
                            alt="Cover {{ $heroBook->title }}"
                        >
                    @else
                        <div class="hero-placeholder">BOOK<br>STORE</div>
                    @endif

                    <div class="hero-sticker">READ IT NOW!</div>
                </div>
            </div>
        </section>

        <div class="ticker" aria-label="BookStore">
            <div class="ticker-track">
                <span>DISCOVER NEW STORIES</span><span>&#9733;</span>
                <span>READ MORE</span><span>&#10022;</span>
                <span>FIND YOUR NEXT BOOK</span><span>&#9733;</span>
                <span>DISCOVER NEW STORIES</span><span>&#9733;</span>
                <span>READ MORE</span><span>&#10022;</span>
                <span>FIND YOUR NEXT BOOK</span><span>&#9733;</span>
            </div>
        </div>

        <section class="section books-section" id="koleksi">
            <div class="container">
                <div class="section-heading reveal">
                    <div>
                        <div class="section-kicker">/// HANDPICKED FOR YOU</div>
                        <h2 class="section-title">FEATURED <span>BOOKS.</span></h2>
                    </div>
                    <div>
                        <p class="section-description">
                            Temukan koleksi buku pilihan yang siap menemani
                            waktu membaca dan memperluas wawasanmu.
                        </p>
                        <a href="{{ route('catalog.index') }}" class="btn btn-red">
                            Semua Buku &#8599;
                        </a>
                    </div>
                </div>

                <div class="book-grid">
                    @forelse($featuredBooks as $index => $book)
                        <article class="book-card reveal">
                            <span class="book-no">0{{ $index + 1 }}</span>

                            <a href="{{ route('catalog.show', $book) }}">
                                <div class="book-image-wrap">
                                    @if($coverUrl($book))
                                        <img
                                            class="book-image"
                                            src="{{ $coverUrl($book) }}"
                                            alt="Cover {{ $book->title }}"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="hero-placeholder" style="width:130px;height:180px;font-size:25px;">
                                            BOOK
                                        </div>
                                    @endif
                                </div>
                            </a>

                            <div class="book-info">
                                <div class="book-genre">
                                    {{ $book->genre->name ?? 'COLLECTION' }}
                                </div>

                                <h3 class="book-title">{{ $book->title }}</h3>

                                <div class="book-author">
                                    {{ $book->author->name ?? 'BookStore Collection' }}
                                </div>

                                <div class="book-bottom">
                                    <div class="book-price">
                                        Rp {{ number_format((float) $book->price, 0, ',', '.') }}
                                    </div>
                                    <a
                                        class="book-arrow"
                                        href="{{ route('catalog.show', $book) }}"
                                        aria-label="Lihat {{ $book->title }}"
                                    >&#8599;</a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="empty-books">
                            <h3>KOLEKSI SEDANG DISIAPKAN</h3>
                            <p>Buku akan tampil di sini setelah tersedia di katalog.</p>
                            <a href="{{ route('catalog.index') }}" class="btn btn-red">Buka Katalog</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="section genre-section" id="genre">
            <div class="container">
                <div class="section-heading reveal">
                    <div>
                        <div class="section-kicker">/// CHOOSE YOUR ADVENTURE</div>
                        <h2 class="section-title">PICK YOUR <span>GENRE.</span></h2>
                    </div>
                    <p class="section-description" style="color:#ffe0e2;">
                        Dari cerita penuh petualangan sampai pengetahuan baru.
                        Pilih dunia yang ingin kamu jelajahi.
                    </p>
                </div>

                <div class="genre-grid">
                    @forelse($genres as $genre)
                        <a href="{{ route('catalog.index') }}" class="genre-card reveal">
                            <strong>{{ $genre->name }}</strong>
                            <span>&#8599;</span>
                        </a>
                    @empty
                        <div class="empty-books">
                            Belum ada kategori genre.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="promo-section">
            <div class="container">
                <div class="promo-panel reveal">
                    <div class="promo-content">
                        <div class="section-kicker">/// THIS IS YOUR SIGN</div>
                        <h2>YOUR NEXT<br><span>CHAPTER</span> STARTS HERE.</h2>
                        <p>
                            Jangan biarkan cerita menarik hanya menjadi daftar keinginan.
                            Temukan buku favoritmu, pilih koleksimu, dan mulai perjalanan
                            membaca yang baru bersama BookStore.
                        </p>
                        <a href="{{ route('catalog.index') }}" class="btn btn-red">
                            Explore Collection &#8599;
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <a href="{{ route('home') }}" class="brand">
                        <span class="brand-mark">B</span>
                        <span>BOOK<span>STORE</span></span>
                    </a>
                    <p class="footer-about">
                        BookStore adalah tempat untuk menemukan cerita,
                        pengetahuan, dan inspirasi melalui koleksi buku pilihan.
                        Mulai petualangan membaca kamu bersama kami.
                    </p>
                </div>

                <div>
                    <div class="footer-heading">Explore</div>
                    <div class="footer-links">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('catalog.index') }}">Katalog Buku</a>
                        <a href="{{ route('about') }}">About Us</a>
                        <a href="{{ route('contact.create') }}">Contact Admin</a>
                        <a href="#koleksi">Buku Unggulan</a>
                        <a href="#genre">Kategori</a>
                    </div>
                </div>

                <div>
                    <div class="footer-heading">Account</div>
                    <div class="footer-links">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                            @else
                                <a href="{{ route('cart.index') }}">Keranjang</a>
                                <a href="{{ route('orders.index') }}">Riwayat Pesanan</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Registrasi</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="copyright">
                <span>&copy; {{ date('Y') }} BOOKSTORE. ALL RIGHTS RESERVED.</span>
                <span>YOUR STORY. YOUR JOURNEY. &#9733;</span>
            </div>
        </div>
    </footer>

    @include('partials.music-player')

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');

        menuToggle?.addEventListener('click', () => {
            navLinks.classList.toggle('open');
        });

        navLinks?.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('open');
            });
        });

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach((element) => {
            revealObserver.observe(element);
        });
    </script>
</body>
</html>
