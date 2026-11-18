<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - BookStore</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            --red: #ed1025;
            --black: #090909;
            --panel: #141414;
            --white: #f8f7f2;
            --muted: #aaa7a3;
            --line: rgba(255,255,255,.13);
            --heading: 'Barlow Condensed', sans-serif;
            --body: 'Inter', Arial, sans-serif;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

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
            z-index: -1;
            pointer-events: none;
            opacity: .16;
            background-image: radial-gradient(#fff .7px, transparent .7px);
            background-size: 22px 22px;
        }

        a { color: inherit; text-decoration: none; }

        .top-line {
            height: 5px;
            background: var(--red);
        }

        .container {
            width: min(1180px, calc(100% - 48px));
            margin: auto;
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
            font-weight: 900;
        }

        .brand span:last-child { color: var(--red); }

        .brand span:last-child span { color: var(--white); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 27px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-links a { transition: color .2s; }
        .nav-links a:hover,
        .nav-links a.active { color: var(--red); }

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
        .btn-red { background: var(--red); color: white; }
        .btn-red:hover { background: #ff263a; }

        .btn-outline {
            border: 1px solid white;
            color: white;
            background: transparent;
            clip-path: none;
        }

        .btn-outline:hover { background: white; color: black; }

        .menu-toggle {
            display: none;
            background: var(--red);
            border: 0;
            color: white;
            padding: 10px 13px;
            font-weight: 900;
            cursor: pointer;
        }

        .content {
            width: min(1050px, calc(100% - 40px));
            margin: auto;
            padding: 95px 0 110px;
        }

        .eyebrow {
            color: var(--red);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 4px;
        }

        h1 {
            margin: 15px 0 25px;
            font-family: var(--heading);
            font-size: clamp(65px, 11vw, 115px);
            line-height: .9;
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
        }

        h1 span { color: var(--red); }

        .intro {
            max-width: 720px;
            color: #c5c2bd;
            font-size: 16px;
            line-height: 1.9;
        }

        .about-panel {
            margin-top: 55px;
            padding: 45px;
            background: var(--panel);
            border-left: 6px solid var(--red);
            position: relative;
            overflow: hidden;
        }

        .about-panel::after {
            content: 'B';
            position: absolute;
            right: 15px;
            bottom: -85px;
            color: rgba(255,255,255,.035);
            font-family: var(--heading);
            font-size: 260px;
            font-weight: 900;
            pointer-events: none;
        }

        h2 {
            margin: 0 0 18px;
            font-family: var(--heading);
            font-size: 38px;
            text-transform: uppercase;
        }

        .about-panel p {
            max-width: 760px;
            color: var(--muted);
            line-height: 1.9;
            position: relative;
            z-index: 1;
        }

        .values {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 25px;
        }

        .value-card {
            padding: 25px;
            background: #111;
            border: 1px solid var(--line);
            transition: transform .25s, border-color .25s;
        }

        .value-card:hover {
            transform: translateY(-5px);
            border-color: var(--red);
        }

        .value-card strong {
            display: block;
            margin-bottom: 12px;
            color: var(--red);
            font-family: var(--heading);
            font-size: 25px;
            text-transform: uppercase;
        }

        .value-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

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

        @media (max-width: 900px) {
            .nav-links { gap: 14px; font-size: 10px; }
            .nav-actions .btn { padding: 11px 13px; }
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
            .content { padding: 65px 0 75px; }
            .about-panel { padding: 28px 22px; }
            .values { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 28px; }
            .footer-grid > div:first-child { grid-column: 1 / -1; }
            .copyright { flex-direction: column; }
        }

        @media (max-width: 380px) {
            .footer-grid { grid-template-columns: 1fr; }
        }
    
/* PERSONA 5 BACKGROUND - DISAMAKAN DENGAN CART */
/* BACKGROUND DOT PATTERN - SAME AS HOME */
    body::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -2;
        pointer-events: none;
        opacity: .16;
        background-image: radial-gradient(#fff 0.7px, transparent 0.7px);
        background-size: 22px 22px;
    }

/* PERSONA 5 - FLOATING BACKGROUND EMBLEM */
body::after {
    content: "Ã¢â„¢â€º";
    position: fixed;
    z-index: -1;
    right: 5%;
    top: 24%;
    font-family: Georgia, serif;
    font-size: clamp(180px, 30vw, 390px);
    font-weight: 900;
    color: rgba(237, 28, 36, .055);
    text-shadow:
        0 0 35px rgba(237, 28, 36, .12),
        0 0 80px rgba(237, 28, 36, .07);
    pointer-events: none;
    animation: phantomFloat 9s ease-in-out infinite;
}

@keyframes phantomFloat {
    0%, 100% {
        transform: translateY(0) rotate(-8deg) scale(1);
        opacity: .55;
    }
    50% {
        transform: translateY(-22px) rotate(5deg) scale(1.04);
        opacity: 1;
    }
}

body {
    background-image:
        radial-gradient(ellipse at 85% 35%, rgba(237,28,36,.09), transparent 38%),
        repeating-linear-gradient(135deg, transparent 0, transparent 35px, rgba(255,255,255,.012) 36px, transparent 37px);
}

@media (prefers-reduced-motion: reduce) {
    body::after {
        animation: none;
    }
}
</style>
</head>
<body>
    @include('partials.user-navbar')

    <main class="content">
        <div class="eyebrow">GET TO KNOW US</div>
        <h1>ABOUT <span>BOOKSTORE</span></h1>

        <p class="intro">
            BookStore adalah platform toko buku online yang menyediakan
            berbagai pilihan bacaan untuk menemani perjalanan belajar,
            mencari inspirasi, dan menikmati cerita baru.
        </p>

        <section class="about-panel">
            <h2>Our Story</h2>
            <p>
                Kami percaya bahwa setiap buku memiliki cerita dan pengetahuan
                yang dapat membuka perspektif baru. Melalui BookStore, kami
                ingin membantu pembaca menemukan buku yang sesuai dengan
                minat dan kebutuhan mereka melalui pengalaman belanja yang
                mudah, nyaman, dan praktis.
            </p>
        </section>

        <section class="values">
            <div class="value-card">
                <strong>Our Mission</strong>
                <p>Memudahkan siapa saja menemukan dan mendapatkan buku berkualitas.</p>
            </div>
            <div class="value-card">
                <strong>Our Vision</strong>
                <p>Menjadi toko buku online yang mendukung budaya membaca dan belajar.</p>
            </div>
            <div class="value-card">
                <strong>Our Values</strong>
                <p>Kemudahan, kenyamanan, pelayanan, dan kecintaan terhadap literasi.</p>
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
                <span>YOUR STORY. YOUR JOURNEY.</span>
            </div>
        </div>
    </footer>

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
    </script>
    @include('partials.music-player')
</body>
</html>
