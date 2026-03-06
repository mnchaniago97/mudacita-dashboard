@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Detail Recruitment</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sdm.recruitment.index') }}">Recruitment</a></li>
                        <li class="breadcrumb-item">Detail</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <a href="{{ route('sdm.recruitment.index') }}" class="btn btn-light">
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
                                                    <div>{{ $recruitment->name }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Email</div>
                                                    <div>{{ $recruitment->email }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Phone</div>
                                                    <div>{{ $recruitment->phone ?? '-' }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Divisi</div>
                                                    <div>{{ ucfirst($recruitment->divisi) }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Status</div>
                                                    <div>
                                                        @php
                                                            $badgeClass = match ($recruitment->status_recruitment) {
                                                                'accepted' => 'bg-success',
                                                                'rejected' => 'bg-danger',
                                                                default => 'bg-warning'
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $badgeClass }}">
                                                            {{ ucfirst($recruitment->status_recruitment) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Tanggal Lahir</div>
                                                    <div>{{ $recruitment->tanggal_lahir ?? '-' }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Jenis Kelamin</div>
                                                    <div>{{ $recruitment->jenis_kelamin ?? '-' }}</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fw-semibold">Pendidikan Terakhir</div>
                                                    <div>{{ $recruitment->pendidikan_terakhir ?? '-' }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="fw-semibold">Alamat Lengkap</div>
                                                    <div>{{ $recruitment->alamat_lengkap ?? '-' }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="fw-semibold">Motivasi</div>
                                                    <div>{{ $recruitment->motivasi ?? '-' }}</div>
                                                </div>
                                                @if ($recruitment->photo_path)
                                                <div class="col-12">
                                                    <div class="fw-semibold">Pas Foto</div>
                                                    <div>
                                                        <img src="{{ asset('storage/' . $recruitment->photo_path) }}" alt="Pas Foto" class="img-thumbnail" style="max-height: 200px;">
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($recruitment->screenshot_path)
                                                <div class="col-12">
                                                    <div class="fw-semibold">Screenshot Bukti</div>
                                                    <div class="d-flex gap-2 flex-wrap">
                                                        @php
                                                            $buktiFiles = is_array($recruitment->screenshot_path) ? $recruitment->screenshot_path : json_decode($recruitment->screenshot_path, true);
                                                        @endphp
                                                        @if($buktiFiles)
                                                            @foreach($buktiFiles as $file)
                                                                <img src="{{ asset('storage/' . $file) }}" alt="Screenshot Bukti" class="img-thumbnail" style="max-height: 150px;">
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($recruitment->cv_path)
                                                <div class="col-12">
                                                    <div class="fw-semibold">CV (Lampiran)</div>
                                                    <div>
                                                        <a href="{{ asset('storage/' . $recruitment->cv_path) }}" target="_blank" class="btn btn-sm btn-info">Lihat CV</a>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($recruitment->status_recruitment === 'rejected')
                                                    <div class="col-12">
                                                        <div class="fw-semibold">Alasan Penolakan</div>
                                                        <div>{{ $recruitment->rejection_reason ?? '-' }}</div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($recruitment->status_recruitment === 'pending')
                                    <div class="mt-4 d-flex gap-2">
                                        <form action="{{ route('sdm.recruitment.approve', $recruitment) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success">Terima</button>
                                        </form>
                                        <form action="{{ route('sdm.recruitment.reject', $recruitment) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger">Tolak</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

