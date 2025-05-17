<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        // Check if authenticated user has admin role
        if (!auth()->user()->hasRole('admin')) {
            // Redirect non-admin users to home page with error message
            return redirect()->route('home')->with('error', 'You do not have permission to access the admin area.');
        }

        return $next($request);
    }
}
