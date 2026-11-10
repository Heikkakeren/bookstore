@extends('layouts.app')

@section('title', 'Selamat Datang di BookStore - Toko Buku Pilihan & Terpercaya')

@push('styles')
<style>
    /* Hero Landing Section */
    .landing-hero {
        background-color: var(--forest-primary);
        background-image: 
            radial-gradient(circle at 85% 20%, rgba(194, 139, 87, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 15% 80%, rgba(36, 82, 62, 0.4) 0%, transparent 60%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
        padding: 5rem 0 6rem;
    }

    .landing-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.02' fill-rule='evenodd'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }

    .landing-badge-official {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(194, 139, 87, 0.18);
        border: 1px solid rgba(194, 139, 87, 0.4);
        color: #e5b98a;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        margin-bottom: 1.5rem;
    }

    .landing-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(2.4rem, 5vw, 4rem);
        line-height: 1.15;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1.25rem;
    }

    .landing-title span {
        color: var(--forest-accent);
        font-style: italic;
    }

    .landing-desc {
        color: #d1dcce;
        font-size: 1.1rem;
        line-height: 1.7;
        max-width: 580px;
        margin-bottom: 2rem;
    }

    /* Trust / Feature Card */
    .feature-card-item {
        background: #ffffff;
        border: 1px solid var(--forest-border);
        border-radius: 12px;
        padding: 2rem 1.5rem;
        height: 100%;
        transition: all 0.3s ease;
        position: relative;
    }

    .feature-card-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(22, 51, 38, 0.08);
        border-color: var(--forest-accent);
    }

    .feature-icon-box {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.25rem;
        transition: transform 0.25s ease;
    }

    .feature-card-item:hover .feature-icon-box {
        transform: scale(1.1);
    }

    /* Step Card */
    .step-number-badge {
        width: 36px;
        height: 36px;
        background: var(--forest-primary);
        color: #ffffff;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    /* Book Card in Landing */
    .landing-book-card {
        background: #ffffff;
        border: 1px solid var(--forest-border);
        border-radius: 10px;
        padding: 1rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }

    .landing-book-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(22, 51, 38, 0.09);
        border-color: var(--forest-primary);
    }

    .landing-book-cover {
        width: 100%;
        aspect-ratio: 2/3;
        background: var(--forest-sand);
        border-radius: 6px;
        overflow: hidden;
        position: relative;
        margin-bottom: 0.85rem;
    }

    .landing-book-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .landing-spine {
        position: absolute;
        top: 0; left: 0; bottom: 0;
        width: 8px;
        background: linear-gradient(to right, rgba(0,0,0,0.35) 0%, rgba(255,255,255,0.15) 50%, rgba(0,0,0,0.1) 100%);
    }

    /* Quick Stats Bar */
    .stats-bar {
        background: #ffffff;
        border: 1px solid var(--forest-border);
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(15, 36, 26, 0.05);
        margin-top: -3rem;
        position: relative;
        z-index: 10;
        padding: 1.75rem 1rem;
    }

    .stat-number {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--forest-primary);
        line-height: 1;
        margin-bottom: 0.25rem;
    }
</style>
@endpush

@section('content')

<!-- ==========================================
     1. HERO LANDING SECTION
========================================== -->
<section class="landing-hero">
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <!-- Official Badge -->
                <div class="landing-badge-official">
                    <i class="bi bi-patch-check-fill text-warning"></i>
                    <span>Toko Buku Online Resmi Terverifikasi</span>
                </div>

                <!-- Main Title -->
                <h1 class="landing-title">
                    Jendela Menuju Ribuan Kisah & <span>Wawasan Tanpa Batas</span>
                </h1>

                <!-- Subtitle / Description -->
                <p class="landing-desc">
                    Temukan buku kurasi terbaik dari teknologi informasi, sastra fiksi, hingga bisnis & ekonomi. Dapatkan jaminan 100% buku original dengan kemudahan <strong>QRIS, GoPay, dan Transfer Bank</strong> — proses cepat, instan, dan terpercaya!
                </p>

                <!-- Call To Action Buttons -->
                <div class="d-flex flex-wrap align-items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-ochre px-4 py-3 rounded-pill shadow">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Akun
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light px-4 py-3 rounded-pill fw-semibold">
                            <i class="bi bi-person-plus me-2"></i>Daftar Pengguna Baru
                        </a>
                        <a href="{{ route('user.catalog') }}" class="btn text-white text-decoration-none px-3 py-2 fw-semibold d-inline-flex align-items-center gap-1 hover-underline">
                            Lihat Katalog Lengkap <i class="bi bi-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('user.catalog') }}" class="btn btn-ochre px-4 py-3 rounded-pill shadow">
                            <i class="bi bi-book-half me-2"></i>Mulai Belanja di Katalog
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-warning px-4 py-3 rounded-pill fw-semibold">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard Administrator
                            </a>
                        @else
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-light px-4 py-3 rounded-pill fw-semibold">
                                <i class="bi bi-bag me-2"></i>Keranjang Saya
                            </a>
                        @endif
                    @endguest
                </div>

                <!-- Small Trust Indicator -->
                <div class="mt-4 pt-3 d-flex flex-wrap align-items-center gap-4 text-white-50 small">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check text-warning fs-5"></i>
                        <span>100% Buku Asli</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-qr-code-scan text-warning fs-5"></i>
                        <span>QRIS & GoPay</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-headset text-warning fs-5"></i>
                        <span>Bantuan Admin Cepat</span>
                    </div>
                </div>
            </div>

            <!-- Hero Graphic Illustration -->
            <div class="col-lg-5 text-center text-lg-end">
                <div class="position-relative d-inline-block">
                    <!-- Circular Seal Stamp -->
                    <div class="position-absolute top-0 start-0 translate-middle-y d-none d-md-flex align-items-center justify-content-center"
                         style="width: 100px; height: 100px; border-radius: 50%; border: 2px dashed rgba(194, 139, 87, 0.8); background: rgba(15, 36, 26, 0.85); backdrop-filter: blur(4px); z-index: 5;">
                        <div class="text-center" style="font-size: 0.65rem; color: #d8aa7a; letter-spacing: 1px; font-weight: 700; text-transform: uppercase;">
                            <i class="bi bi-award fs-5 d-block text-warning mb-1"></i>
                            ORIGINAL<br>QUALITY
                        </div>
                    </div>

                    <!-- Stack of Representative Book Covers -->
                    <div class="p-3 bg-white bg-opacity-10 rounded-4 shadow-lg" style="backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15);">
                        <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=80" 
                             alt="Koleksi Buku BookStore" 
                             class="rounded-3 shadow img-fluid" 
                             style="max-height: 380px; object-fit: cover;">
                        
                        <div class="mt-3 text-start p-2 bg-white rounded-3 shadow-sm d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.72rem; text-transform: uppercase; font-weight: 700;">Buku Terpopuler</small>
                                <span class="fw-bold text-dark font-serif">Pemrograman Laravel untuk Pemula</span>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded">Stok Ada</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     2. QUICK STATS BAR
========================================== -->
<div class="container">
    <div class="stats-bar">
        <div class="row text-center g-3">
            <div class="col-6 col-md-3 border-end">
                <div class="stat-number">{{ $totalBooks }}+</div>
                <div class="text-muted small fw-semibold">Judul Buku Tersedia</div>
            </div>
            <div class="col-6 col-md-3 border-end-md">
                <div class="stat-number">{{ $totalCategories }}</div>
                <div class="text-muted small fw-semibold">Kelompok Kategori Genre</div>
            </div>
            <div class="col-6 col-md-3 border-end">
                <div class="stat-number">100%</div>
                <div class="text-muted small fw-semibold">Buku Asli Bergaransi</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number">QRIS</div>
                <div class="text-muted small fw-semibold">GoPay & Transfer Bank</div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     3. 4 FITUR UTAMA TOKO (STANDAR BNSP)
========================================== -->
<section class="py-5 my-4">
    <div class="container">
        <div class="text-center max-w-xl mx-auto mb-5">
            <span class="text-uppercase fw-bold text-muted small" style="letter-spacing: 2px;">Mengapa Memilih Kami</span>
            <h2 class="font-serif fw-bold mt-1" style="color: var(--forest-primary);">Layanan Terbaik untuk Pecinta Buku</h2>
            <p class="text-secondary small">Dirancang khusus untuk kenyamanan dan keamanan berbelanja buku secara digital.</p>
        </div>

        <div class="row g-4">
            <!-- Feature 1: Digital Payment -->
            <div class="col-md-6 col-lg-3">
                <div class="feature-card-item">
                    <div class="feature-icon-box" style="background: rgba(194, 139, 87, 0.15); color: var(--forest-accent);">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <h5 class="fw-bold font-serif mb-2 text-dark">QRIS & GoPay Instan</h5>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Mendukung pembayaran digital modern via QRIS (BCA, Mandiri, BRI, ShopeePay, Dana, OVO), e-wallet GoPay, serta Transfer Bank resmi.
                    </p>
                </div>
            </div>

            <!-- Feature 2: Original Books -->
            <div class="col-md-6 col-lg-3">
                <div class="feature-card-item">
                    <div class="feature-icon-box" style="background: rgba(22, 51, 38, 0.1); color: var(--forest-primary);">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold font-serif mb-2 text-dark">100% Buku Asli</h5>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Seluruh katalog buku dijamin orisinal langsung dari penerbit terkemuka. Kualitas kertas, cetakan, dan isi terjamin prima.
                    </p>
                </div>
            </div>

            <!-- Feature 3: Catalog & Search -->
            <div class="col-md-6 col-lg-3">
                <div class="feature-card-item">
                    <div class="feature-icon-box" style="background: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                        <i class="bi bi-search"></i>
                    </div>
                    <h5 class="fw-bold font-serif mb-2 text-dark">Pencarian & Filter Cepat</h5>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Temukan judul buku atau nama penulis idaman Anda dalam hitungan detik menggunakan sistem filter kategori yang terstruktur.
                    </p>
                </div>
            </div>

            <!-- Feature 4: Admin Support -->
            <div class="col-md-6 col-lg-3">
                <div class="feature-card-item">
                    <div class="feature-icon-box" style="background: rgba(25, 135, 84, 0.1); color: #198754;">
                        <i class="bi bi-chat-heart"></i>
                    </div>
                    <h5 class="fw-bold font-serif mb-2 text-dark">Layanan Kontak Admin</h5>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Kirim pesan atau pertanyaan kapan saja melalui halaman kontak. Tim kami siap merespons pertanyaan dan rekomendasi buku Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     4. BEST SELLER PREVIEW / KOLEKSI PILIHAN
========================================== -->
<section class="py-5" style="background: var(--forest-sand); border-top: 1px solid var(--forest-border); border-bottom: 1px solid var(--forest-border);">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between mb-4">
            <div>
                <span class="text-uppercase fw-bold small" style="color: var(--forest-accent); letter-spacing: 2px;">Koleksi Unggulan</span>
                <h2 class="font-serif fw-bold mt-1 mb-0" style="color: var(--forest-primary);">Buku Pilihan & Terpopuler</h2>
            </div>
            <a href="{{ route('user.catalog') }}" class="btn btn-outline-forest btn-sm px-3 py-2 rounded-pill mt-3 mt-md-0 fw-semibold">
                Lihat Semua Buku di Katalog <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <!-- Book Grid (6 Books) -->
        <div class="row g-4 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6">
            @forelse($featuredBooks as $book)
                @php
                    $bookStock = $book->stock?->quantity ?? 0;
                @endphp
                <div class="col">
                    <div class="landing-book-card">
                        <!-- Book Cover with Spine -->
                        <a href="{{ route('user.book.show', $book) }}" class="text-decoration-none d-block">
                            <div class="landing-book-cover">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" loading="lazy">
                                @else
                                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted p-2 text-center">
                                        <i class="bi bi-book fs-3 opacity-50 mb-1"></i>
                                        <span style="font-size: 0.65rem;">No Cover</span>
                                    </div>
                                @endif
                                <div class="landing-spine"></div>

                                <!-- Stock Badge -->
                                @if($bookStock <= 0)
                                    <span class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-1 rounded small" style="font-size: 0.65rem; font-weight: 700;">Habis</span>
                                @elseif($bookStock <= 5)
                                    <span class="position-absolute top-0 end-0 bg-warning text-dark px-2 py-1 m-1 rounded small" style="font-size: 0.65rem; font-weight: 700;">Sisa {{ $bookStock }}</span>
                                @endif
                            </div>
                        </a>

                        <!-- Title & Author -->
                        <h6 class="fw-bold font-serif mb-1 text-truncate" title="{{ $book->title }}" style="font-size: 0.88rem;">
                            <a href="{{ route('user.book.show', $book) }}" class="text-decoration-none text-dark hover-forest">
                                {{ $book->title }}
                            </a>
                        </h6>
                        <small class="text-muted text-truncate d-block mb-2" style="font-size: 0.75rem;">
                            {{ $book->author }}
                        </small>

                        <!-- Price & Action -->
                        <div class="mt-auto pt-2 border-top d-flex align-items-center justify-content-between">
                            <div class="fw-bold small text-success font-serif" style="font-size: 0.82rem;">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </div>

                            @auth
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-outline-secondary p-1 px-2" title="Edit (Admin)">
                                        <i class="bi bi-pencil small"></i>
                                    </a>
                                @else
                                    @if($bookStock > 0)
                                        <form method="POST" action="{{ route('cart.add', $book) }}" class="m-0">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-sm btn-primary-custom p-1 px-2 rounded" title="Tambah ke Keranjang">
                                                <i class="bi bi-bag-plus"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-secondary p-1 px-2 rounded opacity-50" disabled title="Stok Habis">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    @endif
                                @endif
                            @else
                                @if($bookStock > 0)
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-forest p-1 px-2 rounded" title="Masuk untuk Memesan">
                                        <i class="bi bi-bag-plus"></i>
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-secondary p-1 px-2 rounded opacity-50" disabled title="Stok Habis">
                                        <i class="bi bi-x"></i>
                                    </button>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada buku yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ==========================================
     5. 4 LANGKAH MUDAH BERBELANJA (HOW IT WORKS)
========================================== -->
<section class="py-5 my-4">
    <div class="container">
        <div class="text-center max-w-xl mx-auto mb-5">
            <span class="text-uppercase fw-bold text-muted small" style="letter-spacing: 2px;">Alur Pemesanan</span>
            <h2 class="font-serif fw-bold mt-1" style="color: var(--forest-primary);">Cara Belanja Mudah & Cepat</h2>
            <p class="text-secondary small">Hanya dalam 4 langkah sederhana, buku favorit Anda siap dikirimkan langsung ke rumah.</p>
        </div>

        <div class="row g-4 text-center">
            <!-- Step 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="p-3">
                    <div class="step-number-badge">1</div>
                    <h5 class="fw-bold font-serif mb-2 text-dark">Pilih Buku</h5>
                    <p class="text-secondary small mb-0">
                        Cari judul atau filter kategori buku yang Anda sukai di katalog lengkap kami.
                    </p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="p-3">
                    <div class="step-number-badge">2</div>
                    <h5 class="fw-bold font-serif mb-2 text-dark">Masukkan Keranjang</h5>
                    <p class="text-secondary small mb-0">
                        Klik tombol tambah keranjang dan tentukan jumlah eksemplar yang ingin dibeli.
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="p-3">
                    <div class="step-number-badge">3</div>
                    <h5 class="fw-bold font-serif mb-2 text-dark">Pilih Pembayaran</h5>
                    <p class="text-secondary small mb-0">
                        Isi alamat pengiriman dan pilih metode bayar: <strong>QRIS, GoPay, atau Transfer</strong>.
                    </p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="p-3">
                    <div class="step-number-badge" style="background: var(--forest-accent);">4</div>
                    <h5 class="fw-bold font-serif mb-2 text-dark">Buku Dikirim</h5>
                    <p class="text-secondary small mb-0">
                        Pesanan langsung diverifikasi oleh admin toko, dikemas aman, dan dikirimkan ke rumah Anda!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     6. FINAL CALL TO ACTION (CTA BANNER)
========================================== -->
<section class="py-5" style="background: var(--forest-primary); color: #ffffff;">
    <div class="container text-center py-4">
        <h2 class="font-serif fw-bold mb-3 display-6 text-white">
            Siap Menemukan Bahan Bacaan Bermutu Hari Ini?
        </h2>
        <p class="text-white-50 max-w-xl mx-auto mb-4" style="font-size: 1.05rem;">
            Bergabunglah bersama ribuan pembaca lainnya. Buat akun sekarang untuk kemudahan pemesanan dan pelacakan transaksi.
        </p>

        <div class="d-flex flex-wrap justify-content-center gap-3">
            @guest
                <a href="{{ route('register') }}" class="btn btn-ochre px-4 py-3 rounded-pill shadow fw-semibold">
                    <i class="bi bi-person-plus me-2"></i>Daftar Akun Gratis Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light px-4 py-3 rounded-pill fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Akun Anda
                </a>
            @else
                <a href="{{ route('user.catalog') }}" class="btn btn-ochre px-4 py-3 rounded-pill shadow fw-semibold">
                    <i class="bi bi-book-half me-2"></i>Mulai Menjelajahi Katalog Buku
                </a>
            @endguest
        </div>
    </div>
</section>

@endsection
