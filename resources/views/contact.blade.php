@extends('layouts.app')

@section('title', 'Hubungi Kami - Layanan Pelanggan')

@section('content')
<!-- Header Banner -->
<section class="py-5 text-white" style="background-color: var(--forest-primary); background-image: radial-gradient(circle at 80% 50%, rgba(36, 82, 62, 0.4) 0%, transparent 60%);">
    <div class="container py-2">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-2" style="color: #d8aa7a; font-size: 0.8rem; letter-spacing: 2px;">
                    <span>🌿</span>
                    <span class="text-uppercase fw-bold">LAYANAN BANTUAN & MASUKAN</span>
                </div>
                <h1 class="font-serif display-5 fw-bold mb-2">Hubungi Tim BookStore</h1>
                <p class="lead small text-light text-opacity-75 mb-0" style="max-width: 600px;">
                    Kami siap mendengarkan pertanyaan, masukan pembaca, maupun permohonan kerjasama dari Anda.
                </p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="bi bi-envelope-paper fs-1 text-warning opacity-75"></i>
            </div>
        </div>
    </div>
</section>

<!-- Form & Info Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Left Column: Contact Cards -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-3 p-4 h-100 bg-white" style="border: 1px solid var(--forest-border) !important;">
                    <h5 class="font-serif fw-bold text-dark mb-1">Informasi Kantor & Dukungan</h5>
                    <p class="text-muted small mb-4">Silakan kunjungi toko buku kami atau hubungi kanal resmi berikut:</p>

                    <div class="d-flex flex-column gap-4">
                        <!-- Address -->
                        <div class="d-flex align-items-start gap-3">
                            <span class="p-3 rounded-circle flex-shrink-0" style="background-color: var(--forest-sand); color: var(--forest-primary);">
                                <i class="bi bi-geo-alt fs-4"></i>
                            </span>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Alamat Utama</h6>
                                <p class="text-muted small mb-0">
                                    Jl. Buku Mandiri No. 45, Kompleks Pendidikan, Jakarta Pusat, DKI Jakarta 10110
                                </p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="d-flex align-items-start gap-3">
                            <span class="p-3 rounded-circle flex-shrink-0" style="background-color: var(--forest-sand); color: var(--forest-accent);">
                                <i class="bi bi-telephone fs-4"></i>
                            </span>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Telepon & WhatsApp</h6>
                                <p class="text-muted small mb-0">
                                    (021) 555-8901 / 0812-3456-7890 (Customer Care)
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="d-flex align-items-start gap-3">
                            <span class="p-3 rounded-circle flex-shrink-0" style="background-color: var(--forest-sand); color: var(--forest-primary);">
                                <i class="bi bi-envelope fs-4"></i>
                            </span>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Email Resmi</h6>
                                <p class="text-muted small mb-0">
                                    kontak@bookstore.test &bull; hello@bookstore.test
                                </p>
                            </div>
                        </div>

                        <!-- Operating Hours -->
                        <div class="d-flex align-items-start gap-3">
                            <span class="p-3 rounded-circle flex-shrink-0" style="background-color: var(--forest-sand); color: var(--forest-dark);">
                                <i class="bi bi-clock fs-4"></i>
                            </span>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Jam Operasional</h6>
                                <p class="text-muted small mb-0">
                                    Senin – Sabtu: 08.00 – 17.00 WIB (Minggu & Libur Tutup)
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top p-3 rounded-2 small text-muted" style="background-color: var(--forest-sand);">
                        <i class="bi bi-shield-check text-success me-1"></i>
                        Pesan Anda langsung tersimpan di basis data dan ditampilkan di <strong>Dashboard Admin</strong> untuk ditindaklanjuti.
                    </div>
                </div>
            </div>

            <!-- Right Column: Contact Form -->
            <div class="col-lg-7">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <!-- Administrator Notice Card (Mencegah Admin Mengirim Pesan ke Diri Sendiri) -->
                    <div class="card border-0 shadow-sm rounded-3 p-4 p-md-5 bg-white text-center h-100 d-flex flex-column justify-content-center" style="border: 1px solid var(--forest-border) !important;">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle mb-3 mx-auto" style="width: 76px; height: 76px; background-color: rgba(194, 139, 87, 0.15); color: var(--forest-accent);">
                            <i class="bi bi-shield-lock-fill fs-1"></i>
                        </div>
                        <h4 class="font-serif fw-bold mb-2" style="color: var(--forest-primary);">Akses Administrator Terdeteksi</h4>
                        <p class="text-muted small mb-4 mx-auto" style="max-width: 480px; line-height: 1.6;">
                            Anda saat ini masuk sebagai <strong>Administrator</strong>. Formulir kontak ini diperuntukkan bagi pelanggan dan pengunjung publik untuk mengirim pesan kepada pengelola toko.
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ route('admin.messages.index') }}" class="btn btn-forest px-4 py-2 fw-semibold">
                                <i class="bi bi-chat-left-text me-1"></i>Buka Kotak Pesan Masuk Admin
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-forest px-4 py-2 fw-semibold">
                                <i class="bi bi-grid-1x2 me-1"></i>Dashboard Admin
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Customer / Guest Contact Form -->
                    <div class="card border-0 shadow-sm rounded-3 p-4 p-md-5 bg-white" style="border: 1px solid var(--forest-border) !important;">
                        <h4 class="font-serif fw-bold text-dark mb-1">Kirimkan Pesan Anda</h4>
                        <p class="text-muted small mb-4">Isi formulir di bawah ini dan tim BookStore akan merespons melalui email secepatnya.</p>

                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label small fw-bold text-secondary">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                        <input type="text" 
                                               name="name" 
                                               id="name"
                                               class="form-control bg-white border-start-0 @error('name') is-invalid @enderror" 
                                               placeholder="Nama lengkap Anda" 
                                               value="{{ old('name', auth()->user()?->name) }}" 
                                               required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger small mt-1">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label small fw-bold text-secondary">
                                        Alamat Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                        <input type="email" 
                                               name="email" 
                                               id="email"
                                               class="form-control bg-white border-start-0 @error('email') is-invalid @enderror" 
                                               placeholder="nama@email.com" 
                                               value="{{ old('email', auth()->user()?->email) }}" 
                                               required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <label for="message" class="form-label small fw-bold text-secondary">
                                        Isi Pesan / Pertanyaan <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="message" 
                                              id="message"
                                              rows="5" 
                                              class="form-control bg-white @error('message') is-invalid @enderror" 
                                              placeholder="Tuliskan pertanyaan, aduan, atau permintaan buku Anda..." 
                                              required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="text-danger small mt-1">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 pt-2">
                                    <button type="submit" class="btn btn-forest px-4 py-2 fw-semibold w-100 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-send"></i>Kirimkan Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
