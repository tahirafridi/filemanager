<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->status === 'Active') {
            return $next($request);
        }

        auth()->guard()->logout();
        
        return redirect()->route('login')->with('error', "Sorry! You are not authorize to access the resource.");
    }
}
