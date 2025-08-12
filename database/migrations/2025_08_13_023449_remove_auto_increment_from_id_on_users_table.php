<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Hapus AUTO_INCREMENT dari kolom id
        DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL');
    }

    public function down(): void
    {
        // Balikkan ke AUTO_INCREMENT
        DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT');
    }
};
