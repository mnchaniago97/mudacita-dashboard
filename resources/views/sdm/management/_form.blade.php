@php
    $isEdit = isset($management);
@endphp

<form
    action="{{ $isEdit
        ? route('sdm.management.update', $management->id)
        : route('sdm.management.store') }}"
    method="POST"
>
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input
                type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $management->name ?? '') }}"
                required
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $management->email ?? '') }}"
                required
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input
                type="text"
                name="phone"
                class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone', $management->phone ?? '') }}"
                required
            >
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Jabatan</label>
            <input
                type="text"
                name="jabatan"
                class="form-control @error('jabatan') is-invalid @enderror"
                value="{{ old('jabatan', $management->jabatan ?? '') }}"
                required
            >
            @error('jabatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Divisi</label>
            <select
                name="divisi"
                class="form-control @error('divisi') is-invalid @enderror"
                required
            >
                <option value="">-- Pilih Divisi --</option>
                @foreach (['program' => 'Program', 'riset' => 'Riset', 'media' => 'Media'] as $key => $label)
                    <option
                        value="{{ $key }}"
                        {{ old('divisi', $management->divisi ?? '') == $key ? 'selected' : '' }}
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('divisi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select
                name="status"
                class="form-control @error('status') is-invalid @enderror"
                required
            >
                <option value="">-- Pilih Status --</option>
                @foreach (['active' => 'Active', 'inactive' => 'Inactive'] as $key => $label)
                    <option
                        value="{{ $key }}"
                        {{ old('status', $management->status ?? '') == $key ? 'selected' : '' }}
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="{{ route('sdm.management.index') }}" class="btn btn-light">
            Batal
        </a>
        <button class="btn btn-primary">
            {{ $isEdit ? 'Update' : 'Simpan' }}
        </button>
    </div>

</form>
