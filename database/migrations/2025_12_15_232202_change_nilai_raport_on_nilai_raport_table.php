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
        Schema::table('nilai_raport', function (Blueprint $table) {
            $table->decimal('nilai_bahasa_indonesia_1', 5, 2)->change();
            $table->decimal('nilai_bahasa_indonesia_2', 5, 2)->change();
            $table->decimal('nilai_bahasa_indonesia_3', 5, 2)->change();
            $table->decimal('nilai_bahasa_indonesia_4', 5, 2)->change();
            $table->decimal('nilai_bahasa_indonesia_5', 5, 2)->change();
            $table->decimal('nilai_matematika_1', 5, 2)->change();
            $table->decimal('nilai_matematika_2', 5, 2)->change();
            $table->decimal('nilai_matematika_3', 5, 2)->change();
            $table->decimal('nilai_matematika_4', 5, 2)->change();
            $table->decimal('nilai_matematika_5', 5, 2)->change();
            $table->decimal('nilai_bahasa_inggris_1', 5, 2)->change();
            $table->decimal('nilai_bahasa_inggris_2', 5, 2)->change();
            $table->decimal('nilai_bahasa_inggris_3', 5, 2)->change();
            $table->decimal('nilai_bahasa_inggris_4', 5, 2)->change();
            $table->decimal('nilai_bahasa_inggris_5', 5, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_raport', function (Blueprint $table) {
            $table->decimal('nilai_raport_semester_1')->change();
            $table->decimal('nilai_raport_semester_2')->change();
            $table->decimal('nilai_raport_semester_3')->change();
            $table->decimal('nilai_raport_semester_4')->change();
            $table->decimal('nilai_raport_semester_5')->change();
        });
    }
};
