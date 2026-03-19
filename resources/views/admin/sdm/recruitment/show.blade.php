@extends('admin.layouts.app')

@push('styles')
    <style>
        .recruitment-detail-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            height: 100%;
            background: #fff;
        }

        .recruitment-detail-title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 14px;
            color: #1f2937;
        }

        .recruitment-detail-item + .recruitment-detail-item {
            margin-top: 12px;
        }

        .recruitment-detail-label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 3px;
        }

        .recruitment-detail-value {
            font-size: 14px;
            color: #111827;
            word-break: break-word;
        }

        .recruitment-text-block {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
            min-height: 56px;
            color: #334155;
        }

        .recruitment-thumb {
            width: 220px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #dbe1ea;
            background: #fff;
        }

        .recruitment-thumb-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .cv-link-btn {
            display: inline-flex;
            align-items: center;
            width: auto !important;
            min-width: 0;
            padding-inline: 14px;
        }
    </style>
@endpush

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Detail Recruitment</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sdm.recruitment.index') }}">Recruitment</a></li>
                        <li class="breadcrumb-item">Detail</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <a href="{{ route('sdm.recruitment.index') }}" class="btn btn-light">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                @php
                                    $badgeClass = match ($recruitment->status_recruitment) {
                                        'accepted' => 'bg-success',
                                        'rejected' => 'bg-danger',
                                        default => 'bg-warning'
                                    };

                                    $screenshots = [];
                                    if ($recruitment->screenshot_path) {
                                        $decoded = json_decode($recruitment->screenshot_path, true);
                                        if (is_array($decoded)) {
                                            $screenshots = $decoded;
                                        } elseif (is_string($recruitment->screenshot_path)) {
                                            $screenshots = [$recruitment->screenshot_path];
                                        }
                                    }
                                @endphp

                                <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
                                    <div>
                                        <h5 class="mb-1">{{ $recruitment->name }}</h5>
                                        <p class="text-muted mb-0">{{ $recruitment->email }}</p>
                                    </div>
                                    <div class="text-md-end">
                                        <div class="text-muted small mb-1">Status Pendaftaran</div>
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($recruitment->status_recruitment) }}</span>
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="recruitment-detail-card">
                                            <div class="recruitment-detail-title">Data Pelamar</div>

                                            <div class="recruitment-detail-item">
                                                <div class="recruitment-detail-label">Phone</div>
                                                <div class="recruitment-detail-value">{{ $recruitment->phone ?? '-' }}</div>
                                            </div>
                                            <div class="recruitment-detail-item">
                                                <div class="recruitment-detail-label">Jabatan</div>
                                                <div class="recruitment-detail-value">{{ $recruitment->jabatan ?? '-' }}</div>
                                            </div>
                                            <div class="recruitment-detail-item">
                                                <div class="recruitment-detail-label">Divisi</div>
                                                <div class="recruitment-detail-value">{{ ucfirst($recruitment->divisi) }}</div>
                                            </div>
                                            <div class="recruitment-detail-item">
                                                <div class="recruitment-detail-label">Tanggal Lahir</div>
                                                <div class="recruitment-detail-value">{{ $recruitment->tanggal_lahir ? \Carbon\Carbon::parse($recruitment->tanggal_lahir)->format('d/m/Y') : '-' }}</div>
                                            </div>
                                            <div class="recruitment-detail-item">
                                                <div class="recruitment-detail-label">Jenis Kelamin</div>
                                                <div class="recruitment-detail-value">{{ $recruitment->jenis_kelamin ?? '-' }}</div>
                                            </div>
                                            <div class="recruitment-detail-item">
                                                <div class="recruitment-detail-label">Pendidikan Terakhir</div>
                                                <div class="recruitment-detail-value">{{ $recruitment->pendidikan_terakhir ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="recruitment-detail-card">
                                            <div class="recruitment-detail-title">Informasi Tambahan</div>

                                            <div class="mb-3">
                                                <div class="recruitment-detail-label">Alamat Lengkap</div>
                                                <div class="recruitment-text-block">{{ $recruitment->alamat_lengkap ?? '-' }}</div>
                                            </div>
                                            <div>
                                                <div class="recruitment-detail-label">Motivasi</div>
                                                <div class="recruitment-text-block">{{ $recruitment->motivasi ?? '-' }}</div>
                                            </div>

                                            @if ($recruitment->status_recruitment === 'rejected')
                                                <div class="mt-3">
                                                    <div class="recruitment-detail-label text-danger">Alasan Penolakan</div>
                                                    <div class="recruitment-text-block border-danger-subtle">{{ $recruitment->rejection_reason ?? '-' }}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="recruitment-detail-card">
                                            <div class="recruitment-detail-title">Lampiran</div>

                                            <div class="row g-4">
                                                <div class="col-md-4">
                                                    <div class="recruitment-detail-label mb-2">Pas Foto</div>
                                                    @if ($recruitment->photo_path)
                                                        <a href="{{ asset('storage/' . $recruitment->photo_path) }}" target="_blank">
                                                            <img
                                                                src="{{ asset('storage/' . $recruitment->photo_path) }}"
                                                                alt="Pas Foto"
                                                                class="recruitment-thumb"
                                                            >
                                                        </a>
                                                    @else
                                                        <div class="recruitment-detail-value">-</div>
                                                    @endif
                                                </div>

                                                <div class="col-md-8">
                                                    <div class="recruitment-detail-label mb-2">Screenshot Bukti</div>
                                                    @if (count($screenshots))
                                                        <div class="recruitment-thumb-grid">
                                                            @foreach ($screenshots as $screenshot)
                                                                <a href="{{ asset('storage/' . $screenshot) }}" target="_blank">
                                                                    <img
                                                                        src="{{ asset('storage/' . $screenshot) }}"
                                                                        alt="Screenshot Bukti"
                                                                        class="recruitment-thumb"
                                                                    >
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="recruitment-detail-value">-</div>
                                                    @endif
                                                </div>

                                                <div class="col-12">
                                                    <div class="recruitment-detail-label mb-2">CV</div>
                                                    @if ($recruitment->cv_path)
                                                        <a href="{{ asset('storage/' . $recruitment->cv_path) }}" target="_blank" class="btn btn-primary btn-sm cv-link-btn">
                                                            <i class="feather-file-text me-1"></i>
                                                            Lihat CV
                                                        </a>
                                                    @else
                                                        <div class="recruitment-detail-value">-</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 d-flex flex-wrap gap-2">
                                    @if ($recruitment->status_recruitment === 'pending')
                                        <form action="{{ route('sdm.recruitment.approve', $recruitment) }}" method="POST" onsubmit="return confirm('Terima pendaftaran ini?')">
                                            @csrf
                                            <button class="btn btn-success btn-sm">Terima</button>
                                        </form>
                                        <form action="{{ route('sdm.recruitment.reject', $recruitment) }}" method="POST" onsubmit="return confirm('Tolak pendaftaran ini?')">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('sdm.recruitment.index') }}" class="btn btn-light btn-sm">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
