
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - BookStore</title>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap');

    * { box-sizing: border-box; }

    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        background: #101010;
        color: #f5f5f5;
        min-height: 100vh;
        background-image: repeating-linear-gradient(
            135deg,
            transparent,
            transparent 45px,
            rgba(255,255,255,.018) 46px,
            rgba(255,255,255,.018) 47px
        );
    }

    .top-line {
        height: 5px;
        background: #e50914;
    }

    .navbar {
        background: #080808;
        padding: 17px 7%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
        border-bottom: 1px solid #292929;
        box-shadow: 0 5px 20px #00000070;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ed1c24;
        text-decoration: none;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 30px;
        font-weight: 900;
        letter-spacing: 2px;
        font-style: italic;
    }

    .brand-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ed1c24;
        color: white;
        font-size: 23px;
        transform: skew(-8deg);
        box-shadow: 3px 3px 0 white;
    }

    .nav-links {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .nav-links a {
        color: #eee;
        text-decoration: none;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 17px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: .2s;
    }

    .nav-links a:hover {
        color: #ed1c24;
    }

    .nav-user {
        color: white;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 16px;
        font-weight: 700;
        font-style: italic;
        border-left: 3px solid #ed1c24;
        padding-left: 10px;
    }

    .logout-form {
        display: inline;
        margin: 0;
    }

    .logout-button {
        border: 1px solid #ed1c24;
        background: transparent;
        color: #ed1c24;
        padding: 7px 13px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 15px;
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
        max-width: 1000px;
        margin: 45px auto;
        padding: 0 20px;
    }

    .checkout-box {
        position: relative;
        overflow: hidden;
        background: #191919;
        padding: 35px;
        border: 1px solid #383838;
        border-top: 5px solid #ed1c24;
        box-shadow: 10px 10px 0 #050505;
    }

    .checkout-box::after {
        content: "CHECKOUT";
        position: absolute;
        right: -15px;
        top: 35px;
        color: rgba(255,255,255,.025);
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 100px;
        font-weight: 900;
        transform: rotate(-10deg);
        pointer-events: none;
    }

    .eyebrow {
        position: relative;
        z-index: 1;
        color: #ed1c24;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    h1 {
        position: relative;
        z-index: 1;
        margin: 0;
        color: white;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 48px;
        font-weight: 900;
        font-style: italic;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-shadow: 3px 3px 0 #ed1c24;
    }

    .subtitle {
        position: relative;
        z-index: 1;
        color: #aaa;
        font-size: 14px;
        margin: 8px 0 30px;
    }

    .message {
        padding: 14px;
        background: #351416;
        color: #ffb5b5;
        border-left: 4px solid #ed1c24;
        margin-bottom: 20px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 25px 0 10px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 25px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .section-title::before {
        content: "";
        width: 5px;
        height: 25px;
        background: #ed1c24;
        transform: skew(-12deg);
    }

    .item {
        position: relative;
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 22px 15px;
        margin: 12px 0;
        background: #222;
        border: 1px solid #363636;
        transition: .25s;
    }

    .item:hover {
        border-color: #ed1c24;
        transform: translateX(4px);
        box-shadow: -4px 0 #ed1c24;
    }

    .item-number {
        align-self: flex-start;
        min-width: 78px;
        color: #ed1c24;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .cover {
        width: 75px;
        height: 100px;
        object-fit: cover;
        border: 2px solid #555;
        box-shadow: 4px 4px 0 #ed1c24;
    }

    .book-info { flex: 1; }

    .book-info h3 {
        margin: 0 0 10px;
        color: white;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 23px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .book-info p {
        margin: 5px 0;
        color: #aaa;
        font-size: 13px;
    }

    .price {
        color: #ed1c24;
        font-weight: bold;
    }

    .subtotal {
        color: white;
        font-weight: 800;
        text-align: right;
        white-space: nowrap;
    }

    .total {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-top: 30px;
        padding: 22px;
        background: #111;
        border: 1px solid #ed1c24;
        border-left: 6px solid #ed1c24;
    }

    .total h3 {
        margin: 0;
        color: #ddd;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 23px;
        text-transform: uppercase;
    }

    .total h2 {
        margin: 0;
        color: #ed1c24;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 32px;
        font-weight: 900;
    }

    .actions {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-top: 30px;
    }

    .btn {
        display: inline-block;
        padding: 14px 22px;
        border: none;
        text-decoration: none;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 17px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: .2s;
    }

    .btn-red {
        background: #ed1c24;
        color: white;
        box-shadow: 4px 4px 0 white;
    }

    .btn-red:hover {
        background: white;
        color: #ed1c24;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0 #ed1c24;
    }

    .btn-gray {
        background: #292929;
        color: white;
        border: 1px solid #555;
    }

    .btn-gray:hover {
        background: #444;
        border-color: white;
    }

    @media (max-width: 700px) {
        .navbar {
            padding: 16px 5%;
        }

        .nav-links {
            gap: 12px;
        }

        .nav-links a {
            font-size: 15px;
        }

        .container {
            margin: 25px auto;
        }

        .checkout-box {
            padding: 22px;
        }

        h1 { font-size: 39px; }

        .item {
            flex-wrap: wrap;
            gap: 12px;
        }

        .item-number {
            width: 100%;
        }

        .subtotal {
            width: 100%;
            text-align: left;
            padding-left: 90px;
        }

        .total {
            align-items: flex-start;
            flex-direction: column;
        }

        .actions {
            flex-direction: column;
        }

        .actions .btn,
        .actions form,
        .actions button {
            width: 100%;
            text-align: center;
        }
    }

/* P5 EXTRA CHECKOUT DETAILS */
.nav-user {
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 17px;
    font-weight: 800;
    font-style: italic;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-left: 3px solid #ed1c24;
    padding: 6px 12px;
    background: linear-gradient(90deg, rgba(237,28,36,.16), transparent);
}

.checkout-box {
    border-right: 3px solid #ed1c24;
}

.checkout-box::before {
    content: "PHANTOM ORDER";
    position: absolute;
    top: 14px;
    right: 18px;
    color: #ed1c24;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 3px;
    transform: rotate(3deg);
    opacity: .8;
}

.section-title {
    position: relative;
    padding-bottom: 12px;
    border-bottom: 1px solid #444;
}

.item::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border-top: 18px solid #ed1c24;
    border-left: 18px solid transparent;
}

.item-number {
    background: rgba(237,28,36,.10);
    padding: 5px 8px;
    border-left: 2px solid #ed1c24;
}

.cover {
    transition: .25s ease;
}

.item:hover .cover {
    transform: rotate(-2deg) scale(1.04);
    box-shadow: 6px 6px 0 #ed1c24;
}

.total::after {
    content: "FINAL PAYMENT";
    position: absolute;
    right: 12px;
    bottom: 5px;
    color: rgba(255,255,255,.13);
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 3px;
}

.btn-red {
    position: relative;
    overflow: hidden;
}

.btn-red::after {
    content: "";
    position: absolute;
    top: -20px;
    left: -35px;
    width: 18px;
    height: 80px;
    background: rgba(255,255,255,.25);
    transform: rotate(25deg);
    transition: .35s;
}

.btn-red:hover::after {
    left: 110%;
}

@media (max-width: 700px) {
    .checkout-box::before {
        font-size: 10px;
        top: 8px;
        right: 10px;
    }

    .nav-user {
        font-size: 15px;
    }
}

/* END P5 EXTRA CHECKOUT DETAILS */
    
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

/* PAYMENT SECTION */
.payment-section {
    margin-top: 30px;
    padding: 22px;
    background: #151515;
    border: 1px solid #444;
    border-left: 4px solid #ed1c24;
}

.payment-section h3 {
    color: #ed1c24;
    font-family: 'Barlow Condensed', sans-serif;
    font-weight: 900;
    margin-bottom: 18px;
}

.payment-option {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px;
    margin-bottom: 12px;
    background: #222;
    border: 1px solid #444;
    cursor: pointer;
}

.payment-option input {
    margin-top: 5px;
    accent-color: #ed1c24;
}

.payment-option span {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.payment-option strong,
.bank-info strong {
    color: #fff;
}

.payment-option small,
.bank-info small {
    color: #aaa;
}

.bank-info {
    padding: 16px;
    margin-top: 15px;
    background: #252525;
    border: 1px dashed #ed1c24;
}

.bank-info p {
    margin: 8px 0;
    color: #eee;
}

.payment-error {
    color: #ff4757;
    margin-top: 12px;
}

/* =========================================
   PERSONA 5 - CHECKOUT NAVBAR & DETAILS
========================================= */

.navbar {
    position: sticky !important;
    top: 0;
    z-index: 100;
    display: block !important;
    padding: 0 !important;
    background: rgba(9,9,9,.94) !important;
    backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(255,255,255,.10) !important;
    box-shadow: 0 8px 28px rgba(0,0,0,.35) !important;
}

.nav-inner {
    width: min(1180px, calc(100% - 48px));
    min-height: 76px;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;
}

.navbar .brand {
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
}

.brand-mark {
    display: grid;
    place-items: center;
    width: 38px;
    height: 38px;
    background: #ed1c24;
    color: white;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 25px;
    clip-path: polygon(15% 0,100% 0,85% 100%,0 85%);
}

.navbar .brand > span:last-child {
    color: #ed1c24;
}

.navbar .brand > span:last-child span {
    color: white;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 27px;
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.nav-links a {
    color: #eee;
    text-decoration: none;
    transition: color .2s;
}

.nav-links a:hover {
    color: #ed1c24;
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.nav-actions form {
    display: inline-flex;
    margin: 0;
}

.menu-toggle {
    display: none;
    border: 1px solid rgba(237,28,36,.7);
    background: transparent;
    color: white;
    padding: 8px 12px;
    font-size: 21px;
    cursor: pointer;
}

/* Panel checkout */
.checkout-box {
    isolation: isolate;
    border: 1px solid rgba(237,28,36,.45) !important;
    border-top: 5px solid #ed1c24 !important;
    background:
        radial-gradient(ellipse at 100% 0%, rgba(237,28,36,.10), transparent 45%),
        linear-gradient(145deg, #202020, #121212 75%) !important;
    box-shadow:
        0 0 0 3px rgba(237,28,36,.04),
        10px 10px 0 #050505,
        0 20px 45px rgba(0,0,0,.35) !important;
    animation: checkoutReveal .65s ease both;
}

.checkout-box::before {
    content: "PHANTOM THIEVES  /  ORDER";
    position: absolute;
    top: 13px;
    right: 20px;
    color: rgba(255,255,255,.20);
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 3px;
    pointer-events: none;
}

.checkout-box::after {
    color: rgba(255,255,255,.035) !important;
    text-shadow: 3px 3px 0 rgba(237,28,36,.08);
}

.checkout-box .eyebrow {
    letter-spacing: 4px;
    text-shadow: 0 0 12px rgba(237,28,36,.4);
}

.checkout-box h1 {
    line-height: 1.08;
    text-shadow: 3px 3px 0 #ed1c24, 0 0 22px rgba(237,28,36,.16);
}

.checkout-box .subtitle {
    position: relative;
    z-index: 1;
    color: #c5c5c5;
    line-height: 1.8;
    margin-top: 12px;
}

.checkout-box .section-title {
    position: relative;
    z-index: 1;
    padding: 12px 16px;
    margin-top: 30px;
    color: white;
    background: linear-gradient(90deg, rgba(237,28,36,.18), transparent);
    border-left: 4px solid #ed1c24;
    letter-spacing: 1px;
}

.checkout-box .item {
    position: relative;
    z-index: 1;
    margin: 18px 0;
    padding: 22px;
    background: rgba(255,255,255,.035);
    border: 1px solid rgba(255,255,255,.12);
    border-left: 3px solid rgba(237,28,36,.8);
    box-shadow: 5px 5px 0 rgba(0,0,0,.25);
    transition: border-color .25s, background .25s, transform .25s;
}

.checkout-box .item:hover {
    background: rgba(237,28,36,.055);
    border-color: rgba(237,28,36,.5);
    transform: translateY(-2px);
}

.checkout-box .item-number {
    color: #ff5059;
    font-family: 'Barlow Condensed', sans-serif;
    font-weight: 800;
    letter-spacing: 2px;
}

.checkout-box .book-info h3 {
    color: #fff;
    line-height: 1.4;
    overflow-wrap: anywhere;
}

.checkout-box .cover {
    border: 1px solid rgba(237,28,36,.45);
    box-shadow: 4px 4px 0 rgba(237,28,36,.16);
}

.checkout-box input:not([type="submit"]):not([type="checkbox"]),
.checkout-box select,
.checkout-box textarea {
    max-width: 100%;
    background-color: #111 !important;
    color: #f5f5f5 !important;
    border: 1px solid #494949 !important;
    border-radius: 3px;
    padding: 12px 14px;
    line-height: 1.5;
}

.checkout-box input:focus,
.checkout-box select:focus,
.checkout-box textarea:focus {
    outline: none;
    border-color: #ed1c24 !important;
    box-shadow: 0 0 0 3px rgba(237,28,36,.12);
}

.checkout-box label {
    display: inline-block;
    margin-bottom: 8px;
    color: #e8e8e8;
    font-weight: 700;
    line-height: 1.5;
}

@keyframes checkoutReveal {
    from { opacity: 0; transform: translateY(14px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Navbar mobile mengikuti Home */
@media (max-width: 680px) {
    .nav-inner {
        width: min(100% - 32px, 520px);
        min-height: 67px;
    }

    .navbar .brand {
        font-size: 27px;
    }

    .menu-toggle {
        display: block;
    }

    .nav-links {
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

    .nav-links.open {
        display: flex;
    }

    .nav-links a {
        padding: 14px 0;
        border-bottom: 1px solid rgba(255,255,255,.10);
    }

    .nav-actions .btn-outline {
        display: none;
    }

    .nav-actions .btn {
        padding: 10px 12px;
        font-size: 9px;
    }

    .checkout-box {
        padding: 25px 18px !important;
    }

    .checkout-box::before {
        font-size: 9px;
        right: 12px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .checkout-box {
        animation: none;
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

    <div class="checkout-box">

        <div class="eyebrow">Bookstore / Final Step</div>
        <h1>Checkout</h1>
        <p class="subtitle">
            Periksa kembali pesanan buku kamu sebelum melanjutkan.
        </p>

        @if($errors->any())
            <div class="message">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <h3 class="section-title">Ringkasan Pesanan</h3>

        @foreach($items as $item)
            <div class="item">
                <span class="item-number">ORDER / {{ $loop->iteration }}</span>

                @if($item['book']->cover_photo)
                    <img
                        class="cover"
                        src="{{ \Illuminate\Support\Str::startsWith($item['book']->cover_photo, ['http://', 'https://']) ? $item['book']->cover_photo : asset('storage/' . $item['book']->cover_photo) }}"
                        alt="{{ $item['book']->title }}"
                    >
                @else
                    <div class="cover" style="background:#e5e7eb;"></div>
                @endif

                <div class="book-info">
                    <h3>{{ $item['book']->title }}</h3>

                    <p>
                        Harga:
                        Rp {{ number_format($item['book']->price, 0, ',', '.') }}
                    </p>

                    <p>
                        Jumlah: {{ $item['quantity'] }} buku
                    </p>
                </div>

                <div class="subtotal">
                    Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                </div>

            </div>
        @endforeach

        <div class="total">
            <h3>Total Pembayaran</h3>
            <h2>
                Rp {{ number_format($total, 0, ',', '.') }}
            </h2>
        </div>

        <form
    action="{{ route('checkout.store') }}"
    method="POST"
    onsubmit="return confirm('Apakah kamu yakin ingin menyelesaikan pesanan ini?')"
>
    @csrf

    <div class="payment-section">
        <h3>METODE PEMBAYARAN</h3>

        <label class="payment-option">
            <input type="radio" name="payment_method" value="cod"
                {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }} required>
            <span>
                <strong>Cash on Delivery (COD)</strong>
                <small>Bayar ketika buku diterima.</small>
            </span>
        </label>

        <label class="payment-option">
            <input type="radio" name="payment_method" value="bank_transfer"
                {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }} required>
            <span>
                <strong>Transfer Bank</strong>
                <small>Transfer manual melalui rekening bank.</small>
            </span>
        </label>

        <div class="bank-info">
            <strong>INFORMASI TRANSFER</strong>
            <p>Bank BCA</p>
            <p>Nomor Rekening: 1234567890</p>
            <p>Atas Nama: BookStore</p>
            <small>Rekening contoh untuk demonstrasi proyek.</small>
        </div>

        @error('payment_method')
            <p class="payment-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="actions">
        <a href="{{ route('cart.index') }}" class="btn btn-gray">
            Kembali ke Keranjang
        </a>

        <button type="submit" class="btn btn-red">
            Konfirmasi Pesanan
        </button>
    </div>
</form>

    </div>

</div>

    @include('partials.music-player')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('checkoutMenuToggle');
    const links = document.getElementById('checkoutNavLinks');

    toggle?.addEventListener('click', function () {
        links?.classList.toggle('open');
    });

    links?.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            links.classList.remove('open');
        });
    });
});
</script>
</body>
</html>


