<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Hapus AUTO_INCREMENT dari kolom id
            DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED');

            // 2. Hapus primary key lama
            $table->dropPrimary();

            // 3. Pastikan kolom no_hp unik & tidak nullable
            $table->string('no_hp', 12)->unique()->change();

            // 4. Jadikan no_hp primary key
            $table->primary('no_hp');
        });
    }

    public function down(): void
{
    // Hapus primary key sekarang (no_hp)
    DB::statement('ALTER TABLE users DROP PRIMARY KEY');

    // Set primary key ke kolom id yang sudah ada, pastikan kolom id AUTO_INCREMENT
    DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT');
    DB::statement('ALTER TABLE users ADD PRIMARY KEY (id)');

    // Ubah kolom no_hp jadi nullable (jika perlu)
    DB::statement('ALTER TABLE users MODIFY no_hp VARCHAR(12) NULL');

    // Hapus index unique no_hp jika ada (opsional)
    $indexes = DB::select("SHOW INDEX FROM users WHERE Key_name = 'users_no_hp_unique'");
    if (count($indexes)) {
        DB::statement('ALTER TABLE users DROP INDEX users_no_hp_unique');
    }
}

};
