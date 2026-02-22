 @extends('admin.layouts.app')

@section('content')
 
 <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Reports</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Program</li>
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
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            
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
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <!-- [Mini Cards] start -->
                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="hstack justify-content-between mb-4 pb-">
                                    <div>
                                        <h5 class="mb-1">Program</h5>
                                        <span class="fs-12 text-muted">Progress Program</span>
                                    </div>
                                   
                                </div>
                                <div class="row g-4">
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card-body border border-dashed border-gray-5 rounded-3 position-relative">
                                            <div class="hstack justify-content-between gap-4">
                                                <div>
                                                    <h6 class="fs-14 text-truncate-1-line">Pilar Pendidikan</h6>
                                                    <div class="fs-12 text-muted">
                                                        <span class="text-dark fw-medium">Total Program:</span>
                                                        {{ number_format($programByPilar['pendidikan']) }}
                                                    </div>
                                                </div>
                                                <div class="project-progress-1"></div>
                                            </div>
                                            <div class="badge bg-gray-200 text-dark project-mini-card-badge">Aktif</div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card-body border border-dashed border-gray-5 rounded-3 position-relative">
                                            <div class="hstack justify-content-between gap-4">
                                                <div>
                                                    <h6 class="fs-14 text-truncate-1-line">Pilar Sosial</h6>
                                                    <div class="fs-12 text-muted">
                                                        <span class="text-dark fw-medium">Total Program:</span>
                                                        {{ number_format($programByPilar['sosial']) }}
                                                    </div>
                                                </div>
                                                <div class="project-progress-2"></div>
                                            </div>
                                            <div class="badge bg-gray-200 text-dark project-mini-card-badge">Aktif</div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card-body border border-dashed border-gray-5 rounded-3 position-relative">
                                            <div class="hstack justify-content-between gap-4">
                                                <div>
                                                    <h6 class="fs-14 text-truncate-1-line">Pilar Lingkungan</h6>
                                                    <div class="fs-12 text-muted">
                                                        <span class="text-dark fw-medium">Total Program:</span>
                                                        {{ number_format($programByPilar['lingkungan']) }}
                                                    </div>
                                                </div>
                                                <div class="project-progress-3"></div>
                                            </div>
                                            <div class="badge bg-gray-200 text-dark project-mini-card-badge">Aktif</div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card-body border border-dashed border-gray-5 rounded-3 position-relative">
                                            <div class="hstack justify-content-between gap-4">
                                                <div>
                                                    <h6 class="fs-14 text-truncate-1-line">Total Program</h6>
                                                    <div class="fs-12 text-muted">
                                                        <span class="text-dark fw-medium">Jumlah:</span>
                                                        {{ number_format($totalProgram) }}
                                                    </div>
                                                </div>
                                                <div class="project-progress-4"></div>
                                            </div>
                                            <div class="badge bg-gray-200 text-dark project-mini-card-badge">Semua</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [Mini Cards] end -->
                    <!-- [Project Report] start -->
                    <div class="col-xxl-8">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Project Report</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body custom-card-action">
                                <div
                                    id="project-statistics-chart"
                                    data-categories='@json($projectReportChart["categories"])'
                                    data-series='@json($projectReportChart["series"])'
                                ></div>
                            </div>
                        </div>
                    </div>
                    <!-- [Project Report] end -->
                    <!-- [Hours Spent] start -->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Aktivitas (Status)</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body custom-card-action p-0">
                                <div
                                    id="weekly-time-spent-chart"
                                    data-series='@json([$activitiesByStatus["completed"], $activitiesByStatus["ongoing"], $activitiesByStatus["planned"]])'
                                ></div>
                            </div>
                            <div class="card-footer hstack justify-content-around">
                                <div class="text-center">
                                    <a href="javascript:void(0);" class="fs-16 fw-bold">
                                        {{ number_format($activitiesByStatus['completed']) }}
                                    </a>
                                    <div class="fs-11 text-muted">Selesai</div>
                                </div>
                                <span class="vr"></span>
                                <div class="text-center">
                                    <a href="javascript:void(0);" class="fs-16 fw-bold">
                                        {{ number_format($activitiesByStatus['ongoing']) }}
                                    </a>
                                    <div class="fs-11 text-muted">Berjalan</div>
                                </div>
                                <span class="vr"></span>
                                <div class="text-center">
                                    <a href="javascript:void(0);" class="fs-16 fw-bold">
                                        {{ number_format($activitiesByStatus['planned']) }}
                                    </a>
                                    <div class="fs-11 text-muted">Direncanakan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [Hours Spent] end -->
                    <!-- [Team Progress] start -->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Team Progress</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body custom-card-action">
                                @forelse ($teamProgress as $progress)
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="fw-semibold text-dark">{{ $progress['name'] }}</div>
                                            <div class="fs-12 text-muted">
                                                {{ $progress['completed'] }}/{{ $progress['total'] }} Aktivitas
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div
                                                class="progress-bar bg-primary"
                                                role="progressbar"
                                                style="width: {{ $progress['percent'] }}%;"
                                                aria-valuenow="{{ $progress['percent'] }}"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-muted">Belum ada data aktivitas.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <!-- [Team Progress] end -->
                    <!-- [Upcomming Schedule] start -->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Upcomming Schedule</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($upcomingAgendas->isEmpty())
                                    <div class="text-muted">Belum ada agenda.</div>
                                @else
                                    @foreach ($upcomingAgendas as $agenda)
                                        <div class="p-3 border border-dashed rounded-3 mb-3">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="wd-50 ht-50 bg-soft-primary text-primary lh-1 d-flex align-items-center justify-content-center flex-column rounded-2 schedule-date">
                                                        <span class="fs-18 fw-bold mb-1 d-block">{{ \Carbon\Carbon::parse($agenda->event_date)->format('d') }}</span>
                                                        <span class="fs-10 fw-semibold text-uppercase d-block">{{ \Carbon\Carbon::parse($agenda->event_date)->format('M') }}</span>
                                                    </div>
                                                    <div class="text-dark">
                                                        <a href="javascript:void(0);" class="fs-13 fw-bold mb-2 text-truncate-1-line">{{ $agenda->title }}</a>
                                                        <span class="fs-11 fw-normal text-muted text-truncate-1-line">
                                                            {{ $agenda->start_time }} - {{ $agenda->end_time }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="text-muted small">
                                                    {{ $agenda->location ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <a href="/agenda" class="card-footer fs-11 fw-bold text-uppercase text-center py-4">More Schedule</a>
                        </div>
                    </div>
                    <!-- [Upcomming Schedule] end -->
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
       
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.ApexCharts) {
                return;
            }

            var projectChartEl = document.getElementById('project-statistics-chart');
            if (projectChartEl) {
                var categories = JSON.parse(projectChartEl.getAttribute('data-categories') || '[]');
                var seriesData = JSON.parse(projectChartEl.getAttribute('data-series') || '[]');

                if (categories.length) {
                    var projectChart = new ApexCharts(projectChartEl, {
                        chart: { type: 'bar', height: 320, toolbar: { show: false } },
                        series: [{ name: 'Aktivitas', data: seriesData }],
                        xaxis: { categories: categories, labels: { rotate: -45 } },
                        dataLabels: { enabled: false },
                        colors: ['#4c6fff']
                    });
                    projectChart.render();
                } else {
                    projectChartEl.innerHTML = '<div class="text-muted p-4">Belum ada data program.</div>';
                }
            }

            var statusChartEl = document.getElementById('weekly-time-spent-chart');
            if (statusChartEl) {
                var statusSeries = JSON.parse(statusChartEl.getAttribute('data-series') || '[]');
                var statusChart = new ApexCharts(statusChartEl, {
                    chart: { type: 'donut', height: 300 },
                    series: statusSeries,
                    labels: ['Selesai', 'Berjalan', 'Direncanakan'],
                    legend: { position: 'bottom' },
                    colors: ['#2dce89', '#5e72e4', '#fb6340']
                });
                statusChart.render();
            }
        });
    </script>

     @endsection

@push('scripts')
<script src="{{ asset('assets/vendors/js/apexcharts.min.js') }}"></script>

@endpush

