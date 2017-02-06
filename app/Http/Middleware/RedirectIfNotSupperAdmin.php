<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfNotSupperAdmin
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
        if (Auth::check() && Auth::user()->isSupperAdmin()) {
            return $next($request);
        } elseif (Auth::user()->isAdmin()){
            return redirect()->action('Admin\DashboardController@index')
                ->with('message-fail', trans('message.do_not_permission'));
        }

        return redirect()->action('SurveyController@index')
            ->with('message-fail', trans('message.do_not_permission'));
    }
}
