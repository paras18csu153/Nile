<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Enum\Role;

class CheckIsSeller
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
        if(Auth::user() && Auth::user()->role == Role::seller){
            return $next($request);
        }
        else{
            return redirect('/home');
        }
    }
}
