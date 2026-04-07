<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    protected $fillable = [
        'id_siswa',
        'id_soal',
        'kunci_jawaban',
        'tahap',
        'urutan'
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
