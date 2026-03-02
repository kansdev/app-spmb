<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixRegistrasi extends Model
{
    protected $table = 'fix_registrasi';

    protected $fillable = [
        'nomor_pendaftaran',
        'nama_siswa',
        'nomor_pendaftar',
        'tempat_lahir',
        'tanggal_lahir',
        'nisn',
        'nis',
        'nik',
        'asal_sekolah',
        'skor_tes',
        'jurusan',
        'status',
    ];
}
