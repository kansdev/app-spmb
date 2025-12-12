<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class IdCard extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kelas', 'jurusan', 'foto_path'];
}
