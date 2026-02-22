@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Manajemen Konten News</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Konten Website</a></li>
                        <li class="breadcrumb-item">News</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
               
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="mb-3">
                    <a href="{{ route('content.news.show') }}" class="btn btn-outline-secondary">
                        <i class="feather-arrow-left me-2"></i>Kembali ke Detail
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('content.news.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- Header Section -->
                        <div class="col-12">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">1. Header Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Hero Title</label>
                                            <input type="text" name="news_hero_title" class="form-control" value="{{ old('news_hero_title', $settings->news_hero_title ?? 'Berita & Artikel') }}">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Hero Subtitle</label>
                                            <input type="text" name="news_hero_subtitle" class="form-control" value="{{ old('news_hero_subtitle', $settings->news_hero_subtitle ?? 'Informasi terkini tentang kegiatan, program, dan informasi menarik dari Muda Cita Indonesia.') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Newsletter Section -->
                        <div class="col-12">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">2. Newsletter Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">CTA Title</label>
                                            <input type="text" name="news_cta_title" class="form-control" value="{{ old('news_cta_title', $settings->news_cta_title ?? 'Dapatkan Info Terbaru') }}">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">CTA Description</label>
                                            <textarea name="news_cta_description" class="form-control" rows="3">{{ old('news_cta_description', $settings->news_cta_description ?? 'Berlangganan newsletter kami untuk mendapatkan informasi terbaru tentang program dan kegiatan Muda Cita Indonesia.') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="feather-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection

