@extends('layouts.app')

@section('title', 'Detail Pesanan ' . $order->order_code)

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('orders.history') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Riwayat Pesanan
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small">Faktur Pesanan</span>
                        <h5 class="fw-bold mb-0 text-dark">{{ $order->order_code }}</h5>
                    </div>
                    <span class="badge bg-{{ $order->status_badge }} px-3 py-2 fs-6">
                        {{ $order->status_label }}
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light small text-uppercase text-secondary">
                                <tr>
                                    <th>Buku</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $item->book->title ?? 'Buku' }}</div>
                                            <div class="text-muted small">{{ $item->book->author ?? '' }}</div>
                                        </td>
                                        <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end fw-bold text-dark">
                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total Pembayaran:</td>
                                    <td class="text-end fw-extrabold text-success fs-5">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-info-circle text-primary me-2"></i>Informasi Transaksi
                    </h6>
                </div>
                <div class="card-body p-3 small">
                    <div class="mb-3">
                        <span class="text-muted d-block">Waktu Transaksi:</span>
                        <span class="fw-semibold">{{ $order->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted d-block">Metode Pembayaran:</span>
                        <span class="badge {{ $order->payment_method_badge }} px-3 py-2 text-uppercase">{{ $order->payment_method_label }}</span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted d-block">Nama Pemesan:</span>
                        <span class="fw-semibold">{{ $order->user->name }}</span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted d-block">Alamat Pengiriman:</span>
                        <span class="fw-semibold text-dark">{{ $order->shipping_address }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
