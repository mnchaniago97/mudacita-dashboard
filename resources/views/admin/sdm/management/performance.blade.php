@extends('admin.layouts.app')

@section('content')
    @php
        $staffPerformance = collect($staffPerformance ?? []);
        $staffPerformanceRows = collect($staffPerformanceRows ?? []);
        $managementList = $managementList ?? collect();
        $roleName = auth()->check() ? (auth()->user()->role->name ?? null) : null;
        $roleNormalized = $roleName ? preg_replace('/[^a-z0-9]/', '', strtolower($roleName)) : null;
        $isSuperAdmin = $roleNormalized === 'superadmin';
        $totalStaff = $managementList->count();
        $avgIndex = $totalStaff ? round($staffPerformance->avg('total_score') / 10, 2) : 0;
        $successfulPrograms = $staffPerformance->sum('programs_success');

        $chartLabels = $staffPerformance->pluck('name');
        $chartAverage = $staffPerformance->map(function ($row) {
            return round(($row['total_score'] ?? 0) / 10, 2);
        });

        $indicatorLabels = [
            'Perencanaan',
            'Pelaksanaan',
            'Kualitas',
            'Inovasi',
            'Evaluasi',
            'Analisis',
            'Kolaborasi',
            'Kepemimpinan',
            'Etika',
            'Dampak',
        ];

        $indicatorAverages = [
            round($staffPerformanceRows->avg('perencanaan') ?? 0, 2),
            round($staffPerformanceRows->avg('pelaksanaan') ?? 0, 2),
            round($staffPerformanceRows->avg('kualitas') ?? 0, 2),
            round($staffPerformanceRows->avg('inovasi') ?? 0, 2),
            round($staffPerformanceRows->avg('evaluasi') ?? 0, 2),
            round($staffPerformanceRows->avg('analisis') ?? 0, 2),
            round($staffPerformanceRows->avg('kolaborasi') ?? 0, 2),
            round($staffPerformanceRows->avg('kepemimpinan') ?? 0, 2),
            round($staffPerformanceRows->avg('etika') ?? 0, 2),
            round($staffPerformanceRows->avg('dampak') ?? 0, 2),
        ];

        $topStaffAggregate = $staffPerformanceRows
            ->groupBy('name')
            ->map(function ($rows, $name) {
                $totalScore = $rows->sum('total_score');
                $avgScore = $rows->count() ? round($totalScore / ($rows->count() * 10), 2) : 0;

                return [
                    'name' => $name,
                    'total' => $totalScore,
                    'average' => $avgScore,
                ];
            })
            ->sortByDesc('total')
            ->take(5)
            ->values();

        $topStaffLabels = $topStaffAggregate->pluck('name');
        $topStaffTotals = $topStaffAggregate->pluck('total');
        $topStaffAverages = $topStaffAggregate->pluck('average');
    @endphp

    <main class="nxl-container">
        <style>
            .performance-charts {
                display: grid;
                gap: 1rem;
                height: 100%;
            }
            .performance-chart-card {
                height: auto;
                min-height: clamp(220px, 28vh, 300px);
            }
            .performance-chart-body {
                height: clamp(180px, 24vh, 260px);
            }
            @media (max-width: 991.98px) {
                .performance-chart-card {
                    min-height: 220px;
                }
                .performance-chart-body {
                    height: 220px;
                }
            }
        </style>
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Kinerja Pengurus</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">SDM</li>
                        <li class="breadcrumb-item">Kinerja Pengurus</li>
                    </ul>
                </div>
            </div>

            <div class="main-content">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">{{ session('warning') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="card stretch stretch-full h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-muted small">Total Pengurus</div>
                                        <div class="h4 mb-0">{{ $totalStaff }}</div>
                                    </div>
                                    <div class="avatar-text avatar-lg bg-primary text-white">
                                        <i class="feather-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card stretch stretch-full h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-muted small">Indeks Kinerja Rata-rata</div>
                                        <div class="h4 mb-0">{{ $avgIndex }}</div>
                                    </div>
                                    <div class="avatar-text avatar-lg bg-success text-white">
                                        <i class="feather-activity"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card stretch stretch-full h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-muted small">Jumlah Program Berhasil</div>
                                        <div class="h4 mb-0">{{ $successfulPrograms }}</div>
                                    </div>
                                    <div class="avatar-text avatar-lg bg-warning text-white">
                                        <i class="feather-award"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1 align-items-stretch">
                    <div class="col-12 col-lg-8">
                        <div id="performance-charts" class="performance-charts">
                            <div class="card stretch stretch-full d-flex flex-column performance-chart-card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Grafik Rata-rata 10 Indikator</h6>
                            </div>
                            <div class="card-body performance-chart-body">
                                <div class="w-100 h-100">
                                    <canvas id="indicatorAverageChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="card stretch stretch-full d-flex flex-column performance-chart-card pb-2">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Pengurus Terbaik (Skor Total & Rata-rata)</h6>
                            </div>
                            <div class="card-body performance-chart-body">
                                <div class="w-100 h-100">
                                    <canvas id="topStaffChart"></canvas>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="h-100">
                            @if ($isSuperAdmin)
                                @include('admin.sdm.management._performance-form')
                            @else
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Input Skor Kinerja</h6>
                                        <div class="text-muted small">Hanya untuk super admin</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-warning mb-0">
                                            Anda tidak memiliki akses untuk mengisi penilaian.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h6 class="card-title mb-0">Tabel Kinerja Per Individu</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th class="text-center">Perencanaan</th>
                                                <th class="text-center">Pelaksanaan</th>
                                                <th class="text-center">Kualitas</th>
                                                <th class="text-center">Inovasi</th>
                                                <th class="text-center">Evaluasi</th>
                                                <th class="text-center">Analisis</th>
                                                <th class="text-center">Kolaborasi</th>
                                                <th class="text-center">Kepemimpinan</th>
                                                <th class="text-center">Etika</th>
                                                <th class="text-center">Dampak</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Aksi</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($staffPerformanceRows as $staff)
                                                <tr>
                                                    <td>{{ $staff['name'] }}</td>
                                                    <td>{{ $staff['position'] }}</td>
                                                    <td class="text-center">{{ $staff['perencanaan'] }}</td>
                                                    <td class="text-center">{{ $staff['pelaksanaan'] }}</td>
                                                    <td class="text-center">{{ $staff['kualitas'] }}</td>
                                                    <td class="text-center">{{ $staff['inovasi'] }}</td>
                                                    <td class="text-center">{{ $staff['evaluasi'] }}</td>
                                                    <td class="text-center">{{ $staff['analisis'] }}</td>
                                                    <td class="text-center">{{ $staff['kolaborasi'] }}</td>
                                                    <td class="text-center">{{ $staff['kepemimpinan'] }}</td>
                                                    <td class="text-center">{{ $staff['etika'] }}</td>
                                                    <td class="text-center">{{ $staff['dampak'] }}</td>
                                                    <td class="text-center fw-semibold">{{ $staff['total_score'] }}</td>
                                                    <td class="text-center">
                                                        @if (!empty($staff['id']) && $isSuperAdmin)
                                                            <div class="hstack gap-2 justify-content-center">
                                                                <a href="{{ route('sdm.management-performance.edit', $staff['id']) }}" class="avatar-text avatar-md">
                                                                    <i class="feather-edit"></i>
                                                                </a>
                                                                <form method="POST" action="{{ route('sdm.management-performance.destroy', $staff['id']) }}"
                                                                    onsubmit="return confirm('Hapus skor kinerja ini?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="avatar-text avatar-md border-0 bg-transparent text-danger">
                                                                        <i class="feather-trash-2"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="14" class="text-center text-muted py-4">
                                                        Belum ada data penilaian.
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const indicatorCanvas = document.getElementById('indicatorAverageChart');
            if (indicatorCanvas) {
                const indicatorLabels = @json($indicatorLabels);
                const indicatorAverages = @json($indicatorAverages);

                new Chart(indicatorCanvas, {
                    type: 'bar',
                    data: {
                        labels: indicatorLabels,
                        datasets: [
                            {
                                label: 'Rata-rata (1-4)',
                                data: indicatorAverages,
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 4,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            const topStaffCanvas = document.getElementById('topStaffChart');
            if (topStaffCanvas) {
                const topStaffLabels = @json($topStaffLabels);
                const topStaffTotals = @json($topStaffTotals);
                const topStaffAverages = @json($topStaffAverages);

                new Chart(topStaffCanvas, {
                    type: 'bar',
                    data: {
                        labels: topStaffLabels,
                        datasets: [
                            {
                                label: 'Skor Total',
                                data: topStaffTotals,
                                backgroundColor: 'rgba(255, 159, 64, 0.7)',
                                borderColor: 'rgba(255, 159, 64, 1)',
                                borderWidth: 1,
                                yAxisID: 'yTotal'
                            },
                            {
                                label: 'Rata-rata (1-4)',
                                data: topStaffAverages,
                                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                yAxisID: 'yAverage'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yTotal: {
                                beginAtZero: true,
                                max: 200,
                                position: 'left',
                                ticks: {
                                    stepSize: 20
                                }
                            },
                            yAverage: {
                                beginAtZero: true,
                                max: 4,
                                position: 'right',
                                grid: {
                                    drawOnChartArea: false
                                },
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

        });
    </script>
@endpush

