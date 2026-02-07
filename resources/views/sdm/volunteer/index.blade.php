@extends('layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Volunteer</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Volunteer</li>
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
                            <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                <i class="feather-bar-chart"></i>
                            </a>
                           
                            <a href="{{ route('sdm.volunteers.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                Tambah Volunteer
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
            <div id="collapseOne" class="accordion-collapse collapse page-header-collapse">
                <div class="accordion-body pb-2">
                    <div class="row">
                  
                         <!-- [Mini Card] start -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card card-body bg-primary text-white position-relative">
                            <h3 class="text-reset">{{ number_format($totalVolunteer) }}</h3>
                            <span class="mt-2">Total Volunteer</span>
                            <div class="position-absolute top-50 end-0 translate-middle">
                                <i class="feather-users fs-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card card-body bg-teal text-white position-relative">
                            <h3 class="text-reset">{{ number_format($activeVolunteer) }}</h3>
                            <span class="mt-2">Volunteer Aktif</span>
                            <div class="position-absolute top-50 end-0 translate-middle">
                                <i class="feather-user-check fs-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card card-body bg-indigo text-white position-relative">
                            <h3 class="text-reset">{{ number_format($newVolunteer) }}</h3>
                            <span class="mt-2">Volunteer Baru</span>
                            <div class="position-absolute top-50 end-0 translate-middle">
                                <i class="feather-user-plus fs-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card card-body bg-danger text-white position-relative">
                            <h3 class="text-reset">{{ number_format($newVolunteer) }}</h3>
                            <span class="mt-2">Volunteer Tidak Aktif</span>
                            <div class="position-absolute top-50 end-0 translate-middle">
                                <i class="feather-user-minus fs-1"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- [Mini Card] end -->
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
                                                <th class="wd-30">
                                                    <div class="btn-group mb-1">
                                                        <div class="custom-control custom-checkbox ms-1">
                                                            <input type="checkbox" class="custom-control-input" id="checkAllCustomer">
                                                            <label class="custom-control-label" for="checkAllCustomer"></label>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th>Volunteer</th>
                                                <th>Email</th>                              
                                                <th>Phone</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($volunteers as $volunteer)
                                        <tr class="single-item">
                                            <td>
                                                <input type="checkbox">
                                            </td>

                                            <td>
                                                <div class="hstack gap-3">
                                                    <div class="avatar-text avatar-md bg-primary text-white">
                                                        {{ strtoupper(substr($volunteer->name, 0, 1)) }}
                                                    </div>
                                                    <div>{{ $volunteer->name }}</div>
                                                </div>
                                            </td>

                                            <td>{{ $volunteer->email }}</td>
                                            <td>{{ $volunteer->phone }}</td>
                                            <td>{{ $volunteer->created_at->format('Y-m-d') }}</td>

                                            <td>
                                                <span class="badge {{ $volunteer->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($volunteer->status) }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('sdm.volunteers.edit', $volunteer) }}" class="avatar-text avatar-md">
                                                        <i class="feather-edit"></i>
                                                    </a>

                                                    <form action="{{ route('sdm.volunteers.destroy', $volunteer) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="avatar-text avatar-md border-0 bg-transparent">
                                                            <i class="feather-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
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
