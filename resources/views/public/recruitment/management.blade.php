<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar Management | Mudacita</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
</head>

<body class="bg-light">
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logomci2.png') }}" alt="Mudacita" class="img-fluid" style="max-height: 80px;">
                        <h4 class="mt-3">Form Pendaftaran Management</h4>
                        <p class="text-muted mb-0">Lengkapi data di bawah ini untuk mendaftar.</p>
                    </div>

                    <form method="POST" action="{{ route('public.recruitment.management.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama</label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Contoh: Aulia Rahman"
                                    required
                                >
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@email.com"
                                    required
                                >
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}"
                                    placeholder="08xxxxxxxxxx"
                                >
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                        <option value="{{ $key }}" {{ old('divisi') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('divisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input
                                    type="date"
                                    name="tanggal_lahir"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir') }}"
                                    placeholder="YYYY-MM-DD"
                                >
                                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select
                                    name="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                >
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    @foreach (['laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan'] as $key => $label)
                                        <option value="{{ $key }}" {{ old('jenis_kelamin') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pendidikan Terakhir</label>
                                <input
                                    type="text"
                                    name="pendidikan_terakhir"
                                    class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                    value="{{ old('pendidikan_terakhir') }}"
                                    placeholder="Contoh: S1 Manajemen"
                                >
                                @error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea
                                    name="alamat_lengkap"
                                    class="form-control @error('alamat_lengkap') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Jalan, kelurahan, kecamatan, kota/kab, provinsi"
                                >{{ old('alamat_lengkap') }}</textarea>
                                @error('alamat_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Motivasi</label>
                                <textarea
                                    name="motivasi"
                                    class="form-control @error('motivasi') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Jelaskan alasan ingin bergabung"
                                >{{ old('motivasi') }}</textarea>
                                @error('motivasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pas Foto</label>
                                <input
                                    type="file"
                                    name="pas_foto"
                                    class="form-control @error('pas_foto') is-invalid @enderror"
                                    accept="image/*"
                                >
                                <small class="text-muted">Format: JPG, PNG (max 2MB)</small>
                                @error('pas_foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

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
                                @error('screenshot_bukti')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">CV</label>
                                <input
                                    type="file"
                                    name="cv"
                                    class="form-control @error('cv') is-invalid @enderror"
                                    accept=".pdf,.doc,.docx"
                                >
                                <small class="text-muted">Format: PDF, DOC, DOCX (max 5MB)</small>
                                @error('cv')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <a href="{{ route('home') }}" class="btn btn-light">Kembali</a>
                            <button class="btn btn-primary">Kirim Pendaftaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
