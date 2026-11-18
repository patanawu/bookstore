<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - BookStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/persona5.css') }}">
    <style>
        body {
            background: #090909;
            color: #f8f6f2;
            min-height: 100vh;
            padding: 45px 15px;
        }
        .contact-wrap { max-width: 760px; margin: auto; }
        .contact-card {
            background: #181818;
            border: 1px solid #383838;
            border-top: 5px solid #ed1025;
            padding: 32px;
            box-shadow: 6px 6px 0 #a90016;
        }
        .contact-title {
            color: #ed1025;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 46px;
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
        }
        .form-label { color: #fff; font-weight: 700; }
        .form-control {
            background: #101010;
            color: #fff;
            border: 1px solid #555;
            border-radius: 0;
            padding: 12px;
        }
        .form-control:focus {
            background: #101010;
            color: #fff;
            border-color: #ed1025;
            box-shadow: 0 0 0 .2rem rgba(237,16,37,.15);
        }
        .btn-send {
            background: #ed1025;
            color: #fff;
            border: 0;
            border-radius: 0;
            padding: 12px 25px;
            font-weight: 800;
            text-transform: uppercase;
        }
        .btn-send:hover { background: #b90018; color: #fff; }
        .back-link { color: #fff; text-decoration: none; font-weight: 700; }
        .back-link:hover { color: #ed1025; }
        .invalid-feedback { display: block; }
        @media(max-width:576px) {
            .contact-card { padding: 22px; }
            .contact-title { font-size: 36px; }
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
<div class="contact-wrap">
    <a href="{{ route('home') }}" class="back-link">&larr; Kembali ke Home</a>

    <div class="contact-card mt-4">
        <h1 class="contact-title">CONTACT US</h1>
        <p class="text-secondary mb-4">Punya pertanyaan atau masukan? Kirim pesan kepada tim BookStore.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">Periksa kembali data yang kamu masukkan.</div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control"
                    value="{{ old('name') }}" required maxlength="255">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email') }}" required maxlength="255">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Subjek</label>
                <input type="text" name="subject" class="form-control"
                    value="{{ old('subject') }}" required maxlength="255">
                @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Pesan</label>
                <textarea name="message" rows="6" class="form-control"
                    required minlength="10" maxlength="5000">{{ old('message') }}</textarea>
                @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-send">Kirim Pesan</button>
        </form>
    </div>
</div>
    @include('partials.music-player')
</body>
</html>

