@extends('layouts.app')

@section('content')

<main class="nxl-container pb-5">
    <div class="nxl-content">

        <div class="page-header mb-4">
            <h5>Tambah Agenda</h5>
        </div>
    <div class="row justify-content-center">
        <div class="col-xl-11 col-lg-9 col-md-10">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('agenda.store') }}" method="POST">
                    @csrf
                    @include('pages.agenda._form', ['agenda' => null])

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('agenda.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            Simpan Kegiatan
                        </button>
                    </div>
                </form>

            </div>
        </div>
</div>
</div>
    </div>
</main>
@endsection
