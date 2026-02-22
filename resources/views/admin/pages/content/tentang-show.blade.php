@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Detail Konten Tentang</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Konten Website</a></li>
                        <li class="breadcrumb-item">Tentang</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTentangHero">
                        <i class="feather-edit-3 me-2"></i>Edit Konten
                    </button>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Konten Tentang</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $teams = $settings->about_teams ?? [];
                                @endphp
                                <div class="table-responsive">
                                    <table class="table table-striped align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">No</th>
                                                <th>Konten</th>
                                                <th>Deskripsi</th>
                                                <th style="width: 160px;">Preview</th>
                                                <th style="width: 140px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class="fw-semibold">Header Image</td>
                                                <td class="text-muted small">Gambar header pada halaman Tentang.</td>
                                                <td>
                                                    @if($settings->tentang_hero_image)
                                                        <img src="{{ asset('storage/' . $settings->tentang_hero_image) }}" style="height: 60px; width: 120px; object-fit: cover;" alt="Header Image">
                                                    @else
                                                        <span class="text-muted small">Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTentangHero">Edit Konten</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td class="fw-semibold">Tentang Intro Image</td>
                                                <td class="text-muted small">Gambar section "Tentang Kami".</td>
                                                <td>
                                                    @if($settings->about_intro_image)
                                                        <img src="{{ asset('storage/' . $settings->about_intro_image) }}" style="height: 60px; width: 120px; object-fit: cover;" alt="Tentang Intro">
                                                    @else
                                                        <span class="text-muted small">Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAboutIntro">Edit Konten</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td class="fw-semibold">Author Visi</td>
                                                <td class="text-muted small">Gambar author pada card Visi.</td>
                                                <td>
                                                    @if($settings->visi_author_image)
                                                        <img src="{{ asset('storage/' . $settings->visi_author_image) }}" style="height: 60px; width: 120px; object-fit: cover;" alt="Visi Author">
                                                    @else
                                                        <span class="text-muted small">Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalVisiAuthor">Edit Konten</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td class="fw-semibold">Author Misi</td>
                                                <td class="text-muted small">Gambar author pada card Misi.</td>
                                                <td>
                                                    @if($settings->misi_author_image)
                                                        <img src="{{ asset('storage/' . $settings->misi_author_image) }}" style="height: 60px; width: 120px; object-fit: cover;" alt="Misi Author">
                                                    @else
                                                        <span class="text-muted small">Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalMisiAuthor">Edit Konten</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td class="fw-semibold">Nilai Image 1</td>
                                                <td class="text-muted small">Gambar kartu nilai pertama.</td>
                                                <td>
                                                    @if($settings->about_value_image_1)
                                                        <img src="{{ asset('storage/' . $settings->about_value_image_1) }}" style="height: 60px; width: 120px; object-fit: cover;" alt="Nilai 1">
                                                    @else
                                                        <span class="text-muted small">Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalValueImages">Edit Konten</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td class="fw-semibold">Nilai Image 2</td>
                                                <td class="text-muted small">Gambar kartu nilai kedua.</td>
                                                <td>
                                                    @if($settings->about_value_image_2)
                                                        <img src="{{ asset('storage/' . $settings->about_value_image_2) }}" style="height: 60px; width: 120px; object-fit: cover;" alt="Nilai 2">
                                                    @else
                                                        <span class="text-muted small">Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalValueImages">Edit Konten</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td class="fw-semibold">Nilai Image 3</td>
                                                <td class="text-muted small">Gambar kartu nilai ketiga.</td>
                                                <td>
                                                    @if($settings->about_value_image_3)
                                                        <img src="{{ asset('storage/' . $settings->about_value_image_3) }}" style="height: 60px; width: 120px; object-fit: cover;" alt="Nilai 3">
                                                    @else
                                                        <span class="text-muted small">Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalValueImages">Edit Konten</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td class="fw-semibold">Overlay Image</td>
                                                <td class="text-muted small">Gambar overlay di bagian bawah halaman.</td>
                                                <td>
                                                    @if($settings->about_overlay_image)
                                                        <img src="{{ asset('storage/' . $settings->about_overlay_image) }}" style="height: 60px; width: 120px; object-fit: cover;" alt="Overlay">
                                                    @else
                                                        <span class="text-muted small">Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalOverlayImage">Edit Konten</button>
                                                </td>
                                            </tr>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @php
                                                    $team = $teams[$i - 1] ?? [];
                                                    $teamName = $team['name'] ?? '-';
                                                    $teamRole = $team['role'] ?? null;
                                                    $teamImage = $team['image'] ?? null;
                                                    $teamImageUrl = $teamImage
                                                        ? (str_starts_with($teamImage, 'assets/') ? asset($teamImage) : asset('storage/' . $teamImage))
                                                        : null;
                                                @endphp
                                                <tr>
                                                    <td>{{ 8 + $i }}</td>
                                                    <td class="fw-semibold">Tim {{ $i }}</td>
                                                    <td class="text-muted small">
                                                        {{ $teamName }}
                                                        @if(!empty($teamRole))
                                                            • {{ $teamRole }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($teamImageUrl)
                                                            <img src="{{ $teamImageUrl }}" style="height: 60px; width: 120px; object-fit: cover;" alt="Team {{ $i }}">
                                                        @else
                                                            <span class="text-muted small">Tidak ada gambar</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTeam">Edit Konten</button>
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->

            <!-- Modals -->
            <div class="modal fade" id="modalTentangHero" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('content.tentang.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Header Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Header Image</label>
                                <input type="file" name="tentang_hero_image" class="form-control mb-3">
                                @if($settings->tentang_hero_image)
                                    <img src="{{ asset('storage/' . $settings->tentang_hero_image) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalAboutIntro" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('content.tentang.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Tentang Intro Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Tentang Intro Image</label>
                                <input type="file" name="about_intro_image" class="form-control mb-3">
                                @if($settings->about_intro_image)
                                    <img src="{{ asset('storage/' . $settings->about_intro_image) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalVisiAuthor" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('content.tentang.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Author Visi Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Author Visi Image</label>
                                <input type="file" name="visi_author_image" class="form-control mb-3">
                                @if($settings->visi_author_image)
                                    <img src="{{ asset('storage/' . $settings->visi_author_image) }}" class="img-thumbnail" style="max-height: 160px; max-width: 100%;">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalMisiAuthor" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('content.tentang.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Author Misi Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Author Misi Image</label>
                                <input type="file" name="misi_author_image" class="form-control mb-3">
                                @if($settings->misi_author_image)
                                    <img src="{{ asset('storage/' . $settings->misi_author_image) }}" class="img-thumbnail" style="max-height: 160px; max-width: 100%;">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalValueImages" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('content.tentang.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Nilai Images</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Nilai Image 1</label>
                                        <input type="file" name="about_value_image_1" class="form-control mb-2">
                                        @if($settings->about_value_image_1)
                                            <img src="{{ asset('storage/' . $settings->about_value_image_1) }}" class="img-thumbnail" style="max-height: 140px; max-width: 100%;">
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Nilai Image 2</label>
                                        <input type="file" name="about_value_image_2" class="form-control mb-2">
                                        @if($settings->about_value_image_2)
                                            <img src="{{ asset('storage/' . $settings->about_value_image_2) }}" class="img-thumbnail" style="max-height: 140px; max-width: 100%;">
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Nilai Image 3</label>
                                        <input type="file" name="about_value_image_3" class="form-control mb-2">
                                        @if($settings->about_value_image_3)
                                            <img src="{{ asset('storage/' . $settings->about_value_image_3) }}" class="img-thumbnail" style="max-height: 140px; max-width: 100%;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalOverlayImage" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('content.tentang.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Overlay Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Overlay Image</label>
                                <input type="file" name="about_overlay_image" class="form-control mb-3">
                                @if($settings->about_overlay_image)
                                    <img src="{{ asset('storage/' . $settings->about_overlay_image) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalTeam" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('content.tentang.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Tim</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">                            <div class="modal-body">
                                <div class="row g-3">
                                    @for ($i = 1; $i <= 12; $i++)
                                        @php
                                            $team = $teams[$i - 1] ?? [];
                                            $teamImage = $team['image'] ?? null;
                                            $teamImageUrl = $teamImage
                                                ? (str_starts_with($teamImage, 'assets/') ? asset($teamImage) : asset('storage/' . $teamImage))
                                                : null;
                                        @endphp
                                        <div class="col-12">
                                            <div class="border rounded p-3">
                                                <h6 class="fw-bold mb-3">Tim {{ $i }}</h6>
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" name="team_{{ $i }}_name" class="form-control" value="{{ old('team_' . $i . '_name', $team['name'] ?? '') }}">
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="form-label">Jabatan</label>
                                                        <input type="text" name="team_{{ $i }}_role" class="form-control" value="{{ old('team_' . $i . '_role', $team['role'] ?? '') }}">
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="form-label">Foto</label>
                                                        <input type="file" name="team_{{ $i }}_image" class="form-control mb-2">
                                                        @if($teamImageUrl)
                                                            <img src="{{ $teamImageUrl }}" class="img-thumbnail" style="max-height: 120px; max-width: 100%;">
                                                        @endif
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="form-label">Facebook</label>
                                                        <input type="text" name="team_{{ $i }}_facebook" class="form-control" value="{{ old('team_' . $i . '_facebook', $team['facebook'] ?? '') }}">
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="form-label">Twitter</label>
                                                        <input type="text" name="team_{{ $i }}_twitter" class="form-control" value="{{ old('team_' . $i . '_twitter', $team['twitter'] ?? '') }}">
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="form-label">Instagram</label>
                                                        <input type="text" name="team_{{ $i }}_instagram" class="form-control" value="{{ old('team_' . $i . '_instagram', $team['instagram'] ?? '') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
<style>
    .modal {
        z-index: 9999 !important;
    }
    .modal-backdrop {
        z-index: 9998 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ['modalTentangHero', 'modalAboutIntro', 'modalVisiAuthor', 'modalMisiAuthor', 'modalValueImages', 'modalOverlayImage', 'modalTeam'].forEach(function (id) {
            var modalEl = document.getElementById(id);
            if (modalEl && modalEl.parentElement !== document.body) {
                document.body.appendChild(modalEl);
            }
        });
    });
</script>
@endpush



