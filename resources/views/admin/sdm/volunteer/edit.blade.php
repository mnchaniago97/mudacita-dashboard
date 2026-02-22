@extends('admin.layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">

        <div class="page-header mb-4">
            <h5>Edit Volunteer</h5>
        </div>
    <div class="row justify-content-center">
        <div class="col-xl-11 col-lg-9 col-md-10">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('sdm.volunteers.update', $volunteer->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $volunteer->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $volunteer->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $volunteer->phone) }}"
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status"
                                    class="form-control @error('status') is-invalid @enderror"
                                    required>
                                <option value="active" {{ old('status', $volunteer->status) == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="inactive" {{ old('status', $volunteer->status) == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('sdm.volunteers.index') }}" class="btn btn-light">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
        </div>
    </div>
    </div>
</main>
@endsection

