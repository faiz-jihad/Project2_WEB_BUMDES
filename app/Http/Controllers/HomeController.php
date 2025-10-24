<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Galeri;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 8 produk terbaru untuk ditampilkan di beranda (jika perlu)
        $produk = Produk::latest()->take(8)->get();

        $galeriHome = Galeri::latest()->take(8)->get();

        return view('pages.beranda', compact('galeriHome', 'produk'));
    }
}
