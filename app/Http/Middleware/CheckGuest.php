<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Enum\Role;

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
        $role = new Role();
        if(Auth::user() && Auth::user()->role == Role::seller){
            return redirect('seller/dashboard');
        }
        return $next($request);
    }
}
