@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Detail Konten Kontak</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Konten Website</a></li>
                        <li class="breadcrumb-item">Kontak</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <a href="{{ route('content.kontak.edit') }}" class="btn btn-primary">
                        <i class="feather-edit-3 me-2"></i>Edit Konten
                    </a>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row g-3">
                    <!-- Contact Info Section -->
                    <div class="col-12 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">1. Informasi Kontak</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Alamat</label>
                                    <p class="form-control-plaintext">{{ $settings->org_address ?? '-' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Email</label>
                                    <p class="form-control-plaintext">{{ $settings->org_email ?? '-' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Telepon</label>
                                    <p class="form-control-plaintext">{{ $settings->org_phone ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Section -->
                    <div class="col-12 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">2. Social Media</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Instagram</label>
                                    <p class="form-control-plaintext">{{ $settings->org_instagram ?? '-' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Twitter/X</label>
                                    <p class="form-control-plaintext">{{ $settings->org_twitter ?? '-' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted">Facebook</label>
                                    <p class="form-control-plaintext">{{ $settings->org_facebook ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Section -->
                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">3. FAQ (Pertanyaan yang Sering Diajukan)</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-muted">FAQ Title</label>
                                        <p class="form-control-plaintext">{{ $settings->kontak_faq_title ?? '-' }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-muted">FAQ Subtitle</label>
                                        <p class="form-control-plaintext">{{ $settings->kontak_faq_subtitle ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">4. Peta Lokasi</h5>
                            </div>
                            <div class="card-body">
                                @if(!empty($settings->org_map_embed))
                                    <div class="ratio ratio-16x9 rounded overflow-hidden">
                                        {!! $settings->org_map_embed !!}
                                    </div>
                                @else
                                    <p class="text-muted">Belum ada peta.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection
