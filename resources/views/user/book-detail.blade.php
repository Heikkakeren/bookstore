@extends('layouts.app')

@section('title', $book->title . ' - Detail Buku')

@push('styles')
<style>
    .detail-cover-box {
        position: relative;
        aspect-ratio: 1 / 1.48;
        border-radius: 6px;
        overflow: hidden;
        background-color: #ede8df;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        max-width: 320px;
        margin: auto;
    }

    .detail-cover-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .detail-spine-shadow {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 16px;
        background: linear-gradient(to right, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.05) 60%, transparent);
        pointer-events: none;
    }

    .related-book-card {
        background: #ffffff;
        border: 1px solid var(--forest-border);
        border-radius: 6px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .related-book-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.08);
        border-color: var(--forest-primary);
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--forest-primary);">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home', ['category' => $book->category_id]) }}" class="text-decoration-none" style="color: var(--forest-primary);">{{ $book->category->name }}</a></li>
            <li class="breadcrumb-item active text-muted" aria-current="page">{{ Str::limit($book->title, 40) }}</li>
        </ol>
    </nav>

    <!-- Book Detail Card -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-5" style="background: #ffffff; border: 1px solid var(--forest-border) !important;">
        <div class="card-body p-4 p-md-5">
            <div class="row g-4 align-items-center">
                <!-- Book Cover Column with Realistic Spine Shadow -->
                <div class="col-md-5 col-lg-4 text-center">
                    <div class="detail-cover-box">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                 alt="{{ $book->title }}" 
                                 class="img-fluid">
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted" style="height: 380px;">
                                <i class="bi bi-book display-1 opacity-25 mb-2"></i>
                                <span class="small">Cover Tidak Tersedia</span>
                            </div>
                        @endif
                        <div class="detail-spine-shadow"></div>
                    </div>
                </div>

                <!-- Book Information Column -->
                <div class="col-md-7 col-lg-8">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                        <span class="badge px-3 py-2 rounded-pill fw-semibold" style="background-color: var(--forest-sand); color: var(--forest-primary); border: 1px solid var(--forest-border);">
                            {{ $book->category->name }}
                        </span>
                        @php
                            $bookStock = $book->stock?->quantity ?? 0;
                        @endphp
                        @if($bookStock > 0)
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold">
                                <i class="bi bi-check2-circle me-1"></i>Stok Tersedia ({{ $bookStock }} pcs)
                            </span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-semibold">
                                <i class="bi bi-x-circle me-1"></i>Stok Habis
                            </span>
                        @endif
                    </div>

                    <h1 class="font-serif fw-bold mb-2 lh-sm text-dark" style="font-size: 2rem;">{{ $book->title }}</h1>

                    <div class="d-flex align-items-center gap-2 text-warning mb-3">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <span class="text-muted small ms-1">(4.9 &bull; Terlaris di Kategori {{ $book->category->name }})</span>
                    </div>

                    <div class="row g-2 mb-3 py-2 border-top border-bottom small" style="border-color: var(--forest-border) !important; color: #52525b;">
                        <div class="col-sm-6">
                            <i class="bi bi-person text-muted me-1"></i>Penulis: <strong class="text-dark">{{ $book->author }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <i class="bi bi-building text-muted me-1"></i>Penerbit: <strong class="text-dark">{{ $book->publisher }}</strong>
                        </div>
                    </div>

                    <!-- Price Box -->
                    <div class="p-3 rounded-2 mb-4 d-flex align-items-baseline gap-2" style="background: var(--forest-sand);">
                        <span class="text-muted small">Harga Buku:</span>
                        <span class="font-serif fw-bold fs-3" style="color: var(--forest-primary);">
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <h6 class="fw-bold font-serif text-dark mb-2">Sinopsis & Deskripsi:</h6>
                        <p class="text-secondary leading-relaxed small" style="line-height: 1.7;">
                            {{ $book->description ?: 'Belum ada deskripsi lengkap untuk buku ini.' }}
                        </p>
                    </div>

                    <!-- Add to Cart Form -->
                    @if(($book->stock?->quantity ?? 0) > 0)
                        @auth
                            @if(auth()->user()->isAdmin())
                                <div class="alert alert-warning py-2 small d-inline-block">
                                    <i class="bi bi-shield-exclamation me-1"></i>Anda masuk sebagai Admin. Untuk berbelanja, gunakan akun User.
                                </div>
                            @else
                                <form method="POST" action="{{ route('cart.add', $book) }}" class="d-flex flex-wrap align-items-center gap-3">
                                    @csrf
                                    <div class="d-flex align-items-center border rounded-2 bg-white p-1" style="width: 140px; border-color: var(--forest-border) !important;">
                                        <label class="small text-muted px-2 fw-semibold">Jumlah:</label>
                                        <input type="number" 
                                               name="quantity" 
                                               value="1" 
                                               min="1" 
                                               max="{{ $book->stock?->quantity ?? 1 }}" 
                                               class="form-control form-control-sm border-0 text-center fw-bold" 
                                               required>
                                    </div>
                                    <button type="submit" class="btn btn-forest px-4 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2">
                                        <i class="bi bi-bag-plus"></i>Tambah ke Keranjang
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-forest px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2">
                                <i class="bi bi-box-arrow-in-right"></i>Masuk untuk Membeli Buku
                            </a>
                        @endauth
                    @else
                        <button class="btn btn-secondary px-4 py-2 fw-semibold" disabled>
                            <i class="bi bi-x-circle me-2"></i>Stok Sedang Habis
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Related Books -->
    @if(isset($relatedBooks) && $relatedBooks->count() > 0)
        <div class="mt-5">
            <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-secondary border-opacity-10">
                <h5 class="font-serif text-uppercase mb-0 fw-bold" style="letter-spacing: 2px; color: var(--forest-primary);">
                    Buku Terkait dalam Kategori yang Sama
                </h5>
            </div>
            <div class="row g-4 row-cols-2 row-cols-md-4">
                @foreach($relatedBooks as $rel)
                    <div class="col">
                        <div class="related-book-card p-3">
                            <a href="{{ route('user.book.show', $rel) }}" class="text-decoration-none">
                                <div class="position-relative rounded mb-2 overflow-hidden" style="aspect-ratio: 1 / 1.48; background: #ede8df;">
                                    @if($rel->cover_image)
                                        <img src="{{ asset('storage/' . $rel->cover_image) }}" 
                                             alt="{{ $rel->title }}" 
                                             class="w-100 h-100 object-fit-cover">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="bi bi-book fs-2"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <h6 class="fw-bold font-serif mb-1 small lh-sm">
                                <a href="{{ route('user.book.show', $rel) }}" class="text-decoration-none text-dark hover-forest">
                                    {{ Str::limit($rel->title, 32) }}
                                </a>
                            </h6>
                            <p class="text-muted small mb-2" style="font-size: 0.75rem;">{{ Str::limit($rel->author, 20) }}</p>
                            <div class="mt-auto fw-bold text-success small">
                                Rp {{ number_format($rel->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
