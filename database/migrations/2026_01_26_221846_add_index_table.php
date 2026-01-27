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
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
        });

        Schema::table('registrasi', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('registrasi', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('registrasi', function (Blueprint $table) {
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email']);
        });

        Schema::table('registrasi', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });

        Schema::table('registrasi', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('registrasi', function (Blueprint $table) {
            $table->dropIndex(['status', 'created_at']);
        });
    }
};
