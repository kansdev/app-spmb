<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataOrangTua extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'data_orang_tua';

    protected $fillable = [
        'user_id',
        'nama_ayah',
        'status_ayah',
        'nomor_ktp_ayah',
        'tahun_lahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'disabilitas_ayah',
        'nama_ibu',
        'status_ibu',
        'nomor_ktp_ibu',
        'tahun_lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'disabilitas_ibu',
        'nama_wali',
        'status_wali',
        'pendidikan_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'disabilitas_wali',
    ];
}
