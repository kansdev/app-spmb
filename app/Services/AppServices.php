<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\DataSiswa;
use App\Models\DataOrangTua;
use App\Models\DataPeriodik;
use App\Models\DocumentUpload;
use App\Models\NilaiRaport;
use App\Models\Registrasi;
use App\Models\Admin;

class AppServices
{
    public function getStatusPendaftar(): array {
        return cache()->remember('dashboard_stats', 300, function () {
            return [
                'users' => User::count(),
                'calon_pendaftar' => User::whereDoesntHave('registrasi')->count(),
                'teregistrasi' => Registrasi::count(),
            ];
            // 'calon_pendaftar' => cache()->remember(
            //     'calon_pendaftar',
            //     300,
            //     fn () => User::doesntHave('registrasi')->count()
            // ),
            // 'teregistrasi' => cache()->remember(
            //     'teregistrasi',
            //     300,
            //     fn () => Registrasi::count()
            // ),
            // 'users' => cache()->remember(
            //     'users',
            //     300,
            //     fn () => User::count()
            // )
        });
        Log::info('Service status pendaftar dipanggil');
    }

    public function getDataUser() {
        $data_user = User::select('id', 'name', 'email', 'phone')->withExists([
            'siswa',
            'orang_tua',
            'periodik',
            'nilai_raport',
            'upload',
            'registrasi'
        ])
        ->orderBy('id', 'desc')
        ->paginate(20);
        Log::info('Service data user dipanggil');

        return $data_user;
    }

    public function getCekUser() {
        Log::info('Service cek user dipanggil');
        return User::with([
            'siswa:id,user_id,nama_siswa',
            'orang_tua',
            'periodik',
            'nilai_raport',
            'upload',
            'registrasi'
        ])
        ->withCount([
            'siswa',
            'orang_tua',
            'periodik',
            'nilai_raport',
            'upload',
            'registrasi'
        ])
        ->whereDoesntHave('registrasi')
        ->paginate(20);
    }

    public function getDataSiswa() {
        Log::info('Service data siswa dipanggil');
        return DataSiswa::with('user')->get();
    }

    public function getPendaftarTeregistrasi() {
        Log::info('Service pendaftar teregistrasi dipanggil');
        // return Registrasi::get();
        $registrasi = User::with('registrasi')->whereHas('registrasi')->paginate(20);
        return $registrasi;
        // return 'tes';
    }

    public function getStatistikWilayah() {
        // Ambil data siswa kelompok perkecamatan -> per kelurahan
        // Mengelompokan kecamatan supaya gampang di looping
        return DataSiswa::select('kecamatan', 'kelurahan', DB::raw('COUNT(*) as total'))
            ->groupBy('kecamatan', 'kelurahan')
            ->orderBy('kecamatan')
            ->orderBy('kelurahan')
            ->get()
            ->groupBy('kecamatan');
    }

    public function getStatistikAgama() {
        return DataSiswa::select('agama', DB::raw('COUNT(*) as total'))
            ->groupBy('agama')
            ->pluck('total', 'agama');
    }

    public function getStatistikJurusan(): array {
        $jurusan_pertama = Registrasi::select('jurusan_pertama as jurusan', DB::raw('COUNT(*) as total'))
            ->whereNotNull('jurusan_pertama')
            ->groupBy('jurusan_pertama')
            ->orderByDesc('total')
            ->pluck('total', 'jurusan');

        $jurusan_kedua = Registrasi::select('jurusan_kedua as jurusan', DB::raw('COUNT(*) as total'))
            ->whereNotNull('jurusan_kedua')
            ->groupBy('jurusan_kedua')
            ->orderByDesc('total')
            ->pluck('total', 'jurusan');

        return [
            'statistik_jurusan_pertama' => $jurusan_pertama,
            'statistik_jurusan_kedua' => $jurusan_kedua,
            'map_jurusan' => $this->map_jurusan()
        ];
    }

    public function map_jurusan() {
        return [
            'MP' => 'Manajemen Perkantoran',
            'AK' => 'Akuntansi',
            'AN' => 'Animasi',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'DKV' => 'Desain Komunikasi Visual',
            'PPLG' => 'Pengembangan Perangkat Lunak dan Gim',
            'BP' => 'Broadcasting dan Perfilman',
        ];
    }

    public function getCalonPendaftar() {
        return Registrasi::with('user.nilai_raport')
            ->where('status', 'Belum Terverifikasi')
            ->orderBy('created_at', 'asc')
            // ->get();
            ->paginate(15);
    }

    public function getTotalJurusanPertama() {
        return Registrasi::select('jurusan_pertama')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('jurusan_pertama')
            ->get();
    }

    public function getPendaftar() {
        return Registrasi::with('user.nilai_raport')
            ->where('status', 'Terverifikasi')
            ->orderBy('created_at', 'desc')
            // ->get();
            ->paginate(15);
    }

    public function getDataDiTolak() {
        return Registrasi::with('user.nilai_raport')
            ->where('status', 'Ditolak')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function verifikasi(int $id): void {
        $registrasi = Registrasi::findOrFail($id);

        if ($registrasi->status === 'Terverifikasi') {
            return ;
        }

        $registrasi->update([
            'status' => 'Terverifikasi'
        ]);
    }

    public static function toNominal($kode): int
    {
        return match ((int) $kode) {
            1 => 999_999,
            2 => 2_999_999,
            3 => 4_999_999,
            4 => 7_999_999,
            5 => 9_999_999,
            6 => 10_000_000,
            default => 7,
        };
    }

    public static function label($kode): string
    {
        return match ((int) $kode) {
            1 => '< Rp 1.000.000',
            2 => 'Rp 1.000.000 s/d 2.999.999',
            3 => 'Rp 3.000.000 s/d 4.999.999',
            4 => 'Rp 5.000.000 s/d 7.999.999',
            5 => 'Rp 8.000.000 s/d 9.999.999',
            6 => '> Rp 10.000.000',
            default => 'Tidak Berpenghasilan',
        };
    }
}

