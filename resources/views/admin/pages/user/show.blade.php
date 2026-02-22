@extends('admin.layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Detail User</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                    <li class="breadcrumb-item">Detail</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card stretch stretch-full">
                        <div class="card-body text-center">
                            <div class="avatar-text avatar-xxl bg-primary text-white mx-auto mb-3">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <div class="text-muted">{{ $user->email }}</div>
                            <div class="mt-3">
                                <span class="badge bg-soft-primary text-primary">
                                    {{ $user->role->name ?? '-' }}
                                </span>
                                <span class="badge bg-soft-secondary text-secondary ms-2">
                                    {{ ucfirst($user->status ?? 'active') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Informasi Akun</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="text-muted small">Nama</div>
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted small">Email</div>
                                    <div class="fw-semibold">{{ $user->email }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted small">Role</div>
                                    <div class="fw-semibold">{{ $user->role->name ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted small">Status</div>
                                    <div class="fw-semibold">{{ ucfirst($user->status ?? 'active') }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted small">Dibuat</div>
                                    <div class="fw-semibold">{{ $user->created_at?->format('Y-m-d H:i') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="{{ route('users.index') }}" class="btn btn-light">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

