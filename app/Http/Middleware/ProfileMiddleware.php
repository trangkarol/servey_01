<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class ProfileMiddleware
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
            return redirect()->route('home')->with('check_show_login', true);
        }

        return $next($request);
    }
}
