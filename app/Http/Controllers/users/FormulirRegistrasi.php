<?php

namespace App\Http\Controllers\users;

use App\Models\Registrasi;
use App\Models\DataSiswa;

use App\Mail\SendMail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class FormulirRegistrasi extends Controller
{
    public function index() {
        $user = Auth::user();
        $data_siswa = DataSiswa::where('user_id', Auth::id())->first();
        $data_registrasi = Registrasi::where('user_id', $user->id)->first();

        return view('user.close.registrasi', compact('data_siswa', 'user', 'data_registrasi'));
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
                'gelombang_sesi' => 'required',
                'waktu_sesi' => 'required'
            ], [
                'required' => ':attribute wajib di isi'
            ]);

            $registrasi = Registrasi::create(array_merge($validated, [
                'user_id' => Auth::id(),
                'nis' => $nis,
                'status' => "Belum Terverifikasi"
            ]));

            try {
                $user = Auth::user();
                Mail::to($user->email)->send(new SendMail($user, $registrasi));
                Log::info('Email registrasi berhasil dikirim', ['nomor_pendaftaran' => $registrasi->nomor_pendaftaran]);
            } catch (\Throwable $th) {
                Log::error('Email registrasi gagal dikirim', [
                    'user_id' => $user->id,
                    'error' => $th->getMessage()
                ]);
                return redirect()->route('home')->with('warning', 'Anda Berhasil Registrasi, email notifikasi gagal dikirim');

            }
            return redirect()->route('home')->with('success', 'Anda Berhasil Registrasi, silahkan cek email dan beranda terkait status pendaftaran dan lihat menu test untuk jadwal tes');
        } catch(ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->route('formulir_registrasi')->with('failed', 'Gagal menyimpan data ke database'. $e->getMessage());
        }
    }
}
