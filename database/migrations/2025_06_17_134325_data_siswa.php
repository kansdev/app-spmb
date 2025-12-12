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
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_siswa');
            $table->string('jenis_kelamin');
            $table->string('nisn');
            $table->string('no_kk');
            $table->string('nik')->uniqe();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('akta_lahir');
            $table->string('disabilitas');
            $table->string('kwarganegaraan');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('alamat');
            $table->string('tempat_tinggal');
            $table->string('transportasi');
            $table->string('anak_keberapa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};
