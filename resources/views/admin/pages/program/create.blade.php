@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header mb-4">
                <h5>Tambah Program</h5>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('pilar.store') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Program</label>
                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}"
                                            required
                                        >
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pilar</label>
                                        <select
                                            name="pilar"
                                            class="form-control @error('pilar') is-invalid @enderror"
                                            required
                                        >
                                            <option value="">-- Pilih Pilar --</option>
                                            @foreach (['pendidikan' => 'Pendidikan', 'sosial' => 'Sosial', 'lingkungan' => 'Lingkungan'] as $key => $label)
                                                <option value="{{ $key }}" {{ old('pilar') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pilar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea
                                            name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            rows="4"
                                        >{{ old('description') }}</textarea>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mt-4 d-flex gap-2">
                                    <a href="{{ url()->previous() }}" class="btn btn-light">Kembali</a>
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

