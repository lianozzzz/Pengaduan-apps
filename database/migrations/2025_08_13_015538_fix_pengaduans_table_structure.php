<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Hapus foreign key constraint lama jika ada
            $table->dropForeign(['user_no_hp']);
            $table->dropColumn('user_no_hp');
            
            // Pastikan kolom no_hp ada dan merupakan foreign key
            if (!Schema::hasColumn('pengaduans', 'no_hp')) {
                $table->string('no_hp');
            }
            
            // Tambah foreign key constraint baru
            $table->foreign('no_hp')->references('no_hp')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropForeign(['no_hp']);
            $table->string('user_no_hp');
            $table->foreign('user_no_hp')->references('no_hp')->on('users')->onDelete('cascade');
        });
    }
};