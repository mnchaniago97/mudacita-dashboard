@extends('layouts.app')

@section('content')
    <main class="nxl-container apps-container apps-notes">
        <div class="nxl-content without-header nxl-full-content">
            <!-- [ Main Content ] start -->
            <div class="main-content d-flex">
                <!-- [ Content Sidebar ] start -->
                <div class="content-sidebar content-sidebar-md" data-scrollbar-target="#psScrollbarInit">
                    <div class="content-sidebar-header bg-white sticky-top hstack justify-content-between">
                        <h4 class="fw-bolder mb-0">Agenda</h4>
                        <a href="javascript:void(0);" class="app-sidebar-close-trigger d-flex">
                            <i class="feather-x"></i>
                        </a>
                    </div>
                    <div class="content-sidebar-header">
                        <a href="{{ route('agenda.create') }}" class="btn btn-primary w-100">
                            <i class="feather-plus me-2"></i>
                            <span>Tambah Agenda</span>
                        </a>
                    </div>
                    <div class="content-sidebar-body">
                        @php
                            $categoryCounts = $events->groupBy(function ($event) {
                                return $event->category ?: 'Tanpa Kategori';
                            })->map->count();
                        @endphp
                        <ul class="nav d-flex flex-column nxl-content-sidebar-item">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link note-link active">
                                    <i class="feather-layers"></i>
                                    <span>Semua</span>
                                    <span class="ms-auto badge bg-soft-primary text-primary">{{ $events->count() }}</span>
                                </a>
                            </li>
                            @foreach($categoryCounts as $categoryName => $count)
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link note-link">
                                        <i class="feather-tag"></i>
                                        <span>{{ $categoryName }}</span>
                                        <span class="ms-auto badge bg-soft-primary text-primary">{{ $count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- [ Content Sidebar  ] end -->

                <!-- [ Main Area  ] start -->
                <div class="content-area" data-scrollbar-target="#psScrollbarInit">
                    <div class="content-area-header sticky-top">
                        <div class="page-header-left d-flex align-items-center gap-2">
                            <a href="javascript:void(0);" class="app-sidebar-open-trigger me-2">
                                <i class="feather-align-left fs-20"></i>
                            </a>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-semibold">Daftar Agenda</span>
                                <span class="badge bg-soft-primary text-primary">{{ $events->count() }} Item</span>
                            </div>
                        </div>
                        <div class="page-header-right ms-auto">
                            <div class="hstack gap-2">
                                <form class="search-form d-none d-md-flex">
                                    <div class="search-form-inner">
                                        <input type="search" class="py-2 px-3 border-0 w-100" placeholder="Cari agenda...">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="content-area-body pb-0">
                        <div class="row note-has-grid" id="agenda-grid">
                            @forelse($events as $event)
                                <div class="col-xxl-4 col-xl-6 col-lg-4 col-sm-6 single-note-item all-category">
                                    <div class="card card-body mb-4 stretch stretch-full">
                                        <span class="side-stick"></span>
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div>
                                                <h5 class="note-title text-truncate w-75 mb-1">
                                                    {{ $event->title }}
                                                </h5>
                                                <p class="fs-11 text-muted note-date">
                                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                                    · {{ $event->start_time ?? '-' }} - {{ $event->end_time ?? '-' }}
                                                </p>
                                            </div>
                                            <div class="hstack gap-1">
                                                <a href="{{ route('agenda.show', $event) }}" class="avatar-text avatar-sm">
                                                    <i class="feather-eye"></i>
                                                </a>
                                                <a href="{{ route('agenda.edit', $event) }}" class="avatar-text avatar-sm">
                                                    <i class="feather-edit-3"></i>
                                                </a>
                                                <form action="{{ route('agenda.destroy', $event) }}" method="POST" onsubmit="return confirm('Hapus agenda ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0 avatar-text avatar-sm text-danger">
                                                        <i class="feather-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="note-content flex-grow-1 mt-2">
                                            <div class="fs-11 fw-semibold text-primary mb-1">
                                                {{ $event->category ?? 'Tanpa Kategori' }}
                                            </div>
                                            <p class="text-muted note-inner-content text-truncate-3-line">
                                                {{ $event->description ?? '-' }}
                                            </p>
                                            <p class="fs-11 text-muted mb-0">
                                                Lokasi: {{ $event->location ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="card card-body">
                                        <div class="text-muted">Belum ada agenda.</div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- [ Content Area ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection
