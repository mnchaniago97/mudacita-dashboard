@extends('admin.layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left">
                <h5>Detail Activity</h5>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('activity.index') }}">Activities</a></li>
                    <li class="breadcrumb-item">Detail</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('activity.edit', $activity) }}" class="btn btn-primary">
                            <i class="feather-edit me-2"></i>
                            Edit Activity
                        </a>
                        <a href="{{ route('activity.index') }}" class="btn btn-light">
                            <i class="feather-arrow-left me-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    @php
                        $badgeClass = match ($activity->status) {
                            'completed' => 'bg-success',
                            'ongoing' => 'bg-warning',
                            default => 'bg-secondary'
                        };
                    @endphp

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Nama Aktivitas</label>
                            <p class="mb-0">{{ $activity->title ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Program Terkait</label>
                            <p class="mb-0">{{ $activity->program->name ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Lokasi</label>
                            <p class="mb-0">
                                @if ($activity->location)
                                    {{ $activity->location->detail ? $activity->location->detail . ' - ' : '' }}
                                    {{ $activity->location->city ?? $activity->location->name }}
                                    {{ $activity->location->province ? ' - ' . $activity->location->province : '' }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Tanggal &amp; Waktu</label>
                            <p class="mb-0">{{ optional($activity->activity_datetime)->format('d M Y H:i') ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Penanggung Jawab</label>
                            <p class="mb-0">{{ $activity->person_in_charge ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Status</label>
                            <div>
                                <span class="badge {{ $badgeClass }}">
                                    {{ $activity->status ? ucfirst($activity->status) : '-' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Deskripsi Singkat</label>
                            <p class="mb-0">{{ $activity->short_description ?? '-' }}</p>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Deskripsi Lengkap</label>
                            <p class="mb-0">{{ $activity->description ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Dokumentasi (Link)</label>
                            @if (!empty($activity->documentation_url))
                                <p class="mb-0">
                                    <a href="{{ $activity->documentation_url }}" target="_blank" rel="noopener">
                                        {{ $activity->documentation_url }}
                                    </a>
                                </p>
                            @else
                                <p class="mb-0">-</p>
                            @endif
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Dokumentasi (Foto)</label>
                            @if (!empty($activity->documentation_photo_path))
                                <div class="mt-2">
                                    <img
                                        src="{{ asset('storage/' . $activity->documentation_photo_path) }}"
                                        alt="Dokumentasi"
                                        class="img-thumbnail"
                                        style="max-width: 220px;"
                                    >
                                </div>
                            @else
                                <p class="mb-0">-</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

