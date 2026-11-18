<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookStore</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #eef5ff;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 8px 30px #00000012;
        }

        h2 {
            text-align: center;
            color: #2563eb;
        }

        p {
            text-align: center;
            color: #64748b;
        }

        label {
            display: block;
            margin: 15px 0 7px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 22px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .success {
            color: #15803d;
            font-size: 13px;
            margin-bottom: 10px;
        }

        a {
            color: #2563eb;
            text-decoration: none;
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
</style>

    <link rel="stylesheet" href="{{ asset('css/persona5.css') }}">
<style>
/* PERSONA 5 AUTH DESIGN - KHUSUS LOGIN & REGISTER */

body {
    position: relative;
    isolation: isolate;
    min-height: 100vh;
    padding: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    background:
        radial-gradient(ellipse at 15% 15%, rgba(237,16,37,.19), transparent 35%),
        radial-gradient(ellipse at 90% 85%, rgba(169,0,22,.16), transparent 35%),
        #090909 !important;
    overflow-x: hidden;
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    z-index: -1;
    pointer-events: none;
    opacity: .18;
    background:
        radial-gradient(rgba(255,255,255,.85) 0.7px, transparent 0.9px),
        repeating-linear-gradient(
            125deg,
            transparent 0,
            transparent 75px,
            rgba(237,16,37,.35) 76px,
            transparent 78px
        );
    background-size: 22px 22px, auto;
}

body::after {
    content: "PERSONA";
    position: fixed;
    right: -35px;
    bottom: 5px;
    z-index: -1;
    pointer-events: none;
    color: rgba(237,16,37,.055);
    font-family: 'Barlow Condensed', sans-serif;
    font-size: clamp(100px, 22vw, 260px);
    font-weight: 900;
    font-style: italic;
    transform: rotate(-8deg);
}

.card {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 440px;
    padding: 42px 36px 34px;
    overflow: hidden;
    background: linear-gradient(145deg, #202020, #101010) !important;
    border: 1px solid #494949 !important;
    border-top: 5px solid #ed1025 !important;
    border-radius: 5px !important;
    box-shadow:
        10px 10px 0 rgba(237,16,37,.22),
        0 20px 65px rgba(0,0,0,.65) !important;
    animation: personaCardIn .65s cubic-bezier(.2,.8,.2,1) both;
}

.card::before {
    content: "BOOKSTORE";
    display: block;
    margin: -5px 0 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #444;
    color: #ed1025;
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 13px;
    font-weight: 900;
    letter-spacing: 3px;
}

.card::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 75px;
    height: 75px;
    background: linear-gradient(135deg, transparent 49%, #ed1025 50%, #ed1025 57%, transparent 58%);
    opacity: .85;
    pointer-events: none;
}

.card:hover {
    transform: translateY(-4px);
    border-color: #ed1025 !important;
    box-shadow:
        12px 13px 0 rgba(237,16,37,.25),
        0 25px 70px rgba(0,0,0,.7) !important;
}

.card h2 {
    margin: 0 0 8px;
    color: #fff !important;
    font-size: clamp(38px, 8vw, 48px) !important;
    font-weight: 900 !important;
    font-style: italic;
    letter-spacing: -1px;
    text-shadow: 3px 3px 0 #ed1025;
}

.card p {
    color: #aaa !important;
    font-size: 13px;
    line-height: 1.7;
}

.card label {
    margin: 17px 0 8px;
    color: #f5f5f5 !important;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.card input {
    width: 100%;
    padding: 13px 14px;
    color: #fff !important;
    background: #0b0b0b !important;
    border: 1px solid #4b4b4b !important;
    border-radius: 2px !important;
    outline: none;
    transition: border-color .25s, box-shadow .25s, transform .25s;
}

.card input:focus {
    border-color: #ed1025 !important;
    box-shadow: 0 0 0 3px rgba(237,16,37,.16), 0 0 18px rgba(237,16,37,.12);
    transform: translateX(2px);
}

.card input::placeholder {
    color: #777;
}

.card button[type="submit"] {
    width: 100%;
    min-height: 48px;
    margin-top: 25px;
    padding: 13px 18px;
    color: #fff !important;
    background: #ed1025 !important;
    border: 1px solid #ed1025 !important;
    border-radius: 2px !important;
    box-shadow: 5px 5px 0 #65000b;
    font-size: 13px;
    font-weight: 900;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    cursor: pointer;
    transition: .22s ease;
}

.card button[type="submit"]:hover {
    background: #ff3045 !important;
    border-color: #ff3045 !important;
    transform: translate(-2px,-2px);
    box-shadow: 7px 7px 0 #65000b;
}

.card button[type="submit"]:active {
    transform: translate(2px,2px);
    box-shadow: 2px 2px 0 #65000b;
}

.card a {
    color: #ff4054 !important;
    font-weight: 800;
    text-decoration: none;
    transition: .2s;
}

.card a:hover {
    color: #fff !important;
    text-shadow: 0 0 10px rgba(237,16,37,.8);
}

.card .error {
    padding: 12px;
    color: #ffc5cb !important;
    background: rgba(237,16,37,.12);
    border-left: 4px solid #ed1025;
    border-radius: 2px;
    line-height: 1.7;
}

.card .success {
    padding: 12px;
    color: #b9f3ca !important;
    background: rgba(20,120,60,.13);
    border-left: 4px solid #27ae60;
    border-radius: 2px;
}

.card form + p {
    margin-top: 25px;
    margin-bottom: 0;
}

@keyframes personaCardIn {
    from {
        opacity: 0;
        transform: translateY(24px) skewY(1deg);
    }
    to {
        opacity: 1;
        transform: translateY(0) skewY(0);
    }
}

@media (max-width: 480px) {
    body {
        padding: 17px;
    }

    .card {
        padding: 32px 23px 27px;
    }

    .card h2 {
        font-size: 39px !important;
    }
}

@media (prefers-reduced-motion: reduce) {
    .card {
        animation: none;
        transition: none;
    }

    .card input,
    .card button {
        transition: none;
    }
}
</style>
</head>

<body>

<div class="card">

    <h2>BookStore</h2>
    <p>Silakan login ke akun Anda</p>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">Login Sekarang</button>
    </form>

    <p>
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar</a>
    </p>

</div>

</body>
</html>