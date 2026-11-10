@extends('layouts.app')

@section('title', 'Riwayat Pesanan Saya')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat Pesanan</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1 text-dark">
                <i class="bi bi-clock-history text-primary me-2"></i>Riwayat Pesanan Saya
            </h2>
            <p class="text-muted small mb-0">Pantau status pemrosesan dan riwayat transaksi buku yang pernah Anda pesan.</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm fw-semibold">
            <i class="bi bi-plus-lg me-1"></i>Belanja Buku Baru
        </a>
    </div>

    @if($orders->count() > 0)
        <div class="row g-4">
            @foreach($orders as $order)
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <!-- Card Header -->
                        <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <span class="bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                    <i class="bi bi-receipt fs-5"></i>
                                </span>
                                <div>
                                    <div class="fw-bold text-dark fs-6">{{ $order->order_code }}</div>
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('d M Y, H:i') }} WIB
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <span class="badge {{ $order->payment_method_badge }} px-3 py-2 text-uppercase fw-semibold">
                                    <i class="bi bi-wallet2 me-1"></i>{{ $order->payment_method_label }}
                                </span>

                                @php
                                    $statusClass = match($order->status) {
                                        'pending' => 'bg-warning text-dark',
                                        'processing' => 'bg-info text-white',
                                        'completed' => 'bg-success text-white',
                                        'cancelled' => 'bg-danger text-white',
                                        default => 'bg-secondary text-white'
                                    };
                                    $statusIcon = match($order->status) {
                                        'pending' => 'bi-hourglass-split',
                                        'processing' => 'bi-arrow-repeat',
                                        'completed' => 'bi-check-circle-fill',
                                        'cancelled' => 'bi-x-circle-fill',
                                        default => 'bi-info-circle'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} px-3 py-2 fw-semibold">
                                    <i class="bi {{ $statusIcon }} me-1"></i>{{ $order->status_label }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body: Items List -->
                        <div class="card-body p-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-lg-8">
                                    <h6 class="text-secondary small fw-bold text-uppercase mb-3">Buku yang Dipesan</h6>
                                    <div class="d-flex flex-column gap-3">
                                        @foreach($order->orderItems as $item)
                                            <div class="d-flex align-items-center gap-3 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                                <div class="rounded bg-light border overflow-hidden flex-shrink-0" style="width: 50px; height: 65px;">
                                                    @if($item->book && $item->book->cover_image)
                                                        <img src="{{ asset('storage/' . $item->book->cover_image) }}" 
                                                             alt="{{ $item->book->title }}" 
                                                             class="w-100 h-100 object-fit-cover">
                                                    @else
                                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                            <i class="bi bi-book"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-bold text-dark">
                                                        {{ $item->book->title ?? 'Buku Tidak Diketahui' }}
                                                    </div>
                                                    <div class="text-muted small">
                                                        {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                                <div class="fw-bold text-dark text-end">
                                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-lg-4 border-start-lg ps-lg-4 mt-4 mt-lg-0">
                                    <div class="bg-light p-3 rounded-3">
                                        <div class="small text-muted mb-1">
                                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>Alamat Pengiriman:
                                        </div>
                                        <p class="small fw-semibold text-dark mb-3">
                                            {{ $order->shipping_address }}
                                        </p>

                                        <div class="d-flex justify-content-between align-items-baseline mb-3 pt-2 border-top">
                                            <span class="text-secondary small">Total Bayar:</span>
                                            <span class="fw-bold fs-5 text-success">
                                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </span>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary fw-semibold">
                                                <i class="bi bi-file-earmark-text me-1"></i>Detail Faktur Pesanan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-5 my-5 bg-white rounded-4 shadow-sm border p-5">
            <i class="bi bi-bag-x display-1 text-muted opacity-50 mb-3 d-block"></i>
            <h4 class="fw-bold text-dark mb-2">Belum Ada Transaksi Pesanan</h4>
            <p class="text-muted mb-4 col-md-6 mx-auto">
                Anda belum pernah melakukan pemesanan buku di BookStore. Temukan buku terbaik dan mulai pesanan pertama Anda sekarang.
            </p>
            <a href="{{ route('home') }}" class="btn btn-primary-custom btn-lg px-4 fw-bold shadow-sm">
                <i class="bi bi-grid-fill me-2"></i>Mulai Berbelanja
            </a>
        </div>
    @endif
</div>
@endsection
