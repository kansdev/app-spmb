<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';

    protected $fillable = [
        'id_siswa',
        'status',
        'tahap',
        'mulai_at',
        'waktu_selesai_umum',
        'selesai_at'
    ];

    public function registrasi()
    {
        return $this->belongsTo(Registrasi::class, 'id_siswa', 'id');
    }
}
