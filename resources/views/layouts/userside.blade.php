<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - LAPOR PAK!</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #dc3545; /* MERAH LAPOR PAK */
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        /* BRAND / LOGO */
        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }


        .btn-close-sidebar {
            display: none;
            background: transparent;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }


        /* MENU AREA */
        .sidebar-menu {
            padding: 1rem;
            flex-grow: 1;
        }

        /* LINK MENU */
        .sidebar .nav-link {
            color: rgba(255,255,255,0.85) !important;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }

        /* HOVER */
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white !important;
        }

        /* ACTIVE */
        .sidebar .nav-link.active {
            background-color: #ffffff;
            color: #dc3545 !important;
            font-weight: 700;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* ===============================
        FOOTER USER & LOGOUT
        ================================ */
        .sidebar-footer {
            padding: 1.5rem;
            background-color: rgba(0,0,0,0.05);
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-footer strong {
            font-size: 0.95rem;
        }

        .sidebar-footer small {
            font-size: 0.8rem;
            opacity: 0.9;
        }

        /* LOGOUT BUTTON */
        .sidebar-footer .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        /* ===============================
        MAIN CONTENT
        ================================ */
        .main-content {
            margin-left: 16rem;
            padding: 2rem;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* ===============================
        MOBILE HEADER
        ================================ */
        .mobile-header {
            display: none;
            background-color: #dc3545;
            padding: 0 16px;
            height: 55px;
            align-items: center;
            justify-content: space-between;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* ===============================
        OVERLAY MOBILE
        ================================ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* RESPONSIVE (MOBILE)*/
        @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
            padding: 1.5rem;
            padding-top: 80px;
        }

        .btn-close-sidebar {
            display: block;
        }

        .mobile-header {
            display: flex;
        }
    }

    </style>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div>
                <i class="bi bi-megaphone-fill me-2"></i> LAPOR PAK!
            </div>
            <button class="btn-close-sidebar" id="closeSidebar">
                &times;
            </button>
        </div>

        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}"
            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-3"></i> Dashboard
            </a>

            <a href="{{ route('pengaduan.index') }}"
            class="nav-link {{ request()->routeIs('pengaduan.index') ? 'active' : '' }}">
                <i class="bi bi-list-ul me-3"></i> Laporan Saya
            </a>

            <a href="{{ route('pengaduan.create') }}"
            class="nav-link {{ request()->routeIs('pengaduan.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle me-3"></i> Buat Laporan
            </a>
            <a href="{{ route('kegiatan.user') }}"
            class="nav-link {{ request()->routeIs('kegiatan.user') ? 'active' : '' }}">
                <i class="bi bi-activity me-3"></i> Kegiatan RT
            </a>
            <a href="{{ route('profile.index') }}"
            class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <i class="bi bi-person-circle me-3"></i> Profile
            </a>
        </div>

        <div class="sidebar-footer">
            <strong>{{ auth()->user()->name }}</strong><br>
            <small>Warga RT 1 RW 7</small>

            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </nav>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const closeBtn = document.getElementById('closeSidebar');

        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>
    
</body>
</html>



