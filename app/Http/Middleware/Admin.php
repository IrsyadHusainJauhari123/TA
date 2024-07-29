<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna terautentikasi
        if (Auth::check()) {
            // Periksa apakah pengguna memiliki role 'admin'
            if (Auth::user()->level === 'admin') {
                return $next($request);
            }
        }

        // Jika pengguna tidak terautentikasi atau tidak memiliki role 'admin', alihkan ke halaman login
        return redirect('login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
