<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Penulis;

class PenulisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dengan role 'penulis'
        $penulisUsers = User::where('role', 'penulis')->get();

        foreach ($penulisUsers as $user) {
            // Cek apakah sudah ada di tabel penulis
            $existingPenulis = Penulis::where('nama_penulis', $user->name)->first();

            if (!$existingPenulis) {
                Penulis::create([
                    'nama_penulis' => $user->name,
                    'Username' => $user->email, // menggunakan email sebagai username
                    'email' => $user->email, // menambahkan email untuk notifikasi
                    'Password' => $user->password, // menggunakan password yang sama
                    'Avatar' => $user->avatar ?? 'default-avatar.png',
                    'Bio' => 'Penulis konten untuk BUMDes Madusari',
                ]);
            }
        }
    }
}
