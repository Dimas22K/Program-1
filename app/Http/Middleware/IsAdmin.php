<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Session::get('role') !== 'admin') {
            return redirect('/login');
        }

        return $next($request);
    }
}
