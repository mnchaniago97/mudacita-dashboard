@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Kinerja Pengurus</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">SDM</li>
                        <li class="breadcrumb-item">Kinerja Pengurus</li>
                        <li class="breadcrumb-item">Edit</li>
                    </ul>
                </div>
            </div>

            <div class="main-content">
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        @include('sdm.management._performance-form', [
                            'formAction' => route('sdm.management-performance.update', $staffPerformance),
                            'formMethod' => 'PUT',
                            'submitLabel' => 'Update Skor',
                            'formTitle' => 'Edit Skor Kinerja',
                            'performance' => $staffPerformance
                        ])
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

