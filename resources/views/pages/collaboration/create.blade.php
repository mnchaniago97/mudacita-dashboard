@extends('layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Tambah Kolaborasi</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('collaborations.index') }}">Kolaborasi</a></li>
                    <li class="breadcrumb-item">Tambah</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            @include('pages.collaboration.partials.form', [
                'action' => route('collaborations.store'),
                'method' => 'POST',
                'collaboration' => null,
                'programs' => $programs,
            ])
        </div>
    </div>
</main>
@endsection
