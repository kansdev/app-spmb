<?php

namespace App\Http\Controllers\users;

use App\Models\Registrasi;
use App\Models\DataSiswa;

use App\Mail\SendMail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Ramsey\Collection\Set;

class FormulirRegistrasi extends Controller
{
    public function index() {
        $user = Auth::user();
        $data_siswa = DataSiswa::where('user_id', Auth::id())->first();

        return view('user.registrasi', compact('data_siswa', 'user'));
    }

    public function generate_nis() {
        $last_nis = Registrasi::orderBy('nis', 'desc')->first();

        if (!$last_nis) {
            return '10250001';
        }

        $digit_terakhir = intval(substr($last_nis->nis, -8));

        return str_pad($digit_terakhir + 1, 8, '0', STR_PAD_LEFT);
    }

    public function save_registrasi(Request $request) {
        try {

            $nis = $this->generate_nis();

            $validated = $request->validate([
                'nomor_pendaftaran' => 'required|string|digits:6',
                'nama_siswa' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nisn' => 'required',
                'nik' => 'required',
                'asal_sekolah' => 'required',
                'jurusan_pertama' => 'required',
                'jurusan_kedua' => 'required',
            ]);

            // var_dump($validated);
            Registrasi::create(array_merge($validated, [
                'user_id' => Auth::id(),
                'nis' => $nis
            ]));

            $user = Auth::user();
            $nomor_pendaftaran = $validated['nomor_pendaftaran'];

            Mail::to($user->email)->send(new SendMail($user, $nomor_pendaftaran));

            return redirect()->route('home')->with('success', 'Anda Berhasil Registrasi, silahkan cek beranda terkait status pendaftaran dan lihat menu test untuk jadwal tes');
        } catch (\Exception $e) {
            return redirect()->route('formulir_registrasi')->with('failed', 'Gagal menyimpan data ke database'. $e->getMessage());
            // return redirect()->route('formulir_registrasi')->with('failed', 'Gagal menyimpan data ke database');
        }
    }
}
