<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus unique lama kalau ada
            $table->dropUnique('users_no_hp_unique');

            // Tambahkan lagi unique (opsional, kalau mau dipastikan tetap unik)
            $table->unique('no_hp', 'users_no_hp_unique');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_no_hp_unique');
        });
    }
};

