<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        // Jika belum login → redirect ke login
        if (!Session::get('login')) {
            return redirect('/auth')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
