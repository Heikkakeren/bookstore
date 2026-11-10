@extends('layouts.app')

@section('title', 'Tentang Toko Buku BookStore')

@section('content')
<!-- Header Banner -->
<section class="py-5 text-white" style="background-color: var(--forest-primary); background-image: radial-gradient(circle at 80% 50%, rgba(36, 82, 62, 0.4) 0%, transparent 60%);">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-2" style="color: #d8aa7a; font-size: 0.8rem; letter-spacing: 2px;">
                    <span>🌿</span>
                    <span class="text-uppercase fw-bold">PROFIL & DEDIKASI KAMI</span>
                </div>
                <h1 class="font-serif display-5 fw-bold mb-3">Membangun Budaya Membaca dan Menginspirasi Kehidupan</h1>
                <p class="lead small text-light text-opacity-75 mb-0" style="max-width: 600px;">
                    Koleksi kurasi bacaan berkualitas untuk memperkaya wawasan serta menemani setiap perjalanan hidup Anda.
                </p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div class="circular-seal mx-auto" style="width: 120px; height: 120px;">
                    <i class="bi bi-book-half fs-3 mb-1"></i>
                    <span class="fw-bold">BookStore</span>
                    <span>Est. 2026</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-5">
    <div class="container">
        <!-- Story & Vision -->
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <div class="pe-lg-4">
                    <span class="text-uppercase small fw-bold" style="color: var(--forest-accent); letter-spacing: 2px;">Mengenal Lebih Dekat</span>
                    <h2 class="font-serif fw-bold text-dark mt-2 mb-4">Dedikasi untuk Kemajuan Literasi dan Pendidikan</h2>
                    <p class="text-secondary leading-relaxed mb-3">
                        <strong>BookStore</strong> didirikan dengan semangat untuk mempermudah akses buku-buku bermakna bagi pelajar, akademisi, profesional, serta pencinta literatur di seluruh Indonesia. 
                    </p>
                    <p class="text-secondary leading-relaxed mb-4">
                        Kami bekerja sama langsung dengan puluhan penerbit terkemuka nasional maupun internasional guna memastikan setiap buku yang sampai ke tangan pembaca adalah 100% karya orisinal, berkualitas cetak prima, dan berharga bersahabat.
                    </p>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm border" style="border-color: var(--forest-border) !important;">
                                <h4 class="font-serif fw-bold mb-1" style="color: var(--forest-primary);">5.000+</h4>
                                <span class="text-muted small">Judul Buku Terkurasi</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm border" style="border-color: var(--forest-border) !important;">
                                <h4 class="font-serif fw-bold mb-1" style="color: var(--forest-accent);">10.000+</h4>
                                <span class="text-muted small">Pembaca Puas di Seluruh RI</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3 p-4 border-start border-4" style="border-left-color: var(--forest-primary) !important; background: #ffffff;">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <span class="p-2 rounded-2" style="background-color: var(--forest-sand); color: var(--forest-primary);">
                                    <i class="bi bi-eye fs-4"></i>
                                </span>
                                <h5 class="font-serif fw-bold mb-0 text-dark">Visi Utama Kami</h5>
                            </div>
                            <p class="text-secondary small mb-0 leading-relaxed">
                                Menjadi platform toko buku digital paling terpercaya dan inklusif di Indonesia yang mendorong kecerdasan bangsa melalui akses literatur yang mudah, cepat, dan terjangkau.
                            </p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-3 p-4 border-start border-4" style="border-left-color: var(--forest-accent) !important; background: #ffffff;">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <span class="p-2 rounded-2" style="background-color: var(--forest-sand); color: var(--forest-accent);">
                                    <i class="bi bi-bullseye fs-4"></i>
                                </span>
                                <h5 class="font-serif fw-bold mb-0 text-dark">Misi Perusahaan</h5>
                            </div>
                            <ul class="text-secondary small mb-0 ps-3 d-flex flex-column gap-1 leading-relaxed">
                                <li>Menyediakan kurasi buku terlengkap dari berbagai genre berkualitas tinggi.</li>
                                <li>Menghadirkan pengalaman belanja online yang aman dan praktis via pembayaran QRIS, GoPay, dan Transfer Bank.</li>
                                <li>Mendukung penerbit dan penulis lokal untuk memperluas jangkauan karya mereka.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nilai Inti / Values -->
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 p-4 text-center h-100 bg-white" style="border: 1px solid var(--forest-border) !important;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mx-auto mb-3" style="width: 55px; height: 55px; background: var(--forest-sand); color: var(--forest-primary);">
                        <i class="bi bi-shield-check fs-3"></i>
                    </div>
                    <h5 class="font-serif fw-bold text-dark mb-2">100% Keaslian Terjamin</h5>
                    <p class="text-secondary small mb-0">
                        Kami hanya menjual buku original langsung dari penerbit resmi dengan standar kualitas cetak terbaik.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 p-4 text-center h-100 bg-white" style="border: 1px solid var(--forest-border) !important;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mx-auto mb-3" style="width: 55px; height: 55px; background: var(--forest-sand); color: var(--forest-accent);">
                        <i class="bi bi-box-seam fs-3"></i>
                    </div>
                    <h5 class="font-serif fw-bold text-dark mb-2">Pengemasan Aman & Rapi</h5>
                    <p class="text-secondary small mb-0">
                        Setiap pesanan buku dikemas dengan perlindungan maksimal agar tiba dalam kondisi sempurna di tangan Anda.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 p-4 text-center h-100 bg-white" style="border: 1px solid var(--forest-border) !important;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mx-auto mb-3" style="width: 55px; height: 55px; background: var(--forest-sand); color: var(--forest-primary);">
                        <i class="bi bi-qr-code-scan fs-3"></i>
                    </div>
                    <h5 class="font-serif fw-bold text-dark mb-2">QRIS & Bayar Digital</h5>
                    <p class="text-secondary small mb-0">
                        Belanja dengan praktis dan modern menggunakan opsi pembayaran instan seperti QRIS, GoPay, atau Transfer Bank.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
