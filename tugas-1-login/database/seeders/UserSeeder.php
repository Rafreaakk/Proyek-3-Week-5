<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Memanggil model user
use Illuminate\Support\Facades\Hash; // Memanggil fungsi Hash untuk enkripsi password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'username' => 'admin',
            'nama_lengkap' => 'ableh',
            'password' => Hash::make('admin123'), // Password dienkripsi
        ]);
        $admin->role = 'admin';
        $admin->save();

        User::create([
            'username' => 'hilmi',
            'nama_lengkap' => 'hilmi kautsar',
            'password' => Hash::make('hilmi123'), // Password dienkripsi
        ]);

        $staff = User::create([
            'username' => 'najwan',
            'nama_lengkap' => 'najwanKeren',
            'password' => Hash::make('najwan123'), // Password dienkripsi
            'role' => 'staff',
        ]);
        $staff->role = 'staff';
        $staff->save();
    }
}
