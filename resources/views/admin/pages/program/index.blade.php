@extends('admin.layouts.app')

@section('content')
<style>
    .pilar-tabs-sticky {
        position: sticky;
        top: 72px;
        z-index: 8;
        background: #fff;
    }
    .pilar-tab-content {
        min-height: 0 !important;
    }
    .pilar-tab-content .tab-pane {
        min-height: 0 !important;
    }
</style>
<main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Pilar {{ ucfirst($currentPilar) }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">View</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                       
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <div class="bg-white py-3 border-bottom rounded-0 p-md-0 mb-0 pilar-tabs-sticky">
                <div class="d-md-none d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0)" class="page-content-left-open-toggle">
                        <i class="feather-align-left fs-20"></i>
                    </a>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="nav-tabs-wrapper page-content-left-sidebar-wrapper">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-content-left-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <ul class="nav nav-tabs nav-tabs-custom-style" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overviewTab">
                                    Overview
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#activityTab">Activities</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] start -->
            <div class="main-content mt-0 pt-0">
                <div class="tab-content pilar-tab-content">
                    <div class="tab-pane fade active show" id="overviewTab">
                        <div class="row">
                            <div class="col-12">
                                @php
                                    $totalPrograms = $programs->total() ?? $programs->count();
                                    $totalActivities = $activities->count();
                                    $ongoingActivities = $activities->where('status', 'ongoing')->count();
                                    $completedActivities = $activities->where('status', 'completed')->count();
                                @endphp
                                <div class="card stretch stretch-full mb-4">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">
                                            <div>
                                                <div class="text-muted">Ringkasan Pilar</div>
                                                <h4 class="mb-2">Pilar {{ ucfirst($currentPilar) }}</h4>
                                                <div class="text-muted">
                                                    Gambaran umum program dan capaian aktivitas pada pilar ini.
                                                </div>
                                            </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [Mini Card] start -->
                            <div class="col-xxl-3 col-md-6">
                                <div class="card stretch stretch-full">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-text avatar-xl rounded bg-primary text-white">
                                                    <i class="feather-grid"></i>
                                                </div>
                                                <a href="javascript:void(0);" class="fw-bold d-block">
                                                    <span class="text-truncate-1-line">Total Program</span>
                                                    <span class="fs-24 fw-bolder d-block">{{ $totalPrograms }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div class="card stretch stretch-full">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-text avatar-xl rounded bg-success text-white">
                                                    <i class="feather-grid"></i>
                                                </div>
                                                <a href="javascript:void(0);" class="fw-bold d-block">
                                                    <span class="text-truncate-1-line">Total Aktivitas</span>
                                                    <span class="fs-24 fw-bolder d-block">{{ $totalActivities }}</span>
                                                </a>
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div class="card stretch stretch-full">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-text avatar-xl rounded bg-teal text-white">
                                                    <i class="feather-grid"></i>
                                                </div>
                                                <a href="javascript:void(0);" class="fw-bold d-block">
                                                    <span class="text-truncate-1-line">Berjalan</span>
                                                    <span class="fs-24 fw-bolder d-block">{{ $ongoingActivities }}</span>
                                                </a>
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div class="card stretch stretch-full">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-text avatar-xl rounded bg-danger text-white">
                                                    <i class="feather-grid"></i>
                                                </div>
                                                <a href="javascript:void(0);" class="fw-bold d-block">
                                                    <span class="text-truncate-1-line">Selesai</span>
                                                    <span class="fs-24 fw-bolder d-block">{{ $completedActivities }}</span>
                                                </a>
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [Mini Card] end -->
                            <div class="col-lg-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h5 class="mb-0">Daftar Program Pilar {{ ucfirst($currentPilar) }}</h5>
                                           
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Program</th>
                                                        <th>Deskripsi</th>
                                                        <th class="text-end">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($programs as $index => $program)
                                                        <tr>
                                                            <td>{{ $programs->firstItem() + $index }}</td>
                                                            <td>{{ $program->name }}</td>
                                                            <td>{{ $program->description ?? '-' }}</td>
                                                            <td class="text-end">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <a href="{{ route('pilar.show', $program) }}" class="avatar-text avatar-md">
                                                                        <i class="feather-eye"></i>
                                                                    </a>
                                                                    <a href="{{ route('pilar.edit', $program) }}"
                                                                       class="avatar-text avatar-md">
                                                                        <i class="feather-edit"></i>
                                                                    </a>
                                                                    <form action="{{ route('pilar.destroy', $program) }}"
                                                                          method="POST"
                                                                          onsubmit="return confirm('Yakin hapus program ini?')">
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
                                                            <td colspan="4" class="text-center text-muted py-4">
                                                                Belum ada program pada pilar ini
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3">
                                            {{ $programs->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="activityTab">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <h5 class="mb-3">Daftar Aktivitas Pilar {{ ucfirst($currentPilar) }}</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama Aktivitas</th>
                                                <th>Program</th>
                                                <th>Tanggal & Waktu</th>
                                                <th>Lokasi</th>
                                                <th>PJ</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        @forelse ($activities as $activity)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $activity->title }}</div>
                                    <div class="small text-muted">{{ $activity->short_description ?? '-' }}</div>
                                </td>
                                <td>{{ $activity->program->name ?? '-' }}</td>
                                <td>{{ optional($activity->activity_datetime)->format('d M Y H:i') ?? '-' }}</td>
                                <td>{{ $activity->location->name ?? '-' }}</td>
                                <td>{{ $activity->person_in_charge ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-soft-secondary text-secondary">
                                        {{ $activity->status ? ucfirst($activity->status) : '-' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada aktivitas untuk pilar ini.
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
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection

