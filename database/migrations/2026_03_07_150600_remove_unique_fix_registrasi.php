<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fix_registrasi', function (Blueprint $table) {
            $table->dropUnique('fix_registrasi_nisn_unique');
            $table->dropUnique('fix_registrasi_nik_unique');
        });
    }

    public function down()
    {
        Schema::table('fix_registrasi', function (Blueprint $table) {
            $table->unique('nisn');
            $table->unique('nik');
        });
    }
};
