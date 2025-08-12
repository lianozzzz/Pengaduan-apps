<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Drop primary key no_hp
        DB::statement('ALTER TABLE users DROP PRIMARY KEY');

        // 2. Ubah kolom id jadi AUTO_INCREMENT dan NOT NULL
        DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT');

        // 3. Jadikan id sebagai primary key
        DB::statement('ALTER TABLE users ADD PRIMARY KEY (id)');

        // 4. (Opsional) Ubah no_hp jadi nullable
        DB::statement('ALTER TABLE users MODIFY no_hp VARCHAR(12) NULL');

        // 5. (Opsional) Hapus unique index no_hp jika ada
        $indexes = DB::select("SHOW INDEX FROM users WHERE Key_name = 'users_no_hp_unique'");
        if(count($indexes)) {
            DB::statement('ALTER TABLE users DROP INDEX users_no_hp_unique');
        }
    }

    public function down(): void
    {
        // Balik lagi ke no_hp sebagai primary key

        DB::statement('ALTER TABLE users DROP PRIMARY KEY');

        DB::statement('ALTER TABLE users MODIFY no_hp VARCHAR(12) NOT NULL');

        DB::statement('ALTER TABLE users ADD PRIMARY KEY (no_hp)');

        DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL');

        // (Opsional) Tambah unique index no_hp kembali jika perlu
        DB::statement('ALTER TABLE users ADD UNIQUE INDEX users_no_hp_unique (no_hp)');
    }
};

