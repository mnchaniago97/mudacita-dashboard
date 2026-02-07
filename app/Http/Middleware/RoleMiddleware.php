<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $userRole = Auth::user()->role->name ?? null;
        $normalizedUserRole = $userRole ? preg_replace('/[^a-z0-9]/', '', strtolower($userRole)) : null;
        $normalizedRoles = array_map(
            fn ($role) => preg_replace('/[^a-z0-9]/', '', strtolower($role)),
            $roles
        );

        if (!in_array($normalizedUserRole, $normalizedRoles, true)) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
