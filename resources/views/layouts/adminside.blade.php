<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7fb;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: #dc3545; /* MERAH LAPOR PAK */
            color: #fff;
            position: fixed;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }



        .sidebar h4 {
            font-weight: 700;
        }

        .sidebar a {
            color: #e9ecef;
            text-decoration: none;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .sidebar a:hover {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }

        .sidebar a.active {
            background-color: #ffffff;
            color: #dc3545 !important;
            font-weight: 700;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }


        .sidebar-footer {
            padding: 1.25rem;
            background-color: rgba(0,0,0,0.08);
            border-top: 1px solid rgba(255,255,255,0.15);
        }

        .sidebar-footer .btn-logout {
            background-color: rgba(255,255,255,0.15);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
        }

        .sidebar-footer .btn-logout:hover {
            background-color: rgba(255,255,255,0.25);
        }


        .content {
            flex-grow: 1;
            padding: 24px;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1040;
            display: none;
        }
        /* DESKTOP */
        @media (min-width: 769px) {
            .content {
                margin-left: 260px;
            }
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 1045;
                transform: translateX(-100%);
                transition: transform .3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .navbar-admin {
                background-color: #dc3545;
                color: #fff;
            }

            .navbar-admin .fw-semibold {
                color: #fff;
            }

            .navbar-admin .btn {
                border-color: rgba(255,255,255,0.5);
                color: #fff;
            }

            .navbar-admin .btn:hover {
                background-color: rgba(255,255,255,0.15);
                color: #fff;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR MOBILE -->
<nav class="navbar navbar-admin shadow-sm d-lg-none">
    <div class="container-fluid">
        <span class="fw-semibold">Admin Panel</span>
        <button class="btn btn-outline-primary" id="toggleSidebar">
            <i class="bi bi-list"></i>
        </button>
    </div>
</nav>

<div class="d-flex">

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-body p-4">

            <div class="d-flex align-items-center justify-content-between mb-4 d-lg-none">
                <h5 class="mb-0 fw-bold text-white">Admin Panel</h5>
                <button class="btn btn-sm text-white" id="closeSidebar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <h4 class="mb-4 d-none d-md-block">Admin Panel</h4>

            <nav>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i> Daftar Laporan
                </a>

                <a href="{{ route('admin.user.index') }}" class="{{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Daftar User
                </a>

                @if(auth()->user()->role === 'superAdmin')
                    <a href="{{ route('admin.admins.index') }}" 
                    class="{{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Daftar Admin
                    </a>
                @endif


                <a href="{{ route('admin.kegiatan.index') }}" class="{{ request()->routeIs('admin.kegiatan.index') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i> Kegiatan RT
                </a>

                <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> Profile Admin
                </a>
            </nav>

        </div>

        <div class="sidebar-footer mt-auto">
            <div class="mb-2">
                <strong>{{ auth()->user()->name }}</strong><br>
                <small class="text-white-50">
                    {{ auth()->user()->role === 'superAdmin' ? 'Super Admin' : 'Admin' }}
                </small>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout w-100">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                </button>
            </form>
        </div>

    </aside>


    <!-- CONTENT -->
    <main class="content w-100">
        <h3 class="fw-bold mb-4">@yield('title')</h3>
        @yield('content')
    </main>

</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('toggleSidebar');
    const closeBtn = document.getElementById('closeSidebar');

    toggleBtn?.addEventListener('click', () => {
        sidebar.classList.add('show');
        overlay.classList.add('show');
    });

    closeBtn?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);

    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
