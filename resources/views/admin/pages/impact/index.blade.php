@extends('admin.layouts.app')
@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Impact Report</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Impact</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="row">
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="hstack gap-2 mb-3">
                                <i class="feather-briefcase"></i>
                                <span>Total Program</span>
                            </div>
                            <h4 class="fw-bolder mb-0">{{ number_format($totalProgram) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="hstack gap-2 mb-3">
                                <i class="feather-activity"></i>
                                <span>Total Aktivitas</span>
                            </div>
                            <h4 class="fw-bolder mb-0">{{ number_format($totalActivity) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="hstack gap-2 mb-3">
                                <i class="feather-users"></i>
                                <span>Total Volunteer</span>
                            </div>
                            <h4 class="fw-bolder mb-0">{{ number_format($totalVolunteer) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="hstack gap-2 mb-3">
                                <i class="feather-target"></i>
                                <span>Total Impact</span>
                            </div>
                            <h4 class="fw-bolder mb-0">{{ number_format($totalImpact) }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-8">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Grafik Project Report</h5>
                        </div>
                        <div class="card-body">
                            <div
                                id="project-report-chart"
                                data-categories='@json($projectReportChart["categories"])'
                                data-series='@json($projectReportChart["series"])'
                            ></div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Team Progress</h5>
                        </div>
                        <div class="card-body">
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
                                <div class="text-muted">Belum ada data aktivitas untuk ditampilkan.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</main>


@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var chartEl = document.getElementById('project-report-chart');
        if (!chartEl || !window.ApexCharts) {
            return;
        }

        var categories = JSON.parse(chartEl.getAttribute('data-categories') || '[]');
        var seriesData = JSON.parse(chartEl.getAttribute('data-series') || '[]');

        if (!categories.length) {
            chartEl.innerHTML = '<div class="text-muted p-4">Belum ada data program untuk ditampilkan.</div>';
            return;
        }

        var options = {
            chart: {
                type: 'bar',
                height: 320,
                toolbar: { show: false }
            },
            series: [{
                name: 'Aktivitas',
                data: seriesData
            }],
            xaxis: {
                categories: categories,
                labels: { rotate: -45 }
            },
            dataLabels: { enabled: false },
            colors: ['#4c6fff']
        };

        var chart = new ApexCharts(chartEl, options);
        chart.render();
    });
</script>
@endpush
@push('scripts')
<script src="{{ asset('assets/vendors/js/apexcharts.min.js') }}"></script>
@endpush


