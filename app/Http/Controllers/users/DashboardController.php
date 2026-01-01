<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.home', ['user' => Auth::user()]);
    }

    public function formulir_siswa()
    {
        return view('user.formulir_siswa', ['user' => Auth::user()]);
    }

    public function formulir_orang_tua()
    {
        return view('user.formulir_orang_tua', ['user' => Auth::user()]);
    }

    // public function upload_berkas()
    // {
    //     return view('user.upload_berkas', ['user' => Auth::user()]);
    // }

    public function akun()
    {
        return view('user.akun', ['user' => Auth::user()]);
    }

    public function update_akun(Request $request) {
        try {
            $request->validate([
                'phone' => 'required|numeric'
            ],
            [
                'phone' => 'Nomor wajib di isi !!!',
                'phone' => 'Nomor wajib angka !!!',
            ]);

            Auth::user()->update([
                'phone' => $request->phone
            ]);

            return redirect()->route('home')->with('success', 'Nomor telepon berhasil di perbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Gagal perbarui nomor telepon, '. $e->getMessage());
        }
    }
}
