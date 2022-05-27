<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\Audit;

class UserAuth extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(auth()->user()){
            return $next($request);
        }
        return redirect('auth/login')->with('error','Permission Denied!!! You do not have access to dashboard. Please login to access your account.');
    }
}