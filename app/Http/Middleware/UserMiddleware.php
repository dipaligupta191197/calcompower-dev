<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if(@Auth::check())
        {
            if(Auth::user()->is_active == 1){
                return $next($request);
            }else{
                Auth::logout();
                return redirect('/')->with('error','Your account is currently under review. Please try after account is confirmed!');
            }
        }
        else
        {
            return redirect('/');
        }
    }
}
