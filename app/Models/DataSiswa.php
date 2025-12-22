<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'data_siswa';

    protected $fillable = [
        'user_id',
        'nama_siswa',
        'jenis_kelamin',
        'nisn',
        'no_kk',
        'nik',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'akta_lahir',
        'disabilitas',
        'kwarganegaraan',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'alamat',
        'tempat_tinggal',
        'transportasi',
        'anak_keberapa'
    ];

    // Relasi ke user
    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
