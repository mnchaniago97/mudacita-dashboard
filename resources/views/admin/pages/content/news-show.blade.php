@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Detail Konten News</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Konten Website</a></li>
                        <li class="breadcrumb-item">News</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <a href="{{ route('content.news.edit') }}" class="btn btn-primary">
                        <i class="feather-edit-3 me-2"></i>Edit Konten
                    </a>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
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
                                        <label class="form-label text-muted">Hero Title</label>
                                        <p class="form-control-plaintext">{{ $settings->news_hero_title ?? '-' }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-muted">Hero Subtitle</label>
                                        <p class="form-control-plaintext">{{ $settings->news_hero_subtitle ?? '-' }}</p>
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
                                        <label class="form-label text-muted">CTA Title</label>
                                        <p class="form-control-plaintext">{{ $settings->news_cta_title ?? '-' }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-muted">CTA Description</label>
                                        <p class="form-control-plaintext">{{ $settings->news_cta_description ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection
