<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Toko Buku Online Terpercaya') - BookStore</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts: Playfair Display (Serif) & Plus Jakarta Sans (Clean Modern Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --forest-dark: #0f241a;
            --forest-primary: #163326;
            --forest-mid: #1d4232;
            --forest-light: #24523e;
            --forest-accent: #c28b57;
            --forest-accent-hover: #ad7845;
            --forest-cream: #fbf9f5;
            --forest-sand: #f3eee6;
            --forest-border: #e6dfd5;
            --forest-text: #212529;
            --forest-muted: #6b7280;
            --bs-font-sans-serif: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }

        body {
            font-family: var(--bs-font-sans-serif);
            background-color: var(--forest-cream);
            color: var(--forest-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            letter-spacing: -0.01em;
        }

        .font-serif {
            font-family: 'Playfair Display', Georgia, serif !important;
        }

        main {
            flex: 1 0 auto;
        }

        /* Main Navbar - Sleek & Modern */
        .navbar-forest {
            background-color: #ffffff;
            border-bottom: 1px solid #ede7df;
            padding: 0.95rem 0;
            box-shadow: 0 4px 20px rgba(15, 36, 26, 0.04);
            transition: all 0.3s ease;
        }

        .navbar-brand-forest {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .brand-logo-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--forest-primary) 0%, #234c38 100%);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 4px 12px rgba(22, 51, 38, 0.2);
            transition: transform 0.2s ease;
        }

        .navbar-brand-forest:hover .brand-logo-icon {
            transform: scale(1.05);
        }

        .brand-logo-text {
            display: flex;
            flex-direction: column;
        }

        .brand-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700;
            font-size: 1.45rem;
            color: var(--forest-primary);
            letter-spacing: 1px;
            line-height: 1.1;
        }

        .brand-subtitle {
            font-size: 0.62rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--forest-accent);
            font-weight: 700;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            font-size: 0.93rem;
            color: #374151;
            padding: 0.5rem 1rem;
            position: relative;
            transition: color 0.2s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--forest-primary);
        }

        .navbar-nav .nav-link.active {
            color: var(--forest-primary);
            font-weight: 700;
        }

        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 1rem;
            right: 1rem;
            height: 2px;
            background-color: var(--forest-accent);
            border-radius: 2px;
        }

        .nav-action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #4b5563;
            background-color: #f7f4ee;
            border: 1px solid #ebe5dc;
            text-decoration: none;
            position: relative;
            transition: all 0.2s ease;
        }

        .nav-action-btn:hover {
            background-color: #ede7df;
            color: var(--forest-primary);
            transform: translateY(-1px);
        }

        /* Forest Buttons */
        .btn-forest {
            background-color: var(--forest-primary);
            border-color: var(--forest-primary);
            color: #ffffff;
            font-weight: 600;
            transition: all 0.25s ease;
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
            letter-spacing: 0.03em;
            transition: all 0.25s ease;
        }

        .btn-ochre:hover {
            background-color: var(--forest-accent-hover);
            border-color: var(--forest-accent-hover);
            color: #ffffff;
            transform: translateY(-1px);
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

        .btn-primary-custom {
            background-color: var(--forest-primary);
            border-color: var(--forest-primary);
            color: #ffffff;
        }

        .btn-primary-custom:hover {
            background-color: var(--forest-mid);
            border-color: var(--forest-mid);
            color: #ffffff;
        }

        .btn-accent-custom {
            background-color: var(--forest-accent);
            border-color: var(--forest-accent);
            color: #ffffff;
        }

        .btn-accent-custom:hover {
            background-color: var(--forest-accent-hover);
            border-color: var(--forest-accent-hover);
            color: #ffffff;
        }

        /* Cart Icon & Badge */
        .cart-icon-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--forest-sand);
            color: var(--forest-primary);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .cart-icon-btn:hover {
            background-color: var(--forest-border);
            color: var(--forest-dark);
        }

        .cart-badge-pill {
            position: absolute;
            top: -2px;
            right: -2px;
            background-color: var(--forest-accent);
            color: #ffffff;
            font-size: 0.68rem;
            font-weight: 700;
            border-radius: 999px;
            padding: 0.15rem 0.42rem;
            line-height: 1;
            box-shadow: 0 2px 4px rgba(194, 139, 87, 0.4);
        }

        /* Footer */
        .footer-forest {
            background-color: var(--forest-dark);
            color: #b8c7bc;
            padding-top: 4rem;
            padding-bottom: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-forest h6 {
            color: #ffffff;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 1.25rem;
        }

        .footer-forest a {
            color: #9cb5a4;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-forest a:hover {
            color: var(--forest-accent);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 1.5rem;
            margin-top: 3rem;
            font-size: 0.8rem;
            color: #839d8c;
        }

        /* Stamp Seal */
        .circular-seal {
            width: 90px;
            height: 90px;
            border: 1px dashed rgba(194, 139, 87, 0.6);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 6px;
            color: var(--forest-accent);
            font-size: 0.62rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: auto;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-forest sticky-top">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand navbar-brand-forest" href="{{ route('home') }}">
                <div class="brand-logo-icon">
                    <i class="bi bi-book-half"></i>
                </div>
                <div class="brand-logo-text">
                    <span class="brand-title">BOOKSTORE</span>
                    <span class="brand-subtitle">BOOKS &bull; STORIES &bull; LIFE</span>
                </div>
            </a>

            <!-- Mobile Toggler -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <!-- Center Navigation -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 py-2 py-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.catalog') || request()->routeIs('user.book.show') ? 'active' : '' }}" href="{{ route('user.catalog') }}">
                            Katalog Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') || request()->routeIs('user.about') ? 'active' : '' }}" href="{{ route('about') }}">
                            Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') || request()->routeIs('user.contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            Kontak
                        </a>
                    </li>
                </ul>

                <!-- Right Action Navigation -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Search Shortcut Button -->
                    <a href="{{ route('home') }}#katalog-search" class="nav-action-btn" title="Cari Buku">
                        <i class="bi bi-search"></i>
                    </a>

                    @guest
                        <!-- Login / Register Buttons -->
                        <a href="{{ route('login') }}" class="btn btn-outline-forest btn-sm px-3 py-2 rounded-pill small">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-forest btn-sm px-3 py-2 rounded-pill shadow-sm small">
                            <i class="bi bi-person-plus me-1"></i>Daftar
                        </a>
                    @endguest

                    @auth
                        @if(auth()->user()->isAdmin())
                            <!-- Admin Panel Badge -->
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-ochre btn-sm px-3 py-2 rounded-pill shadow-sm small">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard Admin
                            </a>
                        @else
                            <!-- Cart Icon Button with Badge -->
                            <a class="nav-action-btn" href="{{ route('cart.index') }}" title="Keranjang Belanja">
                                <i class="bi bi-bag"></i>
                                @php
                                    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                                @endphp
                                @if($cartCount > 0)
                                    <span class="cart-badge-pill">{{ $cartCount }}</span>
                                @endif
                            </a>
                        @endif

                        <!-- User Profile Dropdown -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 fw-semibold text-dark p-0" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-inline-flex align-items-center justify-content-center text-white rounded-circle shadow-sm" style="width: 38px; height: 38px; font-size: 0.85rem; background-color: var(--forest-primary);">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                                <span class="d-none d-md-inline small fw-semibold">{{ Str::limit(auth()->user()->name, 12) }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2 mt-2" aria-labelledby="userMenu" style="border-radius: 10px;">
                                <li class="px-3 py-2 border-bottom">
                                    <div class="fw-bold text-dark">{{ auth()->user()->name }}</div>
                                    <div class="small text-muted">{{ auth()->user()->email }}</div>
                                    <span class="badge bg-{{ auth()->user()->isAdmin() ? 'danger' : 'success' }} mt-1">
                                        {{ strtoupper(auth()->user()->role) }}
                                    </span>
                                </li>
                                @if(auth()->user()->isAdmin())
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-speedometer2 text-danger me-2"></i>Admin Panel
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.books.index') }}">
                                            <i class="bi bi-book me-2"></i>Kelola Buku
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.orders.index') }}">
                                            <i class="bi bi-receipt me-2"></i>Kelola Pesanan
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('orders.history') }}">
                                            <i class="bi bi-clock-history me-2"></i>Riwayat Pesanan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('cart.index') }}">
                                            <i class="bi bi-bag-check me-2"></i>Keranjang Belanja
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger py-2">
                                            <i class="bi bi-box-arrow-right me-2"></i>Keluar (Logout)
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Message Alerts -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm border-0 rounded-3 py-3" role="alert" style="background-color: #eaf5ee; color: #164e2d;">
                <i class="bi bi-check-circle-fill fs-5 text-success me-2"></i>
                <div class="flex-grow-1">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm border-0 rounded-3 py-3" role="alert" style="background-color: #fdf2f2; color: #991b1b;">
                <i class="bi bi-exclamation-triangle-fill fs-5 text-danger me-2"></i>
                <div class="flex-grow-1">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0 rounded-3 py-3" role="alert" style="background-color: #fffbeb; color: #92400e;">
                <div class="d-flex align-items-center mb-1">
                    <i class="bi bi-exclamation-circle-fill fs-5 text-warning me-2"></i>
                    <strong>Perhatian: Terdapat beberapa kesalahan pengisian!</strong>
                </div>
                <ul class="mb-0 ps-4 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Main Content Area -->
    <main>
        @yield('content')
    </main>

    <!-- 3. Elegant Forest Footer -->
    <footer class="footer-forest mt-5">
        <div class="container">
            <div class="row g-4 mb-4">
                <!-- Brand Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center text-white rounded-circle" style="width: 36px; height: 36px; background-color: var(--forest-accent);">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <div class="brand-logo-text">
                            <span class="font-serif text-white fs-5 fw-bold letter-spacing-1">BOOKSTORE</span>
                            <span class="small" style="font-size: 0.6rem; letter-spacing: 2px; color: var(--forest-accent);">BOOKS &bull; STORIES &bull; LIFE</span>
                        </div>
                    </div>
                    <p class="small leading-relaxed" style="color: #9cb5a4;">
                        Toko buku modern dengan kurasi karya literatur, teknologi, bisnis, dan sastra terbaik. Menghadirkan buku bermakna untuk menginspirasi setiap lembaran kisah hidup Anda.
                    </p>
                    <div class="d-flex gap-3 fs-5 mt-3">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-pinterest"></i></a>
                        <a href="#"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="col-lg-2 col-6">
                    <h6>Jelajah</h6>
                    <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                        <li><a href="{{ route('home') }}">Buku Pilihan</a></li>
                        <li><a href="{{ route('home') }}#kategori">Kategori Buku</a></li>
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}">Kontak Kami</a></li>
                    </ul>
                </div>

                <!-- Help Links -->
                <div class="col-lg-2 col-6">
                    <h6>Layanan</h6>
                    <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                        <li><a href="{{ route('orders.history') }}">Lacak Pesanan</a></li>
                        <li><a href="#">QRIS, GoPay & Transfer</a></li>
                        <li><a href="#">Garansi Original</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <!-- Contact & Location -->
                <div class="col-lg-4 col-md-6">
                    <h6>Kontak & Lokasi</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-3" style="color: #9cb5a4;">
                        <li class="d-flex gap-2">
                            <i class="bi bi-geo-alt text-warning"></i>
                            <span>Jl. Buku Mandiri No. 45, Jakarta Pusat 10110</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-envelope text-warning"></i>
                            <span>hello@bookstore.test</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-telephone text-warning"></i>
                            <span>(021) 555-8901 / 0812-3456-7890</span>
                        </li>
                    </ul>

                    <!-- Circular Seal Badge -->
                    <div class="d-flex justify-content-start align-items-center gap-3 pt-2">
                        <div class="circular-seal">
                            <i class="bi bi-book mb-1"></i>
                            <span>Read Deeply</span>
                            <span>Live Fully</span>
                        </div>
                        <div class="small" style="color: #839d8c;">
                            Terdaftar & Tersertifikasi<br>
                            <span class="text-white fw-semibold">BNSP JWD Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                <div>
                    &copy; {{ date('Y') }} <strong>BookStore</strong>. All rights reserved. Uji Kompetensi Kejuruan Web Developer.
                </div>
                <div class="d-flex gap-3 small">
                    <a href="#">Kebijakan Privasi</a>
                    <span>&bull;</span>
                    <a href="#">Syarat Layanan</a>
                    <span>&bull;</span>
                    <a href="#">Kebijakan Cookie</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
