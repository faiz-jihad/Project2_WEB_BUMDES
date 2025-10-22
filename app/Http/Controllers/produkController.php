<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Tampilkan semua produk di halaman utama produk.
     */
    public function index()
    {
        $produk = Produk::latest()->get();

        return view('pages.produk', compact('produk'));
    }

    /**
     * Tampilkan detail produk tertentu.
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);

        return view('pages.detailProduk', compact('produk'));
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
