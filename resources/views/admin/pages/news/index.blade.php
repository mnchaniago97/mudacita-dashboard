@extends('admin.layouts.app')

@push('styles')
<style>
.article-title-wrap,
.article-excerpt-wrap {
        max-width: 100%;
        white-space: normal;
        word-break: break-word;
        overflow-wrap: anywhere;
        display: block;
    }
    .table-article-list {
        table-layout: fixed;
        width: 100%;
    }
    .table-article-list th,
    .table-article-list td {
        white-space: normal;
        word-break: break-word;
        overflow-wrap: anywhere;
        padding: 4px 6px;
    }
    .table-article-list th {
        font-size: 0.68rem;
    }
    .table-article-list td {
        font-size: 0.75rem;
    }
    .table-article-list th:nth-child(1),
    .table-article-list td:nth-child(1) { width: 28px; }
    .table-article-list th:nth-child(2),
    .table-article-list td:nth-child(2) { width: 58px; }
.table-article-list th:nth-child(3),
.table-article-list td:nth-child(3) { width: 45%; max-width: 45%; }
    .table-article-list th:nth-child(4),
    .table-article-list td:nth-child(4) { width: 90px; }
    .table-article-list th:nth-child(5),
    .table-article-list td:nth-child(5) { width: 85px; }
    .table-article-list th:nth-child(6),
    .table-article-list td:nth-child(6) { width: 80px; }
    .table-article-list th:nth-child(7),
    .table-article-list td:nth-child(7) { width: 60px; }
    .table-article-list .badge {
        font-size: 0.62rem;
        padding: 3px 5px;
    }
    .table-article-list img {
        width: 50px !important;
        height: 34px !important;
    }
    .table-article-wrap { overflow-x: hidden; }
</style>
@endpush

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Kelola Artikel</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">Artikel</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto d-flex gap-2">
                    <a href="{{ route('news.categories.index') }}" class="btn btn-outline-primary">
                        <i class="feather-folder me-2"></i>Kelola Kategori
                    </a>
                    <a href="{{ route('news.create') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>Tambah Artikel
                    </a>
                </div>
            </div>
            <!-- [ page-header ] end -->
               
            <!-- [ Main Content ] start -->
            <div class="main-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Daftar Artikel</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-article-wrap">
                                    <table class="table table-hover table-article-list">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Judul</th>
                                                <th>Kategori</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($articles as $index => $article)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if($article->image)
                                                        <img src="{{ asset('storage/' . $article->image) }}" alt="" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                    @else
                                                        <div class="bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 40px; border-radius: 4px;">
                                                            <i class="feather-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="fw-bold article-title-wrap">{{ $article->title }}</div>
                                                    <small class="text-muted article-excerpt-wrap">{{ $article->excerpt ?? 'Tidak ada excerpt' }}</small>
                                                </td>
                                                <td>
                                                    @if($article->category)
                                                        <span class="badge" style="background-color: {{ $article->category->color }}; color: white;">{{ $article->category->name }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">Tanpa Kategori</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($article->status === 'published')
                                                        <span class="badge bg-success">Published</span>
                                                    @else
                                                        <span class="badge bg-warning">Draft</span>
                                                    @endif
                                                    @if($article->is_featured)
                                                        <span class="badge bg-primary ms-1">Featured</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('news.edit', $article->id) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="feather-edit-2"></i>
                                                        </a>
                                                        <form action="{{ route('news.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="feather-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5">
                                                    <div class="avatar-text avatar-lg bg-light text-muted mb-3">
                                                        <i class="feather-file-text"></i>
                                                    </div>
                                                    <h6 class="text-muted">Belum Ada Artikel</h6>
                                                    <p class="text-muted">Klik tombol "Tambah Artikel" untuk membuat artikel pertama</p>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                
                                @if($articles->hasPages())
                                <div class="mt-4">
                                    {{ $articles->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection

