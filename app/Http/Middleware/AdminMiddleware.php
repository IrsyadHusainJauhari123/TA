<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna memiliki role 'admin'
        if (Auth::check() && Auth::user()->level === 'admin') {
            return $next($request);
        }

        // Jika pengguna tidak memiliki role 'admin', redirect atau berikan respons yang sesuai
        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
