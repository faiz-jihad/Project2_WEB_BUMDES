<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        if (Auth::check()) {
            // Jika user login, ambil dari database
            $keranjangItems = Keranjang::where('user_id', Auth::id())
                ->with('produk')
                ->get();

            $keranjang = [];
            $total = 0;

            foreach ($keranjangItems as $item) {
                $id = $item->produk_id . ($item->variasi ?? '');
                $keranjang[$id] = [
                    'id' => $item->produk_id,
                    'nama' => $item->produk->nama,
                    'harga' => $item->produk->harga,
                    'gambar' => $item->produk->gambar,
                    'variasi' => $item->variasi,
                    'jumlah' => $item->jumlah,
                ];
                $total += $item->produk->harga * $item->jumlah;
            }
        } else {
            // Jika tidak login, ambil dari session
            $keranjang = session()->get('keranjang', []);
            $total = 0;
            foreach ($keranjang as $item) {
                $total += $item['harga'] * $item['jumlah'];
            }
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

        if (Auth::check()) {
            // Jika user login, cek keranjang dari database
            $keranjangItems = Keranjang::where('user_id', Auth::id())->get();

            if ($keranjangItems->isEmpty()) {
                return redirect()->route('checkout.index')->with('error', 'Keranjang kamu kosong.');
            }

            // Kosongkan keranjang dari database
            Keranjang::where('user_id', Auth::id())->delete();
        } else {
            // Jika tidak login, cek keranjang dari session
            $keranjang = session()->get('keranjang', []);

            if (empty($keranjang)) {
                return redirect()->route('checkout.index')->with('error', 'Keranjang kamu kosong.');
            }

            // Kosongkan keranjang dari session
            session()->forget('keranjang');
        }

        // Simpan data pesanan ke database (contoh)
        // Pesanan::create([...]);

        return redirect()->route('produk.index')->with('success', 'Pesanan berhasil dikonfirmasi!');
    }
}
