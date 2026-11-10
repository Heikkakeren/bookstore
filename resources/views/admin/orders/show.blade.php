@extends('layouts.admin')
@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')
@section('content')
<div class="mb-3">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Item Pesanan</h6>
                <code>{{ $order->order_code }}</code>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>Buku</th><th>Harga Satuan</th><th>Qty</th><th>Subtotal</th></tr>
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
                            <td colspan="3" class="text-end fw-bold">Total:</td>
                            <td class="fw-bold text-success">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header"><h6 class="mb-0">Info Pesanan</h6></div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5 small">Pelanggan</dt>
                    <dd class="col-7 small">{{ $order->user->name }}</dd>
                    <dt class="col-5 small">Email</dt>
                    <dd class="col-7 small">{{ $order->user->email }}</dd>
                    <dt class="col-5 small">Pembayaran</dt>
                    <dd class="col-7 small"><span class="badge {{ $order->payment_method_badge }}">{{ $order->payment_method_label }}</span></dd>
                    <dt class="col-5 small">Alamat</dt>
                    <dd class="col-7 small">{{ $order->shipping_address }}</dd>
                    <dt class="col-5 small">Tanggal</dt>
                    <dd class="col-7 small">{{ $order->created_at->format('d M Y H:i') }}</dd>
                    <dt class="col-5 small">Status</dt>
                    <dd class="col-7 small"><span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span></dd>
                </dl>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h6 class="mb-0">Update Status</h6></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status Baru</label>
                        <select name="status" class="form-select form-select-sm @error('status') is-invalid @enderror">
                            @foreach(['pending' => 'Menunggu', 'processing' => 'Diproses', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $value => $label)
                                <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-arrow-repeat me-1"></i>Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
