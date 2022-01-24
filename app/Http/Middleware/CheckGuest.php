<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckGuest
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
        if(Auth::user() && Auth::user()->role == "SELLER"){
            return redirect('seller/dashboard');
        }
        return $next($request);
    }
}
