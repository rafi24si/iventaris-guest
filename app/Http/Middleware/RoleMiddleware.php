<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userRole = session('user_role');

        // Jika tidak login
        if (!session('login')) {
            return redirect('/auth')->with('error', 'Anda harus login terlebih dahulu!');
        }

        // Jika role tidak sesuai
        if (!in_array($userRole, $roles)) {
            return response()->view('errors.unauthorized', [
                'message' => 'Anda tidak memiliki akses ke halaman ini. Hanya admin yang dapat mengakses!'
            ], 403);
        }

        return $next($request);
    }
}
