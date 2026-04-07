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
        Schema::create('soal_acak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('registrasi')->cascadeOnDelete();
            $table->foreignId('id_soal')->constrained('soal')->cascadeOnDelete();
            $table->integer('urutan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_acak');
    }
};
