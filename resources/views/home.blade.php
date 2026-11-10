@extends('layouts.app')

@section('title', 'Toko Buku Pilihan - Books, Stories, Life')

@push('styles')
<style>
    /* Hero Section */
    .hero-forest {
        background-color: var(--forest-primary);
        background-image: radial-gradient(circle at 85% 30%, rgba(36, 82, 62, 0.4) 0%, transparent 60%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .hero-pretitle {
        color: #d8aa7a;
        font-size: 0.78rem;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .hero-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(2.3rem, 4.5vw, 3.8rem);
        line-height: 1.15;
        font-weight: 600;
        color: #ffffff;
    }

    .hero-desc {
        color: #d1dcce;
        font-size: 1.05rem;
        line-height: 1.6;
        max-width: 520px;
    }

    .hero-badge-stamp {
        width: 110px;
        height: 110px;
        border: 1px dashed rgba(216, 170, 122, 0.8);
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #d8aa7a;
        font-size: 0.65rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 8px;
        background: rgba(15, 36, 26, 0.6);
        backdrop-filter: blur(4px);
    }

    /* Category Cards */
    .category-card-item {
        background: #ffffff;
        border: 1px solid var(--forest-border);
        border-radius: 8px;
        padding: 1.25rem 0.75rem;
        text-align: center;
        text-decoration: none;
        color: var(--forest-text);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
        height: 100%;
    }

    .category-card-item:hover,
    .category-card-item.active {
        border-color: var(--forest-primary);
        background-color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(22, 51, 38, 0.08);
        color: var(--forest-primary);
    }

    .category-icon-wrap {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        color: var(--forest-primary);
        margin-bottom: 0.5rem;
        transition: transform 0.2s ease;
    }

    .category-card-item:hover .category-icon-wrap {
        transform: scale(1.1);
        color: var(--forest-accent);
    }

    .category-label {
        font-size: 0.82rem;
        font-weight: 600;
        line-height: 1.3;
        margin: 0;
    }

    /* Book Cards - EXACT MATCH to Forest & Page Grid */
    .book-card-forest {
        background: transparent;
        border: none;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform 0.25s ease;
    }

    .book-cover-frame {
        position: relative;
        aspect-ratio: 1 / 1.48;
        border-radius: 4px;
        overflow: hidden;
        background-color: #ede8df;
        box-shadow: 2px 6px 14px rgba(0, 0, 0, 0.12);
        margin-bottom: 0.75rem;
        transition: transform 0.3s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.3s ease;
    }

    .book-card-forest:hover .book-cover-frame {
        transform: translateY(-6px);
        box-shadow: 4px 14px 22px rgba(22, 51, 38, 0.2);
    }

    .book-cover-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .book-spine-shadow {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 12px;
        background: linear-gradient(to right, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.05) 60%, transparent);
        pointer-events: none;
    }

    .book-badge-stock {
        position: absolute;
        top: 8px;
        right: 8px;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        letter-spacing: 0.5px;
    }

    .book-title-forest {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 0.95rem;
        font-weight: 700;
        line-height: 1.3;
        color: var(--forest-text);
        margin-bottom: 0.2rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        min-height: 2.5rem;
    }

    .book-author-forest {
        font-size: 0.78rem;
        color: #71717a;
        margin-bottom: 0.35rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .book-stars-forest {
        font-size: 0.72rem;
        color: #eab308;
        display: flex;
        align-items: center;
        gap: 2px;
        margin-bottom: 0.6rem;
    }

    .book-stars-forest .rating-count {
        color: #8a8a93;
        font-size: 0.7rem;
        margin-left: 4px;
    }

    .book-price-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 0.25rem;
    }

    .book-price-text {
        font-weight: 700;
        font-size: 0.98rem;
        color: var(--forest-primary);
    }

    .btn-cart-square {
        width: 34px;
        height: 34px;
        border-radius: 4px;
        background-color: var(--forest-primary);
        color: #ffffff;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-cart-square:hover {
        background-color: var(--forest-accent);
        color: #ffffff;
        transform: scale(1.06);
    }

    /* Club Banner */
    .club-banner {
        background-color: var(--forest-primary);
        color: #ffffff;
        border-radius: 8px;
        padding: 3rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .club-banner-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 2rem;
        font-weight: 600;
    }

    /* Staff Picks / Editorial Card */
    .staff-pick-card {
        background: #ffffff;
        border: 1px solid var(--forest-border);
        border-radius: 6px;
        padding: 1rem;
        height: 100%;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        transition: all 0.25s ease;
    }

    .staff-pick-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        border-color: var(--forest-primary);
    }

    .staff-pick-cover {
        width: 80px;
        aspect-ratio: 1 / 1.48;
        border-radius: 3px;
        overflow: hidden;
        flex-shrink: 0;
        box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Blog Card */
    .blog-card {
        background: #ffffff;
        border: 1px solid var(--forest-border);
        border-radius: 6px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.25s ease;
    }

    .blog-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.06);
    }

    .blog-img-wrap {
        height: 160px;
        background-color: #e5e0d8;
        overflow: hidden;
    }

    .blog-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-card:hover .blog-img-wrap img {
        transform: scale(1.05);
    }

    /* Newsletter */
    .newsletter-section {
        background-color: #1a3b2d;
        color: #ffffff;
        padding: 3rem 0;
        border-radius: 8px;
    }
</style>
@endpush

@section('content')

<!-- ==========================================
     1. HERO SECTION (Forest & Page Style)
     ========================================== -->
<section class="hero-forest py-5">
    <div class="container py-lg-4">
        <div class="row align-items-center g-4">
            <!-- Left Editorial Text -->
            <div class="col-lg-7">
                <div class="hero-pretitle d-flex align-items-center gap-2">
                    <span>🌿</span>
                    <span>SELAMAT DATANG DI LEMBARAN BARU</span>
                </div>
                <h1 class="hero-title mb-3">
                    Books that inspire.<br>
                    <span style="font-style: italic; color: #ecd5bd;">Moments that stay.</span>
                </h1>
                <p class="hero-desc mb-4">
                    Koleksi kurasi buku pilihan dan karya literatur bermakna untuk menginspirasi hari-hari Anda. Temukan bacaan bermutu mulai dari teknologi, bisnis, fiksi sastra, hingga pengembangan diri.
                </p>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <a href="#katalog-search" class="btn btn-ochre px-4 py-2 fw-semibold text-uppercase small" style="border-radius: 3px; letter-spacing: 1px;">
                        Jelajahi Buku Pilihan &rarr;
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light px-4 py-2 fw-semibold small text-uppercase" style="border-radius: 3px; letter-spacing: 1px; border-color: rgba(255,255,255,0.4);">
                        Tentang BookStore
                    </a>
                </div>

                <!-- Trust Points -->
                <div class="d-flex flex-wrap gap-4 mt-4 pt-3 border-top border-white border-opacity-10 small" style="color: #cad8ce;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check text-warning"></i>
                        <span>100% Buku Original</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-qr-code-scan text-warning"></i>
                        <span>QRIS, GoPay & Transfer</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-truck text-warning"></i>
                        <span>Pengiriman Cepat Seluruh RI</span>
                    </div>
                </div>
            </div>

            <!-- Right Cozy Illustration & Stamp Seal -->
            <div class="col-lg-5 text-center position-relative">
                <div class="p-4 d-inline-block rounded-3 position-relative" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <!-- Visual Stack of Books -->
                    <div class="d-flex flex-column align-items-center py-3">
                        <div class="rounded shadow-sm mb-2 text-dark px-4 py-2 fw-bold small" style="background: #e4dfd7; width: 230px; letter-spacing: 1px;">
                            THE ART OF SLOWNESS
                        </div>
                        <div class="rounded shadow-sm mb-2 text-dark px-4 py-2 fw-bold small" style="background: #d8d0c4; width: 260px; letter-spacing: 1px;">
                            LEARNING LARAVEL MVC
                        </div>
                        <div class="rounded shadow-sm mb-2 text-dark px-4 py-2 fw-bold small" style="background: #c7beaf; width: 280px; letter-spacing: 1px;">
                            PYTHON PROGRAMMING 2026
                        </div>
                        <div class="rounded shadow-sm text-dark px-4 py-2 fw-bold small" style="background: #b8ad9b; width: 300px; letter-spacing: 1px;">
                            RICH DAD &bull; ZERO TO ONE
                        </div>

                        <!-- Cozy Tea & Candle Icons -->
                        <div class="d-flex align-items-center justify-content-center gap-4 mt-3 text-warning opacity-75">
                            <i class="bi bi-cup-hot fs-3" title="Secangkir Kopi Hangat"></i>
                            <i class="bi bi-book fs-3" title="Koleksi Buku Terlengkap"></i>
                            <i class="bi bi-lamp fs-3" title="Membaca Nyaman"></i>
                        </div>
                    </div>

                    <!-- Curated Badge Stamp -->
                    <div class="position-absolute top-0 end-0 translate-middle-y me-2 mt-2">
                        <div class="hero-badge-stamp">
                            <span style="font-weight: 700;">CURATED</span>
                            <span style="font-size: 0.58rem; opacity: 0.85;">WITH CARE</span>
                            <i class="bi bi-book-half mt-1 fs-6"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     2. BROWSE BY CATEGORY (Iconic Row)
     ========================================== -->
<section class="py-5" id="kategori">
    <div class="container">
        <div class="text-center mb-4">
            <h5 class="text-uppercase fw-bold font-serif mb-1" style="letter-spacing: 3px; color: var(--forest-primary); font-size: 1.15rem;">
                BROWSE BY CATEGORY
            </h5>
            <div class="d-inline-block" style="width: 40px; height: 2px; background-color: var(--forest-accent);"></div>
        </div>

        <div class="row g-3 justify-content-center">
            <!-- All Categories -->
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('home') }}#buku-pilihan" class="category-card-item {{ !request('category') ? 'active' : '' }}">
                    <div class="category-icon-wrap">
                        <i class="bi bi-grid"></i>
                    </div>
                    <p class="category-label">Semua Buku</p>
                </a>
            </div>

            @foreach($categories as $category)
                @php
                    // Dynamic icon picker based on category name
                    $slug = strtolower($category->slug);
                    $iconClass = 'bi-journal-bookmark';
                    if (str_contains($slug, 'tekno') || str_contains($slug, 'it') || str_contains($slug, 'komputer')) {
                        $iconClass = 'bi-laptop';
                    } elseif (str_contains($slug, 'fiksi') || str_contains($slug, 'novel') || str_contains($slug, 'sastra')) {
                        $iconClass = 'bi-book';
                    } elseif (str_contains($slug, 'bisnis') || str_contains($slug, 'ekonomi') || str_contains($slug, 'keuangan')) {
                        $iconClass = 'bi-graph-up-arrow';
                    } elseif (str_contains($slug, 'anak')) {
                        $iconClass = 'bi-stars';
                    } elseif (str_contains($slug, 'hidup') || str_contains($slug, 'self')) {
                        $iconClass = 'bi-heart-pulse';
                    }
                @endphp
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('home', ['category' => $category->id]) }}#buku-pilihan" 
                       class="category-card-item {{ request('category') == $category->id ? 'active' : '' }}">
                        <div class="category-icon-wrap">
                            <i class="bi {{ $iconClass }}"></i>
                        </div>
                        <p class="category-label">{{ $category->name }}</p>
                    </a>
                </div>
            @endforeach

            <!-- Gifts & Lifestyle Static Badge -->
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ route('about') }}" class="category-card-item">
                    <div class="category-icon-wrap">
                        <i class="bi bi-gift"></i>
                    </div>
                    <p class="category-label">Lifestyle & Hadiah</p>
                </a>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}#buku-pilihan" class="small text-uppercase fw-bold text-decoration-none" style="letter-spacing: 1.5px; color: var(--forest-primary); font-size: 0.75rem;">
                VIEW ALL CATEGORIES &rarr;
            </a>
        </div>
    </div>
</section>

<!-- ==========================================
     3. BEST SELLERS / BUKU PILIHAN (Exact 6-Column Grid)
     ========================================== -->
<section class="py-4" id="buku-pilihan">
    <div class="container">
        <!-- Section Header -->
        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-secondary border-opacity-10">
            <div>
                <h4 class="font-serif text-uppercase mb-0 fw-bold" style="letter-spacing: 2px; color: var(--forest-primary); font-size: 1.3rem;">
                    BEST SELLERS
                </h4>
                <p class="text-muted small mb-0">Rekomendasi bacaan favorit dan karya paling diminati</p>
            </div>
            <div>
                <a href="{{ route('home') }}" class="text-decoration-none small text-uppercase fw-bold" style="color: var(--forest-primary); letter-spacing: 1px; font-size: 0.75rem;">
                    VIEW ALL BEST SELLERS &rarr;
                </a>
            </div>
        </div>

        <!-- Integrated Search & Filter Form -->
        <div class="card border-0 shadow-sm rounded-3 mb-4" id="katalog-search" style="background: #ffffff; border: 1px solid var(--forest-border) !important;">
            <div class="card-body p-3">
                <form method="GET" action="{{ route('home') }}">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control bg-white border-start-0 py-2" 
                                       placeholder="Cari judul buku atau penulis..." 
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-tags"></i></span>
                                <select name="category" class="form-select bg-white border-start-0 py-2">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-forest btn-sm w-100 fw-semibold py-2">
                                <i class="bi bi-funnel me-1"></i>Filter
                            </button>
                            @if(request('search') || request('category'))
                                <a href="{{ route('home') }}" class="btn btn-outline-danger btn-sm px-3 py-2" title="Reset Filter">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Active Filter Indicator -->
        @if(request('search') || request('category'))
            <div class="alert alert-light border d-flex align-items-center justify-content-between py-2 px-3 mb-4 rounded-2 small" style="background: #ffffff; border-color: var(--forest-border) !important;">
                <div>
                    <i class="bi bi-info-circle text-success me-2"></i>
                    Menampilkan hasil pencarian
                    @if(request('search')) untuk "<strong>{{ request('search') }}</strong>"@endif
                    @if(request('category'))
                        @php
                            $activeCategory = $categories->firstWhere('id', request('category'));
                        @endphp
                        @if($activeCategory) pada kategori <strong>{{ $activeCategory->name }}</strong>@endif
                    @endif
                </div>
                <a href="{{ route('home') }}" class="text-danger text-decoration-none fw-semibold">
                    <i class="bi bi-x-circle me-1"></i>Hapus Filter
                </a>
            </div>
        @endif

        <!-- 6-COLUMN BOOK GRID (EXACT TO REFERENCE SCREENSHOT) -->
        @if($books->count() > 0)
            <div class="row g-4 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6">
                @foreach($books as $book)
                    @php
                        $bookStock = $book->stock?->quantity ?? 0;
                    @endphp
                    <div class="col">
                        <div class="book-card-forest">
                            <!-- Book Cover Frame with Spine & Stock Badge -->
                            <a href="{{ route('user.book.show', $book) }}" class="text-decoration-none d-block">
                                <div class="book-cover-frame">
                                    @if($book->cover_image)
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                             alt="{{ $book->title }}" 
                                             class="book-cover-img" 
                                             loading="lazy">
                                    @else
                                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted bg-light p-2 text-center">
                                            <i class="bi bi-book fs-2 opacity-50 mb-1"></i>
                                            <span style="font-size: 0.65rem;">No Cover</span>
                                        </div>
                                    @endif

                                    <!-- Spine Realistic Shadow -->
                                    <div class="book-spine-shadow"></div>

                                    <!-- Stock Badge -->
                                    @if($bookStock <= 0)
                                        <span class="book-badge-stock bg-danger text-white">Habis</span>
                                    @elseif($bookStock <= 5)
                                        <span class="book-badge-stock bg-warning text-dark">Sisa {{ $bookStock }}</span>
                                    @endif
                                </div>
                            </a>

                            <!-- Book Information -->
                            <h6 class="book-title-forest" title="{{ $book->title }}">
                                <a href="{{ route('user.book.show', $book) }}" class="text-decoration-none text-dark hover-forest">
                                    {{ $book->title }}
                                </a>
                            </h6>

                            <div class="book-author-forest">
                                {{ $book->author }}
                            </div>

                            <!-- Star Rating (Match Reference Image) -->
                            <div class="book-stars-forest">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <span class="rating-count">({{ number_format(rand(1200, 8500)) }})</span>
                            </div>

                            <!-- Price & Add-To-Cart Row -->
                            <div class="book-price-row">
                                <div class="book-price-text">
                                    Rp {{ number_format($book->price, 0, ',', '.') }}
                                </div>

                                <div>
                                    @auth
                                        @if(auth()->user()->isAdmin())
                                            <a href="{{ route('admin.books.edit', $book) }}" class="btn-cart-square bg-secondary" title="Edit Buku (Admin)">
                                                <i class="bi bi-pencil small"></i>
                                            </a>
                                        @else
                                            @if($bookStock > 0)
                                                <form method="POST" action="{{ route('cart.add', $book) }}" class="m-0">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn-cart-square" title="Tambah ke Keranjang">
                                                        <i class="bi bi-bag-plus"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn-cart-square bg-secondary opacity-50" disabled title="Stok Habis">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            @endif
                                        @endif
                                    @else
                                        @if($bookStock > 0)
                                            <a href="{{ route('login') }}" class="btn-cart-square" title="Masuk untuk Membeli">
                                                <i class="bi bi-bag-plus"></i>
                                            </a>
                                        @else
                                            <button class="btn-cart-square bg-secondary opacity-50" disabled title="Stok Habis">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5 my-4 bg-white rounded-3 p-4 border" style="border-color: var(--forest-border) !important;">
                <i class="bi bi-book display-3 text-muted opacity-50 mb-3 d-block"></i>
                <h5 class="fw-bold font-serif text-dark">Buku Tidak Ditemukan</h5>
                <p class="text-muted small mb-3">Tidak ada buku yang sesuai dengan pencarian atau filter yang Anda pilih.</p>
                <a href="{{ route('home') }}" class="btn btn-forest btn-sm px-4 py-2">
                    <i class="bi bi-arrow-repeat me-1"></i>Reset & Tampilkan Semua Buku
                </a>
            </div>
        @endif
    </div>
</section>

<!-- ==========================================
     4. FITUR UTAMA & LAYANAN (Sesuai Standar Uji Kompetensi)
     ========================================== -->
<section class="py-5" style="background-color: var(--forest-sand);">
    <div class="container">
        <div class="row g-4 text-center">
            <!-- 1. Katalog & Pencarian -->
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100 border" style="border-color: var(--forest-border) !important;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 56px; height: 56px; background-color: rgba(22, 51, 38, 0.08); color: var(--forest-primary);">
                        <i class="bi bi-search fs-3"></i>
                    </div>
                    <h5 class="fw-bold font-serif mb-2" style="color: var(--forest-primary);">Pencarian Buku Lengkap</h5>
                    <p class="text-secondary small mb-0">
                        Temukan berbagai judul buku pilihan berdasarkan nama, pengarang, maupun kategori secara instan dan akurat.
                    </p>
                </div>
            </div>

            <!-- 2. QRIS, GoPay & Transfer Bank -->
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100 border" style="border-color: var(--forest-border) !important;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 56px; height: 56px; background-color: rgba(194, 139, 87, 0.12); color: var(--forest-accent);">
                        <i class="bi bi-qr-code-scan fs-3"></i>
                    </div>
                    <h5 class="fw-bold font-serif mb-2" style="color: var(--forest-primary);">QRIS, GoPay & Transfer</h5>
                    <p class="text-secondary small mb-0">
                        Belanja praktis dan terpercaya dengan pilihan metode pembayaran digital: QRIS instan, e-wallet GoPay, dan Transfer Bank resmi.
                    </p>
                </div>
            </div>

            <!-- 3. Contact to Admin -->
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100 border" style="border-color: var(--forest-border) !important;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 56px; height: 56px; background-color: rgba(22, 51, 38, 0.08); color: var(--forest-primary);">
                        <i class="bi bi-headset fs-3"></i>
                    </div>
                    <h5 class="fw-bold font-serif mb-2" style="color: var(--forest-primary);">Layanan Kontak Admin</h5>
                    <p class="text-secondary small mb-0">
                        Punya pertanyaan mengenai ketersediaan stok atau pemesanan? Hubungi admin kami langsung melalui formulir kontak.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     5. HUBUNGI ADMIN & TENTANG KAMI BANNER
     ========================================== -->
<section class="py-5">
    <div class="container">
        <div class="club-banner shadow-sm">
            <div class="row align-items-center g-4">
                <div class="col-lg-2 text-center text-lg-start">
                    <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle" style="background: rgba(255, 255, 255, 0.1); width: 84px; height: 84px;">
                        <i class="bi bi-chat-left-dots fs-1 text-warning"></i>
                    </div>
                </div>
                <div class="col-lg-7 text-center text-lg-start">
                    <div class="small text-uppercase fw-bold mb-1" style="letter-spacing: 2px; color: #d8aa7a;">
                        LAYANAN PENGUNJUNG BOOKSTORE
                    </div>
                    <h3 class="club-banner-title mb-2">
                        Ada Pertanyaan atau Masukan? Hubungi Admin
                    </h3>
                    <p class="mb-0 small" style="color: #cad8ce; max-width: 580px;">
                        Admin kami siap membantu verifikasi pesanan, rekomendasi buku, dan informasi layanan BookStore.
                    </p>
                </div>
                <div class="col-lg-3 text-center text-lg-end">
                    <a href="{{ route('contact') }}" class="btn btn-ochre px-4 py-2 small fw-semibold text-uppercase d-inline-block mb-2" style="border-radius: 3px; letter-spacing: 1px;">
                        <i class="bi bi-envelope me-1"></i>KIRIM PESAN
                    </a>
                    <div>
                        <a href="{{ route('about') }}" class="small text-white text-decoration-none opacity-75 hover-opacity-100">
                            TENTANG KAMI &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
