<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekDataSiswa
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
        if (!Auth::user()->siswa) {

            // Izinkan untuk menuju halaman formulir siswa
            if ($request->routeIs('formulir_siswa')) {
                return $next($request);
            }

            // Infokan jika belum lengkap
            return redirect()->route('formulir_siswa')->with('failed', 'Silahkan isi data siswa untuk lanjut ke tahap berikutnya');
        }

        // Jika sudah lengkap
        return $next($request);
    }
}
