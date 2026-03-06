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

        @if ($isEdit && $recruitment->photo_path)
        <div class="col-12">
            <label class="form-label">Pas Foto Saat Ini</label>
            <div>
                <img src="{{ asset('storage/' . $recruitment->photo_path) }}" alt="Pas Foto" class="img-thumbnail" style="max-height: 200px;">
            </div>
        </div>
        @endif

        <div class="col-md-6">
            <label class="form-label">Pas Foto</label>
            <input
                type="file"
                name="pas_foto"
                class="form-control @error('pas_foto') is-invalid @enderror"
                accept="image/*"
            >
            <small class="text-muted">Format: JPG, PNG (max 2MB)</small>
            @error('pas_foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if ($isEdit && $recruitment->screenshot_path)
        <div class="col-12">
            <label class="form-label">Screenshot Bukti Saat Ini</label>
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

        <div class="col-md-6">
            <label class="form-label">Screenshot Bukti</label>
            <input
                type="file"
                name="screenshot_bukti[]"
                class="form-control @error('screenshot_bukti') is-invalid @enderror"
                accept="image/*"
                multiple
            >
            <small class="text-muted">Screenshot follow IG dan share post (bisa lebih dari 1)</small>
            @error('screenshot_bukti')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if ($isEdit && $recruitment->cv_path)
        <div class="col-12">
            <label class="form-label">CV Saat Ini</label>
            <div>
                <a href="{{ asset('storage/' . $recruitment->cv_path) }}" target="_blank" class="btn btn-sm btn-info">Lihat CV</a>
            </div>
        </div>
        @endif

        <div class="col-md-6">
            <label class="form-label">CV (Lampiran)</label>
            <input
                type="file"
                name="cv"
                class="form-control @error('cv') is-invalid @enderror"
                accept=".pdf,.doc,.docx"
            >
            <small class="text-muted">Format: PDF, DOC, DOCX (max 5MB)</small>
            @error('cv')
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

