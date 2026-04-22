<!DOCTYPE html>
<html>

<head>
    <title>Setup 2FA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Setup Autentikasi 2 Faktor</h3>

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 text-center mb-4">
                                <h6>1. Scan QR Code</h6>
                                <div class="border rounded p-3 bg-white shadow-sm">
                                    {!! QrCode::size(200)->generate($data['qr_url']) !!}
                                </div>

                                <div class="mt-3">
                                    <p class="small text-muted mb-1"><strong>Secret:</strong> <code
                                            class="bg-light px-2 py-1 rounded">{{ $data['secret'] }}</code></p>
                                    <p class="small text-muted mb-0">Scan dengan Google Authenticator, Authy, atau app
                                        TOTP lainnya</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">2. Verifikasi Kode</h6>
                                <form method="POST" action="{{ route('2fa.enable') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Kode dari App (6 digit)</label>
                                        <input type="text" name="otp"
                                            class="form-control form-control-lg @error('otp') is-invalid @enderror"
                                            maxlength="6" autocomplete="one-time-code" required placeholder="123456"
                                            value="{{ old('otp') }}">
                                        @error('otp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <p class="text-muted small mb-3">Buka app → scan QR → masukkan kode 6 digit yang
                                        muncul (input dalam 30 detik).</p>
                                    <button type="submit" class="btn btn-success w-100 py-3">✅ Aktifkan 2FA</button>
                                </form>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <a href="/admin" class="btn btn-outline-secondary">← Kembali Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
