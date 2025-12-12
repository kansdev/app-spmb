<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekDataOrangTua
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
        if (!Auth::user()->orang_tua) {

            // Izinkan untuk menuju halaman formulir siswa
            if ($request->routeIs('formulir_orang_tua')) {
                return $next($request);
            }

            // Infokan jika belum lengkap
            return redirect()->route('formulir_orang_tua')->with('failed', 'Silahkan isi data orang tua untuk lanjut ke tahap berikutnya');
        }

        // Jika sudah lengkap
        return $next($request);
    }
}
