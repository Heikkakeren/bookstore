@extends('layouts.admin')

@section('title', 'Detail Buku - ' . $book->title)
@section('page-title', 'Detail Data Buku')

@section('content')
<div class="mb-4 d-flex align-items-center justify-content-between">
    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Buku
    </a>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning btn-sm fw-semibold">
            <i class="bi bi-pencil-square me-1"></i>Edit Buku Ini
        </a>
        <form method="POST" action="{{ route('admin.books.destroy', $book) }}" 
              class="d-inline"
              onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ $book->title }}\'?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm fw-semibold">
                <i class="bi bi-trash3 me-1"></i>Hapus
            </button>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-4 p-md-5">
        <div class="row g-4 align-items-start">
            <div class="col-md-4 text-center">
                <div class="border rounded-3 p-2 bg-light shadow-sm d-inline-block">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" 
                             alt="{{ $book->title }}" 
                             class="img-fluid rounded object-fit-cover shadow-sm" 
                             style="max-height: 380px;">
                    @else
                        <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center text-muted" style="width: 250px; height: 320px;">
                            <i class="bi bi-book display-1 opacity-25 mb-2"></i>
                            <span class="small">Cover Tidak Tersedia</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-8">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2">
                    {{ $book->category->name }}
                </span>
                <h3 class="fw-extrabold text-dark mb-2">{{ $book->title }}</h3>

                <div class="row g-3 py-3 border-top border-bottom my-3 small text-secondary">
                    <div class="col-sm-6">
                        <span class="text-muted d-block">Penulis:</span>
                        <strong class="text-dark fs-6">{{ $book->author }}</strong>
                    </div>
                    <div class="col-sm-6">
                        <span class="text-muted d-block">Penerbit:</span>
                        <strong class="text-dark fs-6">{{ $book->publisher }}</strong>
                    </div>
                    <div class="col-sm-6">
                        <span class="text-muted d-block">Harga Jual:</span>
                        <strong class="text-success fs-5">Rp {{ number_format($book->price, 0, ',', '.') }}</strong>
                    </div>
                    <div class="col-sm-6">
                        <span class="text-muted d-block">Stok Tersedia:</span>
                        @php
                            $bookStock = $book->stock?->quantity ?? 0;
                        @endphp
                        @if($bookStock <= 0)
                            <span class="badge bg-danger fs-6">0 Pcs (Habis)</span>
                        @else
                            <span class="badge bg-success fs-6">{{ $bookStock }} Pcs</span>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold text-dark mb-2">Sinopsis / Ringkasan Buku:</h6>
                    <p class="text-secondary small leading-relaxed">
                        {{ $book->description ?: 'Belum ada deskripsi yang ditambahkan untuk buku ini.' }}
                    </p>
                </div>

                <div class="p-3 bg-light rounded-3 small text-muted">
                    <i class="bi bi-info-circle me-1"></i>Data buku ini terdaftar pada sistem sejak {{ $book->created_at->format('d F Y, H:i') }} WIB dan terakhir diperbarui pada {{ $book->updated_at->format('d F Y, H:i') }} WIB.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
