<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // 1. Hapus primary key no_hp
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

    public function down(): void
    {
        // Balik ke primary key no_hp lagi (jika rollback)
        DB::statement('ALTER TABLE users DROP PRIMARY KEY');

        Schema::table('users', function (Blueprint $table) {
            $table->string('no_hp', 12)->unique()->nullable(false)->change();
        });

        DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE users ADD PRIMARY KEY (no_hp)');
    }
};

