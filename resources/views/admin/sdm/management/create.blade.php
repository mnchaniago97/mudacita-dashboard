@extends('admin.layouts.app')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header mb-4">
                <h5>Tambah Management</h5>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-9 col-md-10">
                    <div class="card">
                        <div class="card-body">
                            @include('sdm.management._form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

