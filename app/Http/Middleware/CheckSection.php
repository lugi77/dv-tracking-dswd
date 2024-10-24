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
     * @param  mixed  $sections  Can be a single section or multiple sections
     * @return mixed
     */
    public function handle($request, Closure $next, ...$sections)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $userSection = Auth::user()->section;

            // Allow access if the user is an admin (section 0) or if the user's section matches one of the allowed sections
            if ($userSection == 0 || in_array($userSection, $sections)) {
                return $next($request);
            }
        }

        // If not authorized, redirect to home page with an error message
        return redirect()->route('home')->withErrors(['msg' => 'Unauthorized access']);
    }
}
