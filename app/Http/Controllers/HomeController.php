<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Galeri;
use App\Models\Banner; // ⬅️ Tambahkan ini
use App\Models\User; // ⬅️ Tambahkan untuk hitung anggota aktif
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 8 produk terbaru yang masih tersedia (stok > 0)
        $produk = Produk::where('stok', '>', 0)->latest()->take(8)->get();

        // Ambil 8 foto galeri terbaru
        $galeriHome = Galeri::latest()->take(8)->get();

        // Ambil semua data banner (atau bisa limit jika perlu)
        $banners = Banner::with('berita.kategoriBerita')->latest()->get();

        // Hitung jumlah anggota aktif (user yang terdaftar)
        $anggotaAktif = User::count();

        // Kirim semua variabel ke view
        return view('pages.beranda', compact('galeriHome', 'produk', 'banners', 'anggotaAktif'));
    }
}
