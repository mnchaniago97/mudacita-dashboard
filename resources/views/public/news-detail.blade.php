@extends('public.layouts.web')

@section('title', $article->title)
@section('header-class', 'header-short')

@section('header-content')
    <!-- Page Header -->
    <div class="news-detail-hero position-relative" style="z-index: 5;">
        <div class="news-detail-breadcrumb text-white-50 mb-2">
            <a href="{{ route('home') }}" class="text-white-50">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('public.news') }}" class="text-white-50">News</a>
            @if($article->category)
            <span class="mx-2">/</span>
            <span>{{ $article->category->name }}</span>
            @endif
        </div>
        <h1 class="news-detail-title text-white">{{ $article->title }}</h1>
        <div class="news-detail-meta text-white-50">
            @if($article->author_name)
            <span><i class="feather-user me-2"></i>{{ $article->author_name }}</span>
            @endif
            @if($article->published_at)
            <span><i class="feather-calendar me-2"></i>{{ $article->published_at->format('d M Y') }}</span>
            @endif
            @if($article->category)
            <span><i class="feather-tag me-2"></i>{{ $article->category->name }}</span>
            @endif
        </div>
    </div>
@endsection

@section('content')
    <!-- Article Content -->
    <section class="py-5 news-detail-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @if($article->image)
                    <div class="mb-4 news-detail-image">
                        <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid w-100" alt="{{ $article->title }}">
                    </div>
                    @endif
                    
                    <div class="article-content news-detail-content">
                        {!! $article->content !!}
                    </div>
                    
                    <!-- Share -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <span class="fw-bold">Bagikan:</span>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="feather-facebook"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank" class="btn btn-outline-info btn-sm">
                                    <i class="feather-twitter"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ url()->current() }}" target="_blank" class="btn btn-outline-success btn-sm">
                                    <i class="feather-phone"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container">
            <div class="cta-container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h2 class="section-title mb-4" style="font-size: 2.2rem;">{{ $appSettings->news_cta_title ?? 'Dapatkan Info Terbaru' }}</h2>
                        <p class="text-white opacity-75 mb-4">{{ $appSettings->news_cta_description ?? 'Berlangganan newsletter kami untuk mendapatkan informasi terbaru.' }}</p>
                        <div class="d-flex gap-4">
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Gratis</span>
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> No Spam</span>
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
