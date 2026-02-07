@extends('layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Detail Program</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pilar.index', $program->pilar) }}">Pilar {{ ucfirst($program->pilar) }}</a></li>
                    <li class="breadcrumb-item">Detail</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="text-muted small">Nama Program</div>
                            <div class="fw-semibold">{{ $program->name }}</div>
                            <div class="mt-3 text-muted small">Pilar</div>
                            <div class="fw-semibold">{{ ucfirst($program->pilar) }}</div>
                            <div class="mt-3 text-muted small">Deskripsi</div>
                            <div class="fw-semibold">{{ $program->description ?? '-' }}</div>
                            <div class="mt-4">
                                <a href="{{ route('pilar.index', $program->pilar) }}" class="btn btn-light w-100">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Aktivitas Program</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Aktivitas</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal & Waktu</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($activities as $index => $activity)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $activity->title }}</td>
                                                <td>
                                                    @if ($activity->location)
                                                        {{ $activity->location->detail ? $activity->location->detail . ' - ' : '' }}
                                                        {{ $activity->location->city ?? $activity->location->name }}
                                                        {{ $activity->location->province ? ' - ' . $activity->location->province : '' }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ optional($activity->activity_datetime)->format('d M Y H:i') ?? '-' }}</td>
                                                <td>
                                                    @php
                                                        $badgeClass = match ($activity->status) {
                                                            'completed' => 'bg-success',
                                                            'ongoing' => 'bg-warning',
                                                            default => 'bg-secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">
                                                        {{ $activity->status ? ucfirst($activity->status) : '-' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">
                                                    Belum ada aktivitas untuk program ini.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
