@extends('admin.layouts.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Tambah Artikel</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Artikel</a></li>
                        <li class="breadcrumb-item">Tambah</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
               
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- Main Content -->
                        <div class="col-lg-8">
                            <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">Konten Artikel</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Judul Artikel <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Masukkan judul artikel" required>
                                        @error('title')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Excerpt / Ringkasan</label>
                                        <textarea name="excerpt" class="form-control" rows="3" placeholder="Masukkan ringkasan artikel (opsional)">{{ old('excerpt') }}</textarea>
                                        <small class="text-muted">Ringkasan yang ditampilkan di card artikel</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Konten <span class="text-danger">*</span></label>
                                        <textarea name="content" id="summernote" class="form-control" rows="15">{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <div class="card stretch stretch-full mb-3">
                                <div class="card-header">
                                    <h5 class="card-title">Pengaturan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Gambar Cover</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <small class="text-muted">Ukuran maksimal 2MB</small>
                                        <div id="image-preview" class="mt-2"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Kategori</label>
                                        <select name="category_id" class="form-select">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Penulis</label>
                                        <input type="text" name="author_name" class="form-control" value="{{ old('author_name', auth()->user()->name) }}" placeholder="Nama penulis">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">Jadikan artikel utama</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="feather-save me-2"></i>Simpan
                                </button>
                                <a href="{{ route('news.index') }}" class="btn btn-outline-secondary">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Tulis konten artikel di sini...',
                tabsize: 2,
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['misc', ['blockquote', 'codeblock']]
                ],
                styleTags: [
                    'p',
                    { title: 'Heading 1', tag: 'h1', className: 'heading-1', value: '<h1></h1>' },
                    { title: 'Heading 2', tag: 'h2', className: 'heading-2', value: '<h2></h2>' },
                    { title: 'Heading 3', tag: 'h3', className: 'heading-3', value: '<h3></h3>' },
                    { title: 'Heading 4', tag: 'h4', className: 'heading-4', value: '<h4></h4>' },
                    { title: 'Quote', tag: 'blockquote', className: 'blockquote', value: '<blockquote class="blockquote"></blockquote>' },
                    { title: 'Pre', tag: 'pre', className: 'pre', value: '<pre></pre>' }
                ],
                blockquoteBreakingLevels: ['level1', 'level2', 'level3', 'level4', 'level5'],
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadImage(files[i]);
                        }
                    }
                }
            });

            function uploadImage(file) {
                let formData = new FormData();
                formData.append('image', file);
                
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#summernote').summernote('insertImage', e.target.result);
                };
                reader.readAsDataURL(file);
            }

            // Image preview
            $('input[name="image"]').change(function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').html('<img src="' + e.target.result + '" class="img-thumbnail" style="max-height: 150px;">');
                };
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endpush

