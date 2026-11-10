@extends('layouts.admin')
@section('title', 'Detail Pengguna')
@section('page-title', 'Detail Pengguna')
@section('content')
<div class="mb-3">
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card text-center p-4">
            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width:80px;height:80px;">
                <i class="bi bi-person fs-1 text-primary"></i>
            </div>
            <h5 class="fw-bold">{{ $user->name }}</h5>
            <p class="text-muted small">{{ $user->email }}</p>
            <hr>
            <p class="small mb-1"><i class="bi bi-telephone me-2"></i>{{ $user->phone ?? 'Tidak ada' }}</p>
            <p class="small mb-1"><i class="bi bi-geo-alt me-2"></i>{{ $user->address ?? 'Tidak ada' }}</p>
            <p class="small mb-0"><i class="bi bi-calendar me-2"></i>Bergabung {{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h6 class="mb-0">Riwayat Pesanan</h6></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr><th>Kode</th><th>Total</th><th>Status</th><th>Tanggal</th></tr>
                        </thead>
                        <tbody>
                            @forelse($user->orders as $order)
                                <tr>
                                    <td><code>{{ $order->order_code }}</code></td>
                                    <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td><span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                                    <td class="text-muted small">{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada pesanan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
