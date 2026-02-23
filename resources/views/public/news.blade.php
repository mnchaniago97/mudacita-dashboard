@extends('public.layouts.web')

@section('title', 'News')
@section('header-class', 'header-short')

@section('header-content')
    <!-- Page Header -->
    <div class="text-center page-hero position-relative" style="z-index: 5;">
        <h1 class="hero-title text-white mb-5" style="font-size: clamp(1.8rem, 8vw, 4rem); letter-spacing: -0.02em;">{{ $appSettings->news_hero_title ?? 'Berita & Artikel' }}</h1>
        <p class="text-white opacity-75" style="font-size: clamp(0.9rem, 3vw, 1.2rem); max-width: 600px; margin: 0 auto;">
            {{ $appSettings->news_hero_subtitle ?? 'Informasi terkini tentang kegiatan, program, dan informasi menarik dari Muda Cita Indonesia.' }}
        </p>
    </div>
@endsection

@section('content')
    <!-- Latest News Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8">
                    <h2 class="section-title mb-2">Berita Terbaru</h2>
                    <p class="text-muted">Update terkini dari kegiatan kami</p>
                </div>
            </div>

            <!-- Featured News -->
            @if($articles->count() > 0)
            <div class="row mb-5">
                <div class="col-12">
                    @php $featured = $articles->first(); @endphp
                    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                @if($featured->image)
                                    <img src="{{ asset('storage/' . $featured->image) }}" class="img-fluid h-100" alt="{{ $featured->title }}" style="object-fit: cover; min-height: 300px;">
                                @else
                                    <div class="bg-light h-100" style="min-height: 300px;">
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <i class="feather-image" style="font-size: 5rem; color: var(--primary-color); opacity: 0.3;"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-4 p-lg-5">
                                    @if($featured->category)
                                        <span class="badge bg-danger mb-3">{{ $featured->category->name }}</span>
                                    @endif
                                    <h3 class="card-title mb-3" style="font-size: 1.5rem;">{{ $featured->title }}</h3>
                                    <p class="text-muted mb-4">
                                        {{ $featured->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($featured->content), 200) }}
                                    </p>
                                    <div class="d-flex align-items-center text-muted small mb-3">
                                        <i class="feather-calendar me-2"></i>
                                        <span>{{ $featured->published_at ? $featured->published_at->format('d M Y') : '-' }}</span>
                                        @if($featured->author_name)
                                            <span class="mx-2">•</span>
                                            <i class="feather-user me-2"></i>
                                            <span>{{ $featured->author_name }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('public.news.detail', $featured->slug) }}" class="btn-mci btn-mci-red">Baca Selengkapnya <i class="feather-arrow-up-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- News Grid -->
            <div class="row g-4">
                @forelse($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid" alt="{{ $article->title }}" style="height: 200px; object-fit: cover; width: 100%;">
                        @else
                            <div class="bg-light" style="height: 200px;">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <i class="feather-image" style="font-size: 3rem; color: var(--primary-color); opacity: 0.3;"></i>
                                </div>
                            </div>
                        @endif
                        <div class="card-body p-4">
                            @if($article->category)
                                <span class="badge bg-danger mb-2">{{ $article->category->name }}</span>
                            @endif
                            <h5 class="card-title mb-2" style="font-size: 1.1rem; line-height: 1.4;">
                                {{ $article->title }}
                            </h5>
                            <p class="text-muted small mb-3">
                                {{ $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <div class="d-flex align-items-center text-muted small">
                                <i class="feather-calendar me-1"></i>
                                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="feather-file-text text-muted mb-3" style="font-size: 48px;"></i>
                    <p class="text-muted">Belum ada berita terbaru</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
            <div class="text-center mt-5">
                {{ $articles->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5">
        <div class="container">
            <div class="cta-container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h2 class="section-title mb-4" style="font-size: 2.2rem;">{{ $appSettings->news_cta_title ?? 'Dapatkan Info Terbaru' }}</h2>
                        <p class="text-white opacity-75 mb-4">{{ $appSettings->news_cta_description ?? 'Berlangganan newsletter kami untuk mendapatkan informasi terbaru tentang program dan kegiatan Muda Cita Indonesia.' }}</p>
                        <div class="d-flex gap-4">
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Gratis</span>
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> No Spam</span>
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Update Rutin</span>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-4 mt-lg-0">
                        <div class="bg-white p-4 rounded-4 shadow-sm">
                            <p class="text-dark small fw-bold mb-3">Berlangganan newsletter</p>
                            <form class="d-flex flex-column gap-2">
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
