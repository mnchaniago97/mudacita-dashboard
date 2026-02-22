@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Manajemen Konten Kontak</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Konten Website</a></li>
                        <li class="breadcrumb-item">Kontak</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
               
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="mb-3">
                    <a href="{{ route('content.kontak.show') }}" class="btn btn-outline-secondary">
                        <i class="feather-arrow-left me-2"></i>Kembali ke Detail
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('content.kontak.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- Contact Info Section -->
                        <div class="col-12 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">1. Informasi Kontak</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="org_address" class="form-control" rows="3">{{ old('org_address', $settings->org_address ?? 'Jakarta Selatan, Indonesia') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="org_email" class="form-control" value="{{ old('org_email', $settings->org_email ?? 'hello@mudacita.id') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Telepon</label>
                                        <input type="text" name="org_phone" class="form-control" value="{{ old('org_phone', $settings->org_phone ?? '+62 812 3456 7890') }}">
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
                                        <label class="form-label">Instagram</label>
                                        <input type="text" name="org_instagram" class="form-control" value="{{ old('org_instagram', $settings->org_instagram ?? '@mudacitaid') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Twitter/X</label>
                                        <input type="text" name="org_twitter" class="form-control" value="{{ old('org_twitter', $settings->org_twitter ?? '@mudacitaid') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" name="org_facebook" class="form-control" value="{{ old('org_facebook', $settings->org_facebook ?? 'MudaCitaIndonesia') }}">
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
                                            <label class="form-label">FAQ Title</label>
                                            <input type="text" name="kontak_faq_title" class="form-control" value="{{ old('kontak_faq_title', $settings->kontak_faq_title ?? 'Pertanyaan yang Sering Diajukan') }}">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">FAQ Subtitle</label>
                                            <input type="text" name="kontak_faq_subtitle" class="form-control" value="{{ old('kontak_faq_subtitle', $settings->kontak_faq_subtitle ?? 'Temukan jawaban untuk pertanyaan umum tentang Muda Cita Indonesia') }}">
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
                                    <div class="mb-3">
                                        <label class="form-label">Embed Map (Iframe)</label>
                                        <textarea name="org_map_embed" class="form-control" rows="4" placeholder="<iframe ...></iframe>">{{ old('org_map_embed', $settings->org_map_embed ?? '') }}</textarea>
                                        <div class="text-muted small mt-2">Tempelkan kode embed Google Maps di sini.</div>
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

