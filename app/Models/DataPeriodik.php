<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPeriodik extends Model
{
    protected $table = 'data_periodik';

    protected $fillable = [
        'user_id',
        'berat_badan',
        'jarak_tempuh',
        'waktu_tempuh',
        'jumlah_saudara_kandung',
        'tinggi_badan'
    ];
}
