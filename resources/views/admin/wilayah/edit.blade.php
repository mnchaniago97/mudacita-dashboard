@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header mb-4">
                <h5>Edit Lokasi</h5>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('wilayah.locations.update', $location) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Kota/Kabupaten</label>
                                    <input
                                        type="text"
                                        name="city"
                                        class="form-control @error('city') is-invalid @enderror"
                                        value="{{ old('city', $location->city ?? $location->name) }}"
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
                                        value="{{ old('province', $location->province) }}"
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
                                    >{{ old('detail', $location->detail) }}</textarea>
                                    @error('detail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mt-4 d-flex gap-2">
                                    <a href="{{ route('wilayah.locations.index') }}" class="btn btn-light">Kembali</a>
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

