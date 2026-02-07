@extends('layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Kolaborasi</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Kolaborasi</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <a href="{{ route('collaborations.create') }}" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>Tambah Kolaborasi
                </a>
            </div>
        </div>

        <div class="main-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card stretch stretch-full">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Program Kolaborasi</th>
                                    <th>Mitra</th>
                                    <th>Jenis</th>
                                    <th>Pilar</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($collaborations as $collaboration)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $collaboration->title }}</div>
                                            <div class="small text-muted">
                                                Program: {{ $collaboration->program->name ?? '-' }}
                                            </div>
                                        </td>
                                        <td>{{ $collaboration->partner_name }}</td>
                                        <td>{{ $collaboration->partner_type }}</td>
                                        <td>{{ $collaboration->pilar ? ucfirst($collaboration->pilar) : '-' }}</td>
                                        <td>
                                            <span class="badge bg-soft-secondary text-secondary">
                                                {{ ucfirst($collaboration->status) }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{ route('collaborations.show', $collaboration) }}" class="avatar-text avatar-md">
                                                    <i class="feather-eye"></i>
                                                </a>
                                                <a href="{{ route('collaborations.edit', $collaboration) }}" class="avatar-text avatar-md">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <form action="{{ route('collaborations.destroy', $collaboration) }}" method="POST"
                                                      onsubmit="return confirm('Hapus kolaborasi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="avatar-text avatar-md border-0 bg-transparent text-danger">
                                                        <i class="feather-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">Belum ada kolaborasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $collaborations->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
