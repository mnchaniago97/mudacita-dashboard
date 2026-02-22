@extends('admin.layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Settings</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            @if (session('success'))
                <div class="border border-success bg-white text-success p-3 rounded mb-3">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="border border-danger bg-white text-danger p-3 rounded mb-3">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="border border-danger bg-white text-danger p-3 rounded mb-3">
                    <div class="fw-bold mb-1">Gagal menyimpan:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-lg-4">
                            <div class="d-flex align-items-center gap-3">
                                @php
                                    $logoPath = optional($settings)->org_logo_path;
                                @endphp
                                @php
                                    $logoUrl = $logoPath
                                        ? (str_starts_with($logoPath, 'assets/') ? asset($logoPath) : asset('storage/' . $logoPath))
                                        : asset('assets/images/logomci2.png');
                                @endphp
                                <img id="settingsLogoPreview"
                                     src="{{ $logoUrl }}"
                                     alt="Logo"
                                     class="img-fluid rounded"
                                     style="max-height: 64px;">
                                <div>
                                    <div class="fw-bold" id="settingsNamePreview">{{ $settings->org_name ?? 'Mudacita' }}</div>
                                    <div class="text-muted small mt-1">
                                        <div id="settingsEmailPreview">{{ $settings->org_email ?? '-' }}</div>
                                        <div id="settingsPhonePreview">HP: {{ $settings->org_phone ?? '-' }}</div>
                                        <div id="settingsAddressPreview">Alamat: {{ $settings->org_address ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                                <span class="badge bg-soft-primary text-primary">
                                    Timezone: {{ $settings->timezone ?? 'Asia/Jakarta' }}
                                </span>
                                <span class="badge bg-soft-secondary text-secondary">
                                    Locale: {{ $settings->locale ?? 'id' }}
                                </span>
                                <span class="badge {{ $settings->whatsapp_enabled ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger' }}">
                                    WA: {{ $settings->whatsapp_enabled ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-muted small"></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-org" type="button" role="tab">
                                Profil Organisasi
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-home" type="button" role="tab">
                                Home
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-account" type="button" role="tab">
                                Akun
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-notif" type="button" role="tab">
                                Notifikasi WA
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-system" type="button" role="tab">
                                Sistem
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content pb-5">
                        <div class="tab-pane fade show active" id="tab-org" role="tabpanel">
                            <form action="{{ route('settings.organization') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Nama Organisasi</label>
                                        <input type="text" name="org_name" class="form-control" required id="orgNameInput"
                                            value="{{ old('org_name', $settings->org_name) }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" name="org_email" class="form-control" id="orgEmailInput"
                                            value="{{ old('org_email', $settings->org_email) }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">No. HP</label>
                                        <input type="text" name="org_phone" class="form-control" id="orgPhoneInput"
                                            value="{{ old('org_phone', $settings->org_phone) }}">
                                    </div>
                                    <div class="col-12 mb-3"></div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold">Alamat</label>
                                        <textarea name="org_address" class="form-control" rows="3" id="orgAddressInput">{{ old('org_address', $settings->org_address) }}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="tab-home" role="tabpanel">
                            <form action="{{ route('settings.home') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Judul Hero</label>
                                        <input type="text" name="hero_title" class="form-control" required
                                               value="{{ old('hero_title', $settings->hero_title ?? 'Inspirasi Muda, Cita Untuk Indonesia') }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Subjudul</label>
                                        <input type="text" name="hero_subtitle" class="form-control"
                                               value="{{ old('hero_subtitle', $settings->hero_subtitle ?? 'Ayo Bersama Untuk Indonesia') }}">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold">Deskripsi</label>
                                        <textarea name="hero_description" class="form-control" rows="3"
                                                  placeholder="Tuliskan deskripsi singkat...">{{ old('hero_description', $settings->hero_description ?? 'Muda Cita Indonesia hadir untuk menciptakan perubahan nyata melalui kolaborasi dan aksi bersama. Mari wujudkan masa depan yang lebih baik untuk generasi muda Indonesia.') }}</textarea>
                                    </div>
                                    <div class="col-12 mb-3"></div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Tombol</label>
                                        <div class="small text-muted">
                                            Tombol tetap menggunakan: Daftar Management, Daftar Volunteer, Login Admin.
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="tab-account" role="tabpanel">
                            <form action="{{ route('settings.account') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Nama</label>
                                        <input type="text" name="name" class="form-control" required
                                            value="{{ old('name', $user->name) }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" name="email" class="form-control" required
                                            value="{{ old('email', $user->email) }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Password Baru</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Kosongkan jika tidak diganti">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="tab-notif" role="tabpanel">
                            <form action="{{ route('settings.notification') }}" method="POST">
                                @csrf
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="whatsappEnabled"
                                        name="whatsapp_enabled" value="1"
                                        @checked(old('whatsapp_enabled', $settings->whatsapp_enabled))>
                                    <label class="form-check-label" for="whatsappEnabled">Aktifkan Notifikasi</label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Fonnte Token</label>
                                    <input type="text" name="whatsapp_token" class="form-control"
                                        value="{{ old('whatsapp_token', $settings->whatsapp_token) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Fonnte URL</label>
                                    <input type="text" name="whatsapp_url" class="form-control"
                                        value="{{ old('whatsapp_url', $settings->whatsapp_url ?? config('services.fonnte.url')) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Template Pesan</label>
                                    <textarea name="whatsapp_template" class="form-control" rows="4"
                                        placeholder="Contoh: Agenda Baru: {title}">{{
                                            old('whatsapp_template', $settings->whatsapp_template)
                                        }}</textarea>
                                    <div class="form-text">
                                        Placeholder: {title}, {date}, {time}, {location}, {category}, {description}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="tab-system" role="tabpanel">
                            <form action="{{ route('settings.system') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Timezone</label>
                                        <select name="timezone" class="form-select">
                                            <option value="Asia/Jakarta" @selected($settings->timezone === 'Asia/Jakarta')>Asia/Jakarta</option>
                                            <option value="Asia/Makassar" @selected($settings->timezone === 'Asia/Makassar')>Asia/Makassar</option>
                                            <option value="Asia/Jayapura" @selected($settings->timezone === 'Asia/Jayapura')>Asia/Jayapura</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label fw-bold">Locale</label>
                                        <select name="locale" class="form-select">
                                            <option value="id" @selected($settings->locale === 'id')>Bahasa Indonesia</option>
                                            <option value="en" @selected($settings->locale === 'en')>English</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var nameInput = document.getElementById('orgNameInput');
                    var emailInput = document.getElementById('orgEmailInput');
                    var phoneInput = document.getElementById('orgPhoneInput');
                    var addressInput = document.getElementById('orgAddressInput');
                    var logoInput = document.getElementById('orgLogoInput');

                    var namePreview = document.getElementById('settingsNamePreview');
                    var emailPreview = document.getElementById('settingsEmailPreview');
                    var phonePreview = document.getElementById('settingsPhonePreview');
                    var addressPreview = document.getElementById('settingsAddressPreview');
                    var logoPreview = document.getElementById('settingsLogoPreview');

                    function setText(el, text, prefix) {
                        if (!el) return;
                        var value = text && text.trim() ? text : '-';
                        el.textContent = prefix ? prefix + value : value;
                    }

                    if (nameInput) {
                        nameInput.addEventListener('input', function () {
                            setText(namePreview, nameInput.value, '');
                        });
                    }
                    if (emailInput) {
                        emailInput.addEventListener('input', function () {
                            setText(emailPreview, emailInput.value, '');
                        });
                    }
                    if (phoneInput) {
                        phoneInput.addEventListener('input', function () {
                            setText(phonePreview, phoneInput.value, 'HP: ');
                        });
                    }
                    if (addressInput) {
                        addressInput.addEventListener('input', function () {
                            setText(addressPreview, addressInput.value, 'Alamat: ');
                        });
                    }
                    if (logoInput) {
                        logoInput.addEventListener('change', function () {
                            var file = logoInput.files && logoInput.files[0];
                            if (!file) return;
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                logoPreview.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                });
            </script>
        </div>
    </div>
</main>
@endsection

