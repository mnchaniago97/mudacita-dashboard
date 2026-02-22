@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Detail Konten Program - {{ ucfirst($type ?? 'Pilih Program') }}</h5>
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
                    @if($type)
                    <a href="{{ route('content.program.edit', $type) }}" class="btn btn-primary">
                        <i class="feather-edit-3 me-2"></i>Edit Konten
                    </a>
                    @endif
                    <div class="btn-group ms-2">
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
                                            <label class="form-label text-muted">Hero Title</label>
                                            <p class="form-control-plaintext">{{ $settings->{'program_' . $type . '_hero_title'} ?? '-' }}</p>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label text-muted">Hero Subtitle</label>
                                            <p class="form-control-plaintext">{{ $settings->{'program_' . $type . '_hero_subtitle'} ?? '-' }}</p>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label text-muted">Hero Description</label>
                                            <p class="form-control-plaintext">{{ $settings->{'program_' . $type . '_hero_description'} ?? '-' }}</p>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label text-muted">Hero Image</label>
                                            @if($settings->{'program_' . $type . '_hero_image'})
                                                <img src="{{ asset('storage/' . $settings->{'program_' . $type . '_hero_image'}) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                            @else
                                                <p class="text-muted">Tidak ada gambar</p>
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
                                    <h5 class="card-title"><i class="{{ $iconClass }} me-2"></i>2. Program Items - {{ $programName }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        @foreach(range(1, 6) as $i)
                                            <div class="col-12 col-md-6 col-xl-4 mb-3">
                                                <div class="border p-3 rounded h-100">
                                                    <h6 class="mb-3">Program Item {{ $i }}</h6>
                                                    <div class="mb-2">
                                                        <label class="form-label text-muted">Title</label>
                                                        <p class="form-control-plaintext">{{ $settings->{'program_' . $type . '_item' . $i . '_title'} ?? '-' }}</p>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label text-muted">Description</label>
                                                        <p class="form-control-plaintext">{{ $settings->{'program_' . $type . '_item' . $i . '_description'} ?? '-' }}</p>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label text-muted">Image</label>
                                                        @if($settings->{'program_' . $type . '_item' . $i . '_image'})
                                                            <img src="{{ asset('storage/' . $settings->{'program_' . $type . '_item' . $i . '_image'}) }}" class="img-thumbnail" style="max-width: 100%;">
                                                        @else
                                                            <p class="text-muted">Tidak ada gambar</p>
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
                                    <h5 class="card-title"><i class="{{ $iconClass }} me-2"></i>3. CTA Section - {{ $programName }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label text-muted">CTA Title</label>
                                            <p class="form-control-plaintext">{{ $settings->{'program_' . $type . '_cta_title'} ?? '-' }}</p>
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label text-muted">CTA Button Text</label>
                                            <p class="form-control-plaintext">{{ $settings->{'program_' . $type . '_cta_btn_text'} ?? '-' }}</p>
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label text-muted">CTA Button URL</label>
                                            <p class="form-control-plaintext">{{ $settings->{'program_' . $type . '_cta_btn_url'} ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Activities Section -->
                        <div class="col-12">
                            <div class="card stretch stretch-full">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title"><i class="{{ $iconClass }} me-2"></i>4. Kegiatan - {{ $programName }}</h5>
                                    <a href="{{ route('activity.create', ['pilar' => $type]) }}" class="btn btn-sm btn-primary">
                                        <i class="feather-plus me-1"></i>Tambah Kegiatan
                                    </a>
                                </div>
                                <div class="card-body">
                                    @if($activities->count() === 0)
                                        <p class="text-muted mb-0">Belum ada kegiatan untuk pilar ini.</p>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Judul</th>
                                                        <th>Program</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($activities as $activity)
                                                        <tr>
                                                            <td>{{ $activity->title }}</td>
                                                            <td>{{ $activity->program->name ?? '-' }}</td>
                                                            <td>{{ $activity->activity_date?->format('d M Y') ?? '-' }}</td>
                                                            <td>{{ ucfirst($activity->status) }}</td>
                                                            <td>
                                                                <a href="{{ route('activity.edit', $activity) }}" class="btn btn-sm btn-outline-primary">
                                                                    <i class="feather-edit-2"></i>
                                                                </a>
                                                                <a href="{{ route('activity.show', $activity) }}" class="btn btn-sm btn-outline-secondary">
                                                                    <i class="feather-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Pilih Program</h5>
                        <p>Silakan pilih program yang ingin dilihat dari dropdown di atas.</p>
                    </div>
                    <div class="row g-3">
                        @foreach(['pendidikan', 'sosial', 'lingkungan', 'digital'] as $progType)
                            <div class="col-12 col-md-6 col-xl-3">
                                <div class="card stretch stretch-full">
                                    <div class="card-body text-center">
                                        <a href="{{ route('content.program.show', $progType) }}" class="btn btn-outline-primary">
                                            <i class="feather-folder me-2"></i>{{ ucfirst($progType) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection
