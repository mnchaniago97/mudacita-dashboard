@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Detail Management</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sdm.management.index') }}">Management</a></li>
                        <li class="breadcrumb-item">Detail</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <a href="{{ route('sdm.management.index') }}" class="btn btn-light">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="p-3 border rounded h-100">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Nama</div>
                                                    <div>{{ $management->name }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Email</div>
                                                    <div>{{ $management->email }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Phone</div>
                                                    <div>{{ $management->phone ?? '-' }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Jabatan</div>
                                                    <div>{{ $management->jabatan }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Divisi</div>
                                                    <div>
                                                        <span class="badge bg-info">
                                                            {{ ucfirst($management->divisi) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Status</div>
                                                    <div>
                                                        <span class="badge {{ $management->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                                            {{ ucfirst($management->status) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Tanggal Bergabung</div>
                                                    <div>{{ $management->joined_at ? \Carbon\Carbon::parse($management->joined_at)->format('d/m/Y') : '-' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 d-flex gap-2">
                                    <a href="{{ route('sdm.management.edit', $management) }}" class="btn btn-primary">
                                        <i class="feather-edit me-2"></i>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
