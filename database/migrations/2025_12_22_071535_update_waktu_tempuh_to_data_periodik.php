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
        Schema::table('data_periodik', function (Blueprint $table) {
            $table->integer('waktu_tempuh')->comment('dalam menit')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_periodik', function (Blueprint $table) {
            $table->dropColumn('waktu_tempuh')->change();
        });
    }
};
