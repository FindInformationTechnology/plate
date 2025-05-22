<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the language is set in the request
        if (session()->has(key: "locale")) {
            
            $locale = session()-> get('locale');
            
            // Set the language based on the request
            App::setLocale($locale);
            // echo "yes"; die;
            
        } else {
            
            $locale = config('app.fallback_locale');
            
            App::setLocale($locale);
        }

        return $next($request);
    }
}
