<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Tampilkan semua produk di halaman utama produk.
     */
    public function index(Request $request)
    {
        $query = Produk::query();

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $produk = $query->latest()->get();

        return view('pages.produk', compact('produk'));
    }

    /**
     * Tampilkan detail produk tertentu.
     */
    public function show($slug)
    {
        $produk = Produk::where('slug', $slug)->first();

        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan.');
        }

        // Ambil produk lain yang berbeda dari produk saat ini
        $produkLainnya = Produk::where('id', '!=', $produk->id)
            ->where('kategori_id', $produk->kategori_id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Jika produk lain dalam kategori tidak cukup, ambil dari kategori lain
        if ($produkLainnya->count() < 4) {
            $produkTambahan = Produk::where('id', '!=', $produk->id)
                ->whereNotIn('id', $produkLainnya->pluck('id'))
                ->inRandomOrder()
                ->limit(4 - $produkLainnya->count())
                ->get();

            $produkLainnya = $produkLainnya->merge($produkTambahan);
        }

        return view('pages.detailProduk', compact('produk', 'produkLainnya'));
    }

    /**
     * (Opsional) Tambah produk baru dari admin panel.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }
}
