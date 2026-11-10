@extends('layouts.app')
@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-4">
    <div class="mb-3">
        <a href="{{ route('user.orders') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <h3 class="fw-bold mb-4">Detail Pesanan</h3>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <code class="fs-6">{{ $order->order_code }}</code>
                        <span class="ms-2 badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span>
                    </div>
                    <small class="text-muted">{{ $order->created_at->format('d F Y H:i') }}</small>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr><th>Buku</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $item->book->title }}</div>
                                        <div class="text-muted small">{{ $item->book->author }}</div>
                                    </td>
                                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total Pembayaran:</td>
                                <td class="fw-bold text-success fs-5">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h6 class="mb-0">Info Pengiriman</h6></div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-5 small">Penerima</dt>
                        <dd class="col-7 small">{{ $order->user->name }}</dd>
                        <dt class="col-5 small">Pembayaran</dt>
                        <dd class="col-7 small">
                            <span class="badge bg-secondary">{{ strtoupper($order->payment_method) }}</span>
                        </dd>
                        <dt class="col-5 small">Alamat</dt>
                        <dd class="col-7 small">{{ $order->shipping_address }}</dd>
                        <dt class="col-5 small">Status</dt>
                        <dd class="col-7 small">
                            <span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
