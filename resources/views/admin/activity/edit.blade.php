@extends('admin.layouts.app')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left">
                <h5>Edit Activity</h5>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('activity.index') }}">Activities</a></li>
                    <li class="breadcrumb-item">Edit</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    @include('admin.activity.form', ['activity' => $activity])
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

