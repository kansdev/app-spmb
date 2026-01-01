<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    protected $table = 'registrasi';

    protected $fillable = [
        'user_id',
        'nomor_pendaftaran',
        'nama_siswa',
        'nomor_pendaftar',
        'tempat_lahir',
        'tanggal_lahir',
        'nisn',
        'nis',
        'nik',
        'asal_sekolah',
        'jurusan_pertama',
        'jurusan_kedua',
        'status',
        'gelombang_sesi',
        'waktu_sesi'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }


}
