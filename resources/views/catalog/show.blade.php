
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - BookStore</title>

    <style>
@import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800;900&display=swap');

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

body {
    margin: 0;
    font-family: var(--body);
    background:
        radial-gradient(ellipse at 85% 20%, rgba(120,0,12,.16), transparent 35%),
        var(--black);
    color: var(--white);
    overflow-x: hidden;
}

/* NAVBAR SAMA DENGAN HOME */
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

.navbar .container {
    width: min(1180px, calc(100% - 48px));
    max-width: none;
    margin: auto;
    padding: 0;
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
    color: var(--red);
    font-family: var(--heading);
    font-size: 31px;
    font-weight: 900;
    letter-spacing: -1px;
    text-decoration: none;
    transform: skew(-7deg);
}

.brand > span:last-child,
.brand > span:last-child span {
    color: var(--red);
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
    color: var(--white);
    text-decoration: none;
    transition: color .2s;
}

.nav-links a:hover { color: var(--red); }

.nav-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.nav-actions form { margin: 0; }

.nav-actions .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 13px 21px;
    border: 0;
    cursor: pointer;
    font-family: var(--body);
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0,100% 0,100% 78%,91% 100%,0 100%);
    transition: .2s;
}

.nav-actions .btn:hover {
    transform: translateY(-3px) skew(-2deg);
}

.btn-outline {
    background: transparent;
    color: white;
    border: 1px solid var(--line) !important;
}

.btn-red {
    background: var(--red);
    color: white;
}

.menu-toggle {
    display: none;
    background: var(--red);
    color: white;
    border: 0;
    padding: 9px 12px;
    font-size: 20px;
    cursor: pointer;
}

/* KONTEN DETAIL */
.container {
    max-width: 1100px;
    margin: 42px auto;
    padding: 0 22px;
}

.back {
    display: inline-block;
    margin-bottom: 25px;
    color: var(--white);
    font-size: 12px;
    font-weight: 800;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: .2s;
}

.back:hover {
    color: var(--red);
    transform: translateX(-5px);
}

/* NOTIFIKASI */
.message {
    padding: 15px 18px;
    margin-bottom: 18px;
    background: #123b26;
    color: #b7f7cf;
    border-left: 5px solid #22c55e;
    font-size: 13px;
}

.message.error {
    background: #3d1117;
    color: #ffc2c8;
    border-left-color: var(--red);
}

/* PANEL UTAMA */
.detail {
    position: relative;
    display: grid;
    grid-template-columns: minmax(260px, 380px) 1fr;
    gap: 42px;
    padding: 35px;
    background: var(--panel);
    border: 1px solid var(--line);
    border-top: 5px solid var(--red);
    box-shadow: 10px 10px 0 rgba(0,0,0,.35);
    overflow: hidden;
}

.detail::before {
    content: "BOOKSTORE";
    position: absolute;
    right: -15px;
    top: 0;
    color: rgba(255,255,255,.025);
    font-family: var(--heading);
    font-size: clamp(70px, 13vw, 150px);
    font-weight: 900;
    font-style: italic;
    pointer-events: none;
}

.detail > div {
    position: relative;
    z-index: 1;
    min-width: 0;
}

/* COVER */
.detail > div:first-child {
    padding: 10px;
    background: #090909;
    border: 1px solid var(--line);
    box-shadow: 8px 8px 0 var(--red);
}

.cover {
    display: block;
    width: 100%;
    height: 480px;
    object-fit: contain;
    background: #101010;
}

.no-cover {
    height: 480px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #202020;
    color: white;
    font-family: var(--heading);
    font-size: 25px;
    font-weight: 900;
    text-transform: uppercase;
    border: 1px dashed #555;
}

/* INFORMASI BUKU */
.detail h1 {
    margin: 0 0 22px;
    color: white;
    font-family: var(--heading);
    font-size: clamp(38px, 5vw, 58px);
    font-weight: 900;
    line-height: .98;
    text-transform: uppercase;
    font-style: italic;
    overflow-wrap: anywhere;
}

.detail h1::after {
    content: "";
    display: block;
    width: 75px;
    height: 5px;
    margin-top: 15px;
    background: var(--red);
}

.muted {
    color: var(--muted);
    font-size: 13px;
    line-height: 1.8;
}

.price {
    margin: 24px 0;
    color: var(--red);
    font-size: 29px;
    font-weight: 900;
}

.stock {
    padding: 15px 18px;
    margin: 20px 0;
    background: #202020;
    border-left: 5px solid var(--red);
    color: var(--white);
    font-size: 13px;
}

.stock strong { color: #ff5260; }

.detail h3 {
    margin-top: 27px;
    color: white;
    font-family: var(--heading);
    font-size: 25px;
    text-transform: uppercase;
}

.detail h3::after {
    content: "";
    display: block;
    width: 40px;
    height: 3px;
    margin-top: 7px;
    background: var(--red);
}

.detail h3 + .muted {
    padding: 16px;
    background: #101010;
    border: 1px solid var(--line);
}

/* FORM KERANJANG */
.cart-form {
    margin-top: 25px;
    padding: 20px;
    background: #101010;
    border: 1px solid var(--line);
    border-left: 4px solid var(--red);
}

.cart-form label {
    display: block;
    margin-bottom: 12px;
    color: white;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.cart-form input {
    width: 85px;
    min-height: 45px;
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #555;
    border-radius: 0;
    outline: none;
    background: #202020;
    color: white;
    font-size: 14px;
}

.cart-form input:focus {
    border-color: var(--red);
}

.button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 14px 20px;
    border: 0;
    border-radius: 0;
    background: var(--red);
    color: white;
    font-family: var(--body);
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    cursor: pointer;
    clip-path: polygon(0 0,100% 0,100% 78%,91% 100%,0 100%);
    transition: .2s;
}

.button:hover {
    background: white;
    color: var(--red);
    transform: translateY(-3px);
}

.stock-empty {
    padding: 15px;
    background: #3d1117;
    color: #ff9ca5;
    border-left: 5px solid var(--red);
    font-weight: 800;
}

/* RESPONSIVE */
@media(max-width: 900px) {
    .nav-links {
        gap: 14px;
        font-size: 10px;
    }

    .nav-actions .btn {
        padding: 11px 13px;
    }

    .detail {
        gap: 28px;
        padding: 25px;
        grid-template-columns: minmax(220px, 320px) 1fr;
    }
}

@media(max-width: 680px) {
    .navbar .container {
        width: calc(100% - 32px);
    }

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

    .nav-links a {
        padding: 14px 0;
        border-bottom: 1px solid var(--line);
    }

    .nav-actions .btn-outline { display: none; }

    .nav-actions .btn {
        padding: 10px 12px;
        font-size: 9px;
    }

    .container {
        margin-top: 28px;
        padding: 0 16px;
    }

    .detail {
        grid-template-columns: 1fr;
        padding: 20px;
        gap: 30px;
    }

    .cover,
    .no-cover {
        height: 390px;
    }

    .detail h1 { font-size: 42px; }

    .cart-form input {
        margin-bottom: 12px;
    }
}

@media(max-width: 380px) {
    .cover,
    .no-cover {
        height: 320px;
    }

    .detail { padding: 15px; }
}
    
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

/* =====================================
   PERSONA 5 - BOOK DETAIL ENHANCEMENT
   Tombol dan form keranjang tidak diubah
===================================== */

/* Background dengan aksen merah */
body {
    background-image:
        radial-gradient(ellipse at 12% 35%, rgba(237,16,37,.12), transparent 35%),
        radial-gradient(ellipse at 88% 75%, rgba(237,16,37,.09), transparent 38%),
        repeating-linear-gradient(
            135deg,
            transparent 0,
            transparent 42px,
            rgba(255,255,255,.018) 43px,
            transparent 45px
        );
    background-attachment: fixed;
}

/* Panel detail */
.detail {
    overflow: hidden;
    isolation: isolate;
    border: 1px solid rgba(237,16,37,.45);
    box-shadow:
        0 0 0 4px rgba(237,16,37,.035),
        0 18px 55px rgba(0,0,0,.45),
        8px 8px 0 rgba(237,16,37,.22);
    animation: personaDetailIn .8s ease both;
}

/* Watermark dekoratif */
.detail::after {
    content: "PHANTOM";
    position: absolute;
    z-index: 0;
    right: -25px;
    bottom: 5px;
    font-family: var(--heading);
    font-size: clamp(65px, 12vw, 145px);
    font-weight: 900;
    font-style: italic;
    letter-spacing: -5px;
    color: rgba(237,16,37,.055);
    pointer-events: none;
    transform: rotate(-8deg);
    animation: phantomDrift 9s ease-in-out infinite;
}

/* Cover buku */
.detail > div:first-child {
    position: relative;
    border: 1px solid rgba(237,16,37,.55);
    box-shadow:
        8px 8px 0 var(--red),
        0 0 25px rgba(237,16,37,.12);
    transition: box-shadow .35s ease, transform .35s ease;
}

.detail > div:first-child:hover {
    transform: translateY(-5px) rotate(-1deg);
    box-shadow:
        12px 12px 0 var(--red),
        0 0 38px rgba(237,16,37,.25);
}

.cover {
    filter: drop-shadow(0 8px 12px rgba(0,0,0,.35));
    transition: filter .35s ease, transform .35s ease;
}

.detail > div:first-child:hover .cover {
    filter: drop-shadow(0 12px 18px rgba(237,16,37,.25));
}

/* Judul buku */
.detail h1 {
    text-shadow:
        3px 3px 0 rgba(237,16,37,.65),
        0 0 22px rgba(237,16,37,.12);
}

/* Garis aksen judul */
.detail h1::after {
    box-shadow: 0 0 12px rgba(237,16,37,.65);
}

/* Panel deskripsi */
.detail h3 + .muted {
    border-left: 3px solid var(--red);
    box-shadow: inset 8px 0 18px rgba(237,16,37,.045);
    line-height: 1.8;
}

/* Animasi masuk */
@keyframes personaDetailIn {
    from {
        opacity: 0;
        transform: translateY(14px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes phantomDrift {
    0%, 100% {
        transform: translateY(0) rotate(-8deg);
        opacity: .55;
    }
    50% {
        transform: translateY(-12px) rotate(-5deg);
        opacity: 1;
    }
}

@media (prefers-reduced-motion: reduce) {
    .detail,
    .detail::after {
        animation: none;
    }
    .cover,
    .detail > div:first-child {
        transition: none;
    }
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
    <link rel='stylesheet' href='{{ asset('css/persona5-buttons.css') }}'>

</head>

<body>

@include('partials.user-navbar')

<div class="container">

    <a href="{{ route('catalog.index') }}" class="back">
        &larr; Kembali ke Katalog
    </a>

    @if(session('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="message error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="detail">

        <div>
            @if($book->cover_photo)
                <img
                    class="cover"
                    src="{{ \Illuminate\Support\Str::startsWith($book->cover_photo, ['http://', 'https://']) ? $book->cover_photo : asset('storage/' . $book->cover_photo) }}"
                    alt="{{ $book->title }}"
                >
            @else
                <div class="no-cover">Tidak ada cover</div>
            @endif
        </div>

        <div>

            <h1>{{ $book->title }}</h1>

            <p class="muted">
                Penulis:
                {{ $book->author->name ?? 'Tidak diketahui' }}
            </p>

            <p class="muted">
                Genre:
                {{ $book->genre->name ?? 'Tidak ada genre' }}
            </p>

            <p class="price">
                Rp {{ number_format($book->price, 0, ',', '.') }}
            </p>

            <div class="stock">
                Stok tersedia: <strong>{{ $book->stock }}</strong>
            </div>

            <h3>Deskripsi Buku</h3>

            <p class="muted">
                {{ $book->description ?? 'Belum ada deskripsi buku.' }}
            </p>

            @if($book->stock > 0)

                @auth
                    @if(auth()->user()->role === 'user')

                        <form
                            action="{{ route('cart.store', $book->id) }}"
                            method="POST"
                            class="cart-form"
                        >
                            @csrf

                            <label for="quantity">Jumlah Buku</label>

                            <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                value="1"
                                min="1"
                                max="{{ $book->stock }}"
                                required
                            >

                            <button type="submit" class="button">
                                Tambah ke Keranjang
                            </button>
                        </form>

                    @else
                        <p class="muted">
                            Login sebagai pelanggan untuk membeli buku.
                        </p>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="button">
                        Login untuk Membeli
                    </a>
                @endauth

            @else

                <p style="color:#dc2626;font-weight:bold;">
                    Stok buku sedang habis.
                </p>

            @endif

        </div>

    </div>

</div>

<script>
const menuToggle = document.getElementById('menuToggle');
const navLinks = document.getElementById('navLinks');

if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', function () {
        navLinks.classList.toggle('open');
    });
}
</script>
    @include('partials.music-player')
</body>
</html>


