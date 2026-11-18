<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - BookStore</title>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap');

    * { box-sizing: border-box; }

    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        background: #101010;
        color: white;
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
        background: #ed1c24;
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
        font-size: 17px;
        font-weight: 800;
        font-style: italic;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-left: 3px solid #ed1c24;
        padding: 6px 12px;
        background: linear-gradient(90deg, rgba(237,28,36,.16), transparent);
    }

    .logout-form {
        display: inline;
        margin: 0;
    }

    .container {
        max-width: 1000px;
        margin: 55px auto;
        padding: 20px;
    }

    .success-box {
        position: relative;
        overflow: hidden;
        max-width: 680px;
        width: 100%;
        margin: auto;
        padding: 45px 35px;
        background: #191919;
        border: 1px solid #383838;
        border-top: 5px solid #ed1c24;
        border-right: 3px solid #ed1c24;
        text-align: center;
        box-shadow: 10px 10px 0 #050505;
    }

    .success-box::before {
        content: "MISSION COMPLETE";
        position: absolute;
        top: 20px;
        right: -20px;
        color: rgba(255,255,255,.035);
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 65px;
        font-weight: 900;
        transform: rotate(-12deg);
        pointer-events: none;
    }

    .eyebrow {
        position: relative;
        z-index: 1;
        color: #ed1c24;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 4px;
        margin-bottom: 22px;
    }

    .check {
        position: relative;
        z-index: 1;
        width: 90px;
        height: 90px;
        background: #ed1c24;
        color: white;
        border: 4px solid white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
        font-size: 48px;
        font-weight: bold;
        margin: 0 auto 25px;
        transform: rotate(-6deg);
        box-shadow: 7px 7px 0 #7e1015;
    }

    h1 {
        position: relative;
        z-index: 1;
        color: white;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 48px;
        font-weight: 900;
        font-style: italic;
        text-transform: uppercase;
        margin: 0 0 12px;
        text-shadow: 3px 3px 0 #ed1c24;
    }

    p {
        position: relative;
        z-index: 1;
        line-height: 1.7;
        color: #aaa;
        font-size: 14px;
    }

    .order {
        position: relative;
        z-index: 1;
        background: #111;
        padding: 22px;
        border: 1px solid #ed1c24;
        border-left: 5px solid #ed1c24;
        margin: 28px 0;
    }

    .order p {
        margin: 0 0 8px;
        color: #aaa;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .order strong {
        color: #ed1c24;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 27px;
        font-weight: 900;
        letter-spacing: 1px;
        word-break: break-word;
    }

    .buttons {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 30px;
    }

    /* Semua tombol menggunakan satu gaya */
    .btn,
    .logout-button {
        display: inline-block;
        padding: 13px 22px;
        background: #ed1c24;
        color: white;
        border: 1px solid #ed1c24;
        border-radius: 0;
        text-decoration: none;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 17px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        box-shadow: 4px 4px 0 white;
        transition: .2s ease;
    }

    .btn:hover,
    .logout-button:hover {
        background: white;
        color: #ed1c24;
        border-color: white;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0 #ed1c24;
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

        .success-box {
            padding: 35px 20px;
        }

        h1 {
            font-size: 39px;
        }

        .success-box::before {
            font-size: 45px;
        }

        .buttons {
            flex-direction: column;
        }

        .buttons .btn {
            width: 100%;
            text-align: center;
        }
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

/* PERSONA SUCCESS VISUAL ENHANCEMENT */

/* Glow dan tekstur pada panel utama - border asli dipertahankan */
.success-box {
    background:
        radial-gradient(ellipse at 50% 0%, rgba(237,28,36,.16), transparent 55%),
        linear-gradient(145deg, #1d1d1d, #111 75%);
    box-shadow:
        10px 10px 0 #050505,
        0 0 35px rgba(237,28,36,.13),
        inset 0 0 35px rgba(255,255,255,.015);
    animation: successEntrance .8s ease-out both;
}

/* Aksen sudut dekoratif */
.success-box::after {
    content: "PHANTOM THIEVES";
    position: absolute;
    right: -35px;
    bottom: 24px;
    transform: rotate(-45deg);
    padding: 8px 42px;
    background: rgba(237,28,36,.10);
    color: rgba(255,255,255,.12);
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 3px;
    pointer-events: none;
}

/* Ikon transaksi berhasil */
.check {
    animation: checkPulse 2.8s ease-in-out infinite;
    box-shadow:
        0 0 15px rgba(237,28,36,.35),
        0 0 35px rgba(237,28,36,.18);
}

/* Judul */
.success-box h1 {
    text-shadow:
        2px 2px 0 rgba(237,28,36,.35),
        0 0 22px rgba(237,28,36,.15);
    letter-spacing: 1px;
}

/* Label bagian atas */
.eyebrow {
    text-shadow: 0 0 12px rgba(237,28,36,.35);
}

/* Panel nomor pesanan */
.order {
    background:
        linear-gradient(110deg, rgba(237,28,36,.13), transparent 75%),
        #111;
    box-shadow: inset 0 0 22px rgba(237,28,36,.06);
}

.order strong {
    text-shadow: 0 0 12px rgba(237,28,36,.35);
}

/* Ornamen Persona di latar */
body::after {
    content: "♛";
    color: rgba(237,28,36,.055);
    text-shadow:
        0 0 35px rgba(237,28,36,.20),
        0 0 75px rgba(237,28,36,.12);
}

/* Animasi masuk dan denyut */
@keyframes successEntrance {
    from {
        opacity: 0;
        transform: translateY(18px) scale(.985);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes checkPulse {
    0%, 100% {
        filter: brightness(1);
        box-shadow: 0 0 15px rgba(237,28,36,.35);
    }
    50% {
        filter: brightness(1.2);
        box-shadow: 0 0 28px rgba(237,28,36,.5);
    }
}

@media (prefers-reduced-motion: reduce) {
    .success-box,
    .check {
        animation: none !important;
    }
}
</style>
    <link rel='stylesheet' href='{{ asset('css/persona5-buttons.css') }}'>

</head>

<body>

    @include('partials.user-navbar')

    <div class="container">
        <div class="success-box">
            <div class="eyebrow">BOOKSTORE / TRANSACTION REPORT</div>

            <div class="check">&#10003;</div>

            <h1>MISSION COMPLETE!</h1>

            <p>
                Terima kasih sudah berbelanja di BookStore.
                Pesanan kamu berhasil disimpan.
            </p>

            @if(session('success'))
                <p>{{ session('success') }}</p>
            @endif

            @if($orderNumber)
                <div class="order">
                    <p>Nomor Pesanan</p>
                    <strong>{{ $orderNumber }}</strong>
                </div>
            @endif

            <div class="buttons">
                @if($orderNumber)
                    <a href="{{ route('orders.show', $orderNumber) }}" class="btn">
                        Lihat Detail Pesanan
                    </a>
                @endif

                <a href="{{ route('catalog.index') }}" class="btn btn-secondary">
                    Kembali ke Katalog
                </a>
            </div>

        </div>
    </div>

    @include('partials.music-player')
</body>
</html>

