@php
    $isEdit = isset($recruitment);
@endphp

<form
    action="{{ $isEdit
        ? route('sdm.recruitment.update', $recruitment->id)
        : route('sdm.recruitment.store') }}"
    method="POST"
    enctype="multipart/form-data"
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
                value="{{ old('name', $recruitment->name ?? '') }}"
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
                value="{{ old('email', $recruitment->email ?? '') }}"
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
                value="{{ old('phone', $recruitment->phone ?? '') }}"
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
                value="{{ old('jabatan', $recruitment->jabatan ?? '') }}"
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
                        {{ old('divisi', $recruitment->divisi ?? '') == $key ? 'selected' : '' }}
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
            <label class="form-label">Tanggal Lahir</label>
            <input
                type="date"
                name="tanggal_lahir"
                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                value="{{ old('tanggal_lahir', $recruitment->tanggal_lahir ?? '') }}"
            >
            @error('tanggal_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Jenis Kelamin</label>
            <select
                name="jenis_kelamin"
                class="form-control @error('jenis_kelamin') is-invalid @enderror"
            >
                <option value="">-- Pilih Jenis Kelamin --</option>
                @foreach (['laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan'] as $key => $label)
                    <option
                        value="{{ $key }}"
                        {{ old('jenis_kelamin', $recruitment->jenis_kelamin ?? '') == $key ? 'selected' : '' }}
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Pendidikan Terakhir</label>
            <input
                type="text"
                name="pendidikan_terakhir"
                class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                value="{{ old('pendidikan_terakhir', $recruitment->pendidikan_terakhir ?? '') }}"
            >
            @error('pendidikan_terakhir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Alamat Lengkap</label>
            <textarea
                name="alamat_lengkap"
                class="form-control @error('alamat_lengkap') is-invalid @enderror"
                rows="3"
            >{{ old('alamat_lengkap', $recruitment->alamat_lengkap ?? '') }}</textarea>
            @error('alamat_lengkap')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Motivasi</label>
            <textarea
                name="motivasi"
                class="form-control @error('motivasi') is-invalid @enderror"
                rows="3"
            >{{ old('motivasi', $recruitment->motivasi ?? '') }}</textarea>
            @error('motivasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="{{ route('sdm.recruitment.index') }}" class="btn btn-light">
            Batal
        </a>
        <button class="btn btn-primary">
            {{ $isEdit ? 'Update' : 'Simpan' }}
        </button>
    </div>
</form>

