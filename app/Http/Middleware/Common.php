<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Common
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && ((Auth::user()->user_type == 'admin') || (Auth::user()->user_type=="seller"))) {
            return $next($request);
        }
        else{
            abort(404);
        }
    }
}
