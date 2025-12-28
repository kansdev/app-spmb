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
        'nilai_bahasa_indonesia_1',
        'nilai_bahasa_indonesia_2',
        'nilai_bahasa_indonesia_3',
        'nilai_bahasa_indonesia_4',
        'nilai_bahasa_indonesia_5',
        'nilai_matematika_1',
        'nilai_matematika_2',
        'nilai_matematika_3',
        'nilai_matematika_4',
        'nilai_matematika_5',
        'nilai_bahasa_inggris_1',
        'nilai_bahasa_inggris_2',
        'nilai_bahasa_inggris_3',
        'nilai_bahasa_inggris_4',
        'nilai_bahasa_inggris_5',
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

    public function getSkorAttribute() {
        $fields = [
            'nilai_bahasa_indonesia_1',
            'nilai_bahasa_indonesia_2',
            'nilai_bahasa_indonesia_3',
            'nilai_bahasa_indonesia_4',
            'nilai_bahasa_indonesia_5',
            'nilai_matematika_1',
            'nilai_matematika_2',
            'nilai_matematika_3',
            'nilai_matematika_4',
            'nilai_matematika_5',
            'nilai_bahasa_inggris_1',
            'nilai_bahasa_inggris_2',
            'nilai_bahasa_inggris_3',
            'nilai_bahasa_inggris_4',
            'nilai_bahasa_inggris_5',
        ];
    
        return round(
            collect($fields)->sum(fn ($field) => $this->$field ?? 0),
            2
        );        
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
