@extends('layouts.admin')

@section('title', 'Manajemen Data Buku')
@section('page-title', 'Katalog Data Buku')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 font-serif" style="color: var(--forest-primary); font-size: 1.4rem;">
            <i class="bi bi-book me-2" style="color: var(--forest-accent);"></i>Master Data Buku
        </h4>
        <p class="text-muted small mb-0">Kelola inventaris seluruh judul buku, penetapan harga, stok fisik, dan upload cover.</p>
    </div>
    <a href="{{ route('admin.books.create') }}" class="btn btn-forest fw-semibold shadow-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Buku Baru
    </a>
</div>

<!-- Table Card -->
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-3" style="width: 60px;">#</th>
                        <th scope="col" style="width: 80px;">Cover</th>
                        <th scope="col">Judul Buku & Penulis</th>
                        <th scope="col">Kategori</th>
                        <th scope="col" class="text-end">Harga Satuan</th>
                        <th scope="col" class="text-center">Stok</th>
                        <th scope="col" class="text-end pe-3" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td class="ps-3 text-secondary fw-semibold">
                                {{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}
                            </td>
                            <td>
                                <div class="rounded border overflow-hidden shadow-sm" style="width: 52px; height: 72px; border-color: var(--forest-border) !important; background-color: #f7f5f0;">
                                    @if($book->cover_image)
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                             alt="{{ $book->title }}" 
                                             class="w-100 h-100 object-fit-cover">
                                    @else
                                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                            <i class="bi bi-book fs-4 opacity-50"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark fs-6 mb-1">{{ $book->title }}</div>
                                <div class="text-muted small">
                                    <i class="bi bi-person me-1"></i>{{ $book->author }} &bull; <span class="text-secondary">{{ $book->publisher }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge px-3 py-2 rounded-pill fw-semibold border" style="background-color: rgba(194, 139, 87, 0.12); color: #8c5b2a; border-color: rgba(194, 139, 87, 0.3) !important;">
                                    {{ $book->category->name }}
                                </span>
                            </td>
                            <td class="text-end fw-bold" style="color: var(--forest-primary);">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                @php
                                    $bookStock = $book->stock?->quantity ?? 0;
                                @endphp
                                @if($bookStock <= 0)
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">0 (Habis)</span>
                                @elseif($bookStock <= 10)
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">{{ $bookStock }} Pcs</span>
                                @else
                                    <span class="badge px-3 py-2 rounded-pill text-white fw-semibold" style="background-color: var(--forest-primary);">{{ $bookStock }} Pcs</span>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.books.show', $book) }}" class="btn btn-outline-forest" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-outline-warning" title="Edit Buku">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.books.destroy', $book) }}" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ $book->title }}\'? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus Buku">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-book fs-1 d-block mb-2 opacity-50"></i>
                                Belum ada data buku yang terdaftar di sistem.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($books->hasPages())
        <div class="card-footer bg-white py-3 border-top">
            <div class="d-flex justify-content-center mb-0">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection
