@extends('layouts.admin')

@section('title', 'Manajemen Transaksi Pesanan')
@section('page-title', 'Daftar Transaksi Pesanan')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 font-serif" style="color: var(--forest-primary); font-size: 1.4rem;">
            <i class="bi bi-receipt-cutoff me-2" style="color: var(--forest-accent);"></i>Daftar Pesanan Seluruh Pelanggan
        </h4>
        <p class="text-muted small mb-0">Pantau transaksi masuk, verifikasi alamat pengiriman, dan perbarui status pesanan.</p>
    </div>
    <div class="small fw-semibold px-3 py-2 rounded-pill" style="background-color: var(--forest-sand); color: var(--forest-primary);">
        Total Transaksi: <strong>{{ $orders->total() }}</strong> pesanan
    </div>
</div>

<!-- Orders Table Card -->
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-3" style="width: 50px;">#</th>
                        <th scope="col">Kode Pesanan</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col" class="text-end">Total Bayar</th>
                        <th scope="col" class="text-center">Pembayaran</th>
                        <th scope="col" class="text-center">Status Saat Ini</th>
                        <th scope="col" style="min-width: 200px;">Ubah Status Pesanan</th>
                        <th scope="col" class="text-end pe-3" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="ps-3 text-secondary fw-semibold">
                                {{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}
                            </td>
                            <td>
                                <span class="fw-bold font-monospace" style="color: var(--forest-primary);">{{ $order->order_code }}</span>
                                <div class="text-muted small">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $order->user->name ?? 'User Terhapus' }}</div>
                                <div class="text-muted small">{{ $order->user->email ?? '-' }}</div>
                            </td>
                            <td class="text-end fw-bold" style="color: var(--forest-primary);">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $order->payment_method_badge }} text-uppercase px-2 py-1">
                                    {{ $order->payment_method_label }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-{{ $order->status_badge }} px-3 py-2 rounded-pill fw-semibold">
                                    {{ $order->status_label }}
                                </span>
                            </td>

                            <!-- Inline Form Dropdown Ubah Status -->
                            <td>
                                <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="d-flex align-items-center gap-1">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="font-size: 0.85rem;">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>⏳ Menunggu (Pending)</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>📦 Diproses (Processing)</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>✅ Selesai (Completed)</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>❌ Dibatalkan (Cancelled)</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-forest" title="Update Status">
                                        <i class="bi bi-check2"></i>
                                    </button>
                                </form>
                            </td>

                            <td class="text-end pe-3">
                                <!-- Trigger Modal Detail -->
                                <button type="button" 
                                        class="btn btn-sm btn-outline-forest" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalOrderDetail{{ $order->id }}"
                                        title="Lihat Detail Pesanan">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Detail Pesanan -->
                        <div class="modal fade" id="modalOrderDetail{{ $order->id }}" tabindex="-1" aria-labelledby="modalOrderLabel{{ $order->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header" style="background-color: var(--forest-sand);">
                                        <div>
                                            <span class="text-muted small">Rincian Faktur Pesanan</span>
                                            <h6 class="modal-title fw-bold font-monospace" style="color: var(--forest-primary);" id="modalOrderLabel{{ $order->id }}">
                                                {{ $order->order_code }}
                                            </h6>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row g-3 mb-4">
                                            <div class="col-sm-6">
                                                <span class="text-muted small d-block">Pelanggan:</span>
                                                <strong class="text-dark">{{ $order->user->name ?? 'User Terhapus' }}</strong>
                                                <div class="small text-muted">{{ $order->user->email ?? '-' }}</div>
                                                <div class="small text-muted">Telp: {{ $order->user->phone ?? 'Tidak ada' }}</div>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="text-muted small d-block">Metode Pembayaran:</span>
                                                <span class="badge {{ $order->payment_method_badge }} text-uppercase mb-2">{{ $order->payment_method_label }}</span>
                                                <span class="text-muted small d-block">Waktu Pemesanan:</span>
                                                <strong class="text-dark small">{{ $order->created_at->format('d F Y, H:i') }} WIB</strong>
                                            </div>
                                            <div class="col-12">
                                                <div class="p-3 rounded-3" style="background-color: var(--forest-cream); border: 1px solid var(--forest-border);">
                                                    <span class="small fw-bold d-block mb-1" style="color: var(--forest-primary);">
                                                        <i class="bi bi-geo-alt text-danger me-1"></i>Alamat Pengiriman Lengkap:
                                                    </span>
                                                    <p class="mb-0 small text-dark">{{ $order->shipping_address }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="fw-bold mb-2 font-serif" style="color: var(--forest-primary);">Item Buku yang Dipesan:</h6>
                                        <div class="table-responsive border rounded-3 overflow-hidden" style="border-color: var(--forest-border) !important;">
                                            <table class="table align-middle mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="ps-3">Buku</th>
                                                        <th class="text-center">Harga</th>
                                                        <th class="text-center">Jumlah</th>
                                                        <th class="text-end pe-3">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->orderItems as $item)
                                                        <tr>
                                                            <td class="ps-3">
                                                                <div class="fw-bold small text-dark">{{ $item->book->title ?? 'Buku Tidak Diketahui' }}</div>
                                                                <div class="text-muted small">{{ $item->book->author ?? '' }}</div>
                                                            </td>
                                                            <td class="text-center small">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                            <td class="text-center small">{{ $item->quantity }}</td>
                                                            <td class="text-end pe-3 small fw-bold" style="color: var(--forest-primary);">
                                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot style="background-color: var(--forest-sand);">
                                                    <tr>
                                                        <td colspan="3" class="text-end fw-bold" style="color: var(--forest-primary);">Total Pembayaran:</td>
                                                        <td class="text-end pe-3 fw-bold fs-6" style="color: var(--forest-primary);">
                                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light py-2">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-receipt fs-1 d-block mb-2 opacity-50"></i>
                                Belum ada pesanan yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orders->hasPages())
        <div class="card-footer bg-white py-3 border-top">
            <div class="d-flex justify-content-center mb-0">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection
