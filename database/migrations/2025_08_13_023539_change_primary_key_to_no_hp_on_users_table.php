<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Drop primary key lama (id)
        DB::statement('ALTER TABLE users DROP PRIMARY KEY');

        // Ubah kolom no_hp jadi unik dan tidak nullable
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_hp', 12)->unique()->nullable(false)->change();
        });

        // Set primary key baru ke no_hp
        DB::statement('ALTER TABLE users ADD PRIMARY KEY (no_hp)');
    }

    public function down(): void
    {
        // Drop primary key no_hp
        DB::statement('ALTER TABLE users DROP PRIMARY KEY');

        // Set primary key ke kolom id kembali
        DB::statement('ALTER TABLE users ADD PRIMARY KEY (id)');

        // Ubah kolom no_hp jadi nullable dan hapus unique index
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_hp', 12)->nullable()->change();
            $table->dropUnique('users_no_hp_unique');
        });
    }
};

