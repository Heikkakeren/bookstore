@extends('layouts.admin')

@section('title', 'Dashboard Administrasi')
@section('page-title', 'Ringkasan Sistem')

@section('content')
<!-- Welcome Banner (Forest Luxury Theme) -->
<div class="card border-0 shadow-sm rounded-4 mb-4 text-white overflow-hidden" style="background: linear-gradient(135deg, #0d1e17 0%, #163326 50%, #234e3b 100%); border: 1px solid rgba(194, 139, 87, 0.3) !important;">
    <div class="card-body p-4 p-md-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="badge px-3 py-2 rounded-pill fw-bold mb-3" style="background-color: var(--forest-accent); color: #ffffff; letter-spacing: 1px;">
                    <i class="bi bi-shield-check me-1"></i>PANEL ADMINISTRATOR RESMI
                </span>
                <h3 class="fw-bold font-serif mb-2" style="font-size: 1.85rem; letter-spacing: 0.5px;">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h3>
                <p class="text-light text-opacity-75 mb-0" style="font-size: 0.95rem; max-width: 620px;">
                    Sistem Manajemen BookStore siap digunakan. Pantau inventaris katalog buku, kelola kategori, proses pesanan masuk, dan tanggapi pesan kontak pelanggan secara real-time.
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-4 mt-md-0 d-none d-md-block">
                <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle" style="background: rgba(255, 255, 255, 0.08); width: 90px; height: 90px; border: 1px dashed rgba(194, 139, 87, 0.5);">
                    <i class="bi bi-book-half text-warning fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stat Cards (Matching Rubrik: Kategori, Buku, User, Pesanan, Kontak) -->
<div class="row g-3 mb-4">
    <!-- 1. Total Buku -->
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 h-100 p-3 border-start border-4" style="border-left-color: var(--forest-primary) !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Master Data Buku</span>
                    <h2 class="fw-bold text-dark mt-1 mb-0">{{ $totalBooks }}</h2>
                    <span class="small fw-semibold" style="color: var(--forest-primary);">
                        <i class="bi bi-journal-bookmark me-1"></i>Judul Terdaftar
                    </span>
                </div>
                <div class="p-3 rounded-3" style="background-color: rgba(22, 51, 38, 0.08); color: var(--forest-primary);">
                    <i class="bi bi-book fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Total Kategori -->
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 h-100 p-3 border-start border-4" style="border-left-color: var(--forest-accent) !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Kategori Buku</span>
                    <h2 class="fw-bold text-dark mt-1 mb-0">{{ $totalCategories }}</h2>
                    <span class="small fw-semibold" style="color: var(--forest-accent);">
                        <i class="bi bi-tags me-1"></i>Kelompok Kategori
                    </span>
                </div>
                <div class="p-3 rounded-3" style="background-color: rgba(194, 139, 87, 0.12); color: var(--forest-accent);">
                    <i class="bi bi-tags fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Total Pesanan -->
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 h-100 p-3 border-start border-4" style="border-left-color: #234e3b !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Pesanan Masuk</span>
                    <h2 class="fw-bold text-dark mt-1 mb-0">{{ $totalOrders }}</h2>
                    <span class="small text-{{ $pendingOrders > 0 ? 'warning' : 'success' }} fw-semibold">
                        <i class="bi bi-hourglass-split me-1"></i>{{ $pendingOrders }} Menunggu Konfirmasi
                    </span>
                </div>
                <div class="p-3 rounded-3" style="background-color: rgba(35, 78, 59, 0.1); color: #234e3b;">
                    <i class="bi bi-receipt fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Total User Terdaftar -->
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 h-100 p-3 border-start border-4" style="border-left-color: #4b6b58 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Pengguna Terdaftar</span>
                    <h2 class="fw-bold text-dark mt-1 mb-0">{{ $totalUsers }}</h2>
                    <span class="small text-muted">
                        <i class="bi bi-person-check me-1"></i>Akun Pelanggan Aktif
                    </span>
                </div>
                <div class="p-3 rounded-3" style="background-color: rgba(75, 107, 88, 0.1); color: #4b6b58;">
                    <i class="bi bi-people fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Shortcuts (Matching 4 Core Rubric Tasks) -->
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-body p-3">
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <span class="fw-bold text-dark small me-2">
                <i class="bi bi-lightning-charge-fill text-warning me-1"></i>Aksi Cepat:
            </span>
            <a href="{{ route('admin.books.create') }}" class="btn btn-sm btn-forest">
                <i class="bi bi-plus-circle me-1"></i>Tambah Buku Baru
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-ochre">
                <i class="bi bi-tags me-1"></i>Kelola Kategori
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-forest">
                <i class="bi bi-receipt-cutoff me-1"></i>Lihat Pesanan
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-people me-1"></i>Data Pengguna
            </a>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary position-relative">
                <i class="bi bi-chat-left-dots me-1"></i>Pesan Masuk
                @if($unreadContacts > 0)
                    <span class="badge rounded-pill bg-danger ms-1">{{ $unreadContacts }}</span>
                @endif
            </a>
        </div>
    </div>
</div>

<!-- Recent Orders Table (Matching "List pesanan buku dari user yang berbeda-beda") -->
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
        <h6 class="fw-bold mb-0 font-serif" style="color: var(--forest-primary); font-size: 1.1rem;">
            <i class="bi bi-clock-history me-2" style="color: var(--forest-accent);"></i>Transaksi Pesanan Terbaru
        </h6>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-forest fw-semibold">
            Lihat Semua Pesanan <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="small text-uppercase">
                    <tr>
                        <th scope="col" class="ps-3">Kode Pesanan</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Total Transaksi</th>
                        <th scope="col">Metode Bayar</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Pesan</th>
                        <th scope="col" class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td class="ps-3">
                                <span class="fw-bold font-monospace" style="color: var(--forest-primary);">{{ $order->order_code }}</span>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $order->user->name ?? 'User Terhapus' }}</div>
                                <div class="text-muted small">{{ $order->user->email ?? '-' }}</div>
                            </td>
                            <td class="fw-bold" style="color: var(--forest-primary);">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge {{ $order->payment_method_badge }} text-uppercase">{{ $order->payment_method_label }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $order->status_badge }} px-2 py-1">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="text-muted small">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="text-end pe-3">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-forest">
                                    <i class="bi bi-eye me-1"></i>Rincian
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-1 opacity-50"></i>
                                Belum ada transaksi pesanan yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
