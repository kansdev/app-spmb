<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekDataPeriodik
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
        if (!Auth::user()->periodik) {

            // Izinkan untuk menuju halaman formulir siswa
            if ($request->routeIs('formulir_periodik')) {
                return $next($request);
            }

            // Infokan jika belum lengkap
            return redirect()->route('formulir_periodik')->with('failed', 'Silahkan isi data periodik untuk lanjut ke tahap berikutnya');
        }

        // Jika sudah lengkap
        return $next($request);
    }
}
