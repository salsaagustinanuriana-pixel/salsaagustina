<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            /* Palette Slate (Abu-abu) */
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-800: #1e293b;
            --slate-900: #0f172a;

            /* Palette Pink (Aksen) */
            --pink-accent: #f472b6;
            /* Pink cerah */
            --pink-dark: #db2777;
            /* Pink tua */
            --pink-soft: rgba(244, 114, 182, 0.1);

            --sidebar-bg: #1e293b;
            /* Abu-abu arang */
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--slate-200);
            /* Background luar abu-abu lebih keliatan */
            color: var(--slate-900);
            margin: 0;
        }

        /* ===== Sidebar Modern ===== */
        .sidebar {
            min-height: 100vh;
            width: 260px;
            background: var(--sidebar-bg);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
        }

        .brand {
            padding: 24px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .brand span {
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #fff;
        }

        .brand-icon {
            background: var(--pink-accent);
            /* Logo jadi Pink */
            border-radius: 8px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
        }

        .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 4px 16px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .nav-link i {
            font-size: 1.1rem;
            margin-right: 12px;
        }

        /* Hover Sidebar: Jadi Putih & Border Pink */
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--pink-accent);
        }

        /* Menu Aktif: Background Pink & Shadow */
        .nav-link.active {
            background: var(--pink-accent);
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(244, 114, 182, 0.3);
        }

        .section-title {
            color: #4b5563;
            font-size: 0.65rem;
            font-weight: 800;
            margin: 24px 24px 8px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* ===== User Profile Section ===== */
        .user-box {
            padding: 15px;
            margin: 16px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .user-box img {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            border: 2px solid var(--pink-accent);
            /* Border avatar jadi pink */
        }

        /* ===== Header & Topbar ===== */
        .topbar {
            background: #fff;
            border-bottom: 2px solid var(--slate-200);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h4 {
            font-weight: 800;
            color: var(--slate-800);
        }

        .btn-view-store {
            background: var(--pink-soft);
            color: var(--pink-dark);
            font-weight: 700;
            border: 1px solid var(--pink-accent);
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 0.85rem;
            transition: 0.2s;
        }

        .btn-view-store:hover {
            background: var(--pink-accent);
            color: #fff;
        }

        .btn-logout:hover {
            background: #fff1f2;
            color: #e11d48;
            border-color: #fda4af;
        }

        /* ===== Main Content Area ===== */
        main {
            padding: 32px;
            background: var(--slate-200);
            /* Warna dasar abu-abu */
            min-height: calc(100vh - 73px);
        }

        /* Custom Scrollbar Pink */
        ::-webkit-scrollbar-thumb {
            background: var(--pink-accent);
            border-radius: 10px;
        }

    </style>

    @stack('styles')
</head>

<body>
    <div class="d-flex">

        {{-- ===== Sidebar ===== --}}
        <aside class="sidebar d-flex flex-column">

            <div class="brand">
                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none d-flex align-items-center">
                    <div class="brand-icon">
                        <i class="bi bi-grid-1x2-fill fs-5"></i>
                    </div>
                    <span>ADMIN PANEL</span>
                </a>
            </div>

            <nav class="flex-grow-1 mt-3">
                <ul class="nav flex-column px-0 list-unstyled">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </li>

                    <div class="section-title">Manajemen Data</div>

                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i> Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="bi bi-folder2"></i> Kategori
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="bi bi-cart3"></i> Pesanan
                        </a>
                    </li>

                    <div class="section-title">Laporan</div>

                    <li class="nav-item">
                        <a href="{{ route('admin.reports.sales') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <i class="bi bi-bar-chart"></i> Penjualan
                        </a>
                    </li>

                </ul>
            </nav>

            <div class="user-box">
                <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.auth()->user()->name.'&background=f472b6&color=fff' }}" alt="Avatar">
                <div class="user-info">
                    <span class="name text-truncate" style="max-width: 140px;">{{ auth()->user()->name }}</span>
                    <span class="role">Administrator</span>
                </div>
            </div>

        </aside>

        {{-- ===== Main Content Area ===== --}}
        <div class="flex-grow-1 d-flex flex-column">

            <header class="topbar">
                <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-view-store btn-sm d-flex align-items-center">
                        <i class="bi bi-shop me-2"></i> Lihat Toko
                    </a>

                    <div class="vr text-slate-300 my-2"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-logout btn-sm d-flex align-items-center border-0">
                            <i class="bi bi-power me-2"></i> Keluar
                        </button>
                    </form>
                </div>
            </header>

            <main>
                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>
