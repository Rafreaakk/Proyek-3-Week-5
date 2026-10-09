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
        User::create([
            'username' => 'admin',
            'nama_lengkap' => 'ableh',
            'password' => Hash::make('admin123'), // Password dienkripsi
        ]);

        User::create([
            'username' => 'hilmi',
            'nama_lengkap' => 'hilmi kautsar',
            'password' => Hash::make('hilmi123'), // Password dienkripsi
        ]);
    }
}
