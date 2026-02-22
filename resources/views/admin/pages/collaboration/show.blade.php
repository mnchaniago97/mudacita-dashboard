@extends('admin.layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Detail Kolaborasi</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('collaborations.index') }}">Kolaborasi</a></li>
                    <li class="breadcrumb-item">Detail</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="text-muted small">Program Kolaborasi</div>
                            <div class="fw-semibold">{{ $collaboration->title }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Mitra</div>
                            <div class="fw-semibold">{{ $collaboration->partner_name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Jenis Mitra</div>
                            <div class="fw-semibold">{{ $collaboration->partner_type }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Pilar</div>
                            <div class="fw-semibold">{{ $collaboration->pilar ? ucfirst($collaboration->pilar) : '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Program Terkait</div>
                            <div class="fw-semibold">{{ $collaboration->program->name ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Status</div>
                            <div class="fw-semibold">{{ ucfirst($collaboration->status) }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Periode</div>
                            <div class="fw-semibold">
                                {{ $collaboration->start_date ?? '-' }} - {{ $collaboration->end_date ?? '-' }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">PIC</div>
                            <div class="fw-semibold">{{ $collaboration->pic_name ?? '-' }} {{ $collaboration->pic_phone ? '(' . $collaboration->pic_phone . ')' : '' }}</div>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Deskripsi</div>
                            <div class="fw-semibold">{{ $collaboration->description ?? '-' }}</div>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Dokumentasi</div>
                            <div class="fw-semibold">{{ $collaboration->documentation_url ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('collaborations.index') }}" class="btn btn-light">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

