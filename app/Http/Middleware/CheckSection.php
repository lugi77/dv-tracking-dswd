<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $section
     * @return mixed
     */
    public function handle($request, Closure $next, $section)
    {
        if (Auth::check() && Auth::user()->section == $section) {
            return $next($request);
        }

        return redirect()->route('home')->withErrors(['msg' => 'Unauthorized access']);
    }
}
