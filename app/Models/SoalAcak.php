<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalAcak extends Model
{
    protected $table = 'soal_acak';

    protected $fillable = [
        'id_siswa',
        'id_soal',
        'urutan',
        'tahap'
    ];

    public function registrasi()
    {
        return $this->belongsTo(Registrasi::class, 'id_siswa', 'id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal', 'id');
    }
}
