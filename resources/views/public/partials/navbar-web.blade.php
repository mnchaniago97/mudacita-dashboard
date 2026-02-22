@php
    $logoPath = optional($appSettings)->org_logo_path;
    $logoUrl = $logoPath
        ? (str_starts_with($logoPath, 'assets/') ? asset($logoPath) : asset('storage/' . $logoPath))
        : asset('assets/images/logomci2.png');
@endphp

<div class="navbar-container">
    <nav class="navbar navbar-expand-lg sticky-top">
        <a class="navbar-brand" href="/">
            <img src="{{ $logoUrl }}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}" href="{{ route('about') }}">Tentang</a></li>
                <li class="nav-item dropdown program-dropdown">
                    <a class="nav-link {{ request()->is('program*') ? 'active' : '' }}" href="{{ route('program') }}">
                        Program
                    </a>
                    <button class="program-dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Buka menu program">
                        <i class="feather-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu program-dropdown-menu p-0">
                        <div class="program-dropdown-content">
                            <a class="program-dropdown-item" href="{{ route('program.detail', 'pendidikan') }}">
                                <div class="program-dropdown-icon"><i class="feather-book-open"></i></div>
                                <div>
                                    <div class="program-dropdown-title">Pendidikan & Literasi</div>
                                    <div class="program-dropdown-desc">Kegiatan mengajar dan pendampingan belajar di sekolah, komunitas, dan wilayah terbatas akses pendidikan.</div>
                                </div>
                            </a>
                            <a class="program-dropdown-item" href="{{ route('program.detail', 'sosial') }}">
                                <div class="program-dropdown-icon"><i class="feather-heart"></i></div>
                                <div>
                                    <div class="program-dropdown-title">Sosial & Kemanusiaan</div>
                                    <div class="program-dropdown-desc">Kegiatan bantuan kemanusiaan bagi masyarakat terdampak bencana dan krisis sosial.</div>
                                </div>
                            </a>
                            <a class="program-dropdown-item" href="{{ route('program.detail', 'lingkungan') }}">
                                <div class="program-dropdown-icon"><i class="feather-feather"></i></div>
                                <div>
                                    <div class="program-dropdown-title">Lingkungan Berkelanjutan</div>
                                    <div class="program-dropdown-desc">Pendampingan masyarakat dalam upaya pelestarian lingkungan dan sumber daya alam lokal.</div>
                                </div>
                            </a>
                            <a class="program-dropdown-item" href="{{ route('program.detail', 'digital') }}">
                                <div class="program-dropdown-icon"><i class="feather-monitor"></i></div>
                                <div>
                                    <div class="program-dropdown-title">Digital Skill</div>
                                    <div class="program-dropdown-desc">Membantu masyarakat beradaptasi dengan teknologi melalui pengabdian berbasis keterampilan digital.</div>
                                </div>
                            </a>
                        </div>
                        <div class="program-dropdown-footer">
                            <a href="{{ route('program') }}" class="program-dropdown-all">Lihat Semua Program <i class="feather-arrow-up-right ms-1"></i></a>
                        </div>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link {{ request()->is('news') ? 'active' : '' }}" href="/news">News</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
            @auth
                <div class="dropdown">
                    <button class="btn btn-login dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="feather-user me-1"></i>{{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="feather-grid me-2"></i>Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="feather-log-out me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            @endauth
        </div>
    </nav>
</div>
