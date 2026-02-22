@extends('public.layouts.web')

@section('title', $activity->title)

@section('header-content')
    <div class="program-detail-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 pe-lg-5">
                    <span class="tag-label text-white border border-white border-opacity-25 bg-transparent">
                        {{ strtoupper($activity->program->pilar ?? 'KEGIATAN') }}
                    </span>
                    <h1 class="hero-title text-white mb-3">{{ $activity->title }}</h1>
                    <p class="text-white opacity-75 mb-4" style="font-size: 1.05rem; line-height: 1.8;">
                        {{ $activity->short_description }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('public.activities.index', $activity->program->pilar ?? 'pendidikan') }}" class="btn-mci btn-mci-red">Kembali <i class="feather-arrow-up-right"></i></a>
                        @if($activity->documentation_url)
                            <a href="{{ $activity->documentation_url }}" class="btn-mci btn-mci-blue">Dokumentasi <i class="feather-arrow-up-right"></i></a>
                        @endif
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <span class="program-chip">{{ $activity->activity_date?->format('d M Y') }}</span>
                        <span class="program-chip">{{ ucfirst($activity->status) }}</span>
                        @if($activity->location)
                            <span class="program-chip">{{ $activity->location->city ?? $activity->location->name }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="program-detail-media">
                        <img src="{{ $activity->documentation_photo_path ? asset('storage/' . $activity->documentation_photo_path) : asset('assets/images/banner/mudacita2.jpg') }}" alt="{{ $activity->title }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <h2 class="section-title mb-4">Detail Kegiatan</h2>
                    <p class="text-muted" style="line-height: 1.9;">
                        {{ $activity->description ?? $activity->short_description }}
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="program-feature-card">
                        <h4 class="program-feature-title">Informasi</h4>
                        <ul class="list-unstyled text-muted mb-0" style="line-height: 2;">
                            <li><strong>Tanggal:</strong> {{ $activity->activity_date?->format('d M Y') ?? '-' }}</li>
                            <li><strong>Waktu:</strong> {{ $activity->activity_datetime?->format('H:i') ?? '-' }}</li>
                            <li><strong>Penanggung Jawab:</strong> {{ $activity->person_in_charge ?? '-' }}</li>
                            <li><strong>Program:</strong> {{ $activity->program->name ?? '-' }}</li>
                            <li><strong>Lokasi:</strong> {{ $activity->location->detail ?? $activity->location->city ?? '-' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
