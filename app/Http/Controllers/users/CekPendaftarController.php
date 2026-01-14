<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use App\Models\Registrasi;

class CekPendaftarController extends Controller
{
    public function show(Registrasi $registrasi)
    {

        // return view('user.cek_pendaftar', compact('registrasi'));
        dd(
            request()->fullUrl(),
            URL::signedRoute('cek_pendaftar', ['registrasi' => $registrasi->id])
        );
    }
}
