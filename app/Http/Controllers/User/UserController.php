<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->orderBy('name')->paginate(10);

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('pages.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $user->load('role');

        return view('pages.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();

        return view('pages.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function approve(User $user, Request $request)
    {
        if (!$this->isAdminUser($request->user())) {
            abort(403);
        }

        if (($user->role->name ?? null) === 'super_admin') {
            return back()->with('error', 'Akun super admin tidak perlu disetujui.');
        }

        $user->status = 'active';
        $user->save();

        return back()->with('success', 'User berhasil disetujui.');
    }

    public function reject(User $user, Request $request)
    {
        if (!$this->isAdminUser($request->user())) {
            abort(403);
        }

        if (($user->role->name ?? null) === 'super_admin') {
            return back()->with('error', 'Akun super admin tidak dapat ditolak.');
        }

        $user->status = 'rejected';
        $user->save();

        return back()->with('success', 'User berhasil ditolak.');
    }

    public function destroy(User $user)
    {
        if (($user->role->name ?? null) === 'super_admin') {
            return back()->with('error', 'Akun super admin tidak bisa dihapus.');
        }

        if (Auth::id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun yang sedang digunakan.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    private function isAdminUser(?User $user): bool
    {
        $role = $user?->role->name ?? null;
        $normalized = strtolower((string) $role);
        $normalized = str_replace('_', '', $normalized);

        return in_array($normalized, ['superadmin'], true);
    }
}

