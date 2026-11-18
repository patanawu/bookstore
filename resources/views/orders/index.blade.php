
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - BookStore</title>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap');

    * { box-sizing: border-box; }

    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        background: #111;
        color: #f5f5f5;
        background-image: repeating-linear-gradient(
            135deg,
            transparent,
            transparent 35px,
            rgba(255,255,255,.018) 35px,
            rgba(255,255,255,.018) 37px
        );
    }

    .top-line {
        height: 7px;
        background: #ed1c24;
    }

    .navbar {
        min-height: 82px;
        padding: 15px 7%;
        background: #090909;
        border-bottom: 1px solid #292929;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ed1c24;
        text-decoration: none;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 32px;
        font-weight: 900;
        letter-spacing: 1px;
        transform: skew(-5deg);
    }

    .brand-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 37px;
        height: 37px;
        background: #ed1c24;
        color: white;
        font-size: 25px;
        font-weight: 900;
        transform: skew(-8deg);
    }

    .nav-links {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 25px;
    }

    .nav-links a {
        color: #eee;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        transition: .2s;
    }

    .nav-links a:hover {
        color: #ed1c24;
    }

    .nav-user {
        color: #aaa;
        font-size: 12px;
    }

    .logout-form { display: inline; margin: 0; }

    .logout-button {
        padding: 9px 17px;
        border: 1px solid #ed1c24;
        background: transparent;
        color: #ed1c24;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        cursor: pointer;
        transition: .2s;
    }

    .logout-button:hover {
        background: #ed1c24;
        color: white;
    }

    .container {
        max-width: 1120px;
        margin: 55px auto;
        padding: 0 25px;
    }

    .page-heading {
        margin-bottom: 35px;
        border-left: 7px solid #ed1c24;
        padding-left: 20px;
    }

    .eyebrow {
        color: #ed1c24;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    h1 {
        margin: 0;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(38px, 6vw, 58px);
        font-weight: 900;
        text-transform: uppercase;
        line-height: 1;
        transform: skew(-3deg);
    }

    .page-description {
        color: #999;
        font-size: 13px;
        margin-top: 12px;
    }

    .message {
        padding: 15px 18px;
        margin-bottom: 15px;
        border-left: 5px solid #24b36b;
        background: #17251e;
        color: #a5f3c5;
        font-size: 13px;
    }

    .error {
        border-left-color: #ed1c24;
        background: #291719;
        color: #ffb5b5;
    }

    .cart-item {
        position: relative;
        display: flex;
        align-items: center;
        gap: 25px;
        background: #1b1b1b;
        padding: 23px;
        margin-bottom: 17px;
        border: 1px solid #333;
        border-left: 5px solid #ed1c24;
        transition: .2s;
    }

    .cart-item:hover {
        background: #222;
        border-color: #ed1c24;
        transform: translateX(3px);
    }

    .cover {
        width: 105px;
        height: 145px;
        flex-shrink: 0;
        object-fit: cover;
        border: 2px solid #444;
        background: #292929;
    }

    .book-info { flex: 1; min-width: 150px; }

    .book-info h3 {
        margin: 0 0 12px;
        color: white;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 25px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .price {
        color: #ed1c24;
        font-size: 17px;
        font-weight: 800;
    }

    .book-info p {
        color: #aaa;
        font-size: 13px;
    }

    .book-info strong { color: white; }

    .cart-item form {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    input[type="number"] {
        width: 75px;
        padding: 11px;
        border: 1px solid #555;
        background: #101010;
        color: white;
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        outline: none;
    }

    input[type="number"]:focus { border-color: #ed1c24; }

    button, .btn {
        border: none;
        padding: 11px 16px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        transition: .2s;
    }

    .btn-blue {
        background: #ed1c24;
        color: white;
    }

    .btn-blue:hover { background: #bd1018; }

    .btn-green {
        background: #ed1c24;
        color: white;
        padding: 15px 23px;
        font-size: 13px;
        font-weight: 900;
        letter-spacing: .5px;
        clip-path: polygon(5% 0, 100% 0, 95% 100%, 0 100%);
    }

    .btn-green:hover {
        background: white;
        color: #ed1c24;
    }

    .btn-red {
        background: #333;
        color: #ff5555;
        border: 1px solid #ed1c24;
    }

    .btn-red:hover {
        background: #ed1c24;
        color: white;
    }

    .summary {
        position: relative;
        background: #1b1b1b;
        padding: 30px;
        border: 1px solid #444;
        border-top: 5px solid #ed1c24;
        text-align: right;
        margin-top: 35px;
    }

    .summary h3 {
        margin: 0;
        color: #aaa;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .summary h2 {
        color: #ed1c24;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 42px;
        font-weight: 900;
        margin: 8px 0 25px;
    }

    .summary-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 13px;
        flex-wrap: wrap;
    }

    .empty {
        background: #1b1b1b;
        padding: 65px 20px;
        border: 1px solid #333;
        border-top: 5px solid #ed1c24;
        text-align: center;
    }

    .empty h2 {
        margin: 0 0 12px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 35px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .empty p {
        color: #999;
        font-size: 14px;
        margin-bottom: 25px;
    }

    @media (max-width: 750px) {
        .navbar { padding: 17px 5%; }
        .nav-links { gap: 15px; }
        .container { margin: 35px auto; padding: 0 15px; }
        .cart-item { flex-wrap: wrap; gap: 15px; padding: 17px; }
        .book-info { min-width: 180px; }
        .cart-item form { width: 100%; }
        .summary { text-align: center; padding: 23px 15px; }
        .summary-actions { justify-content: center; }
    }

    @media (max-width: 450px) {
        .brand { font-size: 27px; }
        .nav-links { gap: 12px; }
        .nav-links a { font-size: 11px; }
        .cart-item { align-items: flex-start; }
        .cover { width: 85px; height: 120px; }
        .book-info h3 { font-size: 21px; }
        .summary h2 { font-size: 34px; }
        .summary-actions > form,
        .summary-actions > a { width: 100%; }
        .summary-actions button,
        .summary-actions .btn { width: 100%; text-align: center; }
    }

/* ===== PERSONA 5 CART DETAILS ===== */
.p5-cart-details {
    position: relative;
    overflow: hidden;
}

body::before {
    content: "BOOKSTORE";
    position: fixed;
    right: -65px;
    top: 38%;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 110px;
    font-weight: 900;
    color: rgba(237,28,36,.035);
    transform: rotate(-90deg);
    pointer-events: none;
    z-index: -1;
}

.page-heading {
    position: relative;
    overflow: hidden;
    padding-top: 10px;
    padding-bottom: 15px;
}

.page-heading::after {
    content: "YOUR NEXT ADVENTURE STARTS HERE";
    display: inline-block;
    margin-top: 18px;
    padding: 7px 13px;
    background: #ed1c24;
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
    transform: skew(-8deg);
}

.page-heading::before {
    content: "ÃƒÆ’Ã‚Â¢Ãƒâ€¹Ã…â€œÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¦";
    position: absolute;
    right: 35px;
    top: 0;
    color: #ed1c24;
    font-size: 65px;
    transform: rotate(15deg);
    opacity: .8;
}

.cart-item {
    overflow: hidden;
}

.cart-item::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 55px;
    height: 55px;
    background: #ed1c24;
    clip-path: polygon(100% 0, 100% 100%, 0 0);
    opacity: .9;
}

.item-number {
    position: absolute;
    right: 18px;
    bottom: 12px;
    color: #777;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
}

.book-info h3 {
    display: inline-block;
    position: relative;
    padding-bottom: 7px;
}

.book-info h3::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 65%;
    height: 3px;
    background: #ed1c24;
    transform: skew(-25deg);
}

.cover {
    box-shadow: 5px 5px 0 #ed1c24;
    transition: .25s;
}

.cart-item:hover .cover {
    transform: rotate(-2deg) scale(1.025);
}

.summary {
    overflow: hidden;
}

.summary::before {
    content: "TOTAL";
    position: absolute;
    top: 13px;
    left: 20px;
    color: rgba(255,255,255,.07);
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 65px;
    font-weight: 900;
    pointer-events: none;
}

.summary h2 {
    position: relative;
    display: inline-block;
    padding: 5px 15px;
    background: rgba(237,28,36,.09);
    transform: skew(-4deg);
}

.summary h2::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 100%;
    height: 3px;
    background: #ed1c24;
}

.summary-actions {
    position: relative;
    z-index: 1;
}

.empty {
    position: relative;
    overflow: hidden;
}

.empty::before {
    content: "!";
    position: absolute;
    top: -45px;
    right: 25px;
    color: rgba(237,28,36,.12);
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 190px;
    font-weight: 900;
    transform: rotate(12deg);
}

.empty h2, .empty p, .empty a {
    position: relative;
    z-index: 1;
}

@media (max-width: 600px) {
    .page-heading::before {
        right: 5px;
        font-size: 42px;
    }

    .item-number {
        position: static;
        width: 100%;
        text-align: right;
    }

    .summary::before {
        font-size: 45px;
    }
}
/* ===== END PERSONA 5 CART DETAILS ===== */

/* Persona 5 User Navbar Typography */
.nav-user {
    font-family: 'Barlow Condensed', sans-serif !important;
    font-size: 17px !important;
    font-weight: 900 !important;
    font-style: italic;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: #ffffff !important;
    padding: 7px 12px;
    border-left: 4px solid #ed1c24;
    background: linear-gradient(110deg, rgba(237,28,36,.2), transparent);
    transform: skew(-7deg);
    display: inline-block;
}

/* ===== P5 EXTRA VISUAL DETAILS ===== */

/* Bintang grafis, tidak memakai karakter khusus */
.page-heading::before {
    content: "";
    position: absolute;
    right: 38px;
    top: 5px;
    width: 58px;
    height: 58px;
    background: #ed1c24;
    clip-path: polygon(
        50% 0%, 61% 35%, 98% 35%, 68% 57%,
        79% 94%, 50% 72%, 21% 94%, 32% 57%,
        2% 35%, 39% 35%
    );
    transform: rotate(12deg);
    filter: drop-shadow(4px 4px 0 white);
    opacity: .95;
}

/* Garis komik di bawah judul */
.page-heading h1 {
    text-shadow: 3px 3px 0 rgba(237,28,36,.25);
}

.page-heading {
    background-image: linear-gradient(
        110deg,
        rgba(237,28,36,.07),
        transparent 65%
    );
}

/* Aksen diagonal pada kartu buku */
.cart-item::after {
    content: "";
    position: absolute;
    top: 9px;
    right: 66px;
    width: 4px;
    height: 28px;
    background: white;
    transform: skew(-25deg);
    opacity: .8;
    pointer-events: none;
}

.cart-item:hover {
    box-shadow: 7px 7px 0 rgba(237,28,36,.18);
}

/* Sudut komik pada panel total */
.summary::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 75px;
    height: 75px;
    background: #ed1c24;
    clip-path: polygon(100% 0, 100% 100%, 0 0);
    opacity: .85;
    pointer-events: none;
}

.summary h2 {
    text-shadow: 2px 2px 0 rgba(237,28,36,.2);
}

/* Garis dekoratif pada tombol checkout */
.btn-green {
    box-shadow: 4px 4px 0 rgba(255,255,255,.15);
}

.btn-green:hover {
    transform: translateY(-2px);
    box-shadow: 5px 5px 0 #ed1c24;
}

/* Penyesuaian layar kecil */
@media (max-width: 600px) {
    .page-heading::before {
        right: 8px;
        top: 8px;
        width: 38px;
        height: 38px;
    }

    .cart-item::after {
        display: none;
    }

    .summary::after {
        width: 48px;
        height: 48px;
    }
}

/* ===== END P5 EXTRA VISUAL DETAILS ===== */

/* ===== PERSONA 5 ORDER HISTORY ===== */

.order-card {
    position: relative;
    overflow: hidden;
    background: #1b1b1b;
    padding: 25px;
    margin-bottom: 30px;
    border: 2px solid white;
    border-left: 8px solid #ed1c24;
    box-shadow: 7px 7px 0 #ed1c24;
    transition: .2s;
}

.order-card:hover {
    transform: translate(-3px,-3px);
    box-shadow: 10px 10px 0 #ed1c24;
}

.order-card::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 75px;
    height: 75px;
    background: #ed1c24;
    clip-path: polygon(100% 0, 100% 100%, 0 0);
    opacity: .9;
    pointer-events: none;
}

.order-header {
    position: relative;
    border-bottom: 2px solid #ed1c24;
    padding-bottom: 18px;
}

.order-label {
    color: #ed1c24;
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-bottom: 8px;
}

.order-header > div:first-child > div:first-child {
    color: #aaa;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 15px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.order-number {
    display: inline-block;
    margin-top: 7px;
    padding: 7px 13px;
    background: #ed1c24;
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 20px;
    font-weight: 900;
    word-break: break-word;
    transform: skew(-4deg);
}

.date {
    color: #999;
    font-size: 12px;
    margin-top: 10px;
}

.book-list {
    padding: 15px 0;
}

.book-item {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    padding: 16px;
    margin: 10px 0;
    background: #242424;
    border-left: 4px solid #ed1c24;
    border-bottom: 1px solid #444;
}

.book-title {
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 21px;
    font-weight: 800;
    text-transform: uppercase;
}

.book-quantity {
    color: #aaa;
    font-size: 12px;
    margin-top: 6px;
}

.book-item > div:last-child {
    color: #ed1c24;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 19px;
    font-weight: 900;
    white-space: nowrap;
}

.total {
    position: relative;
    border-top: 2px solid #ed1c24;
    padding-top: 20px;
    margin-top: 10px;
}

.total > div:first-child > div {
    color: #aaa;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 16px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.total strong {
    display: inline-block;
    color: #ed1c24;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 30px;
    font-weight: 900;
    margin-top: 6px;
}

.total .btn {
    position: relative;
    z-index: 2;
}

.header {
    margin-bottom: 35px;
    border-left: 7px solid #ed1c24;
    padding: 10px 0 15px 20px;
    background: linear-gradient(110deg, rgba(237,28,36,.08), transparent 70%);
}

.header h1 {
    margin: 0;
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: clamp(38px, 6vw, 58px);
    font-weight: 900;
    text-transform: uppercase;
    line-height: 1;
    transform: skew(-3deg);
}

.header p {
    color: #999;
    font-size: 13px;
    margin-top: 12px;
}

.empty {
    position: relative;
    overflow: hidden;
    background: #1b1b1b;
    border: 2px solid white;
    border-top: 7px solid #ed1c24;
    box-shadow: 7px 7px 0 #ed1c24;
}

.empty h2 {
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 35px;
    font-weight: 900;
    text-transform: uppercase;
}

.empty p {
    color: #999;
}

@media (max-width: 600px) {
    .order-card {
        padding: 18px;
    }

    .book-item {
        flex-wrap: wrap;
    }

    .book-item > div:last-child {
        width: 100%;
    }

    .total {
        flex-direction: column;
        align-items: flex-start;
    }

    .total .btn {
        margin-top: 15px;
    }
}

/* ===== END PERSONA 5 ORDER HISTORY ===== */
    
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
.order-payment-info {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    margin-top: 15px;
    padding: 13px 16px;
    background: #111;
    border-left: 4px solid #ed1c24;
}

.order-payment-info div {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.order-payment-info span {
    color: #aaa;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.order-payment-info strong {
    color: white;
    font-size: 12px;
}

.order-payment-info .paid { color: #58d68d; }
.order-payment-info .unpaid { color: #ffc857; }

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

    <div class="header">
        <div class="eyebrow">Bookstore Collection / Transaction Archive</div>
        <h1>Riwayat Transaksi</h1>
        <p>Daftar pesanan yang pernah kamu lakukan di BookStore.</p>
    </div>

    @if($orders->isEmpty())

        <div class="empty">
            <h2>Belum Ada Transaksi</h2>
            <p>Kamu belum memiliki riwayat pembelian buku.</p>

            <a href="{{ route('catalog.index') }}" class="btn btn-blue">
                Mulai Belanja
            </a>
        </div>

    @else

        @foreach($orders as $orderNumber => $transactions)

            @php
                $firstTransaction = $transactions->first();
                $orderTotal = $transactions->sum('total_amount');
            @endphp

            <div class="order-card">

                <div class="order-header">
                    <div>
                        <div class="order-label">Order Record / BookStore</div>
                        <div>Nomor Pesanan</div>

                        <div class="order-number">
                            {{ $orderNumber }}
                        </div>

                        <div class="date">
                            {{ $firstTransaction->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>

                <div class="book-list">

                    @foreach($transactions as $transaction)

                        <div class="book-item">
                            <div>
                                <div class="book-title">
                                    {{ $transaction->book->title ?? 'Buku tidak tersedia' }}
                                </div>

                                <div class="book-quantity">
                                    Jumlah: {{ $transaction->quantity }} buku
                                </div>
                            </div>

                            <div>
                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                            </div>
                        </div>

                    @endforeach

                </div>

                <div class="total">
                    <div>
                        <div>Total Pembayaran</div>
                        <strong>
                            Rp {{ number_format($orderTotal, 0, ',', '.') }}
                        </strong>
                    </div>

                    @php
                        $paymentMethod = $firstTransaction->payment_method ?? 'cod';
                        $paymentStatus = $firstTransaction->payment_status ?? 'unpaid';
                    @endphp

                    <div class="order-payment-info">
                        <div>
                            <span>Metode Pembayaran</span>
                            <strong>{{ $paymentMethod === 'bank_transfer' ? 'Transfer Bank' : 'COD' }}</strong>
                        </div>
                        <div>
                            <span>Status Pembayaran</span>
                            <strong class="{{ $paymentStatus === 'paid' ? 'paid' : 'unpaid' }}">
                                {{ $paymentStatus === 'paid' ? 'LUNAS' : 'BELUM DIBAYAR' }}
                            </strong>
                        </div>
                    </div>

                    <a
                        href="{{ route('orders.show', $orderNumber) }}"
                        class="btn btn-green"
                    >
                        Lihat Detail
                    </a>
                </div>

            </div>

        @endforeach

    @endif

</div>    @include('partials.music-player')
</body>
</html>


