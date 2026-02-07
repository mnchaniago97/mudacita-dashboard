@extends('layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Activities</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Activities</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('activity.create') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            Tambah Activity
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown">
                                <i class="feather-filter"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('activity.index') }}">
                                    <i class="feather-eye me-2"></i>Semua
                                </a>
                                <a class="dropdown-item" href="{{ route('activity.index', ['pilar' => 'pendidikan']) }}">
                                    <i class="feather-book-open me-2"></i>Pendidikan
                                </a>
                                <a class="dropdown-item" href="{{ route('activity.index', ['pilar' => 'sosial']) }}">
                                    <i class="feather-heart me-2"></i>Sosial
                                </a>
                                <a class="dropdown-item" href="{{ route('activity.index', ['pilar' => 'lingkungan']) }}">
                                    <i class="feather-sun me-2"></i>Lingkungan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->

        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Aktivitas</th>
                                            <th>Program</th>
                                            <th>Location</th>
                                            <th>Tanggal & Waktu</th>
                                            <th>PJ</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($activities as $index => $activity)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $activity->title }}</td>
                                            <td>{{ $activity->program->name ?? '-' }}</td>
                                            <td>
                                                @if ($activity->location)
                                                    {{ $activity->location->detail ? $activity->location->detail . ' - ' : '' }}
                                                    {{ $activity->location->city ?? $activity->location->name }}
                                                    {{ $activity->location->province ? ' - ' . $activity->location->province : '' }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                {{ optional($activity->activity_datetime)->format('d M Y H:i') ?? '-' }}
                                            </td>
                                            <td>{{ $activity->person_in_charge ?? '-' }}</td>
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
                                            <td class="text-end">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('activity.show', $activity) }}" class="avatar-text avatar-md">
                                                        <i class="feather-eye"></i>
                                                    </a>
                                                    <a href="{{ route('activity.edit', $activity) }}" class="avatar-text avatar-md">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('activity.destroy', $activity) }}" method="POST" onsubmit="return confirm('Yakin hapus activity ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="avatar-text avatar-md border-0 bg-transparent text-danger">
                                                            <i class="feather-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                Belum ada data activity
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- Pagination dihapus -->
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
