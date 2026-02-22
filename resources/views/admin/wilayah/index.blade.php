@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Wilayah</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Wilayah</li>
                    </ul>
                </div>
            </div>

            <div class="main-content">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <h6 class="mb-3">Tambah Lokasi</h6>
                                <form method="POST" action="{{ route('wilayah.locations.store') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Kota/Kabupaten</label>
                                        <input
                                            type="text"
                                            name="city"
                                            class="form-control @error('city') is-invalid @enderror"
                                            value="{{ old('city') }}"
                                            required
                                        >
                                        @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Provinsi</label>
                                        <input
                                            type="text"
                                            name="province"
                                            class="form-control @error('province') is-invalid @enderror"
                                            value="{{ old('province') }}"
                                            required
                                        >
                                        @error('province')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Detail Lokasi</label>
                                        <textarea
                                            name="detail"
                                            class="form-control @error('detail') is-invalid @enderror"
                                            rows="3"
                                        >{{ old('detail') }}</textarea>
                                        @error('detail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <button class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card stretch stretch-full">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kota/Kabupaten</th>
                                                <th>Provinsi</th>
                                                <th>Detail</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($locations as $index => $location)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $location->city ?? $location->name }}</td>
                                                    <td>{{ $location->province ?? '-' }}</td>
                                                    <td>{{ $location->detail ?? '-' }}</td>
                                                    <td class="text-end">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <a href="{{ route('wilayah.locations.edit', $location) }}"
                                                               class="avatar-text avatar-md">
                                                                <i class="feather-edit"></i>
                                                            </a>
                                                            <form action="{{ route('wilayah.locations.destroy', $location) }}"
                                                                  method="POST"
                                                                  onsubmit="return confirm('Yakin hapus lokasi ini?')">
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
                                                    <td colspan="5" class="text-center text-muted py-4">
                                                        Belum ada lokasi
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

