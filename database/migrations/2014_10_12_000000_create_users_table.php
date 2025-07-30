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
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
        $table->date('tanggal_lahir');
        $table->string('no_hp');
        $table->string('username')->unique(); // Tambahkan unique
        $table->string('password');
        $table->enum('role', ['admin', 'user'])->default('user'); // Role dibatasi dan diberi default
        $table->rememberToken(); // Tambahkan ini untuk fitur login Laravel
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
