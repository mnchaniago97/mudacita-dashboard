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
        $role = auth()->user()->role->name ?? null;
        $normalized = strtolower((string) $role);
        $normalized = str_replace('_', '', $normalized);

        if (in_array($normalized, ['superadmin', 'admin'], true)) {
            $users = User::with('role')->orderBy('name')->paginate(10);
        } else {
            $users = User::with('role')
                ->where('id', auth()->id())
                ->orderBy('name')
                ->paginate(10);
        }

        return view('admin.pages.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.pages.user.create', compact('roles'));
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

        return view('admin.pages.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (!$this->canManageUser(auth()->user(), $user)) {
            abort(403);
        }

        $roles = Role::orderBy('name')->get();

        return view('admin.pages.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if (!$this->canManageUser($request->user(), $user)) {
            abort(403);
        }

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

    public function activate(User $user, Request $request)
    {
        if (!$this->isAdminUser($request->user())) {
            abort(403);
        }

        if (($user->role->name ?? null) === 'super_admin') {
            return back()->with('error', 'Akun super admin tidak dapat dinonaktifkan.');
        }

        $user->status = 'active';
        $user->save();

        return back()->with('success', 'Akun user berhasil diaktifkan.');
    }

    public function deactivate(User $user, Request $request)
    {
        if (!$this->isAdminUser($request->user())) {
            abort(403);
        }

        if (($user->role->name ?? null) === 'super_admin') {
            return back()->with('error', 'Akun super admin tidak dapat dinonaktifkan.');
        }

        if (Auth::id() === $user->id) {
            return back()->with('error', 'Tidak bisa menonaktifkan akun yang sedang digunakan.');
        }

        $user->status = 'inactive';
        $user->save();

        return back()->with('success', 'Akun user berhasil dinonaktifkan.');
    }

    public function destroy(User $user)
    {
        if (!$this->canDeleteUser(auth()->user(), $user)) {
            abort(403);
        }

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

    private function isSuperAdminUser(?User $user): bool
    {
        $role = $user?->role->name ?? null;
        $normalized = strtolower((string) $role);
        $normalized = str_replace('_', '', $normalized);

        return $normalized === 'superadmin';
    }

    private function isAdminRole(?User $user): bool
    {
        $role = $user?->role->name ?? null;
        $normalized = strtolower((string) $role);
        $normalized = str_replace('_', '', $normalized);

        return $normalized === 'admin';
    }

    private function canManageUser(?User $actor, User $target): bool
    {
        if (!$actor) {
            return false;
        }

        if ($this->isSuperAdminUser($actor)) {
            return true;
        }

        if ($this->isAdminRole($actor)) {
            return ($target->role->name ?? null) !== 'super_admin';
        }

        return $actor->id === $target->id;
    }

    private function canDeleteUser(?User $actor, User $target): bool
    {
        if (!$actor) {
            return false;
        }

        if ($this->isSuperAdminUser($actor)) {
            return true;
        }

        if ($this->isAdminRole($actor)) {
            return ($target->role->name ?? null) !== 'super_admin';
        }

        return false;
    }
}
