<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'google_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function siswa() {
        return $this->hasOne(DataSiswa::class, 'user_id');
    }

    public function orang_tua() {
        return $this->hasOne(DataOrangTua::class, 'user_id');
    }

    public function periodik() {
        return $this->hasOne(DataPeriodik::class, 'user_id');
    }

    public function nilai_raport() {
        return $this->hasOne(NilaiRaport::class, 'user_id');
    }

    public function upload_berkas() {
        return $this->hasMany(DocumentUpload::class, 'user_id');
    }

    public function upload() {
        return $this->hasOne(DocumentUpload::class, 'user_id');
    }

    public function registrasi() {
        return $this->hasOne(Registrasi::class, 'user_id');
    }
}
