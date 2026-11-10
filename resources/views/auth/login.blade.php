<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookStore</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f3460 0%, #1a1a2e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-card { border-radius: 1rem; overflow: hidden; }
        .auth-left {
            background: linear-gradient(135deg, #e94560 0%, #0f3460 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 2rem;
            min-height: 400px;
        }
        .auth-left h2 { font-weight: 800; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            <div class="card auth-card shadow-lg">
                <div class="row g-0">
                    <div class="col-md-5 auth-left d-none d-md-flex">
                        <i class="bi bi-book-half" style="font-size: 4rem; opacity: 0.8;"></i>
                        <h2 class="mt-3">BookStore</h2>
                        <p class="text-center opacity-75">Toko Buku Online Terpercaya</p>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold mb-1">Selamat Datang!</h4>
                            <p class="text-muted small mb-4">Masuk ke akun Anda untuk melanjutkan.</p>

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show py-2">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    {{ $errors->first() }}
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="email@contoh.com" required autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="loginPassword">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password" id="loginPassword" class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Masukkan password" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="loginPassword" title="Lihat/Sembunyikan Password" tabindex="-1">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                    <label class="form-check-label small" for="remember">Ingat saya</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                                </button>
                            </form>
                            <hr>
                            <p class="text-center small mb-0">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">Daftar di sini</a>
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
