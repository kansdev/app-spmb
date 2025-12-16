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
            $table->decimal('nilai_raport_semester_1', 5, 2)->change();
            $table->decimal('nilai_raport_semester_2', 5, 2)->change();
            $table->decimal('nilai_raport_semester_3', 5, 2)->change();
            $table->decimal('nilai_raport_semester_4', 5, 2)->change();
            $table->decimal('nilai_raport_semester_5', 5, 2)->change();
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
