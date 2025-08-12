<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['user_id']);
            
            // Ganti kolom user_id jadi user_no_hp
            $table->renameColumn('user_id', 'user_no_hp');

            // Sesuaikan tipe data (misalnya string 15 untuk no HP)
            $table->string('user_no_hp', 15)->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->renameColumn('user_no_hp', 'user_id');
            $table->unsignedBigInteger('user_id')->change();
        });
    }
};
