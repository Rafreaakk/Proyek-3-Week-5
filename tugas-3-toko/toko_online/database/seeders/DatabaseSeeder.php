<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'id_user' => 'USR001',
            'nama_lengkap' => 'Rafi Ardi',
            'email' => 'rafi@gmail.com',
            'username' => 'rafi',
            'password' => Hash::make('123456'),
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Gegerkalongsari No. 15, Bandung'
        ]);

        // 10 Produk Denim
        $products = [
            ['id_barang' => 'BRG001', 'nama_barang' => 'Raw Denim 14oz Heavyweight', 'deskripsi' => 'Celana denim kaku berkualits tinggi.', 'harga' => 350000, 'stok' => 10, 'gambar' => '1.jpg'],
            ['id_barang' => 'BRG002', 'nama_barang' => 'Slim Fit Indigo Wash Denim', 'deskripsi' => 'Celana denim pas di kaki warna indigo.', 'harga' => 280000, 'stok' => 5, 'gambar' => '2.jpg'],
            ['id_barang' => 'BRG003', 'nama_barang' => 'Baggy Vintage Light Blue', 'deskripsi' => 'Gaya potong longgar warna biru muda.', 'harga' => 310000, 'stok' => 8, 'gambar' => '3.jpg'],
            ['id_barang' => 'BRG004', 'nama_barang' => 'Japanese Selvedge Denim 16oz', 'deskripsi' => 'Bahan jepang kualitas terbaik.', 'harga' => 550000, 'stok' => 3, 'gambar' => '4.jpg'],
            ['id_barang' => 'BRG005', 'nama_barang' => 'Black Washed Straight Fit', 'deskripsi' => 'Warna hitam pudar dengan potongan lurus.', 'harga' => 290000, 'stok' => 12, 'gambar' => '5.jpg'],
            ['id_barang' => 'BRG006', 'nama_barang' => 'Loose Denim 12oz IndiBrown', 'deskripsi' => 'Warna cokelat indigo gaya santai.', 'harga' => 320000, 'stok' => 6, 'gambar' => '6.jpg'],
            ['id_barang' => 'BRG007', 'nama_barang' => 'Raw Denim 22oz Zero Zeke', 'deskripsi' => 'Super tebal dan kaku.', 'harga' => 650000, 'stok' => 0, 'gambar' => '7.jpg'], // Stok 0 untuk tes
            ['id_barang' => 'BRG008', 'nama_barang' => 'Relaxed Fit Deep Blue', 'deskripsi' => 'Nyaman dipakai seharian.', 'harga' => 270000, 'stok' => 7, 'gambar' => '8.jpg'],
            ['id_barang' => 'BRG009', 'nama_barang' => 'Classic Straight Denim 15oz', 'deskripsi' => 'Model klasik sepanjang masa.', 'harga' => 340000, 'stok' => 4, 'gambar' => '9.jpg'],
            ['id_barang' => 'BRG010', 'nama_barang' => 'Ripped Skinny Denim', 'deskripsi' => 'Gaya sobek-sobek kekinian.', 'harga' => 300000, 'stok' => 2, 'gambar' => '10.jpg'],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
