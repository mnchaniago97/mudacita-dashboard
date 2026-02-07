@extends('layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ul>
                </div>
                
            </div>
            <!-- [ page-header ] end -->
             
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                 <!-- [Mini Card] start -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card bg-success border-success text-white overflow-hidden">
                            <div class="card-body">
                                <i class="feather-share-2 fs-20"></i>
                                <h5 class="fs-4 text-reset mt-4 mb-1">{{ number_format($collaborationTotal) }}</h5>
                                <div class="fs-16 text-reset fw-normal">Kolaborasi</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card bg-primary border-primary text-white overflow-hidden">
                            <div class="card-body">
                                <i class="feather-users fs-20"></i>
                                <h5 class="fs-4 text-reset mt-4 mb-1">{{ number_format($totalActivity) }}</h5>
                                <div class="fs-16 text-reset fw-normal">Aktivitas</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card bg-warning border-warning text-white overflow-hidden">
                            <div class="card-body">
                                <i class="feather-user-plus fs-20"></i>
                                <h5 class="fs-4 text-reset mt-4 mb-1">{{ number_format($totalVolunteer) }}</h5>
                                <div class="fs-16 text-reset fw-normal">Volunteer</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card bg-danger border-danger text-white overflow-hidden">
                            <div class="card-body">
                                <i class="feather-briefcase fs-20"></i>
                                <h5 class="fs-4 text-reset mt-4 mb-1">{{ number_format($totalProgram) }}</h5>
                                <div class="fs-16 text-reset fw-normal">Program Aktif</div>
                            </div>
                        </div>
                    </div>
                    <!-- [Mini Card] end -->

                      
                   
                     
                   
                    <!-- [Muda Cita Indonesia - Overview] start -->
                    <div class="col-xxl-8">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Muda Cita Indonesia - Overview</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="Expand">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="p-4">
                                    <h6 class="mb-3">Aktivitas Organisasi</h6>

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total Management</span>
                                            <strong>{{ number_format($totalManagement) }} Orang</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total Volunteer</span>
                                            <strong>{{ number_format($totalVolunteer) }} Orang</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Program Aktif</span>
                                            <strong>{{ number_format($totalProgram) }} Program</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Kegiatan Berjalan</span>
                                            <strong>{{ number_format($activitiesByStatus['ongoing']) }} Aktivitas</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row g-4">
                                    <div class="col-lg-3">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="fs-12 text-muted mb-1">Divisi Program</div>
                                            <h6 class="fw-bold text-dark">{{ number_format($managementByDivisi['program']) }} Management</h6>
                                            <div class="progress mt-2 ht-3">
                                                <div class="progress-bar bg-primary" style="width: {{ $managementDivisiPercent['program'] }}%"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="fs-12 text-muted mb-1">Divisi Riset</div>
                                            <h6 class="fw-bold text-dark">{{ number_format($managementByDivisi['riset']) }} Management</h6>
                                            <div class="progress mt-2 ht-3">
                                                <div class="progress-bar bg-success" style="width: {{ $managementDivisiPercent['riset'] }}%"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="fs-12 text-muted mb-1">Divisi Media</div>
                                            <h6 class="fw-bold text-dark">{{ number_format($managementByDivisi['media']) }} Management</h6>
                                            <div class="progress mt-2 ht-3">
                                                <div class="progress-bar bg-info" style="width: {{ $managementDivisiPercent['media'] }}%"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="fs-12 text-muted mb-1">Program Pendidikan</div>
                                            <h6 class="fw-bold text-dark">{{ number_format($programByPilar['pendidikan']) }} Aktif</h6>
                                            <div class="progress mt-2 ht-3">
                                                <div class="progress-bar bg-dark" style="width: {{ $totalProgram ? round(($programByPilar['pendidikan'] / $totalProgram) * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [Muda Cita Indonesia - Overview] end -->

                    <!-- [Aktivitas & SDM Overview] start -->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Aktivitas & SDM Overview</h5>
                            </div>

                            <div class="card-body custom-card-action">
                                <div id="leads-overview-donut"></div>

                                <div class="row g-2">
                                    <div class="col-4">
                                        <div class="p-2 hstack gap-2 rounded border border-dashed">
                                            <span class="wd-7 ht-7 rounded-circle bg-primary"></span>
                                            <span>Pengurus <span class="fs-10 text-muted">({{ number_format($totalManagement) }})</span></span>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="p-2 hstack gap-2 rounded border border-dashed">
                                            <span class="wd-7 ht-7 rounded-circle bg-success"></span>
                                            <span>Volunteer <span class="fs-10 text-muted">({{ number_format($totalVolunteer) }})</span></span>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="p-2 hstack gap-2 rounded border border-dashed">
                                            <span class="wd-7 ht-7 rounded-circle bg-warning"></span>
                                            <span>Program <span class="fs-10 text-muted">({{ number_format($totalProgram) }})</span></span>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="p-2 hstack gap-2 rounded border border-dashed">
                                            <span class="wd-7 ht-7 rounded-circle bg-info"></span>
                                            <span>Pendidikan <span class="fs-10 text-muted">({{ number_format($programByPilar['pendidikan']) }})</span></span>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="p-2 hstack gap-2 rounded border border-dashed">
                                            <span class="wd-7 ht-7 rounded-circle bg-danger"></span>
                                            <span>Sosial <span class="fs-10 text-muted">({{ number_format($programByPilar['sosial']) }})</span></span>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="p-2 hstack gap-2 rounded border border-dashed">
                                            <span class="wd-7 ht-7 rounded-circle bg-dark"></span>
                                            <span>Lingkungan <span class="fs-10 text-muted">({{ number_format($programByPilar['lingkungan']) }})</span></span>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="p-2 hstack gap-2 rounded border border-dashed">
                                            <span class="wd-7 ht-7 rounded-circle bg-secondary"></span>
                                            <span>Kegiatan <span class="fs-10 text-muted">({{ number_format($totalActivity) }})</span></span>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="p-2 hstack gap-2 rounded border border-dashed">
                                            <span class="wd-7 ht-7 rounded-circle bg-success"></span>
                                            <span>Selesai <span class="fs-10 text-muted">({{ number_format($activitiesByStatus['completed']) }})</span></span>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="p-2 hstack gap-2 rounded border border-dashed">
                                            <span class="wd-7 ht-7 rounded-circle bg-warning"></span>
                                            <span>Rencana <span class="fs-10 text-muted">({{ number_format($activitiesByStatus['planned']) }})</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [Aktivitas & SDM Overview] end -->

                   
                    
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
   
    @endsection
    
    @push('scripts')
<script src="{{ asset('assets/vendors/js/apexcharts.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // hanya jalan kalau elemen ada
    const donut = document.querySelector("#leads-overview-donut");
    if (!donut) return;

    var options = {
        series: [
            {{ $totalManagement }},
            {{ $totalVolunteer }},
            {{ $totalProgram }}
        ],
        chart: {
            type: 'donut',
            height: 260
        },
        labels: ['Management', 'Volunteer', 'Program'],
        legend: {
            position: 'bottom'
        },
        dataLabels: {
            enabled: false
        }
    };

    var chart = new ApexCharts(donut, options);
    chart.render();
});
</script>
@endpush



