<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        $user = auth('admin')->user();

        if (!auth('admin')->check() || !$user->roles()->whereIn('name', $roles)->exists()) {
            return back()->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
