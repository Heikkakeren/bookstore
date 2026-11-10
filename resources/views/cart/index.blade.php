@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Keranjang Belanja</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1 text-dark">
                <i class="bi bi-cart3 text-primary me-2"></i>Keranjang Belanja
            </h2>
            <p class="text-muted small mb-0">Kelola kuantitas buku yang ingin Anda beli sebelum melanjutkan ke pembayaran.</p>
        </div>
        @if($cartItems->count() > 0)
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">
                {{ $cartItems->sum('quantity') }} Item Buku
            </span>
        @endif
    </div>

    @if($cartItems->count() > 0)
        <div class="row g-4">
            <!-- Cart Items Table Column -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary small text-uppercase">
                                <tr>
                                    <th scope="col" style="min-width: 280px;">Buku</th>
                                    <th scope="col" class="text-center" style="width: 140px;">Harga Satuan</th>
                                    <th scope="col" class="text-center" style="width: 150px;">Jumlah</th>
                                    <th scope="col" class="text-end" style="width: 140px;">Subtotal</th>
                                    <th scope="col" class="text-center" style="width: 60px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <!-- Book Details -->
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="rounded bg-light border overflow-hidden flex-shrink-0" style="width: 60px; height: 80px;">
                                                    @if($item->book->cover_image)
                                                        <img src="{{ asset('storage/' . $item->book->cover_image) }}" 
                                                             alt="{{ $item->book->title }}" 
                                                             class="w-100 h-100 object-fit-cover">
                                                    @else
                                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                            <i class="bi bi-book fs-3"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <span class="badge bg-secondary small mb-1">{{ $item->book->category->name }}</span>
                                                    <h6 class="fw-bold mb-1 text-dark lh-sm">
                                                        <a href="{{ route('user.book.show', $item->book) }}" class="text-decoration-none text-dark hover-primary">
                                                            {{ $item->book->title }}
                                                        </a>
                                                    </h6>
                                                    <div class="text-muted small">
                                                        <i class="bi bi-person me-1"></i>{{ $item->book->author }}
                                                    </div>
                                                    <div class="text-secondary small">
                                                        Sisa stok: <span class="fw-semibold">{{ $item->book->stock?->quantity ?? 0 }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Unit Price -->
                                        <td class="text-center fw-semibold text-secondary">
                                            Rp {{ number_format($item->book->price, 0, ',', '.') }}
                                        </td>

                                        <!-- Quantity Update Form -->
                                        <td class="text-center">
                                            <form method="POST" action="{{ route('cart.update', $item) }}" class="d-flex flex-column align-items-center justify-content-center gap-1">
                                                @csrf
                                                @method('PATCH')
                                                <div class="d-flex align-items-center gap-1">
                                                    <input type="number" 
                                                           name="quantity" 
                                                           value="{{ $item->quantity }}" 
                                                           min="1" 
                                                           max="{{ $item->book->stock?->quantity ?? 1 }}"
                                                           onchange="this.form.submit()"
                                                           class="form-control form-control-sm text-center fw-bold" 
                                                           style="width: 70px;"
                                                           title="Ubah angka lalu tekan Enter atau klik ikon update"
                                                           required>
                                                    <button type="submit" class="btn btn-sm btn-outline-forest py-1 px-2" title="Perbarui Jumlah">
                                                        <i class="bi bi-arrow-repeat"></i>
                                                    </button>
                                                </div>
                                                @if(($item->book->stock?->quantity ?? 0) > 1)
                                                    <button type="button" 
                                                            onclick="this.previousElementSibling.querySelector('input').value = {{ $item->book->stock->quantity }}; this.closest('form').submit();" 
                                                            class="btn btn-link text-decoration-none p-0 text-muted" 
                                                            style="font-size: 0.7rem;" 
                                                            title="Beli seluruh sisa stok">
                                                        Beli Semua ({{ $item->book->stock->quantity }})
                                                    </button>
                                                @endif
                                            </form>
                                        </td>

                                        <!-- Subtotal -->
                                        <td class="text-end fw-bold text-success">
                                            Rp {{ number_format($item->quantity * $item->book->price, 0, ',', '.') }}
                                        </td>

                                        <!-- Delete Item Button -->
                                        <td class="text-center">
                                            <form method="POST" action="{{ route('cart.destroy', $item) }}" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ $item->book->title }}\' dari keranjang?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="Hapus dari keranjang">
                                                    <i class="bi bi-trash3 fs-5"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Shopping Assistance Box -->
                <div class="alert alert-info border-0 rounded-3 shadow-sm mt-3 d-flex align-items-center gap-3">
                    <i class="bi bi-shield-check fs-2 text-info"></i>
                    <div class="small">
                        <strong>Metode Pembayaran Aman:</strong> Mendukung <em>Cash on Delivery (COD)</em> — Bayar langsung ke kurir saat buku sampai di tempat Anda tanpa biaya tersembunyi!
                    </div>
                </div>
            </div>

            <!-- Order Summary Card Column -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 90px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-receipt me-2 text-primary"></i>Ringkasan Belanja
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Jumlah Buku</span>
                            <span class="fw-semibold">{{ $cartItems->sum('quantity') }} item</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Biaya Pengiriman</span>
                            <span class="text-success fw-semibold">GRATIS (Promo)</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Metode Bayar</span>
                            <span class="badge bg-success">Payment at Delivery (COD)</span>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold text-dark fs-6">Total Pembayaran</span>
                            <span class="fw-extrabold text-success fs-4">
                                Rp {{ number_format($totalPrice, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Proceed to Checkout Button -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary-custom btn-lg fw-bold shadow-sm py-2">
                                <i class="bi bi-credit-card me-2"></i>Proceed to Checkout
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary fw-semibold py-2">
                                <i class="bi bi-arrow-left me-1"></i>Lanjutkan Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="text-center py-5 my-5 bg-white rounded-4 shadow-sm border p-5">
            <div class="mb-3">
                <i class="bi bi-cart-x display-1 text-muted opacity-50"></i>
            </div>
            <h3 class="fw-bold text-dark mb-2">Keranjang Belanja Masih Kosong</h3>
            <p class="text-muted mb-4 col-md-6 mx-auto">
                Anda belum menambahkan buku apa pun ke dalam keranjang belanja. Jelajahi katalog kami dan temukan buku favorit Anda sekarang.
            </p>
            <a href="{{ route('home') }}" class="btn btn-primary-custom btn-lg px-4 fw-bold shadow-sm">
                <i class="bi bi-grid-fill me-2"></i>Mulai Berbelanja
            </a>
        </div>
    @endif
</div>
@endsection
