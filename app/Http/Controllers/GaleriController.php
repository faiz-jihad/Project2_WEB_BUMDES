<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function foto(Request $request)
    {
        // Ambil kategori dari query string, default "all"
        $kategori = $request->get('kategori', 'all');

        // Ambil daftar kategori unik
        $kategoriList = Galeri::select('kategori')->distinct()->pluck('kategori');

        // Ambil galeri, filter jika kategori dipilih
        $galeriQuery = Galeri::query()->latest();
        if ($kategori != 'all') {
            $galeriQuery->where('kategori', $kategori);
        }

        $galeri = $galeriQuery->paginate(12); // pagination 12 per halaman

        return view('pages.galeri', compact('galeri', 'kategoriList', 'kategori'));
    }
}
