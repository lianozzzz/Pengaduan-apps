<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Matikan sementara pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('lokasi', 100)->change();
        });

        // Nyalakan lagi pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('lokasi', 50)->change();
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
