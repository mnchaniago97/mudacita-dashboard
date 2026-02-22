@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Manajemen Konten Home</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Konten Website</a></li>
                        <li class="breadcrumb-item">Home</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="mb-3">
                    <a href="{{ route('content.home.show') }}" class="btn btn-outline-secondary">
                        <i class="feather-arrow-left me-2"></i>Kembali ke Detail
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">1. Hero Banner</h5>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalHeroBanner">Edit Konten</button>
                            </div>
                            <div class="card-body">
                                @if($settings->hero_image_path)
                                    <img src="{{ asset('storage/' . $settings->hero_image_path) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                @else
                                    <span class="text-muted small">Belum ada gambar.</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">2. Banner Tentang Kami</h5>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAboutBanner">Edit Konten</button>
                            </div>
                            <div class="card-body">
                                @if($settings->about_image_path)
                                    <img src="{{ asset('storage/' . $settings->about_image_path) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                @else
                                    <span class="text-muted small">Belum ada gambar.</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">4. Author Visi & Misi</h5>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAuthor">Edit Konten</button>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="text-muted small mb-2">Author Visi</div>
                                        @if($settings->visi_author_image)
                                            <img src="{{ asset('storage/' . $settings->visi_author_image) }}" class="img-thumbnail" style="max-height: 160px; max-width: 100%;">
                                        @else
                                            <span class="text-muted small">Belum ada gambar.</span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="text-muted small mb-2">Author Misi</div>
                                        @if($settings->misi_author_image)
                                            <img src="{{ asset('storage/' . $settings->misi_author_image) }}" class="img-thumbnail" style="max-height: 160px; max-width: 100%;">
                                        @else
                                            <span class="text-muted small">Belum ada gambar.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">5. Cerita Dampak (Artikel Eksternal)</h5>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalImpact">Edit Konten</button>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <div class="fw-semibold">{{ $settings->impact_1_title ?? 'Penerima Manfaat' }}</div>
                                        <div class="text-muted small">{{ $settings->impact_1_number ?? '-' }} • {{ $settings->impact_1_date ?? '-' }}</div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="fw-semibold">{{ $settings->impact_2_title ?? 'Volunteer' }}</div>
                                        <div class="text-muted small">{{ $settings->impact_2_number ?? '-' }} • {{ $settings->impact_2_date ?? '-' }}</div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="fw-semibold">{{ $settings->impact_3_title ?? 'Bantuan Tersalurkan' }}</div>
                                        <div class="text-muted small">{{ $settings->impact_3_number ?? '-' }} • {{ $settings->impact_3_date ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hero Banner Modal -->
                <div class="modal fade" id="modalHeroBanner" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('content.home.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Hero Banner</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Hero Banner Image</label>
                                    <input type="file" name="hero_image_path" class="form-control mb-3">
                                    @if($settings->hero_image_path)
                                        <img src="{{ asset('storage/' . $settings->hero_image_path) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                    @endif
                                    <div class="row g-3 mt-2">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Teks Tombol 1</label>
                                            <input type="text" name="hero_btn1_text" class="form-control" value="{{ old('hero_btn1_text', $settings->hero_btn1_text ?? 'Ayo Gabung') }}">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Link Tombol 1</label>
                                            <input type="text" name="hero_btn1_url" class="form-control" value="{{ old('hero_btn1_url', $settings->hero_btn1_url ?? '#') }}">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Teks Tombol 2</label>
                                            <input type="text" name="hero_btn2_text" class="form-control" value="{{ old('hero_btn2_text', $settings->hero_btn2_text ?? 'Donasi Sekarang') }}">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Link Tombol 2</label>
                                            <input type="text" name="hero_btn2_url" class="form-control" value="{{ old('hero_btn2_url', $settings->hero_btn2_url ?? '#') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- About Banner Modal -->
                <div class="modal fade" id="modalAboutBanner" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('content.home.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Banner Tentang Kami</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Banner Image (Tentang Kami)</label>
                                    <input type="file" name="about_image_path" class="form-control mb-3">
                                    @if($settings->about_image_path)
                                        <img src="{{ asset('storage/' . $settings->about_image_path) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Author Modal -->
                <div class="modal fade" id="modalAuthor" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('content.home.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Author Visi & Misi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Author Visi Image</label>
                                            <input type="file" name="visi_author_image" class="form-control mb-2">
                                            @if($settings->visi_author_image)
                                                <img src="{{ asset('storage/' . $settings->visi_author_image) }}" class="img-thumbnail" style="max-height: 160px; max-width: 100%;">
                                            @endif
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Author Misi Image</label>
                                            <input type="file" name="misi_author_image" class="form-control mb-2">
                                            @if($settings->misi_author_image)
                                                <img src="{{ asset('storage/' . $settings->misi_author_image) }}" class="img-thumbnail" style="max-height: 160px; max-width: 100%;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Impact Modal -->
                <div class="modal fade" id="modalImpact" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('content.home.update') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Cerita Dampak (Artikel Eksternal)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <h6 class="fw-bold mb-2">Penerima Manfaat</h6>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Angka</label>
                                            <input type="text" name="impact_1_number" class="form-control" value="{{ old('impact_1_number', $settings->impact_1_number) }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" name="impact_1_title" class="form-control" value="{{ old('impact_1_title', $settings->impact_1_title ?? 'Penerima Manfaat') }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="text" name="impact_1_date" class="form-control" value="{{ old('impact_1_date', $settings->impact_1_date) }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Link Artikel</label>
                                            <input type="url" name="impact_1_url" class="form-control" value="{{ old('impact_1_url', $settings->impact_1_url) }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="impact_1_text" rows="2" class="form-control">{{ old('impact_1_text', $settings->impact_1_text) }}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <hr class="my-2">
                                        </div>

                                        <div class="col-12">
                                            <h6 class="fw-bold mb-2">Volunteer</h6>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Angka</label>
                                            <input type="text" name="impact_2_number" class="form-control" value="{{ old('impact_2_number', $settings->impact_2_number) }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" name="impact_2_title" class="form-control" value="{{ old('impact_2_title', $settings->impact_2_title ?? 'Volunteer') }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="text" name="impact_2_date" class="form-control" value="{{ old('impact_2_date', $settings->impact_2_date) }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Link Artikel</label>
                                            <input type="url" name="impact_2_url" class="form-control" value="{{ old('impact_2_url', $settings->impact_2_url) }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="impact_2_text" rows="2" class="form-control">{{ old('impact_2_text', $settings->impact_2_text) }}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <hr class="my-2">
                                        </div>

                                        <div class="col-12">
                                            <h6 class="fw-bold mb-2">Bantuan Tersalurkan</h6>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Angka</label>
                                            <input type="text" name="impact_3_number" class="form-control" value="{{ old('impact_3_number', $settings->impact_3_number) }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" name="impact_3_title" class="form-control" value="{{ old('impact_3_title', $settings->impact_3_title ?? 'Bantuan Tersalurkan') }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="text" name="impact_3_date" class="form-control" value="{{ old('impact_3_date', $settings->impact_3_date) }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Link Artikel</label>
                                            <input type="url" name="impact_3_url" class="form-control" value="{{ old('impact_3_url', $settings->impact_3_url) }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="impact_3_text" rows="2" class="form-control">{{ old('impact_3_text', $settings->impact_3_text) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection


