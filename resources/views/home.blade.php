<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | {{ optional($appSettings)->org_name ?? 'Mudacita' }}</title>

    @php
        $faviconPath = optional($appSettings)->org_favicon_path;
    @endphp
    <link rel="shortcut icon" href="{{ $faviconPath ? asset($faviconPath) : asset('assets/images/logomci3.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
</head>

<body class="bg-light">
@php
    $logoPath = optional($appSettings)->org_logo_path;
    $heroImage = optional($appSettings)->hero_image_path;
    $logoUrl = $logoPath
        ? (str_starts_with($logoPath, 'assets/') ? asset($logoPath) : asset('storage/' . $logoPath))
        : asset('assets/images/logomci2.png');
    $heroUrl = $heroImage
        ? (str_starts_with($heroImage, 'assets/') ? asset($heroImage) : asset('storage/' . $heroImage))
        : asset('assets/images/banner/muda-cita.jpeg');
    $heroTitle = optional($appSettings)->hero_title ?? 'Inspirasi Muda, Cita Untuk Indonesia';
    $heroSubtitle = optional($appSettings)->hero_subtitle ?? 'Ayo Bersama Untuk Indonesia';
    $heroDescription = optional($appSettings)->hero_description
        ?? 'Muda Cita Indonesia hadir untuk menciptakan perubahan nyata melalui kolaborasi dan aksi bersama. Mari wujudkan masa depan yang lebih baik untuk generasi muda Indonesia.';
@endphp

<main class="py-5" style="background: #0f5e7a;">
    <div class="container">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-4 p-lg-5">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <img src="{{ $logoUrl }}"
                             alt="{{ optional($appSettings)->org_name ?? 'Mudacita' }}"
                             class="img-fluid"
                             style="max-height: 56px;">
                        <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm px-3">
                            Login Admin
                        </a>
                    </div>
                </div>

                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <h1 class="fw-bold display-5 mb-3 text-dark">
                            {{ $heroTitle }}
                        </h1>
                        <h5 class="text-danger fw-bold mb-3">{{ $heroSubtitle }}</h5>
                        <p class="text-muted mb-4">{{ $heroDescription }}</p>

                        <div class="d-grid d-md-flex gap-3">
                            <a href="{{ route('public.recruitment.management.create') }}" class="btn btn-danger btn-lg px-4 w-100 w-md-auto">
                                Daftar Management
                            </a>
                            <a href="{{ route('public.recruitment.volunteer.create') }}" class="btn btn-primary btn-lg px-4 w-100 w-md-auto">
                                Daftar Volunteer
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="rounded-4 overflow-hidden shadow-sm">
                            <img src="{{ $heroUrl }}"
                                 alt="Hero"
                                 class="img-fluid w-100"
                                 style="object-fit: cover; min-height: 280px;">
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6">
                        <div class="text-muted small">Email</div>
                        <div class="fw-semibold">{{ optional($appSettings)->org_email ?? '-' }}</div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="text-muted small">HP</div>
                        <div class="fw-semibold">{{ optional($appSettings)->org_phone ?? '-' }}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-muted small">Alamat</div>
                        <div class="fw-semibold">{{ optional($appSettings)->org_address ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="text-center text-muted py-4 small">
    {{ optional($appSettings)->org_name ?? 'Mudacita' }} &copy; {{ date('Y') }}
</footer>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
