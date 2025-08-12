<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('ALTER TABLE users DROP PRIMARY KEY');
        DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE users MODIFY no_hp VARCHAR(12) NOT NULL');
        DB::statement('ALTER TABLE users ADD PRIMARY KEY (no_hp)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE users DROP PRIMARY KEY');
        DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
        DB::statement('ALTER TABLE users MODIFY no_hp VARCHAR(12) NULL');
    }
};

