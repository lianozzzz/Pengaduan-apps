<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus primary key lama
            $table->dropPrimary();

            // Pastikan no_hp unik dan tidak nullable
            $table->string('no_hp', 12)->unique()->change();

            // Set no_hp jadi primary key
            $table->primary('no_hp');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke primary key id
            $table->dropPrimary();
            $table->bigIncrements('id')->first();
        });
    }
};

