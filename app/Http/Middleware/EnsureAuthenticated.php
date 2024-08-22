<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Prevent caching
        $response = $next($request);
        $response->headers->add(['Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0']);
        $response->headers->add(['Cache-Control' => 'post-check=0, pre-check=0', 'Pragma' => 'no-cache']);

        return $response;
    }
}
