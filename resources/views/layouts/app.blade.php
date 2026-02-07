<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <title>Muda Cita Indonesia Dashboard</title>
    @php
        $faviconPath = optional($appSettings)->org_favicon_path;
    @endphp
    <link rel="shortcut icon" type="image/x-icon" href="{{ $faviconPath ? asset($faviconPath) : asset('assets/images/logomci3.png') }}" />

    <!-- CORE -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    
    <!-- PLUGINS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/select2-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/jquery.steps.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/quill.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    

    <style>
        :root {
            --app-footer-height: 72px;
        }
        body {
            padding-bottom: var(--app-footer-height);
        }
        .app-footer {
            margin-left: 280px;
            padding: 16px 30px;
            background: #fff;
            border-top: 1px solid #e5e7eb;
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1020;
            height: var(--app-footer-height);
            display: flex;
            align-items: center;
        }
        @media (max-width: 1199.98px) {
            .app-footer {
                margin-left: 0;
            }
        }
        .minimenu .app-footer {
            margin-left: 100px;
        }
        .nxl-container .nxl-content .main-content {
            padding-bottom: calc(var(--app-footer-height) + 20px);
        }
        @media (max-width: 1199.98px) {
            :root {
                --app-footer-height: 80px;
            }
            .app-footer {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- CONTENT --}}
        <main>
            @yield('content')
        </main>

        <footer class="app-footer">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-2 text-muted small">
                <div>
                    <strong>{{ optional($appSettings)->org_name ?? 'Mudacita' }}</strong>
                    &copy; {{ date('Y') }}
                </div>
                <div>
                    Email: {{ optional($appSettings)->org_email ?? '-' }} |
                    HP: {{ optional($appSettings)->org_phone ?? '-' }} |
                    Alamat: {{ optional($appSettings)->org_address ?? '-' }}
                </div>
            </div>
        </footer>

<!-- CORE -->
<script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/common-init.min.js') }}"></script>
<script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

@stack('scripts')


</body>
</html>
