<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Drop existing foreign key constraint if exists
        try {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        } catch (Exception $e) {
            // Foreign key mungkin tidak ada, lanjut saja
        }
        
        // Rename column user_id to no_hp and change its type
        DB::statement('ALTER TABLE pengaduans CHANGE user_id no_hp VARCHAR(12) NOT NULL');
        
        // Add new foreign key constraint
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->foreign('no_hp')
                  ->references('no_hp')
                  ->on('users')
                  ->onDelete('cascade');
        });
        
        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Drop the foreign key
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropForeign(['no_hp']);
        });
        
        // Rename back to user_id
        DB::statement('ALTER TABLE pengaduans CHANGE no_hp user_id BIGINT(20) NOT NULL');
        
        // Add back old foreign key (this might fail if users.id doesn't exist)
        // Schema::table('pengaduans', function (Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};