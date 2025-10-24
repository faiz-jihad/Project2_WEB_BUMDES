<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class KeranjangController extends Controller
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
        $id = $produk->id . ($request->variasi ?? '');

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = [
                'id' => $produk->id,
                'nama' => $produk->nama,
                'harga' => $produk->harga,
                'gambar' => $produk->gambar,
                'variasi' => $request->variasi ?? null,
                'jumlah' => 1,
            ];
        }

        session()->put('keranjang', $keranjang);
        return response()->json(['success' => true]);
    }

    public function hapus(Request $request)
    {
        $keranjang = session()->get('keranjang', []);
        $id = $request->id;

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function updateJumlah(Request $request)
    {
        $keranjang = session()->get('keranjang', []);
        $id = $request->id;
        $jumlah = max(1, (int) $request->jumlah);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] = $jumlah;
            session()->put('keranjang', $keranjang);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
