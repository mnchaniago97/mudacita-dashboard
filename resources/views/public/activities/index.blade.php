@extends('public.layouts.web')

@section('title', 'Kegiatan')

@section('header-content')
    <div class="text-center py-5 mt-4 position-relative" style="z-index: 5;">
        <h1 class="hero-title text-white mb-3" style="font-size: 3.2rem;">Kegiatan {{ ucfirst($type) }}</h1>
        <p class="text-white opacity-75" style="font-size: 1.1rem; max-width: 640px; margin: 0 auto;">
            Daftar kegiatan yang terkait dengan pilar program {{ ucfirst($type) }}.
        </p>
    </div>
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row g-4">
                @forelse($activities as $activity)
                    <div class="col-md-6 col-lg-4">
                        <div class="program-gallery-card h-100">
                            <img src="{{ $activity->documentation_photo_path ? asset('storage/' . $activity->documentation_photo_path) : asset('assets/images/banner/mudacita2.jpg') }}" alt="{{ $activity->title }}" class="img-fluid">
                            <div class="program-gallery-body">
                                <h5>{{ $activity->title }}</h5>
                                <p>{{ $activity->short_description }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <small class="text-muted">{{ $activity->activity_date?->format('d M Y') }}</small>
                                    <a href="{{ route('public.activities.show', $activity) }}" class="text-danger fw-bold text-decoration-none small">
                                        Lihat Detail <i class="feather-arrow-up-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada kegiatan untuk pilar ini.</p>
                    </div>
                @endforelse
            </div>

            @if($activities->hasPages())
                <div class="mt-4">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
