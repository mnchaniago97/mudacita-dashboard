@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Kelola Kategori</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Artikel</a></li>
                        <li class="breadcrumb-item">Kategori</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <a href="{{ route('news.categories.create') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>Tambah Kategori
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
                                <h5 class="card-title">Daftar Kategori</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Slug</th>
                                                <th>Deskripsi</th>
                                                <th>Artikel</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($categories as $index => $category)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <span class="badge" style="background-color: {{ $category->color }}; color: white;">{{ $category->name }}</span>
                                                </td>
                                                <td><code>{{ $category->slug }}</code></td>
                                                <td>{{ $category->description ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $category->articles->count() }} artikel</span>
                                                </td>
                                                <td>
                                                    @if($category->is_active)
                                                        <span class="badge bg-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-warning">Nonaktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('news.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="feather-edit-2"></i>
                                                        </a>
                                                        <form action="{{ route('news.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" {{ $category->articles->count() > 0 ? 'disabled' : '' }}>
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
                                                        <i class="feather-folder"></i>
                                                    </div>
                                                    <h6 class="text-muted">Belum Ada Kategori</h6>
                                                    <p class="text-muted">Klik tombol "Tambah Kategori" untuk membuat kategori</p>
                                                </td>
                                            </tr>
                                            @endforelse
                                    </table>
                                        </tbody>
                                </div>
                                
                                @if($categories->hasPages())
                                <div class="mt-4">
                                    {{ $categories->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
    </main>
        </div>
@endsection

