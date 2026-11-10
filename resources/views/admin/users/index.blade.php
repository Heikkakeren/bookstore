@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Daftar Pengguna Terdaftar')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 font-serif" style="color: var(--forest-primary); font-size: 1.4rem;">
            <i class="bi bi-people me-2" style="color: var(--forest-accent);"></i>Daftar Pengguna / Pelanggan
        </h4>
        <p class="text-muted small mb-0">Informasi akun pengguna yang terdaftar untuk berbelanja di BookStore.</p>
    </div>
    <div class="small fw-semibold px-3 py-2 rounded-pill" style="background-color: var(--forest-sand); color: var(--forest-primary);">
        Total Pelanggan: <strong>{{ $users->total() }}</strong> pengguna
    </div>
</div>

<!-- Users Table Card -->
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-3" style="width: 60px;">#</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nomor Telepon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col" class="text-center">Role</th>
                        <th scope="col">Bergabung Sejak</th>
                        <th scope="col" class="text-end pe-3" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="ps-3 text-secondary fw-semibold">
                                {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="d-inline-flex align-items-center justify-content-center text-white rounded-circle fw-bold" style="width: 34px; height: 34px; font-size: 0.85rem; background-color: var(--forest-primary);">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                    <span class="fw-bold text-dark">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none text-muted">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $user->phone ?: '-' }}</span>
                            </td>
                            <td>
                                <span class="text-muted small">{{ Str::limit($user->address ?: 'Belum diisi', 35) }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge px-3 py-2 rounded-pill fw-semibold text-uppercase" style="background-color: rgba(22, 51, 38, 0.1); color: var(--forest-primary);">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="text-muted small">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="text-end pe-3">
                                <!-- Trigger Modal Detail User -->
                                <button type="button" 
                                        class="btn btn-sm btn-outline-forest" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalUserDetail{{ $user->id }}"
                                        title="Lihat Profil Pelanggan">
                                    <i class="bi bi-person-lines-fill me-1"></i>Profil
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Detail Pelanggan -->
                        <div class="modal fade" id="modalUserDetail{{ $user->id }}" tabindex="-1" aria-labelledby="modalUserLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header" style="background-color: var(--forest-sand);">
                                        <h6 class="modal-title fw-bold font-serif" style="color: var(--forest-primary);" id="modalUserLabel{{ $user->id }}">
                                            <i class="bi bi-person-badge me-2" style="color: var(--forest-accent);"></i>Informasi Akun Pelanggan
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="text-center mb-4">
                                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center text-white mb-2" style="width: 60px; height: 60px; background-color: var(--forest-primary); font-size: 1.5rem; font-weight: 700; border: 2px solid var(--forest-accent);">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <h5 class="fw-bold mb-0 font-serif" style="color: var(--forest-primary);">{{ $user->name }}</h5>
                                            <span class="text-muted small">{{ $user->email }}</span>
                                        </div>

                                        <dl class="row small mb-0">
                                            <dt class="col-4 text-muted">No. Telepon:</dt>
                                            <dd class="col-8 fw-semibold text-dark">{{ $user->phone ?: 'Belum dicantumkan' }}</dd>

                                            <dt class="col-4 text-muted">Alamat Utama:</dt>
                                            <dd class="col-8 text-dark">{{ $user->address ?: 'Belum dicantumkan' }}</dd>

                                            <dt class="col-4 text-muted">Role Akses:</dt>
                                            <dd class="col-8">
                                                <span class="badge text-uppercase" style="background-color: var(--forest-accent);">{{ $user->role }}</span>
                                            </dd>

                                            <dt class="col-4 text-muted">Tanggal Daftar:</dt>
                                            <dd class="col-8 text-dark">{{ $user->created_at->format('d F Y, H:i') }} WIB</dd>

                                            <dt class="col-4 text-muted">Total Belanja:</dt>
                                            <dd class="col-8">
                                                <span class="badge fw-bold px-2 py-1 text-white" style="background-color: var(--forest-primary);">
                                                    {{ $user->orders()->count() }} Kali Pemesanan
                                                </span>
                                            </dd>
                                        </dl>
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
                                <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                                Belum ada pelanggan yang mendaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
        <div class="card-footer bg-white py-3 border-top">
            <div class="d-flex justify-content-center mb-0">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection
