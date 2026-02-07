@extends('layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Volunteer Recruitment</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Volunteer Recruitment</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <a href="{{ route('sdm.volunteer-recruitment.create') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        Tambah Volunteer Recruitment
                    </a>
                </div>
            </div>

            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Minat</th>
                                                <th>Komitmen</th>
                                                <th>Status</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($volunteerRecruitments as $index => $item)
                                                <tr>
                                                    <td>{{ $volunteerRecruitments->firstItem() + $index }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->minat ?? '-' }}</td>
                                                    <td>{{ $item->komitmen ?? '-' }}</td>
                                                    <td>
                                                        @php
                                                            $badgeClass = match ($item->status_recruitment) {
                                                                'accepted' => 'bg-success',
                                                                'rejected' => 'bg-danger',
                                                                default => 'bg-warning'
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $badgeClass }}">
                                                            {{ ucfirst($item->status_recruitment) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <a href="{{ route('sdm.volunteer-recruitment.show', $item) }}"
                                                               class="avatar-text avatar-md">
                                                                <i class="feather-eye"></i>
                                                            </a>
                                                            <a href="{{ route('sdm.volunteer-recruitment.edit', $item) }}"
                                                               class="avatar-text avatar-md">
                                                                <i class="feather-edit"></i>
                                                            </a>
                                                            <form action="{{ route('sdm.volunteer-recruitment.destroy', $item) }}"
                                                                  method="POST"
                                                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="avatar-text avatar-md border-0 bg-transparent text-danger">
                                                                    <i class="feather-trash-2"></i>
                                                                </button>
                                                            </form>

                                                            @if ($item->status_recruitment === 'pending')
                                                                <form action="{{ route('sdm.volunteer-recruitment.approve', $item) }}"
                                                                      method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-success">
                                                                        Terima
                                                                    </button>
                                                                </form>
                                                                <form action="{{ route('sdm.volunteer-recruitment.reject', $item) }}"
                                                                      method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger">
                                                                        Tolak
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted py-4">
                                                        Belum ada data volunteer recruitment
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
