<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pendaftaran Berhasil</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
</head>

<body class="bg-light">
@php
    $logoPath = optional($appSettings)->org_logo_path;
    $logoUrl = $logoPath
        ? (str_starts_with($logoPath, 'assets/') ? asset($logoPath) : asset('storage/' . $logoPath))
        : asset('assets/images/logomci2.png');
@endphp

<main class="py-5" style="background: #0f5e7a;">
    <div class="container">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-4 p-lg-5">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <img src="{{ $logoUrl }}"
                         alt="{{ optional($appSettings)->org_name ?? 'Mudacita' }}"
                         class="img-fluid"
                         style="max-height: 56px;">
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center p-5">
                                <div class="avatar-text avatar-xxl bg-soft-success text-success mx-auto mb-4">
                                    <i class="feather-check"></i>
                                </div>
                                <h3 class="mb-2">Pendaftaran berhasil</h3>
                                <p class="text-muted mb-4">
                                    Pendaftaran {{ request('type') === 'volunteer' ? 'Volunteer' : 'Management' }} sudah kami terima.
                                    Tim kami akan meninjau dan menghubungi Anda.
                                </p>
                                <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
