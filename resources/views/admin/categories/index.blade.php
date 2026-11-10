@extends('layouts.admin')

@section('title', 'Manajemen Kategori Buku')
@section('page-title', 'Kategori Buku')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 font-serif" style="color: var(--forest-primary); font-size: 1.4rem;">
            <i class="bi bi-tags me-2" style="color: var(--forest-accent);"></i>Daftar Kategori Buku
        </h4>
        <p class="text-muted small mb-0">Kelola kelompok kategori buku untuk pengelompokan produk di katalog toko.</p>
    </div>
    <!-- Button Trigger Modal Tambah -->
    <button type="button" class="btn btn-forest fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAddCategory">
        <i class="bi bi-plus-lg me-1"></i>Tambah Kategori Baru
    </button>
</div>

<!-- Table Card -->
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-3" style="width: 70px;">#</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Slug URL</th>
                        <th scope="col" class="text-center">Jumlah Buku</th>
                        <th scope="col">Tanggal Dibuat</th>
                        <th scope="col" class="text-end pe-3" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="ps-3 text-secondary fw-semibold">
                                {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $category->name }}</span>
                            </td>
                            <td>
                                <code class="px-2 py-1 rounded" style="background-color: rgba(22, 51, 38, 0.08); color: var(--forest-primary);">{{ $category->slug }}</code>
                            </td>
                            <td class="text-center">
                                <span class="badge px-3 py-2 rounded-pill fw-semibold" style="background-color: rgba(194, 139, 87, 0.15); color: #8c5b2a;">
                                    {{ $category->books_count }} Judul Buku
                                </span>
                            </td>
                            <td class="text-muted small">
                                {{ $category->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <!-- Edit Trigger Button (Opens Modal) -->
                                    <button type="button" 
                                            class="btn btn-outline-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEditCategory{{ $category->id }}"
                                            title="Edit Kategori">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori \'{{ $category->name }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus Kategori">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Kategori for this Item -->
                        <div class="modal fade" id="modalEditCategory{{ $category->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $category->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header" style="background-color: var(--forest-sand);">
                                            <h6 class="modal-title fw-bold text-dark font-serif" id="modalEditLabel{{ $category->id }}">
                                                <i class="bi bi-pencil-square text-warning me-2"></i>Edit Kategori Buku
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label for="name{{ $category->id }}" class="form-label small fw-bold text-secondary">
                                                    Nama Kategori <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       name="name" 
                                                       id="name{{ $category->id }}" 
                                                       class="form-control" 
                                                       value="{{ old('name', $category->name) }}" 
                                                       required>
                                                <div class="form-text small text-muted">Slug URL akan diperbarui otomatis berdasarkan nama kategori ini.</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light py-2">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-sm btn-forest">
                                                <i class="bi bi-save me-1"></i>Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-tags fs-1 d-block mb-2 opacity-50"></i>
                                Belum ada kategori buku yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($categories->hasPages())
        <div class="card-footer bg-white py-3 border-top">
            <div class="d-flex justify-content-center mb-0">
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modalAddCategory" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="modal-header" style="background-color: var(--forest-sand);">
                    <h6 class="modal-title fw-bold font-serif" style="color: var(--forest-primary);" id="modalAddLabel">
                        <i class="bi bi-plus-circle me-2" style="color: var(--forest-accent);"></i>Tambah Kategori Buku Baru
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="name_new" class="form-label small fw-bold text-secondary">
                            Nama Kategori <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name_new" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Contoh: Pemrograman & Komputer" 
                               value="{{ old('name') }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-text small text-muted">Nama kategori harus unik dan belum pernah didaftarkan sebelumnya.</div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-forest">
                        <i class="bi bi-check-lg me-1"></i>Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
