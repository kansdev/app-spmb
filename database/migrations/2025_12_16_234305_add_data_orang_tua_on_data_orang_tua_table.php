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
        Schema::table('data_orang_tua', function (Blueprint $table) {
            $table->string('nomor_ktp_ayah');
            $table->string('nomor_ktp_ibu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_orang_tua', function (Blueprint $table) {
            $table->string('nomor_ktp_ayah');
            $table->string('nomor_ktp_ibu');
        });
    }
};
