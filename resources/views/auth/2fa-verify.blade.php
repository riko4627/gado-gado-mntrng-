<!DOCTYPE html>
<html>

<head>
    <title>Verifikasi 2FA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Verifikasi 2FA</h3>

                        @if (session('info'))
                            <div class="alert alert-info">{{ session('info') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('2fa.verify.post') }}"> @csrf
                            <div class="mb-4">
                                <label class="form-label">Kode 2FA (6 digit)</label>
                                <input type="text" name="otp"
                                    class="form-control form-control-lg @error('otp') is-invalid @enderror"
                                    maxlength="6" autocomplete="one-time-code" required placeholder="123456"
                                    value="{{ old('otp') }}">
                                @error('otp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 text-center">
                                <p class="text-muted small">
                                    Masukkan kode dari aplikasi Authenticator Anda<br>
                                    <strong>Buka aplikasi → scan QR → masukkan kode 6 digit</strong>
                                </p>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3">
                                Verifikasi
                            </button>
                        </form>

                        <hr class="my-4">
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none">← Kembali ke Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
