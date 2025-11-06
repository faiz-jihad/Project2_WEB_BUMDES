<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query pencarian
        $search = $request->get('search');

        // Query berita dengan filter pencarian
        $beritaQuery = Berita::with('kategoriBerita', 'penulis');

        if ($search) {
            $beritaQuery->where(function ($query) use ($search) {
                $query->where('Judul', 'like', '%' . $search . '%')
                    ->orWhere('Isi_Berita', 'like', '%' . $search . '%');
            });
        }

        $berita = $beritaQuery->latest()->paginate(12)->appends(['search' => $search]);

        // Ambil kategori berita untuk navigasi
        $kategori = KategoriBerita::all();

        // Ambil berita populer (berdasarkan jumlah views atau created_at terbaru)
        $populer = Berita::with('kategoriBerita', 'penulis')
            ->latest()
            ->take(5)
            ->get();

        // Ambil banner untuk slider jika diperlukan
        $banners = Banner::with('berita.kategoriBerita', 'berita.penulis')->get();

        return view('pages.Berita', compact('berita', 'banners', 'kategori', 'populer', 'search'));
    }

    public function kategori(Request $request, $slug)
    {
        // Cari kategori berdasarkan slug
        $kategori = KategoriBerita::where('slug', $slug)->firstOrFail();

        // Ambil query pencarian
        $search = $request->get('search');

        // Query berita berdasarkan kategori dengan filter pencarian
        $beritaQuery = Berita::with('kategoriBerita', 'penulis')
            ->where('id_kategori', $kategori->id_kategori);

        if ($search) {
            $beritaQuery->where(function ($query) use ($search) {
                $query->where('Judul', 'like', '%' . $search . '%')
                    ->orWhere('Isi_Berita', 'like', '%' . $search . '%');
            });
        }

        $berita = $beritaQuery->latest()->paginate(12)->appends(['search' => $search]);

        // Ambil semua kategori untuk navigasi
        $kategoriBerita = KategoriBerita::all();

        // Ambil berita populer
        $populer = Berita::with('kategoriBerita', 'penulis')
            ->latest()
            ->take(5)
            ->get();

        return view('pages.Berita', compact('berita', 'kategori', 'kategoriBerita', 'populer', 'search'));
    }



    public function show($slug)
    {
        $berita = Berita::with('kategoriBerita', 'penulis')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.detail', compact('berita'));
    }
}
