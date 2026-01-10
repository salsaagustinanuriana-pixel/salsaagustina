<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --purple-main: #7c3aed;
            --purple-dark: #4c1d95;
            --purple-soft: #ede9fe;
            --purple-bg: #f5f3ff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--purple-bg);
        }

        /* ===== Sidebar ===== */
        .sidebar {
            min-height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #8b5cf6, #6d28d9);
            box-shadow: 6px 0 30px rgba(124, 58, 237, .35);
        }

        .brand {
            padding: 22px;
            border-bottom: 1px solid rgba(255, 255, 255, .2);
        }

        .brand span {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .nav-link {
            color: rgba(255, 255, 255, .85);
            padding: 12px 18px;
            border-radius: 14px;
            margin: 6px 14px;
            display: flex;
            align-items: center;
            transition: all .25s ease;
            font-weight: 500;
        }

        .nav-link i {
            width: 22px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, .18);
            color: #fff;
            transform: translateX(6px);
        }

        .nav-link.active {
            background: #fff;
            color: var(--purple-dark);
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .1);
        }

        .nav-link.active i {
            color: var(--purple-dark);
        }

        .section-title {
            color: rgba(255, 255, 255, .6);
            font-size: .7rem;
            margin: 22px 22px 8px;
            text-transform: uppercase;
        }

        /* ===== User Box ===== */
        .user-box {
            padding: 18px;
            border-top: 1px solid rgba(255, 255, 255, .2);
            display: flex;
            gap: 12px;
            color: #fff;
        }

        .user-box img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
        }

        /* ===== Topbar ===== */
        .topbar {
            background: var(--purple-soft);
            border-bottom: 1px solid #ddd6fe;
        }

        .topbar h4 {
            font-weight: 600;
            color: var(--purple-dark);
        }

        .btn-soft-purple {
            background: var(--purple-main);
            color: #fff;
            border: none;
        }

        .btn-soft-purple:hover {
            background: #6d28d9;
            color: #fff;
        }

        /* ===== Main Content ===== */
        main {
            min-height: calc(100vh - 72px);
            background: var(--purple-bg);
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
                    <i class="bi bi-shop fs-4 me-2"></i>
                    <span>Admin Panel</span>
                </a>
            </div>

            <nav class="flex-grow-1 mt-3">
                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam me-2"></i> Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="bi bi-folder me-2"></i> Kategori
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="bi bi-receipt me-2"></i> Pesanan
                        </a>
                    </li>

                    <div class="section-title">Laporan</div>

                    <li class="nav-item">
                        <a href="{{ route('admin.reports.sales') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <i class="bi bi-graph-up me-2"></i> Laporan Penjualan
                        </a>
                    </li>

                </ul>
            </nav>

            <div class="user-box">
                <img src="{{ auth()->user()->avatar_url }}">
                <div>
                    <div class="fw-semibold">{{ auth()->user()->name }}</div>
                    <small class="opacity-75">Administrator</small>
                </div>
            </div>

        </aside>

        {{-- ===== Main ===== --}}
        <div class="flex-grow-1 d-flex flex-column">

            <header class="topbar py-3 px-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>

                <div class="d-flex gap-2">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-soft-purple btn-sm">
                        <i class="bi bi-shop me-1"></i> Lihat Toko
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <div class="px-4 pt-3">
                @include('partials.flash-messages')
            </div>

            <main class="p-4">
                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>

