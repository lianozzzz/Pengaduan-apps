<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Drop foreign key lama dulu (pastikan nama foreign key benar)
            $table->dropForeign(['user_id']);

            // Ubah tipe kolom user_id dari unsignedBigInteger ke string(12)
            $table->string('user_id', 12)->change();

            // Buat foreign key baru mengarah ke users.no_hp
            $table->foreign('user_id')->references('no_hp')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Drop foreign key baru dulu
            $table->dropForeign(['user_id']);

            // Ubah tipe kolom user_id kembali ke unsignedBigInteger
            $table->unsignedBigInteger('user_id')->change();

            // Buat foreign key lama ke users.id lagi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};

