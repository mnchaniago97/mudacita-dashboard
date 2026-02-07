@extends('layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header mb-4">
            <h5>Detail Agenda</h5>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-11 col-lg-9 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="text-muted fs-12">Judul</div>
                                <div class="fw-semibold">{{ $agenda->title }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted fs-12">Kategori</div>
                                <div class="fw-semibold">{{ $agenda->category ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted fs-12">Tanggal</div>
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($agenda->event_date)->format('d M Y') }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted fs-12">Waktu</div>
                                <div class="fw-semibold">
                                    {{ $agenda->start_time ?? '-' }} - {{ $agenda->end_time ?? '-' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted fs-12">Lokasi</div>
                                <div class="fw-semibold">{{ $agenda->location ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted fs-12">Notifikasi WhatsApp</div>
                                <div class="fw-semibold">{{ $agenda->notify_whatsapp ? 'Aktif' : 'Nonaktif' }}</div>
                            </div>
                            <div class="col-12">
                                <div class="text-muted fs-12">Deskripsi</div>
                                <div class="fw-semibold">{{ $agenda->description ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('agenda.index') }}" class="btn btn-light">Kembali</a>
                            <a href="{{ route('agenda.edit', $agenda) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
