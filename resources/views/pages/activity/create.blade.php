@extends('layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left">
                <h5>Create Activity</h5>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('activity.index') }}">Activities</a></li>
                    <li class="breadcrumb-item">Create</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    @include('pages.activity.form')
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
