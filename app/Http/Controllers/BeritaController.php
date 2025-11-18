<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Services\ViewTrackingService;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    protected $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    public function index(Request $request)
    {
        // Ambil query pencarian
        $search = $request->get('search');

        // Query berita dengan filter pencarian - hanya yang approved
        $beritaQuery = Berita::with('kategoriBerita', 'penulis')
            ->where('status', 'approved');

        if ($search) {
            $beritaQuery->where(function ($query) use ($search) {
                $query->where('Judul', 'like', '%' . $search . '%')
                    ->orWhere('Isi_Berita', 'like', '%' . $search . '%');
            });
        }

        $berita = $beritaQuery->latest()->paginate(12)->appends(['search' => $search]);

        // Ambil kategori berita untuk navigasi
        $kategori = KategoriBerita::all();

        // Ambil berita populer (berdasarkan jumlah views) - hanya yang approved
        $populer = Berita::with('kategoriBerita', 'penulis')
            ->where('status', 'approved')
            ->orderBy('views_count', 'desc')
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

        // Query berita berdasarkan kategori dengan filter pencarian - hanya yang approved
        $beritaQuery = Berita::with('kategoriBerita', 'penulis')
            ->where('id_kategori', $kategori->id_kategori)
            ->where('status', 'approved');

        if ($search) {
            $beritaQuery->where(function ($query) use ($search) {
                $query->where('Judul', 'like', '%' . $search . '%')
                    ->orWhere('Isi_Berita', 'like', '%' . $search . '%');
            });
        }

        $berita = $beritaQuery->latest()->paginate(12)->appends(['search' => $search]);

        // Ambil semua kategori untuk navigasi
        $kategoriBerita = KategoriBerita::all();

        // Ambil berita populer (berdasarkan views) - hanya yang approved
        $populer = Berita::with('kategoriBerita', 'penulis')
            ->where('status', 'approved')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        return view('pages.Berita', compact('berita', 'kategoriBerita', 'populer', 'search'));
    }

    public function show($slug)
    {
        $berita = Berita::with('kategoriBerita', 'penulis')
            ->where('slug', $slug)
            ->firstOrFail();

        // Track view
        $this->viewTrackingService->trackView($berita);

        return view('pages.detail', compact('berita'));
    }

    /*
    |--------------------------------------------------------------------------
    | LIKE METHODS
    |--------------------------------------------------------------------------
    */
    public function like($slug)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $berita = Berita::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        if ($berita->isLikedBy($user)) {
            // Unlike
            $berita->likedByUsers()->detach($user->id);
            $liked = false;
        } else {
            // Like
            $berita->likedByUsers()->attach($user->id);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $berita->likesCount()
        ]);
    }
}
