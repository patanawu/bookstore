<div class="user-site-top-line"></div>

<header class="navbar user-site-navbar">
    <div class="container nav-inner">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark">B</span>
            <span>BOOK<span>STORE</span></span>
        </a>

        <nav class="nav-links" id="sharedUserNavLinks">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#koleksi">Koleksi</a>
            <a href="{{ route('home') }}#genre">Genre</a>
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

            <button class="menu-toggle" id="sharedUserMenuToggle"
                type="button" aria-label="Buka menu">&#9776;</button>
        </div>
    </div>
</header>

<style>
@import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800;900&display=swap');

.user-site-top-line {
    height: 5px;
    background: #ed1c24;
}

.navbar.user-site-navbar {
    position: sticky !important;
    top: 0;
    z-index: 999;
    display: block;
    width: 100%;
    padding: 0 !important;
    background: rgba(9,9,9,.94) !important;
    backdrop-filter: blur(16px);
    border: 0 !important;
    border-bottom: 1px solid rgba(255,255,255,.10) !important;
    box-shadow: 0 8px 28px rgba(0,0,0,.35) !important;
}

.user-site-navbar .nav-inner {
    width: min(1180px, calc(100% - 48px));
    min-height: 76px;
    margin: auto;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;
}

.user-site-navbar .brand {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 31px;
    font-weight: 900;
    letter-spacing: -1px;
    text-decoration: none;
    transform: skew(-7deg);
    white-space: nowrap;
}

.user-site-navbar .brand-mark {
    display: grid;
    place-items: center;
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    background: #ed1c24;
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 25px;
    clip-path: polygon(15% 0,100% 0,85% 100%,0 85%);
}

.user-site-navbar .brand > span:last-child {
    color: #ed1c24;
}

.user-site-navbar .brand > span:last-child span {
    color: white;
}

.user-site-navbar .nav-links {
    display: flex;
    align-items: center;
    gap: 27px;
    margin: 0;
    padding: 0;
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.user-site-navbar .nav-links a {
    padding: 0;
    color: #eee;
    text-decoration: none;
    transition: color .2s;
    border: 0;
}

.user-site-navbar .nav-links a:hover {
    color: #ed1c24;
}

.user-site-navbar .nav-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-site-navbar .nav-actions form {
    display: inline-flex;
    margin: 0;
}

.user-site-navbar .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px 21px;
    border: 0;
    border-radius: 0;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0,100% 0,100% 78%,91% 100%,0 100%);
    transition: transform .2s, background .2s;
}

.user-site-navbar .btn:hover {
    transform: translateY(-3px) skew(-2deg);
}

.user-site-navbar .btn-red {
    background: #ed1c24;
    color: white;
}

.user-site-navbar .btn-red:hover {
    background: #ff263a;
}

.user-site-navbar .btn-outline {
    background: transparent;
    color: white;
    border: 1px solid rgba(255,255,255,.35);
}

.user-site-navbar .btn-outline:hover {
    background: rgba(255,255,255,.10);
}

.user-site-navbar .menu-toggle {
    display: none;
    padding: 8px 12px;
    border: 1px solid rgba(237,28,36,.7);
    background: transparent;
    color: white;
    font-size: 21px;
    cursor: pointer;
}

@media (max-width: 900px) {
    .user-site-navbar .nav-inner {
        gap: 14px;
    }

    .user-site-navbar .nav-links {
        gap: 14px;
        font-size: 10px;
    }

    .user-site-navbar .brand {
        font-size: 27px;
    }
}

@media (max-width: 680px) {
    .user-site-navbar .nav-inner {
        width: min(100% - 32px, 520px);
        min-height: 67px;
    }

    .user-site-navbar .brand {
        font-size: 27px;
    }

    .user-site-navbar .menu-toggle {
        display: block;
    }

    .user-site-navbar .nav-links {
        display: none;
        position: absolute;
        top: 67px;
        left: 0;
        right: 0;
        padding: 20px 24px;
        background: #101010;
        border-bottom: 2px solid #ed1c24;
        flex-direction: column;
        align-items: stretch;
        gap: 0;
    }

    .user-site-navbar .nav-links.open {
        display: flex;
    }

    .user-site-navbar .nav-links a {
        padding: 14px 0;
        border-bottom: 1px solid rgba(255,255,255,.10);
    }

    .user-site-navbar .nav-actions .btn-outline {
        display: none;
    }

    .user-site-navbar .btn {
        padding: 10px 12px;
        font-size: 9px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('sharedUserMenuToggle');
    const links = document.getElementById('sharedUserNavLinks');

    toggle?.addEventListener('click', function () {
        links?.classList.toggle('open');
    });

    links?.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            links?.classList.remove('open');
        });
    });
});
</script>
<style>
/* FINAL OVERRIDE: SAMAKAN NAVBAR DENGAN HOME */
header.navbar.user-site-navbar {
    padding: 0 !important;
    margin: 0 !important;
    width: 100% !important;
    min-height: 0 !important;
    display: block !important;
    box-sizing: border-box !important;
}

header.navbar.user-site-navbar .nav-inner {
    min-height: 76px !important;
    padding: 0 !important;
    margin: 0 auto !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 25px !important;
}

header.navbar.user-site-navbar .brand {
    display: inline-flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 0 !important;
    margin: 0 !important;
    font-family: 'Barlow Condensed', sans-serif !important;
    font-size: 31px !important;
    font-weight: 900 !important;
    line-height: 1 !important;
    letter-spacing: -1px !important;
    text-decoration: none !important;
    transform: skew(-7deg) !important;
    background: transparent !important;
    box-shadow: none !important;
}

header.navbar.user-site-navbar .brand-mark {
    display: grid !important;
    place-items: center !important;
    width: 38px !important;
    min-width: 38px !important;
    height: 38px !important;
    padding: 0 !important;
    background: #ed1c24 !important;
    color: #fff !important;
    font-family: 'Barlow Condensed', sans-serif !important;
    font-size: 25px !important;
    font-weight: 900 !important;
    line-height: 1 !important;
    clip-path: polygon(15% 0,100% 0,85% 100%,0 85%) !important;
}

header.navbar.user-site-navbar .brand > span:last-child {
    color: #ed1c24 !important;
    font-family: 'Barlow Condensed', sans-serif !important;
    font-size: 31px !important;
    font-weight: 900 !important;
    letter-spacing: -1px !important;
}

header.navbar.user-site-navbar .brand > span:last-child span {
    color: #fff !important;
}

header.navbar.user-site-navbar .nav-links {
    display: flex !important;
    align-items: center !important;
    gap: 27px !important;
    margin: 0 !important;
    padding: 0 !important;
}

header.navbar.user-site-navbar .nav-links a {
    padding: 0 !important;
    color: #eee !important;
    font-family: 'Inter', sans-serif !important;
    font-size: 12px !important;
    font-weight: 800 !important;
    letter-spacing: 1px !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
    border: 0 !important;
    background: transparent !important;
}

header.navbar.user-site-navbar .nav-links a:hover {
    color: #ed1c24 !important;
}

header.navbar.user-site-navbar .nav-actions {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    margin: 0 !important;
    padding: 0 !important;
}

header.navbar.user-site-navbar .nav-actions form {
    display: inline-flex !important;
    margin: 0 !important;
    padding: 0 !important;
}

/* Tombol Keranjang, Masuk, Daftar, Logout */
header.navbar.user-site-navbar .nav-actions .btn,
header.navbar.user-site-navbar .nav-actions button.btn {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-height: 0 !important;
    margin: 0 !important;
    padding: 13px 21px !important;
    border: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    text-shadow: none !important;
    font-family: 'Inter', sans-serif !important;
    font-size: 11px !important;
    font-weight: 900 !important;
    line-height: normal !important;
    letter-spacing: 1px !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
    cursor: pointer !important;
    clip-path: polygon(0 0,100% 0,100% 78%,91% 100%,0 100%) !important;
    transition: transform .2s, background .2s !important;
}

header.navbar.user-site-navbar .nav-actions .btn-red,
header.navbar.user-site-navbar .nav-actions button.btn-red {
    background: #ed1c24 !important;
    color: #fff !important;
    border: 0 !important;
}

header.navbar.user-site-navbar .nav-actions .btn-outline {
    background: transparent !important;
    color: #fff !important;
    border: 1px solid rgba(255,255,255,.35) !important;
}

header.navbar.user-site-navbar .nav-actions .btn:hover {
    transform: translateY(-3px) skew(-2deg) !important;
}

header.navbar.user-site-navbar .nav-actions .btn-red:hover {
    background: #ff263a !important;
    color: #fff !important;
}

header.navbar.user-site-navbar .nav-actions .btn-outline:hover {
    background: rgba(255,255,255,.10) !important;
    color: #fff !important;
}

/* Matikan efek tombol lama dari halaman Checkout */
header.navbar.user-site-navbar .nav-actions .btn::before,
header.navbar.user-site-navbar .nav-actions .btn::after {
    content: none !important;
    display: none !important;
    box-shadow: none !important;
}

header.navbar.user-site-navbar .menu-toggle {
    display: none;
}

@media (max-width: 900px) {
    header.navbar.user-site-navbar .nav-inner {
        gap: 14px !important;
    }

    header.navbar.user-site-navbar .nav-links {
        gap: 14px !important;
    }

    header.navbar.user-site-navbar .brand,
    header.navbar.user-site-navbar .brand > span:last-child {
        font-size: 27px !important;
    }
}

@media (max-width: 680px) {
    header.navbar.user-site-navbar .nav-inner {
        min-height: 67px !important;
    }

    header.navbar.user-site-navbar .nav-links {
        display: none !important;
        position: absolute !important;
        top: 67px !important;
        left: 0 !important;
        right: 0 !important;
        padding: 20px 24px !important;
        background: #101010 !important;
        border-bottom: 2px solid #ed1c24 !important;
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 0 !important;
    }

    header.navbar.user-site-navbar .nav-links.open {
        display: flex !important;
    }

    header.navbar.user-site-navbar .nav-links a {
        padding: 14px 0 !important;
        border-bottom: 1px solid rgba(255,255,255,.10) !important;
    }

    header.navbar.user-site-navbar .menu-toggle {
        display: block !important;
    }

    header.navbar.user-site-navbar .nav-actions .btn-outline {
        display: none !important;
    }

    header.navbar.user-site-navbar .nav-actions .btn {
        padding: 10px 12px !important;
        font-size: 9px !important;
    }
}
</style>

<style>
/* FINAL FIX: BOOKSTORE FULL RED */
header.navbar.user-site-navbar .brand,
header.navbar.user-site-navbar .brand span,
header.navbar.user-site-navbar .brand strong,
header.navbar.user-site-navbar .brand b,
header.navbar.user-site-navbar .brand .brand-text,
header.navbar.user-site-navbar .brand .brand-name {
    color: #ed1c24 !important;
}

/* Pastikan efek teks lama tidak mengubah warna */
header.navbar.user-site-navbar .brand span,
header.navbar.user-site-navbar .brand strong {
    -webkit-text-fill-color: #ed1c24 !important;
}
</style>

<style>
/* FIX LOGO B: huruf putih di dalam kotak merah */
header.navbar.user-site-navbar .brand .brand-mark {
    color: #ffffff !important;
    -webkit-text-fill-color: #ffffff !important;
    background: #ed1c24 !important;
    border-color: #ed1c24 !important;
    opacity: 1 !important;
    visibility: visible !important;
}

/* Pastikan tulisan BOOKSTORE tetap merah */
header.navbar.user-site-navbar .brand > span:not(.brand-mark) {
    color: #ed1c24 !important;
    -webkit-text-fill-color: #ed1c24 !important;
}
</style>