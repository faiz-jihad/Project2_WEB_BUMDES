<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Galeri;
use App\Models\Banner; // ⬅️ Tambahkan ini
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 8 produk terbaru
        $produk = Produk::latest()->take(8)->get();

        // Ambil 8 foto galeri terbaru
        $galeriHome = Galeri::latest()->take(8)->get();

        // Ambil semua data banner (atau bisa limit jika perlu)
        $banners = Banner::with('berita.kategoriBerita')->latest()->get();

        // Kirim semua variabel ke view
        return view('pages.beranda', compact('galeriHome', 'produk', 'banners'));
    }
}
