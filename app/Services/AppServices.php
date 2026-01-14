<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

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
        return [
            'calon_pendaftar' => cache()->remember(
                'calon_pendaftar',
                300,
                fn () => User::doesntHave('registrasi')->count()
            ), 
            'teregistrasi' => cache()->remember(
                'teregistrasi',
                300,
                fn () => Registrasi::count()
            ),
            'users' => cache()->remember(
                'users',
                300,
                fn () => User::count()
            )
        ];
        Log::info('Service dipanggil');
    } 

    public function getDataUser() {
        $data_user = User::select('id', 'name', 'email')
        ->with([
            'siswa',
            'orang_tua',
            'periodik',
            'nilai_raport',
            'upload',
            'registrasi'
        ])
        ->paginate(20);

        $data_user->getCollection()->transform(function ($user) {
            $user->sudah_isi_form = 
                $user->siswa || 
                $user->orang_tua ||
                $user->periodik ||
                $user->nilai_raport ||
                $user->upload_berkas ||
                $user->registrasi;

            return $user;
        });
        Log::info('Service dipanggil');

        return $data_user;
    }

    public function getCekUser() {
        return User::with([
            'siswa',
            'orang_tua',
            'periodik',
            'nilai_raport',
            'upload',
            'registrasi'
        ])
        ->whereDoesntHave('registrasi')
        ->paginate(20);

        Log::info('Service dipanggil');
    }

    public function getDataSiswa() {
        Log::info('Service dipanggil');
        return DataSiswa::with('user')->get();
    }

    public function getPendaftarTeregistrasi() {
        Log::info('Service dipanggil');
        return Registrasi::get();
    }
}

