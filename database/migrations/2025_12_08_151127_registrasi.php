<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nomor_pendaftaran')->unique();
            $table->string('nama_siswa');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('nisn')->unique();
            $table->string('nik')->unique();
            $table->string('asal_sekolah');
            $table->string('jurusan_pertama');
            $table->string('jurusan_kedua');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi');
    }
};
