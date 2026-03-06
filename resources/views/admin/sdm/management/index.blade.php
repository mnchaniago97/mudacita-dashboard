@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Management</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Management</li>
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
                            
                            <a href="{{ route('sdm.management.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                Tambah Management
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
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="customerList">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Management</th>
                                                <th>Divisi</th>
                                                <th>Jabatan</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                            </thead>

                                       <tbody>
                                        @forelse ($managements as $index => $item)
                                        <tr>
                                            <td>{{ $managements->firstItem() + $index }}</td>

                                            <td>
                                                <div class="hstack gap-3">
                                                    <div class="avatar-text avatar-md bg-primary text-white">
                                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $item->name }}</div>
                                                        <small class="text-muted">{{ $item->email }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge bg-info">
                                                    {{ ucfirst($item->divisi) }}
                                                </span>
                                            </td>

                                            <td>{{ $item->jabatan }}</td>

                                            <td>{{ $item->phone ?? '-' }}</td>

                                            <td>
                                                <span class="badge {{ $item->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>

                                            <td class="text-end">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('sdm.management.show', $item) }}" class="avatar-text avatar-md" title="Detail">
                                                        <i class="feather-eye"></i>
                                                    </a>

                                                    <a href="{{ route('sdm.management.edit', $item) }}" class="avatar-text avatar-md">
                                                        <i class="feather-edit"></i>
                                                    </a>

                                                    <form action="{{ route('sdm.management.destroy', $item) }}" method="POST"
                                                        onsubmit="return confirm('Yakin hapus management ini?')">
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
                                            <td colspan="7" class="text-center text-muted py-4">
                                                Belum ada data management
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

