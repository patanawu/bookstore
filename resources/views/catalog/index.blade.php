
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - BookStore</title>

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

* {
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    margin: 0;
    font-family: var(--body);
    background:
        radial-gradient(ellipse at 85% 20%, rgba(120,0,12,.16), transparent 35%),
        #090909;
    color: var(--white);
    overflow-x: hidden;
}

/* NAVBAR - mengikuti Home */
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
    padding: 0;
}

.navbar .container {
    width: min(1180px, calc(100% - 48px));
    max-width: none;
    margin: 0 auto;
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
    color: var(--white);
    font-family: var(--heading);
    font-size: 31px;
    font-weight: 900;
    letter-spacing: -1px;
    text-decoration: none;
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

.brand span:last-child span {
    color: var(--red);
}

header.navbar nav.nav-links {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    gap: 27px;
    padding: 0;
    background: transparent;
    border: 0;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.nav-links a {
    color: var(--white);
    text-decoration: none;
    font-size: 12px;
    font-weight: 800;
    transition: color .2s;
}

.nav-links a:hover {
    color: var(--red);
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.nav-actions form {
    margin: 0;
}

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
    transition: transform .2s, background .2s;
}

.nav-actions .btn:hover {
    transform: translateY(-3px) skew(-2deg);
}

.nav-actions .btn-outline {
    background: transparent;
    color: white;
    border: 1px solid var(--line);
}

.nav-actions .btn-red {
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

/* AREA KATALOG */
.container {
    max-width: 1200px;
    margin: 45px auto;
    padding: 0 22px;
    position: relative;
}

.heading {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    min-height: 205px;
    margin-bottom: 35px;
    padding: 38px 35px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background:
        linear-gradient(110deg, rgba(237,16,37,.96), rgba(105,0,12,.88) 58%, rgba(20,20,20,.9));
    border-left: 9px solid white;
    clip-path: polygon(0 0,100% 0,100% 82%,94% 100%,0 100%);
}

.heading::before {
    content: "BOOK";
    position: absolute;
    z-index: -1;
    right: 20px;
    bottom: -48px;
    font-family: var(--heading);
    font-size: clamp(100px, 20vw, 220px);
    font-weight: 900;
    font-style: italic;
    color: rgba(0,0,0,.17);
    line-height: 1;
    transform: skew(-10deg);
}

.heading::after {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    right: 25%;
    width: 10px;
    height: 130%;
    background: rgba(0,0,0,.18);
    transform: rotate(25deg);
}

.heading h1 {
    margin: 24px 0 15px;
    color: #ffffff;
    font-family: var(--heading);
    font-size: clamp(58px, 8vw, 112px);
    font-weight: 900;
    line-height: .88;
    letter-spacing: -4px;
    text-transform: uppercase;
    font-style: italic;
    transform: skew(-3deg) rotate(-1deg);
    text-shadow: 5px 5px 0 #111111, 8px 8px 0 var(--red);
}

.heading h1 span {
    display: inline-block;
    color: var(--red);
    -webkit-text-stroke: 1px white;
    text-shadow: 5px 5px 0 #111111;
    transform: skew(-2deg);
}

.muted {
    color: var(--muted);
    font-size: 13px;
}

.heading .muted {
    margin: 10px 0 0;
    color: rgba(255,255,255,.85);
    font-size: 14px;
}

/* PENCARIAN */
.search {
    position: relative;
    display: flex;
    gap: 12px;
    margin-bottom: 38px;
    padding: 20px;
    flex-wrap: wrap;
    background: #141414;
    border: 1px solid var(--line);
    border-left: 5px solid var(--red);
    box-shadow: 8px 8px 0 rgba(0,0,0,.3);
}

.search input,
.search select {
    min-height: 48px;
    padding: 13px 15px;
    border: 1px solid #414141;
    border-radius: 0;
    outline: none;
    background: #090909;
    color: white;
    font-family: var(--body);
    font-size: 13px;
}

.search input {
    flex: 1;
    min-width: 180px;
}

.search input:focus,
.search select:focus {
    border-color: var(--red);
}

.search button {
    padding: 13px 25px;
    border: 0;
    border-radius: 0;
    background: var(--red);
    color: white;
    font-family: var(--body);
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    clip-path: polygon(0 0,100% 0,100% 78%,91% 100%,0 100%);
    transition: .2s;
}

.search button:hover {
    background: var(--red-dark);
    transform: translateY(-3px);
}

/* KARTU BUKU */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
    gap: 28px;
}

.book {
    position: relative;
    overflow: hidden;
    background: #151515;
    color: var(--white);
    border: 1px solid rgba(255,255,255,.12);
    box-shadow: 7px 7px 0 rgba(237,16,37,.85);
    transition: .25s;
}

.book::before {
    content: "";
    position: absolute;
    z-index: 2;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: var(--red);
}

.book:hover {
    transform: translateY(-8px) rotate(-1deg);
    box-shadow: 11px 11px 0 var(--red);
    border-color: var(--red);
}

.cover {
    width: 100%;
    height: 270px;
    object-fit: cover;
    background: #242424;
    display: block;
    border-bottom: 3px solid var(--red);
    transition: transform .35s;
}

.book:hover .cover {
    transform: scale(1.035);
}

.no-cover {
    height: 270px;
    display: flex;
    align-items: center;
    justify-content: center;
    background:
        linear-gradient(135deg, #252525 50%, #171717 50%);
    color: white;
    font-family: var(--heading);
    font-size: 22px;
    font-weight: 800;
    text-transform: uppercase;
    border-bottom: 3px solid var(--red);
}

.book-info {
    padding: 19px;
}

.book-info h3 {
    margin: 0 0 14px;
    color: white;
    font-family: var(--heading);
    font-size: 23px;
    font-weight: 800;
    line-height: 1.05;
    text-transform: uppercase;
}

.book-info .muted {
    color: #aaa7a3;
    margin: 8px 0;
    font-size: 12px;
}

.price {
    color: #ff3042;
    font-size: 19px;
    font-weight: 900;
    margin: 17px 0 10px;
}

.detail {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-top: 7px;
    padding: 12px 19px;
    background: var(--red);
    color: white;
    text-decoration: none;
    font-size: 11px;
    font-weight: 900;
    letter-spacing: .7px;
    text-transform: uppercase;
    clip-path: polygon(0 0,100% 0,100% 78%,91% 100%,0 100%);
    transition: .2s;
}

.detail:hover {
    background: white;
    color: var(--red);
    transform: translateY(-3px);
}

/* PAGINATION DAN DATA KOSONG */
.pagination {
    margin-top: 40px;
    color: white;
}

.pagination a,
.pagination span {
    display: inline-block;
    padding: 10px 14px;
    margin: 3px;
    background: #1c1c1c;
    color: white;
    text-decoration: none;
    border: 1px solid #444;
}

.pagination .active span {
    background: var(--red);
    border-color: var(--red);
}

.empty {
    position: relative;
    background: #151515;
    padding: 55px 30px;
    text-align: center;
    border-left: 6px solid var(--red);
    border-top: 1px solid var(--line);
    border-bottom: 1px solid var(--line);
}

.empty h3 {
    color: white;
    font-family: var(--heading);
    font-size: 32px;
    text-transform: uppercase;
    font-style: italic;
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
}

@media(max-width: 680px) {
    .navbar .container {
        width: calc(100% - 32px);
    }

    .nav-inner {
        min-height: 67px;
    }

    .brand {
        font-size: 27px;
    }

    .menu-toggle {
        display: block;
    }

    header.navbar nav.nav-links {
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

    header.navbar nav.nav-links.open {
        display: flex;
    }

    .nav-links a {
        padding: 14px 0;
        border-bottom: 1px solid var(--line);
    }

    .nav-actions .btn-outline {
        display: none;
    }

    .nav-actions .btn {
        padding: 10px 12px;
        font-size: 9px;
    }

    .container {
        margin-top: 30px;
        padding: 0 16px;
    }

    .heading {
        min-height: 165px;
        padding: 25px 20px;
    }

    .search {
        padding: 13px;
    }

    .search input,
    .search select,
    .search button {
        width: 100%;
    }

    .grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .cover,
    .no-cover {
        height: 210px;
    }

    .book-info {
        padding: 13px;
    }

    .book-info h3 {
        font-size: 19px;
    }
}

@media(max-width: 380px) {
    .grid {
        grid-template-columns: 1fr;
    }

    .cover,
    .no-cover {
        height: 260px;
    }
}
/* DETAIL TAMBAHAN - PERSONA 5 STYLE */

/* BOOKSTORE full merah */
.brand > span:last-child,
.brand > span:last-child span {
    color: var(--red) !important;
}

/* Label kecil di bawah judul katalog */
.heading p::before {
    content: "BOOKSTORE COLLECTION";
    display: block;
    margin-bottom: 9px;
    color: white;
    font-size: 10px;
    font-weight: 900;
    letter-spacing: 3px;
}

/* Aksen dekoratif pada latar */
.heading {
    background-image:
        repeating-linear-gradient(
            125deg,
            transparent 0,
            transparent 48px,
            rgba(255,255,255,.035) 49px,
            rgba(255,255,255,.035) 51px
        ),
        linear-gradient(110deg, rgba(237,16,37,.96), rgba(105,0,12,.88) 58%, rgba(20,20,20,.9));
}

/* Nomor urut pada setiap kartu buku */
.grid {
    counter-reset: book-number;
}

.book {
    counter-increment: book-number;
}

.book-info::before {
    content: "BOOK NO. " counter(book-number, decimal-leading-zero);
    display: block;
    width: fit-content;
    margin-bottom: 12px;
    padding: 5px 9px;
    background: var(--red);
    color: white;
    font-size: 9px;
    font-weight: 900;
    letter-spacing: 1.5px;
    transform: skew(-7deg);
}

/* Sudut merah dekoratif pada kartu */
.book::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 42px;
    height: 42px;
    z-index: 3;
    pointer-events: none;
    background: var(--red);
    clip-path: polygon(100% 0, 100% 100%, 0 0);
}

/* Garis aksen pada judul buku */
.book-info h3 {
    position: relative;
    padding-bottom: 10px;
}

.book-info h3::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 38px;
    height: 3px;
    background: var(--red);
}

/* Efek interaksi pada kartu */
.book {
    transition: transform .25s, box-shadow .25s, border-color .25s;
}

.book:hover {
    border-color: var(--red);
}

.detail {
    position: relative;
    overflow: hidden;
}

.detail:hover {
    letter-spacing: 1px;
}

/* Aksen kecil pada area pencarian */
.search::before {
    content: "FIND YOUR NEXT STORY";
    position: absolute;
    top: -21px;
    left: 0;
    color: var(--red);
    font-size: 9px;
    font-weight: 900;
    letter-spacing: 2px;
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

/* PERSONA 5 - CATALOG VISUAL EFFECT */
.heading {
    background-image:
        repeating-linear-gradient(
            130deg,
            transparent 0px,
            transparent 24px,
            rgba(255,255,255,.045) 25px,
            transparent 27px
        ),
        linear-gradient(110deg,
            rgba(237,16,37,.97),
            rgba(105,0,12,.94) 58%,
            rgba(15,15,15,.98)
        );
    box-shadow: 8px 8px 0 #111111, 12px 12px 0 rgba(237,16,37,.45);
}

.heading h1::after {
    content: "\2726";
    display: inline-block;
    margin-left: 12px;
    color: white;
    font-size: .35em;
    vertical-align: top;
    text-shadow: 2px 2px 0 #111;
}

.heading p {
    text-shadow: 2px 2px 0 rgba(0,0,0,.55);
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

    <div class="heading">
        <h1>KATALOG <span>BUKU</span></h1>
        <p class="muted">Temukan buku favoritmu di BookStore.</p>
    </div>

    <form action="{{ route('catalog.index') }}" method="GET" class="search">

        <input
            type="text"
            name="search"
            placeholder="Cari judul buku..."
            value="{{ request('search') }}"
        >

        <select name="genre_id">
            <option value="">Semua Genre</option>

            @foreach($genres as $genre)
                <option value="{{ $genre->id }}"
                    {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Cari Buku</button>

    </form>

    @if($books->count() > 0)

        <div class="grid">

            @foreach($books as $book)

                <div class="book">

                    @if($book->cover_photo)
                        <img
                            src="{{ \Illuminate\Support\Str::startsWith($book->cover_photo, ['http://', 'https://']) ? $book->cover_photo : asset('storage/' . $book->cover_photo) }}"
                            alt="{{ $book->title }}"
                            class="cover"
                        >
                    @else
                        <div class="no-cover">Tidak ada cover</div>
                    @endif

                    <div class="book-info">

                        <h3>{{ $book->title }}</h3>

                        <p class="muted">
                            Penulis: {{ $book->author->name ?? '-' }}
                        </p>

                        <p class="muted">
                            Genre: {{ $book->genre->name ?? '-' }}
                        </p>

                        <p class="price">
                            Rp{{ number_format($book->price, 0, ',', '.') }}
                        </p>

                        <p class="muted">Stok: {{ $book->stock }}</p>

                        <a href="{{ route('catalog.show', $book->id) }}" class="detail">
                            Lihat Detail
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="pagination">
            {{ $books->links() }}
        </div>

    @else

        <div class="empty">
            <h3>Buku tidak ditemukan</h3>
            <p class="muted">Coba gunakan kata kunci atau genre lain.</p>
        </div>

    @endif

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





