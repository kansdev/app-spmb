<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekNilaiRaport
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
        if (!Auth::user()->nilai_raport) {

            // Izinkan untuk menuju halaman formulir nilai raport
            if ($request->routeIs('formulir_nilai_raport')) {
                return $next($request);
            }

            // Infokan jika belum lengkap
            return redirect()->route('formulir_nilai_raport')->with('failed', 'Silahkan isi nilai raport untuk lanjut ke tahap berikutnya');
        }

        return $next($request);
    }
}
