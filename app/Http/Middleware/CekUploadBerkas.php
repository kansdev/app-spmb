<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekUploadBerkas
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

        // Berkas wajib
        $required_filed = ['kk', 'ktp_orang_tua', 'akte_lahir', 'foto'];

        // Ambil berkas yang sudah di upload
        $upload_type = Auth::user()->upload()->pluck('type')->toArray();

        // Cek apakah semua berkas sudah ada
        $missing_file = array_diff($required_filed, $upload_type);

        // Cek jika masih ada file yang kosong
        if (!empty($missing_file)) {

            // Izinkan untuk menuju halaman formulir siswa
            if ($request->routeIs('upload_berkas')) {
                return $next($request);
            }

            // Kirim notifikas jika belum lengkap
            return redirect()->route('upload_berkas')->with('failed', 'Silahkan upload berkas dahulu untuk lanjut ke registrasi');
        }

        // Cek jika belum lengkap atau kosong
        if (!Auth::user()->upload) {

            // Izinkan untuk menuju halaman formulir siswa
            if ($request->routeIs('upload_berkas')) {
                return $next($request);
            }

            // Infokan jika belum lengkap
            return redirect()->route('upload_berkas')->with('failed', 'Silahkan upload berkas dahulu untuk lanjut ke registrasi');
        }

        // Jika sudah lengkap
        return $next($request);
    }
}
