<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Add cache headers to prevent back navigation
            $response = $next($request);
            $response->headers->add([
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0', 'post-check=0, pre-check=0',
                'Pragma' => 'no-cache',
            ]);
            return $response;
        }

        return $next($request);

    }
}