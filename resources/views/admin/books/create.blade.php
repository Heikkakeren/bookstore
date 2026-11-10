@extends('layouts.admin')

@section('title', 'Tambah Buku Baru')
@section('page-title', 'Tambah Data Buku')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Buku
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="bi bi-journal-plus text-primary me-2"></i>Formulir Tambah Buku Baru
        </h5>
    </div>
    <div class="card-body p-4 p-md-5">
        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Left Column: Book Details -->
                <div class="col-lg-8">
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label small fw-bold text-secondary">
                            Judul Buku <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               placeholder="Contoh: Pemrograman Laravel 11 untuk Pemula" 
                               value="{{ old('title') }}" 
                               required>
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Author -->
                        <div class="col-md-6">
                            <label for="author" class="form-label small fw-bold text-secondary">
                                Nama Penulis <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="author" 
                                   id="author" 
                                   class="form-control @error('author') is-invalid @enderror" 
                                   placeholder="Contoh: Budi Raharjo" 
                                   value="{{ old('author') }}" 
                                   required>
                            @error('author')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Publisher -->
                        <div class="col-md-6">
                            <label for="publisher" class="form-label small fw-bold text-secondary">
                                Nama Penerbit <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="publisher" 
                                   id="publisher" 
                                   class="form-control @error('publisher') is-invalid @enderror" 
                                   placeholder="Contoh: Informatika Bandung" 
                                   value="{{ old('publisher') }}" 
                                   required>
                            @error('publisher')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Category -->
                        <div class="col-md-4">
                            <label for="category_id" class="form-label small fw-bold text-secondary">
                                Kategori Buku <span class="text-danger">*</span>
                            </label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="col-md-4">
                            <label for="price" class="form-label small fw-bold text-secondary">
                                Harga Satuan (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">Rp</span>
                                <input type="number" 
                                       name="price" 
                                       id="price" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       placeholder="125000" 
                                       min="0"
                                       step="1000"
                                       value="{{ old('price') }}" 
                                       required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div class="col-md-4">
                            <label for="stock" class="form-label small fw-bold text-secondary">
                                Jumlah Stok Fisik <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   name="stock" 
                                   id="stock" 
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   placeholder="50" 
                                   min="0" 
                                   value="{{ old('stock', 10) }}" 
                                   required>
                            @error('stock')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label small fw-bold text-secondary">
                            Deskripsi / Sinopsis Buku
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  placeholder="Tuliskan sinopsis, topik bahasan, atau keunggulan isi buku secara jelas...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Right Column: Cover Image Upload -->
                <div class="col-lg-4">
                    <div class="card border rounded-3 p-3 bg-light">
                        <label class="form-label small fw-bold text-secondary mb-2">
                            Unggah Cover Gambar Buku
                        </label>
                        
                        <!-- Image Preview Box -->
                        <div class="border rounded-3 p-2 bg-white text-center mb-3 d-flex flex-column align-items-center justify-content-center overflow-hidden" 
                             style="min-height: 260px;">
                            <img id="coverPreview" src="#" alt="Preview Cover" class="img-fluid rounded d-none" style="max-height: 250px; object-fit: contain;">
                            <div id="coverPlaceholder" class="text-muted py-5">
                                <i class="bi bi-cloud-arrow-up display-3 opacity-50 d-block mb-2"></i>
                                <span class="small d-block fw-semibold">Pratinjau Cover Buku</span>
                                <span class="text-secondary small">Pilih file gambar untuk melihat preview</span>
                            </div>
                        </div>

                        <input type="file" 
                               name="cover_image" 
                               id="cover_image" 
                               class="form-control @error('cover_image') is-invalid @enderror" 
                               accept="image/jpeg,image/png,image/jpg,image/webp">
                        <div class="form-text small text-muted mt-1">
                            Format didukung: JPG, PNG, WEBP. Maksimal ukuran file: 2 MB.
                        </div>
                        @error('cover_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Form Action Buttons -->
                <div class="col-12 pt-3 border-top d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4 fw-semibold shadow-sm">
                        <i class="bi bi-save me-1"></i>Simpan Data Buku
                    </button>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary px-4 fw-semibold">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const coverInput = document.getElementById('cover_image');
    const coverPreview = document.getElementById('coverPreview');
    const coverPlaceholder = document.getElementById('coverPlaceholder');

    if (coverInput) {
        coverInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    coverPreview.src = event.target.result;
                    coverPreview.classList.remove('d-none');
                    coverPlaceholder.classList.add('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endpush
