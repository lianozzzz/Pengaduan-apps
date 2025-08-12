<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
   public function up(): void
{
    // 1. Ubah kolom id jadi BIGINT UNSIGNED tanpa AUTO_INCREMENT dulu
    DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL');

    // 2. Drop primary key lama (dari kolom id)
    DB::statement('ALTER TABLE users DROP PRIMARY KEY');

    // 3. Ubah kolom no_hp jadi unik dan NOT NULL
    Schema::table('users', function (Blueprint $table) {
        $table->string('no_hp', 12)->unique()->nullable(false)->change();
    });

    // 4. Jadikan no_hp primary key baru
    DB::statement('ALTER TABLE users ADD PRIMARY KEY (no_hp)');
}



    public function down(): void
{
    // 1. Drop primary key no_hp
    DB::statement('ALTER TABLE users DROP PRIMARY KEY');

    // 2. Jadikan kolom id AUTO_INCREMENT dan primary key lagi
    DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT');
    DB::statement('ALTER TABLE users ADD PRIMARY KEY (id)');

    // 3. Ubah kolom no_hp jadi nullable dan hapus unique index
    Schema::table('users', function (Blueprint $table) {
        $table->string('no_hp', 12)->nullable()->change();
        $table->dropUnique('users_no_hp_unique'); // pastikan nama index sesuai
    });
}


};
