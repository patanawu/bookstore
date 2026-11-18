
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | BookStore</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
            color: #263445;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #173e65;
            color: white;
            padding: 25px 18px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 40px;
            padding-left: 10px;
        }

        .brand i {
            color: #70b8ff;
            margin-right: 8px;
        }

        .menu-label {
            font-size: 11px;
            color: #a9bfd5;
            margin: 25px 10px 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d8e5f1;
            text-decoration: none;
            padding: 13px 14px;
            margin-bottom: 6px;
            border-radius: 9px;
            font-size: 14px;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2c5f8f;
            color: white;
        }

        .sidebar a i {
            font-size: 17px;
        }

        .logout {
            position: absolute;
            bottom: 25px;
            left: 18px;
            right: 18px;
        }

        .main-content {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .topbar h2 {
            font-size: 25px;
            font-weight: bold;
            color: #173e65;
        }

        .topbar p {
            color: #8794a3;
            font-size: 14px;
            margin-top: 5px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 10px 16px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            background: #e3f0ff;
            color: #2474bd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .profile-name {
            font-weight: bold;
            font-size: 13px;
        }

        .profile-role {
            color: #8b98a8;
            font-size: 11px;
        }

        .welcome-card {
            background: linear-gradient(120deg, #1c4d7c, #3987c9);
            color: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .welcome-card p {
            color: #d8eaff;
            margin-bottom: 0;
            font-size: 14px;
        }

        .welcome-icon {
            position: absolute;
            right: 45px;
            top: 15px;
            font-size: 100px;
            color: rgba(255,255,255,.15);
        }

        .section-title {
            font-size: 19px;
            font-weight: bold;
            color: #24496d;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            padding: 23px;
            border-radius: 14px;
            border: none;
            height: 100%;
            box-shadow: 0 3px 15px rgba(0,0,0,.035);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 17px;
        }

        .icon-blue {
            background: #e3f0ff;
            color: #3687d0;
        }

        .icon-green {
            background: #e1f6eb;
            color: #2ba66a;
        }

        .icon-orange {
            background: #fff0dc;
            color: #e69a35;
        }

        .icon-purple {
            background: #eee7ff;
            color: #8764d5;
        }

        .stat-card h3 {
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: #8995a4;
            font-size: 13px;
            margin: 0;
        }

        .management-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            height: 100%;
            box-shadow: 0 3px 15px rgba(0,0,0,.035);
            transition: .2s;
        }

        .management-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 22px rgba(0,0,0,.08);
        }

        .management-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e7f1fc;
            color: #337fbd;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .management-card h5 {
            font-size: 16px;
            font-weight: bold;
            color: #24496d;
        }

        .management-card p {
            color: #8995a4;
            font-size: 13px;
            min-height: 40px;
        }

        .management-card .btn {
            font-size: 13px;
            padding: 8px 16px;
            border-radius: 7px;
        }

        .btn-primary {
            background: #337fbd;
            border-color: #337fbd;
        }

        .btn-primary:hover {
            background: #24669e;
            border-color: #24669e;
        }

        .footer {
            text-align: center;
            color: #a1aab5;
            font-size: 12px;
            margin-top: 40px;
        }

        @media(max-width: 768px) {
            .sidebar {
                width: 75px;
                padding: 20px 10px;
            }

            .brand {
                font-size: 0;
                text-align: center;
                padding: 0;
            }

            .brand i {
                font-size: 25px;
                margin: 0;
            }

            .menu-label,
            .sidebar a span,
            .logout span {
                display: none;
            }

            .sidebar a {
                justify-content: center;
                padding: 14px 5px;
            }

            .logout {
                left: 10px;
                right: 10px;
            }

            .main-content {
                margin-left: 75px;
                padding: 20px 15px;
            }

            .welcome-icon {
                display: none;
            }

            .topbar {
                align-items: flex-start;
                gap: 15px;
            }

            .admin-profile {
                padding: 7px;
            }

            .profile-info {
                display: none;
            }
        }
    </style>

<link rel='stylesheet' href='{{ asset('css/persona5.css') }}'>

<style>
/* ADMIN DASHBOARD - PERSONA 5 OVERRIDE */

body.admin-dashboard {
    background-color: #090909 !important;
    color: #f8f6f2 !important;
    font-family: Inter, sans-serif !important;
}

body.admin-dashboard .sidebar {
    width: 250px !important;
    height: 100vh !important;
    position: fixed !important;
    inset: 0 auto 0 0 !important;
    padding: 25px 18px !important;
    background: #101010 !important;
    border-right: 4px solid #ed1025 !important;
    z-index: 1000;
}

body.admin-dashboard .brand {
    color: #fff !important;
    font-family: 'Barlow Condensed', sans-serif !important;
    font-size: 28px !important;
    font-weight: 900 !important;
    text-transform: uppercase;
    margin-bottom: 40px;
}

body.admin-dashboard .brand i {
    color: #ed1025 !important;
}

body.admin-dashboard .menu-label {
    color: #888 !important;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

body.admin-dashboard .sidebar a {
    color: #ddd !important;
    border-radius: 2px !important;
    padding: 13px 14px;
    margin-bottom: 7px;
    font-weight: 700;
}

body.admin-dashboard .sidebar a:hover,
body.admin-dashboard .sidebar a.active {
    background: #ed1025 !important;
    color: #fff !important;
    box-shadow: 4px 4px 0 #65000b;
}

body.admin-dashboard .sidebar a i {
    color: inherit !important;
}

body.admin-dashboard .main-content {
    margin-left: 250px !important;
    padding: 35px !important;
    min-height: 100vh;
    color: #fff !important;
}

body.admin-dashboard .topbar {
    padding-bottom: 22px;
    border-bottom: 1px solid #333;
}

body.admin-dashboard .topbar h2 {
    color: #fff !important;
    font-size: 34px !important;
    letter-spacing: 1px;
}

body.admin-dashboard .topbar p {
    color: #aaa !important;
}

body.admin-dashboard .admin-profile {
    background: #181818 !important;
    border: 1px solid #444;
    border-radius: 2px !important;
    color: #fff;
}

body.admin-dashboard .profile-icon {
    background: #ed1025 !important;
    color: white !important;
    border-radius: 2px !important;
}

body.admin-dashboard .profile-name {
    color: #fff;
}

body.admin-dashboard .profile-role {
    color: #aaa;
}

body.admin-dashboard .welcome-card {
    background: linear-gradient(115deg, #79000d, #ed1025) !important;
    border-left: 8px solid white !important;
    border-radius: 2px !important;
    padding: 35px !important;
    box-shadow: 8px 8px 0 #410008 !important;
}

body.admin-dashboard .welcome-card h3 {
    color: white !important;
    font-size: 32px !important;
}

body.admin-dashboard .welcome-card p {
    color: #fff !important;
}

body.admin-dashboard .welcome-icon {
    color: rgba(255,255,255,.15) !important;
}

body.admin-dashboard .section-title {
    color: #fff !important;
    font-size: 25px;
    text-transform: uppercase;
    border-left: 5px solid #ed1025;
    padding-left: 12px;
}

body.admin-dashboard .stat-card,
body.admin-dashboard .management-card {
    background: #181818 !important;
    border: 1px solid #444 !important;
    border-radius: 2px !important;
    box-shadow: 5px 5px 0 rgba(237,16,37,.22) !important;
    color: #fff !important;
}

body.admin-dashboard .stat-card {
    padding: 23px;
    min-height: 175px;
}

body.admin-dashboard .stat-icon,
body.admin-dashboard .management-icon {
    background: #30090e !important;
    color: #ff3449 !important;
    border: 1px solid #ed1025;
    border-radius: 2px !important;
}

body.admin-dashboard .stat-card h3 {
    color: #ed1025 !important;
    font-family: 'Barlow Condensed', sans-serif !important;
    font-size: 34px !important;
}

body.admin-dashboard .stat-card p,
body.admin-dashboard .management-card p {
    color: #aaa !important;
}

body.admin-dashboard .management-card {
    transition: .2s ease;
}

body.admin-dashboard .management-card:hover {
    transform: translateY(-5px);
    border-color: #ed1025 !important;
    box-shadow: 7px 7px 0 rgba(237,16,37,.35) !important;
}

body.admin-dashboard .management-card h5 {
    color: #fff !important;
    font-size: 21px !important;
}

body.admin-dashboard .management-card .btn {
    border-radius: 0 !important;
}

body.admin-dashboard .footer {
    color: #777 !important;
    border-top: 1px solid #333;
    padding-top: 20px;
}

body.admin-dashboard .logout button {
    border-radius: 0 !important;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    body.admin-dashboard .sidebar {
        width: 76px !important;
        height: 100vh !important;
        position: fixed !important;
        padding: 20px 9px !important;
    }

    body.admin-dashboard .brand {
        font-size: 0 !important;
        text-align: center;
        padding: 0;
    }

    body.admin-dashboard .brand i {
        font-size: 25px;
    }

    body.admin-dashboard .menu-label,
    body.admin-dashboard .sidebar a span,
    body.admin-dashboard .logout span {
        display: none !important;
    }

    body.admin-dashboard .sidebar a {
        justify-content: center;
        padding: 14px 5px;
    }

    body.admin-dashboard .logout {
        left: 8px;
        right: 8px;
    }

    body.admin-dashboard .main-content {
        margin-left: 76px !important;
        padding: 20px 14px !important;
    }

    body.admin-dashboard .topbar {
        flex-wrap: wrap;
        gap: 15px;
    }

    body.admin-dashboard .welcome-card {
        padding: 24px !important;
    }

    body.admin-dashboard .welcome-card h3 {
        font-size: 25px !important;
    }

    body.admin-dashboard .welcome-icon {
        display: none;
    }

    body.admin-dashboard .profile-info {
        display: none;
    }
}

/* PERSONA 5 SUBTLE DASHBOARD EFFECT */

body.admin-dashboard {
    position: relative;
    isolation: isolate;
    background-image:
        radial-gradient(circle at 88% 18%, rgba(237,16,37,.13), transparent 25%),
        radial-gradient(circle at 15% 85%, rgba(237,16,37,.07), transparent 28%),
        repeating-linear-gradient(
            135deg,
            transparent 0px,
            transparent 35px,
            rgba(255,255,255,.012) 36px,
            transparent 38px
        ) !important;
}

body.admin-dashboard::before {
    content: "";
    position: fixed;
    inset: 0;
    z-index: -1;
    pointer-events: none;
    opacity: .18;
    background-image: radial-gradient(
        rgba(255,255,255,.35) .8px,
        transparent .8px
    );
    background-size: 22px 22px;
}

body.admin-dashboard::after {
    content: "♛";
    position: fixed;
    right: 3%;
    bottom: 2%;
    z-index: -1;
    pointer-events: none;
    color: rgba(237,16,37,.045);
    font-size: clamp(180px, 27vw, 390px);
    font-weight: 900;
    line-height: 1;
    transform: rotate(-12deg);
    text-shadow: 0 0 45px rgba(237,16,37,.12);
    animation: adminPhantomFloat 9s ease-in-out infinite;
}

body.admin-dashboard .welcome-card {
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 25px rgba(237,16,37,.13),
                7px 7px 0 rgba(0,0,0,.35) !important;
}

body.admin-dashboard .welcome-card::after {
    content: "PHANTOM THIEVES";
    position: absolute;
    right: 22px;
    bottom: 10px;
    color: rgba(255,255,255,.12);
    font-family: 'Barlow Condensed', sans-serif;
    font-size: clamp(22px, 4vw, 42px);
    font-weight: 900;
    letter-spacing: 4px;
    transform: skew(-10deg);
    pointer-events: none;
}

body.admin-dashboard .stat-card,
body.admin-dashboard .management-card {
    position: relative;
    overflow: hidden;
    transition: transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease !important;
}

body.admin-dashboard .stat-card::before,
body.admin-dashboard .management-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 38px;
    height: 3px;
    background: #ed1025;
    box-shadow: 0 0 12px rgba(237,16,37,.7);
}

body.admin-dashboard .stat-card:hover {
    transform: translateY(-4px);
    border-color: rgba(237,16,37,.75) !important;
    box-shadow: 0 0 18px rgba(237,16,37,.16),
                5px 5px 0 rgba(237,16,37,.2) !important;
}

body.admin-dashboard .management-card:hover {
    box-shadow: 0 0 22px rgba(237,16,37,.2),
                7px 7px 0 rgba(237,16,37,.35) !important;
}

body.admin-dashboard .section-title {
    text-shadow: 0 0 14px rgba(237,16,37,.25);
}

body.admin-dashboard .topbar h2 {
    text-shadow: 2px 2px 0 rgba(237,16,37,.35);
}

@keyframes adminPhantomFloat {
    0%, 100% {
        transform: translateY(0) rotate(-12deg);
        opacity: .75;
    }
    50% {
        transform: translateY(-15px) rotate(-8deg);
        opacity: 1;
    }
}

@media (prefers-reduced-motion: reduce) {
    body.admin-dashboard::after {
        animation: none;
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
<style>
/* LOGO B ADMIN - MENYERUPAI NAVBAR USER */
body.admin-dashboard .sidebar .brand {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    min-height: 38px;
    padding: 0 10px !important;
    margin-bottom: 40px !important;
    font-size: 0 !important;
}

body.admin-dashboard .sidebar .brand-mark {
    display: grid !important;
    place-items: center !important;
    width: 38px !important;
    min-width: 38px !important;
    height: 38px !important;
    background: #ed1c24 !important;
    color: #ffffff !important;
    -webkit-text-fill-color: #ffffff !important;
    font-family: 'Barlow Condensed', sans-serif !important;
    font-size: 25px !important;
    font-weight: 900 !important;
    line-height: 1 !important;
    clip-path: polygon(15% 0,100% 0,85% 100%,0 85%);
}
</style>
<style>
/* BRAND ADMIN - SAMA DENGAN NAVBAR HOME */
body.admin-dashboard .sidebar .brand {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    gap: 10px !important;
    padding: 0 10px !important;
    margin-bottom: 40px !important;
    font-family: 'Barlow Condensed', sans-serif !important;
    font-size: 31px !important;
    font-weight: 900 !important;
    line-height: 1 !important;
}

body.admin-dashboard .sidebar .brand-mark {
    display: grid !important;
    place-items: center !important;
    width: 38px !important;
    min-width: 38px !important;
    height: 38px !important;
    background: #ed1c24 !important;
    color: #fff !important;
    -webkit-text-fill-color: #fff !important;
    font-size: 25px !important;
    font-weight: 900 !important;
    clip-path: polygon(15% 0,100% 0,85% 100%,0 85%);
}

body.admin-dashboard .sidebar .brand-text {
    color: #ed1c24 !important;
    -webkit-text-fill-color: #ed1c24 !important;
    font-family: 'Barlow Condensed', sans-serif !important;
    font-size: 31px !important;
    font-weight: 900 !important;
    letter-spacing: -1px !important;
    white-space: nowrap !important;
}

body.admin-dashboard .sidebar .brand-text span {
    color: #ed1c24 !important;
    -webkit-text-fill-color: #ed1c24 !important;
}
</style>
</head>

<body class="admin-dashboard" data-persona-admin-bg="1">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
    <span class="brand-mark">B</span>
    <span class="brand-text">BOOK<span>STORE</span></span>
</div>

        <div class="menu-label">Menu Utama</div>

        <a href="{{ route('admin.dashboard') }}" class="active">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <div class="menu-label">Manajemen Data</div>

        <a href="{{ route('admin.genres') }}">
            <i class="bi bi-tags"></i>
            <span>Kelola Genre</span>
        </a>

        <a href="{{ route('admin.authors') }}">
            <i class="bi bi-pen"></i>
            <span>Kelola Author</span>
        </a>

        <a href="{{ route('admin.books') }}">
            <i class="bi bi-book"></i>
            <span>Kelola Buku</span>
        </a>

        <div class="menu-label">Pengguna</div>

        <a href="{{ route('admin.users') }}">
            <i class="bi bi-people"></i>
            <span>Daftar User</span>
        </a>

        <a href="{{ route('admin.orders') }}">
            <i class="bi bi-cart-check"></i>
            <span>Daftar Pesanan</span>
        </a>
        <a href="{{ route('admin.contact-messages.index') }}">
            <i class="bi bi-envelope"></i>
            <span>Pesan Masuk</span>
        </a>

        <div class="logout">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="btn btn-outline-light w-100 text-start">
                    <i class="bi bi-box-arrow-left me-2"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <div class="topbar">
            <div>
                <h2>Dashboard</h2>
                <p>Selamat datang di halaman administrasi BookStore.</p>
            </div>

            <div class="admin-profile">
                <div class="profile-icon">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="profile-info">
                    <div class="profile-name">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="profile-role">Administrator</div>
                </div>
            </div>
        </div>


        <!-- WELCOME -->
        <div class="welcome-card">
            <h3>Selamat Datang, {{ auth()->user()->name }}!</h3>
            <p>
                Kelola data buku, kategori, penulis, dan pengguna
                melalui dashboard BookStore.
            </p>

            <i class="bi bi-book-half welcome-icon"></i>
        </div>


        <!-- STATISTICS -->
        <h4 class="section-title">Ringkasan Data</h4>

        <div class="row g-4 mb-5">

            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon icon-blue">
                        <i class="bi bi-book"></i>
                    </div>
                    <h3>{{ \App\Models\Book::count() }}</h3>
                    <p>Total Buku</p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon icon-green">
                        <i class="bi bi-tags"></i>
                    </div>
                    <h3>{{ \App\Models\Genre::count() }}</h3>
                    <p>Total Genre</p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon icon-orange">
                        <i class="bi bi-pen"></i>
                    </div>
                    <h3>{{ \App\Models\Author::count() }}</h3>
                    <p>Total Author</p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon icon-purple">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>{{ \App\Models\User::where('role', 'user')->count() }}</h3>
                    <p>Total User</p>
                </div>
            </div>

        </div>


        <!-- MANAGEMENT MENU -->
        <h4 class="section-title">Manajemen BookStore</h4>

        <div class="row g-4">

            <!-- GENRE -->
            <div class="col-md-6 col-xl-4">
                <div class="management-card">
                    <div class="management-icon">
                        <i class="bi bi-tags"></i>
                    </div>
                    <h5>Kelola Genre</h5>
                    <p>
                        Tambah, edit, dan hapus kategori buku.
                    </p>
                    <a href="{{ route('admin.genres') }}"
                       class="btn btn-primary">
                        Kelola Genre
                    </a>
                </div>
            </div>


            <!-- AUTHOR -->
            <div class="col-md-6 col-xl-4">
                <div class="management-card">
                    <div class="management-icon">
                        <i class="bi bi-pen"></i>
                    </div>
                    <h5>Kelola Author</h5>
                    <p>
                        Atur data penulis buku yang tersedia.
                    </p>
                    <a href="{{ route('admin.authors') }}"
                       class="btn btn-primary">
                        Kelola Author
                    </a>
                </div>
            </div>


            <!-- BOOK -->
            <div class="col-md-6 col-xl-4">
                <div class="management-card">
                    <div class="management-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <h5>Kelola Buku</h5>
                    <p>
                        Tambah, edit, hapus, dan pantau stok buku.
                    </p>
                    <a href="{{ route('admin.books') }}"
                       class="btn btn-primary">
                        Kelola Buku
                    </a>
                </div>
            </div>


            <!-- USERS -->
            <div class="col-md-6 col-xl-4">
                <div class="management-card">
                    <div class="management-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5>Daftar User</h5>
                    <p>
                        Lihat pengguna yang sudah terdaftar.
                    </p>
                    <a href="{{ route('admin.users') }}"
                       class="btn btn-primary">
                        Lihat User
                    </a>
                </div>
            </div>


            <!-- ORDERS -->
            <div class="col-md-6 col-xl-4">
                <div class="management-card">
                    <div class="management-icon">
                        <i class="bi bi-cart-check"></i>
                    </div>
                    <h5>Daftar Pesanan</h5>
                    <p>
                        Pantau pesanan buku dari pengguna.
                    </p>
                    <a href="{{ route('admin.orders') }}" class="btn btn-primary">Lihat Pesanan</a>
                </div>
            </div>


                        <!-- CONTACT MESSAGES -->
            <div class="col-md-6 col-xl-4">
                <div class="management-card">
                    <div class="management-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h5>Pesan Masuk</h5>
                    <p>Baca dan kelola pesan dari pengunjung BookStore.</p>
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-primary">
                        Lihat Pesan
                    </a>
                </div>
            </div>
<!-- PROFILE -->
            <div class="col-md-6 col-xl-4">
                <div class="management-card">
                    <div class="management-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <h5>Administrator</h5>
                    <p>
                        Anda sedang mengelola aplikasi BookStore.
                    </p>
                    <span class="badge bg-success">Admin Aktif</span>
                </div>
            </div>

        </div>


        <!-- FOOTER -->
        <div class="footer">
            &copy; {{ date('Y') }} BookStore Admin Dashboard.
            All Rights Reserved.
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

