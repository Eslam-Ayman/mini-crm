<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if (auth()->user()->role === 'employee') {
            // route with normal URI
            return redirect('employee');
            // route with Name
            return redirect()->route('employee.index');
        }
        return $next($request);
    }
}
