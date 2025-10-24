<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        $total = 0;

        foreach ($keranjang as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        return view('pages.checkout', compact('keranjang', 'total'));
    }

    // Proses konfirmasi pesanan
    public function proses(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:20',
            'pembayaran' => 'required|in:transfer,cod',
        ]);

        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('checkout.index')->with('error', 'Keranjang kamu kosong.');
        }

        // Simpan data pesanan ke database (contoh)
        // Pesanan::create([...]);

        // Kosongkan keranjang
        session()->forget('keranjang');

        return redirect()->route('produk.index')->with('success', 'Pesanan berhasil dikonfirmasi!');
    }
}
