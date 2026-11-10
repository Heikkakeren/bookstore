@extends('layouts.app')

@section('title', 'Checkout Pembayaran')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-decoration-none">Keranjang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout Pesanan</li>
        </ol>
    </nav>

    <div class="mb-4 pb-2 border-bottom">
        <h2 class="fw-bold mb-1 text-dark">
            <i class="bi bi-credit-card-2-front text-primary me-2"></i>Konfirmasi & Checkout Pesanan
        </h2>
        <p class="text-muted small mb-0">Pastikan alamat pengiriman dan metode pembayaran sudah sesuai sebelum pesanan diproses.</p>
    </div>

    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <div class="row g-4">
            <!-- Left Column: Shipping & Payment Method -->
            <div class="col-lg-7">
                <!-- Customer Information Card -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-person-badge text-primary me-2"></i>Identitas Penerima
                        </h6>
                        <span class="badge bg-light text-secondary border">Akun Terdaftar</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Nama Lengkap</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->name }}" readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Alamat Email</label>
                                <input type="email" class="form-control bg-light" value="{{ $user->email }}" readonly disabled>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small fw-semibold text-secondary">Nomor Telepon / WhatsApp</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->phone ?? 'Belum dicantumkan' }}" readonly disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address Card -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-geo-alt-fill text-danger me-2"></i>Alamat Pengiriman Lengkap <span class="text-danger">*</span>
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-2">Tuliskan nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota, dan patokan agar kurir mudah menemukan lokasi Anda.</p>
                        <div class="mb-3">
                            <textarea name="shipping_address" 
                                      id="shipping_address"
                                      rows="3" 
                                      class="form-control @error('shipping_address') is-invalid @enderror" 
                                      placeholder="Contoh: Jl. Merdeka No. 12, RT 02 / RW 05, Kel. Sukamaju, Kec. Cilincing, Jakarta Utara 14120 (Depan Masjid Al-Ikhlas)" 
                                      required>{{ old('shipping_address', $user->address) }}</textarea>
                            @error('shipping_address')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Method Card (Payment at Delivery) -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-wallet2 text-success me-2"></i>Pilihan Metode Pembayaran <span class="text-danger">*</span>
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Pilih cara pembayaran yang paling nyaman untuk Anda:</p>

                        @error('payment_method')
                            <div class="alert alert-danger py-2 small mb-3">
                                <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                            </div>
                        @enderror

                        <div class="row g-3">
                            <!-- 1. QRIS (Scan Barcode) -->
                            <div class="col-md-4">
                                <label class="payment-card-label d-block h-100">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="qris" 
                                           class="d-none payment-radio" 
                                           {{ old('payment_method', 'qris') === 'qris' ? 'checked' : '' }} 
                                           required>
                                    <div class="p-3 border rounded-3 text-center cursor-pointer payment-box h-100 {{ old('payment_method', 'qris') === 'qris' ? 'selected' : '' }}">
                                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 d-inline-flex mb-2">
                                            <i class="bi bi-qr-code-scan fs-3"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">QRIS</h6>
                                        <p class="text-muted small mb-0" style="font-size: 0.75rem;">Scan barcode instan via BCA, Mandiri, BRImo, ShopeePay, Dana, dll.</p>
                                    </div>
                                </label>
                            </div>

                            <!-- 2. GoPay (E-Wallet) -->
                            <div class="col-md-4">
                                <label class="payment-card-label d-block h-100">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="gopay" 
                                           class="d-none payment-radio" 
                                           {{ old('payment_method') === 'gopay' ? 'checked' : '' }}>
                                    <div class="p-3 border rounded-3 text-center cursor-pointer payment-box h-100 {{ old('payment_method') === 'gopay' ? 'selected' : '' }}">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 d-inline-flex mb-2">
                                            <i class="bi bi-wallet2 fs-3"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">GoPay</h6>
                                        <p class="text-muted small mb-0" style="font-size: 0.75rem;">Pembayaran praktis & cepat menggunakan saldo GoPay atau nomor HP.</p>
                                    </div>
                                </label>
                            </div>

                            <!-- 3. Transfer Bank -->
                            <div class="col-md-4">
                                <label class="payment-card-label d-block h-100">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="transfer" 
                                           class="d-none payment-radio" 
                                           {{ old('payment_method') === 'transfer' ? 'checked' : '' }}>
                                    <div class="p-3 border rounded-3 text-center cursor-pointer payment-box h-100 {{ old('payment_method') === 'transfer' ? 'selected' : '' }}">
                                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 d-inline-flex mb-2">
                                            <i class="bi bi-bank fs-3"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">Transfer Bank</h6>
                                        <p class="text-muted small mb-0" style="font-size: 0.75rem;">Transfer manual / ATM ke rekening resmi BCA BookStore Indonesia.</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Payment Instructions Note Box -->
                        <div class="mt-3 p-3 rounded-2 small" style="background: var(--forest-sand); border: 1px dashed var(--forest-border);">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="bi bi-info-circle-fill" style="color: var(--forest-accent);"></i>
                                <strong class="text-dark">Petunjuk Pembayaran:</strong>
                            </div>
                            <span class="text-secondary" id="payment-instruction-text">
                                Silakan pilih metode pembayaran di atas. Rincian tagihan dan konfirmasi pembayaran akan diproses oleh administrator toko.
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary & Submit -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 90px;">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-bag-check me-2 text-primary"></i>Rincian Pesanan
                        </h6>
                        <span class="badge px-3 py-2 rounded-pill fw-bold" style="background-color: var(--forest-primary); color: #ffffff;">
                            Total: {{ $cartItems->sum('quantity') }} Buku
                        </span>
                    </div>

                    <div class="card-body p-0">
                        <!-- Scrollable Items List -->
                        <div class="p-3 overflow-auto" style="max-height: 280px;">
                            @foreach($cartItems as $item)
                                <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                                    <div class="d-flex align-items-center gap-2 me-2">
                                        <div class="rounded bg-light border overflow-hidden flex-shrink-0" style="width: 40px; height: 50px;">
                                            @if($item->book->cover_image)
                                                <img src="{{ asset('storage/' . $item->book->cover_image) }}" 
                                                     alt="{{ $item->book->title }}" 
                                                     class="w-100 h-100 object-fit-cover">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                    <i class="bi bi-book small"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark small lh-sm">{{ Str::limit($item->book->title, 28) }}</div>
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <span class="badge bg-success bg-opacity-10 text-success fw-bold" style="font-size: 0.75rem;">
                                                    {{ $item->quantity }} pcs
                                                </span>
                                                <span class="text-muted small">@ Rp {{ number_format($item->book->price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fw-bold text-dark small text-end">
                                        Rp {{ number_format($item->quantity * $item->book->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price Breakdown -->
                        <div class="p-4 bg-light bg-opacity-50 border-top">
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-secondary">Subtotal Buku</span>
                                <span class="fw-semibold">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-secondary">Ongkos Kirim</span>
                                <span class="text-success fw-bold">GRATIS</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 small">
                                <span class="text-secondary">Biaya Layanan COD</span>
                                <span class="text-success fw-bold">Rp 0</span>
                            </div>

                            <hr class="my-2">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fw-bold text-dark">Total Pembayaran</span>
                                <span class="fw-extrabold text-success fs-4">
                                    Rp {{ number_format($totalPrice, 0, ',', '.') }}
                                </span>
                            </div>

                            <!-- Submit Order Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary-custom btn-lg fw-bold shadow-sm py-3">
                                    <i class="bi bi-check2-circle me-2"></i>Konfirmasi & Buat Pesanan
                                </button>
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary fw-semibold py-2">
                                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Keranjang
                                </a>
                            </div>

                            <p class="text-center text-muted small mt-3 mb-0">
                                <i class="bi bi-lock-fill text-secondary me-1"></i>
                                Data transaksi terlindungi dengan aman oleh sistem BookStore.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
.cursor-pointer {
    cursor: pointer;
}
.payment-box {
    transition: all 0.2s ease-in-out;
    background-color: #ffffff;
}
.payment-box:hover {
    border-color: #0f2b5c !important;
    background-color: #f8fafc;
}
.payment-box.selected {
    border-color: #0f2b5c !important;
    border-width: 2px !important;
    background-color: #f1f5f9;
}
</style>
@endpush

@push('scripts')
<script>
document.querySelectorAll('.payment-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.payment-box').forEach(box => {
            box.classList.remove('selected');
        });
        if (this.checked) {
            this.closest('.payment-card-label').querySelector('.payment-box').classList.add('selected');
        }
    });
});
</script>
@endpush
