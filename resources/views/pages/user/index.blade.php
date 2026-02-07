@extends('layouts.app')

@section('content')
@php
    $roleName = auth()->check() ? (auth()->user()->role->name ?? null) : null;
    $roleNormalized = strtolower((string) $roleName);
    $roleNormalized = str_replace('_', '', $roleNormalized);
    $isSuperAdmin = $roleNormalized === 'superadmin';
    $isAdmin = $roleNormalized === 'admin';
    $canApprove = $isSuperAdmin;
@endphp
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">User</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">User</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>
                    Tambah User
                </a>
            </div>
        </div>

        <div class="main-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card stretch stretch-full">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="border-b">
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name ?? '-' }}</td>
                                        <td>
                                            @php
                                                $status = $user->status ?? 'active';
                                                $statusBadge = match ($status) {
                                                    'active' => 'bg-success',
                                                    'pending' => 'bg-warning text-dark',
                                                    'inactive' => 'bg-secondary',
                                                    'rejected' => 'bg-danger',
                                                    default => 'bg-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $statusBadge }}">{{ ucfirst($status) }}</span>
                                        </td>
                                        <td>{{ $user->created_at?->format('Y-m-d') }}</td>
                                        <td class="text-end">
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{ route('users.show', $user) }}" class="avatar-text avatar-md">
                                                    <i class="feather-eye"></i>
                                                </a>
                                                @if ($canApprove && (($user->role->name ?? null) !== 'super_admin'))
                                                    @if (($user->status ?? 'active') === 'active')
                                                        <form action="{{ route('users.deactivate', $user) }}" method="POST"
                                                            onsubmit="return confirm('Nonaktifkan user ini?')">
                                                            @csrf
                                                            <button type="submit" class="avatar-text avatar-md border-0 bg-transparent text-warning" title="Nonaktifkan">
                                                                <i class="feather-slash"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('users.activate', $user) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="avatar-text avatar-md border-0 bg-transparent text-success" title="Aktifkan">
                                                                <i class="feather-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                                @php
                                                    $targetRole = $user->role->name ?? null;
                                                    $canEdit = $isSuperAdmin || ($isAdmin && $targetRole !== 'super_admin') || auth()->id() === $user->id;
                                                    $canDelete = ($isSuperAdmin || ($isAdmin && $targetRole !== 'super_admin')) && auth()->id() !== $user->id;
                                                @endphp
                                                @if ($canEdit)
                                                    <a href="{{ route('users.edit', $user) }}" class="avatar-text avatar-md">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                @endif
                                                @if ($canDelete)
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                        onsubmit="return confirm('Hapus user ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="avatar-text avatar-md border-0 bg-transparent text-danger">
                                                            <i class="feather-trash-2"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Belum ada user.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
