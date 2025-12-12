<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sudah login atau belum
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek jika belum lengkap atau kosong
        if (empty(Auth::user()->phone)) {

            // Izinkan untuk menuju halaman akun
            if ($request->routeIs('akun')) {
                return $next($request);
            }

            // Infokan jika belum lengkap
            return redirect()->route('akun')->with('failed', 'Anda belum melengkapi nomor telepon, silahkan lengkapi terlebih dahulu');
        }

        // Jika sudah lengkap
        return $next($request);
    }
}
