@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Kategori</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Artikel</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news.categories.index') }}">Kategori</a></li>
                        <li class="breadcrumb-item">Edit</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
               
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Form Kategori</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('news.categories.update', $category->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" placeholder="Contoh: Pendidikan" required>
                                        @error('name')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Deskripsi</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi kategori (opsional)">{{ old('description', $category->description) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Warna</label>
                                        <div class="d-flex gap-3 flex-wrap">
                                            @php
                                                $colors = [
                                                    '#08546c' => 'Primary',
                                                    '#d9232d' => 'Danger',
                                                    '#2dce89' => 'Success',
                                                    '#fb6340' => 'Warning',
                                                    '#5b5b5b' => 'Secondary',
                                                    '#11cdef' => 'Info',
                                                    '#f5365c' => 'Red',
                                                    '#fb6340' => 'Orange',
                                                ];
                                            @endphp
                                            @foreach($colors as $color => $name)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="color" id="color_{{ $loop->index }}" value="{{ $color }}" {{ old('color', $category->color) == $color ? 'checked' : '' }}>
                                                <label class="form-check-label" for="color_{{ $loop->index }}">
                                                    <span class="badge" style="background-color: {{ $color }}; color: white;">{{ $name }}</span>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Aktif</label>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="feather-save me-2"></i>Simpan Perubahan
                                        </button>
                                        <a href="{{ route('news.categories.index') }}" class="btn btn-outline-secondary">
                                            Batal
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection

