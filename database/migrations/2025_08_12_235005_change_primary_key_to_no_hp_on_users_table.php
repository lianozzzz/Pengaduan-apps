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
        Schema::table('users', function (Blueprint $table) {
            // Balikin primary key ke id
            $table->dropPrimary();
            DB::statement('ALTER TABLE users MODIFY id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY');
        });
    }
};
