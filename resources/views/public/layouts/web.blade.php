<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ optional($appSettings)->org_name ?? 'Muda Cita Indonesia' }}</title>

    @php
        $faviconPath = optional($appSettings)->org_favicon_path;
    @endphp
    <link rel="shortcut icon" href="{{ $faviconPath ? asset($faviconPath) : asset('assets/images/logomci3.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/feather.min.css') }}">
    @vite(['resources/css/style.css'])
    
    @yield('styles')
</head>

<body>
    @php
        $logoPath = optional($appSettings)->org_logo_path;
        $logoUrl = $logoPath
            ? (str_starts_with($logoPath, 'assets/') ? asset($logoPath) : asset('storage/' . $logoPath))
            : asset('assets/images/logomci2.png');
    @endphp
    
    <div class="header-wrapper @yield('header-class')">
        <div class="decor-blob blob-1"></div>
        <div class="decor-blob blob-2"></div>
        <div class="decor-blob blob-3"></div>

        <div class="container">
            <!-- Navbar -->
            @include('public.partials.navbar-web')

            @yield('header-content')
        </div>
    </div>

    @yield('content')

    <!-- Footer Area -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ $logoUrl }}" style="filter: brightness(0) invert(1); max-height: 40px;" class="mb-4">
                    <div class="d-flex">
                        <a href="#">News</a>
                        <a href="{{ route('program') }}">Services</a>
                        <a href="{{ route('about') }}">About</a>
                        <a href="#">Contact</a>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex justify-content-md-end">
                        <a href="#">Copyright</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms & Conditions</a>
                    </div>
                </div>
            </div>
            <div class="text-center pt-4" style="border-top: 1px solid rgba(255,255,255,0.1); font-size: 0.7rem; color: rgba(255,255,255,0.4);">
                &copy; {{ date('Y') }} {{ optional($appSettings)->org_name ?? 'Muda Cita Indonesia' }}. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
