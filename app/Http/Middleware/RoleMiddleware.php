<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Check if the user is authenticated and has the correct role
        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

        // Redirect or show an error message if the user does not have the required role
        return redirect('/unauthorized')->with('error', 'You do not have permission to access this page.');
    }
}