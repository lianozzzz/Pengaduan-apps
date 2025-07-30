<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnLengthsInTables extends Migration
{
    public function up()
    {
        // Update tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_lengkap', 30)->change();
            $table->string('no_hp', 12)->change();
            $table->string('username', 15)->change();
        });

        // Update tabel pengaduans
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('judul_pengaduan', 50)->change();
            $table->string('lokasi', 50)->change();
        });
    }

    public function down()
    {
        // Kembalikan ke panjang sebelumnya (ubah sesuai default awalmu)
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_lengkap', 255)->change();
            $table->string('no_hp', 255)->change();
            $table->string('username', 255)->change();
        });

        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('judul_pengaduan', 255)->change();
            $table->string('lokasi', 255)->change();
        });
    }
}
