<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequirePhoneVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If user is not authenticated, let auth middleware handle it
        if (!$user) {
            return $next($request);
        }

        // If user doesn't need phone verification, continue
        if (!$user->needsPhoneVerification()) {
            return $next($request);
        }

        // If this is already the phone verification route, allow it
        if ($request->routeIs('phone.verify.show') || 
            $request->routeIs('phone.verify.send') || 
            $request->routeIs('phone.verify.confirm')) {
            return $next($request);
        }

        // Redirect to phone verification page
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Phone verification required.',
                'redirect' => route('phone.verify.show')
            ], 423); // 423 Locked
        }

        return redirect()->route('phone.verify.show')
            ->with('warning', __('message.Phone_Verification_Required'));
    }
} 