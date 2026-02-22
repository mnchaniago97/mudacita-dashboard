@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Manajemen Konten Tentang</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Konten Website</a></li>
                        <li class="breadcrumb-item">Tentang</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="mb-3">
                    <a href="{{ route('content.tentang.show') }}" class="btn btn-outline-secondary">
                        <i class="feather-arrow-left me-2"></i>Kembali ke Detail
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('content.tentang.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- Hero/Header Section -->
                        <div class="col-12">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">1. Header Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Hero Title</label>
                                            <input type="text" name="tentang_hero_title" class="form-control" value="{{ old('tentang_hero_title', $settings->tentang_hero_title ?? 'Inspirasi Muda, Cita untuk Indonesia') }}">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Hero Image</label>
                                            <input type="file" name="tentang_hero_image" class="form-control mb-2">
                                            @if(!empty($settings->tentang_hero_image))
                                                <img src="{{ asset('storage/' . $settings->tentang_hero_image) }}" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Visi Section -->
                        <div class="col-12 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">2. Visi Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Visi Description</label>
                                        <textarea name="visi_description" class="form-control" rows="4">{{ old('visi_description', $settings->visi_description ?? '') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Author Name</label>
                                        <input type="text" name="visi_author_name" class="form-control" value="{{ old('visi_author_name', $settings->visi_author_name ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Author Title</label>
                                        <input type="text" name="visi_author_title" class="form-control" value="{{ old('visi_author_title', $settings->visi_author_title ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Author Image</label>
                                        <input type="file" name="visi_author_image" class="form-control mb-2">
                                        @if(!empty($settings->visi_author_image))
                                            <img src="{{ asset('storage/' . $settings->visi_author_image) }}" class="img-thumbnail" style="max-height: 100px; max-width: 100%;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Misi Section -->
                        <div class="col-12 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">3. Misi Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Misi List (One per line)</label>
                                        <textarea id="misi_input" class="form-control" rows="5" placeholder="Enter each misi on a new line"></textarea>
                                        <div id="misi_container">
                                            @if(!empty($settings->misi_list))
                                                @foreach($settings->misi_list as $misi)
                                                    <input type="hidden" name="misi_list[]" value="{{ $misi }}">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Author Name</label>
                                        <input type="text" name="misi_author_name" class="form-control" value="{{ old('misi_author_name', $settings->misi_author_name ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Author Title</label>
                                        <input type="text" name="misi_author_title" class="form-control" value="{{ old('misi_author_title', $settings->misi_author_title ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Author Image</label>
                                        <input type="file" name="misi_author_image" class="form-control mb-2">
                                        @if(!empty($settings->misi_author_image))
                                            <img src="{{ asset('storage/' . $settings->misi_author_image) }}" class="img-thumbnail" style="max-height: 100px; max-width: 100%;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Values/Nilai Section -->
                        <div class="col-12">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">4. Nilai-Nilai Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        @foreach(range(1, 3) as $i)
                                            <div class="col-12 col-md-4 mb-3">
                                                <div class="border p-3 rounded h-100">
                                                    <h6 class="mb-3">Nilai {{ $i }}</h6>
                                                    <div class="mb-2">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="nilai{{ $i }}_title" class="form-control" value="{{ $settings->{'nilai' . $i . '_title'} ?? '' }}">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="nilai{{ $i }}_description" class="form-control" rows="3">{{ $settings->{'nilai' . $i . '_description'} ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Section -->
                        <div class="col-12">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">5. CTA Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">CTA Title</label>
                                            <input type="text" name="tentang_cta_title" class="form-control" value="{{ old('tentang_cta_title', $settings->tentang_cta_title ?? 'Saatnya Terlibat dan Dukung Program Kami') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="feather-save me-2"></i>Simpan Semua Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const misiInput = document.getElementById('misi_input');
        const misiContainer = document.getElementById('misi_container');
        
        // Initial load of misi list into textarea
        const initialMisis = [];
        misiContainer.querySelectorAll('input').forEach(input => {
            initialMisis.push(input.value);
        });
        misiInput.value = initialMisis.join('\n');

        // Update hidden inputs when textarea changes
        misiInput.addEventListener('input', function() {
            const lines = this.value.split('\n').filter(line => line.trim() !== '');
            misiContainer.innerHTML = '';
            lines.forEach(line => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'misi_list[]';
                input.value = line.trim();
                misiContainer.appendChild(input);
            });
        });
    });
</script>
@endpush

