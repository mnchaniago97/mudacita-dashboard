@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Konten Program - {{ ucfirst($type ?? 'Pilih Program') }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Konten Website</a></li>
                        <li class="breadcrumb-item">Program</li>
                        @if($type)
                        <li class="breadcrumb-item">{{ ucfirst($type) }}</li>
                        @endif
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="feather-folder me-2"></i>Pilih Program
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('content.program.show', 'pendidikan') }}">Pendidikan</a></li>
                            <li><a class="dropdown-item" href="{{ route('content.program.show', 'sosial') }}">Sosial</a></li>
                            <li><a class="dropdown-item" href="{{ route('content.program.show', 'lingkungan') }}">Lingkungan</a></li>
                            <li><a class="dropdown-item" href="{{ route('content.program.show', 'digital') }}">Transformasi Digital</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
              
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="mb-3">
                    <a href="{{ $type ? route('content.program.show', $type) : '#' }}" class="btn btn-outline-secondary">
                        <i class="feather-arrow-left me-2"></i>Kembali ke Detail
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                @endif

                @if($type)
                    @php
                        $programIcons = [
                            'pendidikan' => 'feather-book-open text-primary',
                            'sosial' => 'feather-heart text-success',
                            'lingkungan' => 'feather-sun text-warning',
                            'digital' => 'feather-monitor text-info'
                        ];
                        $programNames = [
                            'pendidikan' => 'Pendidikan',
                            'sosial' => 'Sosial',
                            'lingkungan' => 'Lingkungan',
                            'digital' => 'Transformasi Digital'
                        ];
                        $iconClass = $programIcons[$type] ?? 'feather-folder';
                        $programName = $programNames[$type] ?? ucfirst($type);
                    @endphp

                    <form action="{{ route('content.program.update', $type) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <!-- Hero Section -->
                            <div class="col-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-header">
                                        <h5 class="card-title"><i class="{{ $iconClass }} me-2"></i>1. Hero Section - {{ $programName }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">Hero Title</label>
                                                <input type="text" name="program_hero_title" class="form-control" value="{{ old('program_hero_title', $settings->{'program_' . $type . '_hero_title'} ?? '') }}">
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">Hero Subtitle</label>
                                                <input type="text" name="program_hero_subtitle" class="form-control" value="{{ old('program_hero_subtitle', $settings->{'program_' . $type . '_hero_subtitle'} ?? '') }}">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Hero Description</label>
                                                <textarea name="program_hero_description" class="form-control" rows="3">{{ old('program_hero_description', $settings->{'program_' . $type . '_hero_description'} ?? '') }}</textarea>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Hero Image</label>
                                                <input type="file" name="program_hero_image" class="form-control mb-2">
                                                @if(!empty($settings->{'program_' . $type . '_hero_image'}))
                                                    <img src="{{ asset('storage/' . $settings->{'program_' . $type . '_hero_image'}) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Program Items Section -->
                            <div class="col-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-header">
                                        <h5 class="card-title">2. Daftar Program - {{ $programName }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted mb-3">Kelola program items untuk {{ $programName }}. Tambahkan hingga 6 program.</p>
                                        <div class="row g-3">
                                            @foreach(range(1, 6) as $i)
                                                <div class="col-12 col-md-6 col-xl-4 mb-3">
                                                    <div class="border p-3 rounded h-100">
                                                        <h6 class="mb-3">Program {{ $i }}</h6>
                                                        <div class="mb-2">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="program{{ $i }}_title" class="form-control" value="{{ $settings->{'program_' . $type . '_item' . $i . '_title'} ?? '' }}">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="program{{ $i }}_description" class="form-control" rows="3">{{ $settings->{'program_' . $type . '_item' . $i . '_description'} ?? '' }}</textarea>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Image</label>
                                                            <input type="file" name="program{{ $i }}_image" class="form-control mb-2">
                                                            @if(!empty($settings->{'program_' . $type . '_item' . $i . '_image'}))
                                                                <img src="{{ asset('storage/' . $settings->{'program_' . $type . '_item' . $i . '_image'}) }}" class="img-thumbnail" style="max-width: 100%;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery Section -->
                            <div class="col-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-header">
                                        <h5 class="card-title">3. Kegiatan Unggulan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="program_gallery_title" class="form-control" value="{{ old('program_gallery_title', $settings->{'program_' . $type . '_gallery_title'} ?? 'Kegiatan Unggulan') }}">
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">Subtitle</label>
                                                <input type="text" name="program_gallery_subtitle" class="form-control" value="{{ old('program_gallery_subtitle', $settings->{'program_' . $type . '_gallery_subtitle'} ?? '') }}">
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">Button Text</label>
                                                <input type="text" name="program_gallery_btn_text" class="form-control" value="{{ old('program_gallery_btn_text', $settings->{'program_' . $type . '_gallery_btn_text'} ?? 'Lihat Semua') }}">
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">Button URL</label>
                                                <input type="text" name="program_gallery_btn_url" class="form-control" value="{{ old('program_gallery_btn_url', $settings->{'program_' . $type . '_gallery_btn_url'} ?? '#') }}">
                                            </div>
                                        </div>
                                        <div class="row g-3 mt-2">
                                            @foreach(range(1, 3) as $i)
                                                <div class="col-12 col-md-6 col-xl-4 mb-3">
                                                    <div class="border p-3 rounded h-100">
                                                        <h6 class="mb-3">Kegiatan {{ $i }}</h6>
                                                        <div class="mb-2">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="gallery{{ $i }}_title" class="form-control" value="{{ $settings->{'program_' . $type . '_gallery_item' . $i . '_title'} ?? '' }}">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="gallery{{ $i }}_description" class="form-control" rows="3">{{ $settings->{'program_' . $type . '_gallery_item' . $i . '_description'} ?? '' }}</textarea>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Link URL</label>
                                                            <input type="text" name="gallery{{ $i }}_url" class="form-control" value="{{ $settings->{'program_' . $type . '_gallery_item' . $i . '_url'} ?? '' }}">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Image</label>
                                                            <input type="file" name="gallery{{ $i }}_image" class="form-control mb-2">
                                                            @if(!empty($settings->{'program_' . $type . '_gallery_item' . $i . '_image'}))
                                                                <img src="{{ asset('storage/' . $settings->{'program_' . $type . '_gallery_item' . $i . '_image'}) }}" class="img-thumbnail" style="max-width: 100%;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Section -->
                            <div class="col-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-header">
                                        <h5 class="card-title">4. CTA Section</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">CTA Title</label>
                                                <input type="text" name="program_cta_title" class="form-control" value="{{ old('program_cta_title', $settings->{'program_' . $type . '_cta_title'} ?? '') }}">
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">CTA Button Text</label>
                                                <input type="text" name="program_cta_btn_text" class="form-control" value="{{ old('program_cta_btn_text', $settings->{'program_' . $type . '_cta_btn_text'} ?? 'Gabung Program') }}">
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">CTA Button URL</label>
                                                <input type="text" name="program_cta_btn_url" class="form-control" value="{{ old('program_cta_btn_url', $settings->{'program_' . $type . '_cta_btn_url'} ?? '#') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="feather-save me-2"></i>Simpan Perubahan - {{ $programName }}
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">Pengaturan Konten Program</h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning">
                                        <i class="feather-alert-circle me-2"></i>
                                        Silakan pilih jenis program terlebih dahulu dari dropdown di atas.
                                    </div>
                                    
                                    <div class="row g-4">
                                        <div class="col-md-6 col-xl-3">
                                            <a href="{{ route('content.program.edit', 'pendidikan') }}" class="text-decoration-none">
                                                <div class="card border-primary h-100">
                                                    <div class="card-body text-center">
                                                        <div class="avatar-text avatar-lg bg-primary-subtle text-primary mb-3 mx-auto" style="width: 64px; height: 64px;">
                                                            <i class="feather-book-open"></i>
                                                        </div>
                                                        <h6 class="text-primary">Pendidikan</h6>
                                                        <p class="text-muted small mb-0">Kelola konten program pendidikan</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-3">
                                            <a href="{{ route('content.program.edit', 'sosial') }}" class="text-decoration-none">
                                                <div class="card border-success h-100">
                                                    <div class="card-body text-center">
                                                        <div class="avatar-text avatar-lg bg-success-subtle text-success mb-3 mx-auto" style="width: 64px; height: 64px;">
                                                            <i class="feather-heart"></i>
                                                        </div>
                                                        <h6 class="text-success">Sosial</h6>
                                                        <p class="text-muted small mb-0">Kelola konten program sosial</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-3">
                                            <a href="{{ route('content.program.edit', 'lingkungan') }}" class="text-decoration-none">
                                                <div class="card border-warning h-100">
                                                    <div class="card-body text-center">
                                                        <div class="avatar-text avatar-lg bg-warning-subtle text-warning mb-3 mx-auto" style="width: 64px; height: 64px;">
                                                            <i class="feather-sun"></i>
                                                        </div>
                                                        <h6 class="text-warning">Lingkungan</h6>
                                                        <p class="text-muted small mb-0">Kelola konten program lingkungan</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-3">
                                            <a href="{{ route('content.program.edit', 'digital') }}" class="text-decoration-none">
                                                <div class="card border-info h-100">
                                                    <div class="card-body text-center">
                                                        <div class="avatar-text avatar-lg bg-info-subtle text-info mb-3 mx-auto" style="width: 64px; height: 64px;">
                                                            <i class="feather-monitor"></i>
                                                        </div>
                                                        <h6 class="text-info">Transformasi Digital</h6>
                                                        <p class="text-muted small mb-0">Kelola konten program digital</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection

