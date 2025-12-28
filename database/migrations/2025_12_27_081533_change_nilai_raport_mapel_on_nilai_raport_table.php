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
            // hapus field lama
            $table->dropColumn([
                'nilai_raport_semester_1',
                'nilai_raport_semester_2',
                'nilai_raport_semester_3',
                'nilai_raport_semester_4',
                'nilai_raport_semester_5',
            ]);

            // tambah field baru
            $table->decimal('nilai_bahasa_indonesia_1', 5, 2);
            $table->decimal('nilai_bahasa_indonesia_2', 5, 2);
            $table->decimal('nilai_bahasa_indonesia_3', 5, 2);
            $table->decimal('nilai_bahasa_indonesia_4', 5, 2);
            $table->decimal('nilai_bahasa_indonesia_5', 5, 2);

            $table->decimal('nilai_matematika_1', 5, 2);
            $table->decimal('nilai_matematika_2', 5, 2);
            $table->decimal('nilai_matematika_3', 5, 2);
            $table->decimal('nilai_matematika_4', 5, 2);
            $table->decimal('nilai_matematika_5', 5, 2);

            $table->decimal('nilai_bahasa_inggris_1', 5, 2);
            $table->decimal('nilai_bahasa_inggris_2', 5, 2);
            $table->decimal('nilai_bahasa_inggris_3', 5, 2);
            $table->decimal('nilai_bahasa_inggris_4', 5, 2);
            $table->decimal('nilai_bahasa_inggris_5', 5, 2);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_raport', function (Blueprint $table) {
            // hapus field baru
            $table->dropColumn([
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
            ]);
    
            // kembalikan field lama
            $table->decimal('nilai_raport_semester_1', 5, 2);
            $table->decimal('nilai_raport_semester_2', 5, 2);
            $table->decimal('nilai_raport_semester_3', 5, 2);
            $table->decimal('nilai_raport_semester_4', 5, 2);
            $table->decimal('nilai_raport_semester_5', 5, 2);
        });
    }
};
