<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EmployeeMiddleware
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
        foreach (Auth::user()->role as $role) {
            if($role->name == 'employee'){
                return $next($request);
            }
        }
        return redirect('/');
    }
}
