
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - BookSales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #eaf4ff, #f8fbff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 18px;
        }
        .btn-primary {
            background: #3987d6;
            border: none;
        }
    </style>

<link rel='stylesheet' href='{{ asset('css/persona5.css') }}'>

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

</style>
</head>
<body data-persona-admin-bg="1">
    <div class="card login-card shadow p-4">
        <div class="text-center mb-4">
            <h3 class="fw-bold">BookSales</h3>
            <p class="text-muted">Admin Dashboard Login</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                       class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>
        </form>
    </div>
</body>
</html>

