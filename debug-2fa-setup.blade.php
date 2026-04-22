@php
    dd([
        'data' => $data ?? 'NO DATA PASSED',
        'data_keys' => $data ? array_keys($data) : [],
        'data_secret' => $data['secret'] ?? 'NO SECRET',
        'data_qr' => $data['qr'] ?? 'NO QR',
        'user' => Auth::user(),
        'session_2fa_secret' => session('2fa_secret'),
    ]);
@endphp
