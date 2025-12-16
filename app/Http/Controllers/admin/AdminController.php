<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DataSiswa;
use App\Models\User;
use App\Models\Registrasi;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(): View {

        $calon_pendaftar = DB::table('users')
        ->leftJoin('registrasi', 'users.id', '=', 'registrasi.user_id')
        ->join('data_siswa', 'users.id', '=', 'data_siswa.user_id')
        // ->join('data_orang_tua', 'users.id', '=', 'data_orang_tua.user_id')
        // ->join('document_upload', 'users.id', '=', 'document_upload.user_id')
        // ->join('data_periodik', 'users.id', '=', 'data_periodik.user_id')
        // ->join('nilai_raport', 'users.id', '=', 'nilai_raport.user_id')
        ->whereNull('registrasi.id')
        ->count();

        $teregistrasi = DB::table('registrasi')->count();

        $users = DB::table('users')->count();

        $data_user = User::get();
        $data_siswa = DataSiswa::with('user')->get();

        // $cek_user = User::whereHas('siswa')
        // ->with(['siswa', 'orang_tua', 'periodik', 'nilai_raport', 'upload'])
        // ->get()
        // ->map(function ($user) {
        //     return [
        //         'id' => $user->id,
        //         'nama' => optional($user->siswa)->nama_siswa ?? '-',
        //         'email' => $user->email,
        //         'phone' => $user->phone,

        //         // Status per formulir
        //         'form_siswa' => $user->siswa ? true : false,
        //         'form_orang_tua' => $user->orang_tua ? true : false,
        //         'form_periodik' => $user->periodik ? true : false,
        //         'nilai_raport' => $user->nilai_raport ? true : false,
        //         'upload_berkas' => $user->upload ? true : false,

        //         // Status keseluruhan
        //         'status_lengkap' =>
        //             $user->siswa &&
        //             $user->orang_tua &&
        //             $user->periodik &&
        //             $user->nilai_raport &&
        //             $user->upload
        //     ];
        // });

        $cek_user = User::whereHas('siswa')
        ->with([
            'siswa',
            'orang_tua',
            'periodik',
            'nilai_raport',
            'upload',
            'registrasi'
        ])
        ->where(function ($q) {
            $q->whereDoesntHave('siswa')
              ->orWhereDoesntHave('orang_tua')
              ->orWhereDoesntHave('periodik')
              ->orWhereDoesntHave('nilai_raport')
              ->orWhereDoesntHave('upload');
        })
        ->whereDoesntHave('registrasi') // ❌ belum final registrasi
        ->get();

        $pendaftar_teregistrasi = Registrasi::get();


        $admin = session()->only(['id', 'name', 'level']);
        // dd($cek_user);

        return view('admin.dashboard', compact('admin', 'calon_pendaftar', 'teregistrasi', 'users', 'data_user', 'data_siswa', 'cek_user', 'pendaftar_teregistrasi'));
    }

    public function grafik(): View {

        $admin = session()->only(['id', 'name', 'level']);

        // Ambil data siswa kelompok perkecamatan -> per kelurahan
        // Mengelompokan kecamatan supaya gampang di looping
        $statistik = DataSiswa::select('kecamatan', 'kelurahan', DB::raw('COUNT(*) as total'))
        ->groupBy('kecamatan', 'kelurahan')
        ->orderBy('kecamatan')
        ->orderBy('kelurahan')
        ->get()
        ->groupBy('kecamatan');

        return view('admin.grafik', compact('admin', 'statistik'));
    }

    public function pendaftar() {
        // Skrip lama
        $admin = session()->only(['id', 'name', 'level']);
        // $calon_pendaftar = Registrasi::with('user.nilai_raport')->first();
        $calon_pendaftar = Registrasi::with('user.nilai_raport')->get();
        // $nilaiRaport = $calon_pendaftar->user->nilai_raport;
        // dd($calon_pendaftar);
        // dd($calon_pendaftar->user, $calon_pendaftar->user->nilai_raport);
        return view('admin.pendaftar', compact('admin', 'calon_pendaftar'));
    }

}
