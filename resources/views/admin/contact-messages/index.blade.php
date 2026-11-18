<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesan Masuk - BookStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/persona5.css') }}">
    <style>
        body { background:#090909; color:#f8f6f2; min-height:100vh; padding:35px 15px; }
        .messages-wrap { max-width:1100px; margin:auto; }
        .page-title {
            color:#ed1025; font-family:'Barlow Condensed',sans-serif;
            font-size:46px; font-weight:900; font-style:italic;
        }
        .message-card {
            background:#181818; border:1px solid #383838;
            border-left:5px solid #ed1025; padding:22px;
            margin-bottom:18px; box-shadow:4px 4px 0 #a90016;
        }
        .message-subject { color:#ed1025; font-weight:900; font-size:20px; }
        .message-meta { color:#aaa; font-size:14px; }
        .message-body { white-space:pre-wrap; overflow-wrap:anywhere; color:#eee; }
        .btn-back {
            display:inline-block; color:#fff; border:2px solid #ed1025;
            padding:9px 17px; text-decoration:none; font-weight:800;
        }
        .btn-back:hover { background:#ed1025; color:#fff; }
        .btn-delete { border-radius:0; font-weight:700; }
    </style>

<style>

/* PERSONA 5 ADMIN BACKGROUND ONLY */

body[data-persona-admin-bg="1"] {
    position: relative;
    isolation: isolate;
    background-image:
        radial-gradient(circle at 88% 16%, rgba(237,16,37,.17), transparent 28%),
        radial-gradient(circle at 8% 85%, rgba(237,16,37,.09), transparent 30%),
        repeating-linear-gradient(
            135deg,
            transparent 0,
            transparent 38px,
            rgba(255,255,255,.012) 39px,
            transparent 41px
        ) !important;
    background-attachment: fixed !important;
}

body[data-persona-admin-bg="1"]::before {
    content: "";
    position: fixed;
    inset: 0;
    z-index: -1;
    pointer-events: none;
    opacity: .16;
    background-image: radial-gradient(
        rgba(255,255,255,.4) .8px,
        transparent .8px
    );
    background-size: 22px 22px;
}

body[data-persona-admin-bg="1"]::after {
    content: "\265B";
    position: fixed;
    right: 3%;
    bottom: 1%;
    z-index: -1;
    pointer-events: none;
    color: rgba(237,16,37,.055);
    font-size: clamp(190px, 28vw, 400px);
    font-weight: 900;
    line-height: 1;
    transform: rotate(-12deg);
    text-shadow: 0 0 45px rgba(237,16,37,.2);
    animation: adminPersonaCrown 9s ease-in-out infinite;
}

@keyframes adminPersonaCrown {
    0%, 100% {
        transform: translateY(0) rotate(-12deg);
        opacity: .65;
    }
    50% {
        transform: translateY(-14px) rotate(-8deg);
        opacity: 1;
    }
}

@media (prefers-reduced-motion: reduce) {
    body[data-persona-admin-bg="1"]::after {
        animation: none;
    }
}
.page-title {
    color: #ed1025 !important;
}

</style>
</head>
<body data-persona-admin-bg="1">
<div class="messages-wrap">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title mb-0">PESAN MASUK</h1>
            <p class="text-secondary mb-0">Pesan yang dikirim oleh pengunjung BookStore.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn-back">←</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-secondary">Total pesan: {{ $messages->count() }}</div>

    @forelse($messages as $message)
        <div class="message-card">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div class="message-subject">{{ $message->subject }}</div>
                <div class="message-meta">{{ $message->created_at->format('d/m/Y H:i') }}</div>
            </div>

            <div class="mt-2 mb-3 message-meta">
                <strong class="text-white">{{ $message->name }}</strong>
                &middot;
                <a href="mailto:{{ $message->email }}" class="text-info">{{ $message->email }}</a>
            </div>

            <div class="message-body mb-3">{{ $message->message }}</div>

            <form action="{{ route('admin.contact-messages.destroy', $message) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-delete">Hapus Pesan</button>
            </form>
        </div>
    @empty
        <div class="message-card text-center text-secondary">
            Belum ada pesan masuk.
        </div>
    @endforelse
</div>
</body>
</html>
