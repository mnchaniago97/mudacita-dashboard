@php
    $isEdit = isset($volunteerRecruitment);
@endphp

<form
    action="{{ $isEdit
        ? route('sdm.volunteer-recruitment.update', $volunteerRecruitment->id)
        : route('sdm.volunteer-recruitment.store') }}"
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
                value="{{ old('name', $volunteerRecruitment->name ?? '') }}"
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
                value="{{ old('email', $volunteerRecruitment->email ?? '') }}"
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
                value="{{ old('phone', $volunteerRecruitment->phone ?? '') }}"
            >
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Tanggal Lahir</label>
            <input
                type="date"
                name="tanggal_lahir"
                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                value="{{ old('tanggal_lahir', $volunteerRecruitment->tanggal_lahir ?? '') }}"
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
                        {{ old('jenis_kelamin', $volunteerRecruitment->jenis_kelamin ?? '') == $key ? 'selected' : '' }}
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
                value="{{ old('pendidikan_terakhir', $volunteerRecruitment->pendidikan_terakhir ?? '') }}"
            >
            @error('pendidikan_terakhir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Minat</label>
            <input
                type="text"
                name="minat"
                class="form-control @error('minat') is-invalid @enderror"
                value="{{ old('minat', $volunteerRecruitment->minat ?? '') }}"
            >
            @error('minat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Komitmen</label>
            <input
                type="text"
                name="komitmen"
                class="form-control @error('komitmen') is-invalid @enderror"
                value="{{ old('komitmen', $volunteerRecruitment->komitmen ?? '') }}"
            >
            @error('komitmen')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Skill</label>
            <textarea
                name="skill"
                class="form-control @error('skill') is-invalid @enderror"
                rows="3"
            >{{ old('skill', $volunteerRecruitment->skill ?? '') }}</textarea>
            @error('skill')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Alamat Lengkap</label>
            <textarea
                name="alamat_lengkap"
                class="form-control @error('alamat_lengkap') is-invalid @enderror"
                rows="3"
            >{{ old('alamat_lengkap', $volunteerRecruitment->alamat_lengkap ?? '') }}</textarea>
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
            >{{ old('motivasi', $volunteerRecruitment->motivasi ?? '') }}</textarea>
            @error('motivasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Harapan</label>
            <textarea
                name="harapan"
                class="form-control @error('harapan') is-invalid @enderror"
                rows="3"
            >{{ old('harapan', $volunteerRecruitment->harapan ?? '') }}</textarea>
            @error('harapan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="{{ route('sdm.volunteer-recruitment.index') }}" class="btn btn-light">
            Batal
        </a>
        <button class="btn btn-primary">
            {{ $isEdit ? 'Update' : 'Simpan' }}
        </button>
    </div>
</form>

