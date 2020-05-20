<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;
use Closure;

class CheckRole
{

    public function handle($request, Closure $next)
    {

       $data = User::find(Auth::user()->role_id);

        if(Auth::user()->role_id != 1)
            return redirect()->intended('home');
        else
        return $next($request);
    }
}
