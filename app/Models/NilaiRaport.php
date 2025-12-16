<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiRaport extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'nilai_raport';

    protected $fillable = [
        'user_id',
        'nilai_raport_semester_1',
        'nilai_raport_semester_2',
        'nilai_raport_semester_3',
        'nilai_raport_semester_4',
        'nilai_raport_semester_5',
    ];

    public function getRataRataAttribute() {
        return round((
            $this->nilai_raport_semester_1 +
            $this->nilai_raport_semester_2 +
            $this->nilai_raport_semester_3 +
            $this->nilai_raport_semester_4 +
            $this->nilai_raport_semester_5
        ) / 5, 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
