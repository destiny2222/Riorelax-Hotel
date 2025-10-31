<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        /** @var \App\Models\Admin $user */
        $user = Auth::guard('admin')->user();

        if (!$user) {
            // If user is not authenticated, redirect to login
            return redirect()->route('admin.login.form');
        }

        // The 'role' middleware parameter can be a comma-separated string.
        // We need to explode it into an array.
        $requiredRoles = [];
        foreach ($roles as $role) {
            $requiredRoles = array_merge($requiredRoles, explode(',', $role));
        }
        
        // Trim whitespace from each role name
        $requiredRoles = array_map('trim', $requiredRoles);

        // Super Admin has access to everything
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Check if the user has any of the required roles
        foreach ($requiredRoles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // If no roles match, deny access
        Alert::error('Access Denied', 'You do not have permission to access this page.');
        return redirect()->route('admin.home');
    }
}
