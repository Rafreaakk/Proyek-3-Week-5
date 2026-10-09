<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            ['nama' => 'Raw Denim 22Oz Zero Zeke', 'harga' => 1600000, 'stok' => 10],
            ['nama' => 'Raw Denim 17Oz IndiBrown', 'harga' => 1200000, 'stok' => 15],
            ['nama' => 'Raw Denim 14Oz Indigo', 'harga' => 800000, 'stok' => 20],
            ['nama' => 'Japanese Selvedge Denim 16oz', 'harga' => 1000000, 'stok' => 12],
            ['nama' => 'Loose Denim 120z IndiBrown', 'harga' => 900000, 'stok' => 18],
        ];
    

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }

    }
}
