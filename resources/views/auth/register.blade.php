<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - BookStore</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f3460 0%, #1a1a2e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }
        .auth-left {
            background: linear-gradient(135deg, #e94560 0%, #0f3460 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 2rem;
            border-radius: 1rem 0 0 1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg" style="border-radius: 1rem; overflow: hidden;">
                <div class="row g-0">
                    <div class="col-md-4 auth-left d-none d-md-flex">
                        <i class="bi bi-person-plus" style="font-size: 4rem; opacity: 0.8;"></i>
                        <h3 class="mt-3 fw-bold">Bergabung!</h3>
                        <p class="text-center opacity-75 small">Daftarkan diri Anda dan nikmati ribuan pilihan buku.</p>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold mb-1">Buat Akun Baru</h4>
                            <p class="text-muted small mb-4">Isi data berikut untuk mendaftar.</p>

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show py-2">
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li class="small">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold" for="regPassword">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="regPassword" class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="Min. 8 karakter" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="regPassword" title="Lihat/Sembunyikan Password" tabindex="-1">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold" for="regPasswordConfirm">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" id="regPasswordConfirm" class="form-control"
                                                   placeholder="Ulangi password" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="regPasswordConfirm" title="Lihat/Sembunyikan Password" tabindex="-1">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Nomor Telepon</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone') }}" placeholder="Contoh: 08123456789">
                                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Alamat</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                                  rows="1" placeholder="Alamat lengkap Anda">{{ old('address') }}</textarea>
                                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                    <i class="bi bi-person-check me-2"></i>Daftar Sekarang
                                </button>
                            </form>
                            <hr>
                            <p class="text-center small mb-0">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">Masuk di sini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                targetInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });
</script>
</body>
</html>
