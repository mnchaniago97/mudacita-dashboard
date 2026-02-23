@extends('public.layouts.web')

@section('title', 'Program')
@section('header-class', 'header-short')

@section('header-content')
    <!-- Page Header -->
    <div class="text-center program-hero position-relative" style="z-index: 5;">
        <h1 class="hero-title text-white mb-3" style="font-size: clamp(2rem, 8vw, 4rem); letter-spacing: -0.02em;">Program Kami</h1>
        <p class="text-white opacity-75" style="font-size: clamp(0.9rem, 3vw, 1.2rem); max-width: 600px; margin: 0 auto;">
            Menjadi ruang bagi generasi muda Indonesia untuk berkontribusi dalam pembangunan bangsa melalui empat pilar program kerja kami.
        </p>
    </div>
@endsection

@section('content')
    <!-- Pilar Programs -->
    <section class="pillars-section program-pillars">
        <div class="container">
            <div class="row g-4">
                @php
                    $pilarTags = ['01', '02', '03', '04'];
                    $pilarData = [
                        [
                            'key' => 'pendidikan',
                            'title' => $appSettings->pilar1_title ?? 'Pendidikan & Literasi',
                            'subtitle' => $appSettings->pilar1_subtitle ?? 'Rumah Baca Eduva',
                            'description' => $appSettings->pilar1_description ?? 'Memperkuat akses pendidikan berkualitas dan meningkatkan literasi untuk generasi muda Indonesia.',
                            'icon' => 'feather-book-open',
                            'color' => 'primary',
                            'image' => 'assets/images/banner/mudacita1.jpg'
                        ],
                        [
                            'key' => 'sosial',
                            'title' => $appSettings->pilar2_title ?? 'Sosial & Kemanusiaan',
                            'subtitle' => $appSettings->pilar2_subtitle ?? 'MCI Socio Project',
                            'description' => $appSettings->pilar2_description ?? 'Menggerakkan kepedulian sosial dan kemanusiaan untuk membantu mereka yang membutuhkan.',
                            'icon' => 'feather-heart',
                            'color' => 'success',
                            'image' => 'assets/images/banner/mudacita2.jpg'
                        ],
                        [
                            'key' => 'lingkungan',
                            'title' => $appSettings->pilar3_title ?? 'Lingkungan',
                            'subtitle' => $appSettings->pilar3_subtitle ?? 'MCI Green',
                            'description' => $appSettings->pilar3_description ?? 'Melestarikan lingkungan melalui aksi nyata dan edukasi kesadaran hijau.',
                            'icon' => 'feather-sun',
                            'color' => 'warning',
                            'image' => 'assets/images/banner/mudacita3.jpg'
                        ],
                        [
                            'key' => 'digital',
                            'title' => $appSettings->pilar4_title ?? 'Transformasi Digital',
                            'subtitle' => $appSettings->pilar4_subtitle ?? 'MCI Digital Impact',
                            'description' => $appSettings->pilar4_description ?? 'Memperkuat kapasitas digital generasi muda untuk masa depan yang lebih cerah.',
                            'icon' => 'feather-monitor',
                            'color' => 'info',
                            'image' => 'assets/images/banner/mudacita4.JPG'
                        ]
                    ];
                @endphp

                @foreach($pilarData as $index => $pilar)
                <div class="col-md-6 col-lg-3">
                    <div class="pilar-card {{ $index == 3 ? 'dark' : '' }}">
                        <div class="pilar-title-row">
                            <span class="pilar-meta">{{ $pilarTags[$index] }}</span>
                            <h4 class="pilar-title">{{ $pilar['title'] }}</h4>
                        </div>
                        <p class="pilar-subtitle">{{ $pilar['subtitle'] }}</p>
                        <p class="pilar-desc">{{ $pilar['description'] }}</p>
                        <a href="{{ route('program.detail', $pilar['key']) }}" class="btn-mci btn-mci-red btn-sm mt-auto w-fit" style="width: fit-content; padding: 10px 20px; font-size: 0.75rem;">
                            Learn More <i class="feather-arrow-up-right ms-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Program Details Section -->
    <section class="program-detail-section">
        <div class="container">
            @foreach($pilarData as $index => $pilar)
            <div class="row align-items-center program-detail-row {{ $index % 2 == 1 ? 'flex-lg-row-reverse' : '' }}">
                <div class="col-lg-6">
                    <span class="tag-label">{{ $pilar['title'] }}</span>
                    <h2 class="section-title mb-4">{{ $pilar['title'] }}</h2>
                    <p class="text-muted mb-4" style="font-size: 1rem; line-height: 1.9;">
                        {{ $pilar['description'] }}
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('program.detail', $pilar['key']) }}" class="btn-mci btn-mci-red">Lihat Program <i class="feather-arrow-up-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="program-media">
                        <img src="{{ asset($pilar['image']) }}" alt="{{ $pilar['title'] }}" class="img-fluid">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Program Accordion Section -->
    <section class="program-accordion-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="section-title text-white mb-4" style="font-size: 2.4rem;">
                        Gerakan Anak Muda untuk Dampak Sosial Berkelanjutan
                    </h2>
                    <div class="program-accordion">
                        @foreach($pilarData as $index => $pilar)
                        <div class="program-accordion-item {{ $index == 0 ? 'active' : '' }}">
                            <button class="program-accordion-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#programCollapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="programCollapse{{ $index }}">
                                <span>{{ $pilar['title'] }}</span>
                                <i class="feather-{{ $index == 0 ? 'minus' : 'plus' }}"></i>
                            </button>
                            <div id="programCollapse{{ $index }}" class="collapse {{ $index == 0 ? 'show' : '' }}" data-bs-parent=".program-accordion">
                                <div class="program-accordion-body">
                                    {{ $pilar['description'] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="program-accordion-media">
                        <img src="{{ asset('assets/images/banner/mudacita5.JPG') }}" alt="Program Muda Cita" class="img-fluid">
                        <a href="{{ route('program') }}" class="btn-mci btn-mci-red program-accordion-cta">
                            Ayo Gabung <i class="feather-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Overlay Section -->
    <section class="overlay-image-section">
        <div class="overlay-image" style="background-image: url('{{ asset('assets/images/banner/mudacita2.jpg') }}');"></div>
        <div class="overlay-fade"></div>
    </section>

    <!-- CTA Section -->
    <section>
        <div class="container">
            <div class="cta-container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h2 class="section-title mb-4" style="font-size: 2.2rem;">Bergabunglah dengan Program Kami</h2>
                        <p class="text-white opacity-75 mb-4">Jadilah bagian dari perubahan positif untuk Indonesia. Setiap kontribusi Anda sangat berarti.</p>
                        <div class="d-flex gap-4">
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Volunteer</span>
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Donatur</span>
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Mitra</span>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-5 mt-lg-0">
                        <div class="bg-white p-4 rounded-4 shadow-sm">
                            <p class="text-dark small fw-bold mb-3">Bergabung dengan newsletter kami</p>
                            <form class="d-flex gap-2">
                                <input type="email" class="form-control" placeholder="Email Anda *" required>
                                <button type="submit" class="btn btn-dark px-4 fw-bold">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
