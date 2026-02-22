@extends('public.layouts.web')

@section('title', $program['title'])

@section('header-content')
    <div class="program-detail-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 pe-lg-5">
                    <span class="tag-label text-white border border-white border-opacity-25 bg-transparent">
                        {{ strtoupper($type) }}
                    </span>
                    <h1 class="hero-title text-white mb-3">{{ $program['title'] }}</h1>
                    <p class="program-detail-subtitle mb-3">{{ $program['subtitle'] }}</p>
                    <p class="text-white opacity-75 mb-4" style="font-size: 1.05rem; line-height: 1.8;">
                        {{ $program['description'] }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#kegiatan" class="btn-mci btn-mci-red">Lihat Kegiatan <i class="feather-arrow-up-right"></i></a>
                        <a href="{{ route('program') }}" class="btn-mci btn-mci-blue">Kembali <i class="feather-arrow-up-right"></i></a>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-4">
                        @foreach($program['tags'] as $tag)
                            <span class="program-chip">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="program-detail-media">
                        <img src="{{ asset($program['image']) }}" alt="{{ $program['title'] }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Fokus Program</h2>
                <p class="text-muted">Area utama yang kami dorong dalam pilar ini</p>
            </div>
            <div class="row g-4">
                @foreach($program['features'] as $feature)
                    <div class="col-md-4">
                        <div class="program-feature-card h-100">
                            <div class="program-feature-icon">
                                <i class="{{ $feature['icon'] }}"></i>
                            </div>
                            <h4 class="program-feature-title">{{ $feature['title'] }}</h4>
                            <p class="program-feature-text">{{ $feature['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="kegiatan" class="program-gallery-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h2 class="section-title">{{ $gallery['title'] }}</h2>
                    <p class="text-muted">{{ $gallery['subtitle'] }}</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('public.activities.index', $type) }}" class="btn-mci btn-mci-red rounded-pill px-4">{{ $gallery['button_text'] }} <i class="feather-arrow-up-right ms-1"></i></a>
                </div>
            </div>
            <div class="row g-4">
                @forelse($activities as $activity)
                    <div class="col-md-4">
                        <div class="program-gallery-card">
                            <img src="{{ $activity->documentation_photo_path ? asset('storage/' . $activity->documentation_photo_path) : asset('assets/images/banner/mudacita2.jpg') }}" alt="{{ $activity->title }}" class="img-fluid">
                            <div class="program-gallery-body">
                                <h5>{{ $activity->title }}</h5>
                                <p>{{ $activity->short_description }}</p>
                                <a href="{{ route('public.activities.show', $activity) }}" class="text-danger fw-bold text-decoration-none small">
                                    Lihat Detail <i class="feather-arrow-up-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">Belum ada kegiatan untuk program ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="cta-container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h2 class="section-title mb-4" style="font-size: 2.2rem;">Gabung dan Dukung Program Ini</h2>
                        <p class="text-white opacity-75 mb-4">Jadilah bagian dari perubahan nyata bersama Muda Cita Indonesia.</p>
                        <div class="d-flex gap-4 flex-wrap">
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Volunteer</span>
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Donatur</span>
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Mitra</span>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-4 mt-lg-0">
                        <div class="bg-white p-4 rounded-4 shadow-sm">
                            <p class="text-dark small fw-bold mb-3">Dapatkan update kegiatan terbaru.</p>
                            <form class="d-flex gap-2 flex-column flex-md-row">
                                <input type="email" class="form-control" placeholder="Your email *" required>
                                <button type="submit" class="btn btn-dark px-4 fw-bold">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
