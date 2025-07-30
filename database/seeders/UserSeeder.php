<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat role jika belum ada
        $adminRole = Role::updateOrCreate(['name' => 'admin']);
        $userRole = Role::updateOrCreate(['name' => 'user']);

        // Buat user admin
        $admin = User::updateOrCreate(
            ['username' => 'admin'],
            [
                'nama_lengkap' => 'Admin Sistem',
                'jenis_kelamin' => 'Laki-Laki',
                'tanggal_lahir' => '1990-01-01',
                'no_hp' => '081234567890',
                'username' => 'admin',
                'password' => Hash::make('admin123'), // ganti password sesuai keinginan
                'role' => 'admin',
            ]
        );
        $admin->assignRole($adminRole);

        // Buat user biasa 
        $user = User::updateOrCreate(
            ['username' => 'user'],
            [
                'nama_lengkap' => 'User Biasa',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '2000-01-01',
                'no_hp' => '089876543210',
                'username' => 'user',
                'password' => Hash::make('admin123'), // ganti password sesuai keinginan
                'role' => 'user',
            ]
        );
        $user->assignRole($userRole);
    }
}
