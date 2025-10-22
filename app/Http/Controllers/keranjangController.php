<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class keranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        $total = 0;

        foreach ($keranjang as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        return view('pages.keranjang', compact('keranjang', 'total'));
    }

    public function tambah(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);
        $keranjang = session()->get('keranjang', []);

        $id = $produk->id . ($request->variasi ? '-' . $request->variasi : '');

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = [
                'id' => $produk->id,
                'nama' => $produk->nama,
                'harga' => $produk->harga,
                'gambar' => $produk->gambar,
                'variasi' => $request->variasi,
                'jumlah' => 1,
            ];
        }

        session()->put('keranjang', $keranjang);

        return response()->json(['success' => true]);
    }

    public function hapus(Request $request)
    {
        $keranjang = session()->get('keranjang', []);
        unset($keranjang[$request->id]);
        session()->put('keranjang', $keranjang);

        return redirect()->route('keranjang.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}
