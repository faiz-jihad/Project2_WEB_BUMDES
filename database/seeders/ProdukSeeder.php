<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Produk::insert([
            [
                'nama' => 'Kopi Arabika Madusari',
                'deskripsi' => 'Kopi lokal dengan cita rasa khas pegunungan.',
                'harga' => 35000,
                'gambar' => 'kopi.jpg',
            ],
            [
                'nama' => 'Madu Hutan Asli',
                'deskripsi' => 'Madu murni dari lebah hutan tanpa campuran.',
                'harga' => 55000,
                'gambar' => 'madu.jpg',
            ],
        ]);
    }
}


