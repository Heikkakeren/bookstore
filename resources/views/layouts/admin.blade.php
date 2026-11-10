<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - BookStore</title>
    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bs-font-sans-serif: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            --forest-primary: #163326;
            --forest-mid: #234e3b;
            --forest-light: #2d624a;
            --forest-dark: #0d1e17;
            --forest-accent: #c28b57;
            --forest-accent-hover: #a87242;
            --forest-sand: #f0ebe1;
            --forest-cream: #fbf9f5;
            --forest-border: #e6dfd3;
            --forest-sidebar-bg: #11271e;
        }

        body {
            font-family: var(--bs-font-sans-serif);
            background-color: var(--forest-cream);
            color: #2c3832;
        }

        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Playfair Display', Georgia, serif;
        }

        /* ─── Override Bootstrap Primary with Forest Palette ─── */
        .btn-primary {
            background-color: var(--forest-primary) !important;
            border-color: var(--forest-primary) !important;
            color: #ffffff !important;
            font-weight: 600;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--forest-mid) !important;
            border-color: var(--forest-mid) !important;
            color: #ffffff !important;
        }

        .btn-outline-primary {
            color: var(--forest-primary) !important;
            border-color: var(--forest-primary) !important;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: var(--forest-primary) !important;
            color: #ffffff !important;
        }

        .bg-primary {
            background-color: var(--forest-primary) !important;
        }

        .text-primary {
            color: var(--forest-primary) !important;
        }

        .badge.bg-primary {
            background-color: var(--forest-primary) !important;
            color: #ffffff !important;
        }

        /* Custom buttons matching User UI */
        .btn-forest {
            background-color: var(--forest-primary);
            border-color: var(--forest-primary);
            color: #ffffff;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-forest:hover {
            background-color: var(--forest-mid);
            border-color: var(--forest-mid);
            color: #ffffff;
        }

        .btn-ochre {
            background-color: var(--forest-accent);
            border-color: var(--forest-accent);
            color: #ffffff;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-ochre:hover {
            background-color: var(--forest-accent-hover);
            border-color: var(--forest-accent-hover);
            color: #ffffff;
        }

        .btn-outline-forest {
            border: 1px solid var(--forest-primary);
            color: var(--forest-primary);
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-outline-forest:hover {
            background-color: var(--forest-primary);
            color: #ffffff;
        }

        /* ─── Sidebar Navigation (Forest Luxury Theme) ─── */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #0d1e17 0%, #11271e 40%, #163326 100%);
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            transition: all 0.3s ease;
            border-right: 1px solid rgba(194, 139, 87, 0.25);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 1.4rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(194, 139, 87, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--forest-accent);
            font-size: 1.15rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar-brand-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700;
            font-size: 1.25rem;
            color: #ffffff;
            letter-spacing: 1px;
            line-height: 1.1;
            margin: 0;
        }

        .sidebar-brand-sub {
            font-size: 0.62rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--forest-accent);
            font-weight: 700;
            display: block;
            margin-top: 2px;
        }

        .sidebar nav {
            flex-grow: 1;
            padding-bottom: 1.5rem;
        }

        .nav-section-title {
            color: #8fa89b;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 1.1rem 1.25rem 0.35rem;
        }

        .sidebar .nav-link {
            color: #cad8ce;
            padding: 0.7rem 1.15rem;
            border-radius: 8px;
            margin: 0.2rem 0.75rem;
            font-weight: 500;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.08);
            transform: translateX(3px);
        }

        .sidebar .nav-link.active {
            color: #ffffff;
            background-color: var(--forest-accent);
            box-shadow: 0 4px 14px rgba(194, 139, 87, 0.35);
            font-weight: 600;
        }

        .sidebar .nav-link i {
            width: 22px;
            font-size: 1.1rem;
            margin-right: 8px;
        }

        /* ─── Main Content Container ─── */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: var(--forest-cream);
        }

        /* Topbar Header */
        .topbar {
            background: #ffffff;
            padding: 0.85rem 1.75rem;
            border-bottom: 1px solid var(--forest-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: 0 2px 8px rgba(22, 51, 38, 0.03);
        }

        .topbar-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700;
            color: var(--forest-primary);
            margin: 0;
            font-size: 1.25rem;
        }

        .content-area {
            padding: 2rem 1.75rem;
            flex: 1 0 auto;
        }

        /* ─── Cards & Tables Styling ─── */
        .card {
            border: 1px solid var(--forest-border);
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(22, 51, 38, 0.04);
            background: #ffffff;
        }

        .table thead th {
            background-color: var(--forest-sand) !important;
            color: var(--forest-primary) !important;
            font-weight: 700 !important;
            font-size: 0.78rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            border-bottom: 2px solid var(--forest-border) !important;
            padding-top: 0.85rem !important;
            padding-bottom: 0.85rem !important;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(194, 139, 87, 0.04) !important;
        }

        .avatar-admin-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--forest-primary);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            border: 2px solid var(--forest-accent);
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -260px;
            }
            .sidebar.show {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar" id="adminSidebar">
        <!-- Brand Link -->
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i class="bi bi-book-half"></i>
            </div>
            <div>
                <h5 class="sidebar-brand-title">BOOKSTORE</h5>
                <small class="sidebar-brand-sub">PANEL ADMINISTRASI</small>
            </div>
        </a>

        <!-- Nav Menus (Strictly Matching BNSP Standard) -->
        <nav class="mt-2">
            <!-- 1. Menu Utama -->
            <div class="nav-section-title">Menu Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>Dashboard
            </a>

            <!-- 2. Katalog & Produk (Rubrik: Kategori & Buku CRUD) -->
            <div class="nav-section-title">Katalog & Inventaris</div>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>Kategori Buku
            </a>
            <a href="{{ route('admin.books.index') }}" class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i>Master Data Buku
            </a>

            <!-- 3. Operasional Transaksi (Rubrik: List Pesanan & List User) -->
            <div class="nav-section-title">Transaksi & Pelanggan</div>
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-receipt-cutoff"></i>Daftar Pesanan
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>Pengguna Terdaftar
            </a>

            <!-- 4. Layanan Pengunjung (Rubrik: Contact to Admin) -->
            <div class="nav-section-title">Layanan & Pesan</div>
            <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') || request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="bi bi-chat-left-text"></i>Pesan Kontak
            </a>

            <hr class="border-secondary border-opacity-25 mx-3 my-3">
            <a href="{{ route('home') }}" class="nav-link text-warning" target="_blank">
                <i class="bi bi-shop"></i>Kunjungi Toko
            </a>
        </nav>
    </aside>

    <!-- Main Content Container -->
    <div class="main-content">
        <!-- Topbar Header -->
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none border" id="sidebarToggle">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <h5 class="topbar-title">@yield('page-title', 'Dashboard')</h5>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" class="btn btn-outline-forest btn-sm d-none d-md-inline-flex align-items-center gap-1" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>Lihat Web User</span>
                </a>

                <div class="d-flex align-items-center gap-2">
                    <div class="avatar-admin-circle">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="d-none d-sm-block text-start lh-1">
                        <div class="fw-bold small text-dark">{{ auth()->user()->name }}</div>
                        <span class="badge text-uppercase" style="background-color: var(--forest-accent); font-size: 0.65rem;">ADMINISTRATOR</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm fw-semibold" title="Keluar">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm border-0 rounded-3 py-3 mb-4" role="alert" style="background-color: #eaf5ee; color: #164e2d;">
                    <i class="bi bi-check-circle-fill text-success fs-5 me-2"></i>
                    <div class="flex-grow-1">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm border-0 rounded-3 py-3 mb-4" role="alert" style="background-color: #fdf2f2; color: #991b1b;">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-5 me-2"></i>
                    <div class="flex-grow-1">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0 rounded-3 py-3 mb-4" role="alert" style="background-color: #fffbeb; color: #92400e;">
                    <div class="d-flex align-items-center mb-1">
                        <i class="bi bi-exclamation-circle-fill text-warning fs-5 me-2"></i>
                        <strong>Validasi Input Gagal:</strong>
                    </div>
                    <ul class="mb-0 ps-4 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="bg-white py-3 px-4 border-top text-muted small text-center text-md-between d-md-flex align-items-center justify-content-between mt-auto">
            <span>&copy; {{ date('Y') }} <strong>BookStore Admin Panel</strong> &mdash; Uji Kompetensi Kejuruan BNSP Junior Web Developer.</span>
            <span>Desain Sistem: Forest & Ochre Luxury Theme</span>
        </footer>
    </div>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const adminSidebar = document.getElementById('adminSidebar');
        if (sidebarToggle && adminSidebar) {
            sidebarToggle.addEventListener('click', () => {
                adminSidebar.classList.toggle('show');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>