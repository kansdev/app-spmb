<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DataSiswa;
use App\Models\User;
use App\Models\Registrasi;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Eloquent\Builder;
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

        $cek_user = User::with([
            'siswa',
            'orang_tua',
            'periodik',
            'nilai_raport',
            'upload',
            'registrasi'
        ])
        // ->whereHas('siswa')
        // ->where(function ($q) {
        //     $q->whereDoesntHave('siswa')
        //       ->orWhereDoesntHave('orang_tua')
        //       ->orWhereDoesntHave('periodik')
        //       ->orWhereDoesntHave('nilai_raport')
        //       ->orWhereDoesntHave('upload');
        // })
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

        $agama = DataSiswa::select('agama')
        ->get()
        ->groupBy('agama')
        ->map(function ($item){
            return $item->count();
        });

        $registrasi = Registrasi::select('jurusan_pertama', 'jurusan_kedua')->get();

        $jurusan_pertama = collect();
        $jurusan_kedua = collect();
        foreach ($registrasi as $r) {
            if ($r->jurusan_pertama) {
                $jurusan_pertama->push($r->jurusan_pertama);
            }
            if ($r->jurusan_kedua) {
                $jurusan_kedua->push($r->jurusan_kedua);
            }
        }

        $statistik_jurusan_pertama = $jurusan_pertama
        ->groupBy(fn($item) => $item)
        ->map(fn ($items) => $items->count())
        ->sortDesc();

        $statistik_jurusan_kedua = $jurusan_kedua
        ->groupBy(fn($item) => $item)
        ->map(fn ($items) => $items->count())
        ->sortDesc();

        $map_jurusan = [
            'MP' => 'Manajemen Perkantoran',
            'AK' => 'Akuntansi',
            'AN' => 'Animasi',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'DKV' => 'Desain Komunikasi Visual',
            'PPLG' => 'Pengembangan Perangkat Lunak dan Gim',
            'BP' => 'Broadcasting dan Perfilman',
        ];

        return view('admin.grafik', compact('admin', 'statistik', 'statistik_jurusan_pertama', 'statistik_jurusan_kedua', 'agama', 'map_jurusan'));
    }

    public function pendaftar() {
        // Skrip lama
        $admin = session()->only(['id', 'name', 'level']);
        // $calon_pendaftar = Registrasi::with('user.nilai_raport')->first();
        $calon_pendaftar = Registrasi::with('user.nilai_raport')->get();
        // $registrasi = Registrasi::get();
        // $nilaiRaport = $calon_pendaftar->user->nilai_raport;
        // dd($calon_pendaftar);
        // dd($calon_pendaftar->user, $calon_pendaftar->user->nilai_raport);
        return view('admin.pendaftar', compact('admin', 'calon_pendaftar'));
    }

    public function verifikasi($id) {
        $registrasi = Registrasi::findOrFail($id);

        $registrasi->update([
            'status' => 'Terverifikasi'
        ]);

        return back()->with('success', 'Pendaftar berhasil diverifikasi');
    }

    public function tolak_verifikasi($id) {
        $registrasi = Registrasi::findOrFail($id);

        $registrasi->update([
            'status' => 'Ditolak'
        ]);

        return back()->with('success', 'Pendaftar berhasil ditolak');


    }

}
