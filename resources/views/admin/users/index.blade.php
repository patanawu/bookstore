<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar User - BookStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/persona5.css') }}">

    <style>
        body.admin-users-page {
            background: #090909 !important;
            color: #f8f6f2 !important;
            min-height: 100vh;
            padding: 35px 15px;
        }

        .users-wrapper {
            max-width: 1150px;
            margin: auto;
        }

        .users-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .users-title {
            color: #ed1025 !important;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 900;
            font-style: italic;
            text-transform: uppercase;
            margin: 0;
        }

        .users-subtitle {
            color: #aaa;
            margin: 5px 0 0;
        }

        .users-back {
            display: inline-block;
            padding: 11px 20px;
            color: #fff !important;
            border: 2px solid #ed1025;
            text-decoration: none;
            font-weight: 800;
            text-transform: uppercase;
            transition: .2s;
        }

        .users-back:hover {
            background: #ed1025;
            transform: translateY(-2px);
        }

        .users-panel {
            background: #181818;
            border: 1px solid #383838;
            border-top: 5px solid #ed1025;
            padding: 25px;
            box-shadow: 8px 8px 0 #a90016;
        }

        .users-panel-heading {
            color: #fff;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            color: #f8f6f2;
            min-width: 650px;
        }

        .users-table th {
            background: #ed1025;
            color: #fff;
            padding: 15px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
            border: 0;
        }

        .users-table td {
            background: #202020;
            color: #eee;
            padding: 15px;
            border-bottom: 1px solid #383838;
        }

        .users-table tr:hover td {
            background: #292929;
        }

        .user-number {
            color: #ed1025 !important;
            font-weight: 900;
        }

        .user-email {
            color: #ddd !important;
        }

        .users-empty {
            text-align: center;
            padding: 35px !important;
            color: #aaa !important;
        }

        .users-total {
            margin: 20px 0 0;
            color: #aaa;
            font-weight: 700;
        }

        .users-total strong {
            color: #ed1025;
            font-size: 22px;
        }

        @media (max-width: 600px) {
            body.admin-users-page {
                padding: 22px 12px;
            }

            .users-panel {
                padding: 15px;
                box-shadow: 4px 4px 0 #a90016;
            }

            .users-back {
                width: 100%;
                text-align: center;
            }
        }
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

</style>
</head>

<body class="admin-users-page" data-persona-admin-bg="1">
    <main class="users-wrapper">
        <header class="users-header">
            <div>
                <h1 class="users-title">Registered Users</h1>
                <p class="users-subtitle">Daftar pengguna yang telah terdaftar di BookStore.</p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="users-back">←</a>
        </header>

        <section class="users-panel">
            <h2 class="users-panel-heading">Data Pengguna</h2>

            <div class="table-responsive">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Tanggal Registrasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="user-number">{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="user-email">{{ $user->email }}</td>
                                <td>{{ $user->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="users-empty">
                                    Belum ada user yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p class="users-total">
                TOTAL USER TERDAFTAR:
                <strong>{{ $users->count() }}</strong>
            </p>
        </section>
    </main>
</body>
</html>