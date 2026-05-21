<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah role user tersebut adalah 'superadmin' (sesuai database seeder)
        if (auth()->check() && auth()->user()->role === 'super_admin') {
            return $next($request); // Lolos, boleh masuk ke halaman admin
        }

        // Jika bukan superadmin, tendang dan kasih error 403
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}