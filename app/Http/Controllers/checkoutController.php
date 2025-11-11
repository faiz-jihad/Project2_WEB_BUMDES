<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PesananBaru;
use App\Notifications\PesananCreated;
use App\Models\User;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
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
                    'gambar' => $item->produk->gambar ? asset('storage/' . $item->produk->gambar) : asset('images/no-image.jpg'),
                    'variasi' => $item->variasi,
                    'jumlah' => $item->jumlah,
                ];
                $total += $item->produk->harga * $item->jumlah;
            }
        } else {
            // Jika tidak login, ambil dari session
            $keranjang = session()->get('keranjang', []);
            $total = 0;
            foreach ($keranjang as $key => $item) {
                $keranjang[$key]['gambar'] = $item['gambar'] ? asset('storage/' . $item['gambar']) : asset('images/no-image.jpg');
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
            'catatan' => 'nullable|string|max:500',
        ]);

        if (Auth::check()) {
            // Jika user login, cek keranjang dari database
            $keranjangItems = Keranjang::where('user_id', Auth::id())->get();

            if ($keranjangItems->isEmpty()) {
                return redirect()->route('checkout.index')->with('error', 'Keranjang kamu kosong.');
            }

            // Prepare items data
            $items = [];
            $total = 0;
            foreach ($keranjangItems as $item) {
                // Check stock availability
                if ($item->produk->stok < $item->jumlah) {
                    return redirect()->route('checkout.index')->with('error', 'Stok produk ' . $item->produk->nama . ' tidak mencukupi.');
                }

                $items[] = [
                    'produk_id' => $item->produk_id,
                    'nama' => $item->produk->nama,
                    'harga' => $item->produk->harga,
                    'gambar' => $item->produk->gambar ? asset('storage/' . $item->produk->gambar) : asset('images/no-image.jpg'),
                    'jumlah' => $item->jumlah,
                    'variasi' => $item->variasi,
                    'subtotal' => $item->produk->harga * $item->jumlah,
                ];
                $total += $item->produk->harga * $item->jumlah;
            }

            // Simpan pesanan ke database
            $pesanan = Pesanan::create([
                'user_id' => Auth::id(),
                'nama_pemesan' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'metode_pembayaran' => $request->pembayaran,
                'status' => 'pending',
                'items' => $items,
                'total_harga' => $total,
                'catatan' => $request->catatan,
            ]);

            // Kurangi stok produk
            foreach ($keranjangItems as $item) {
                $produk = $item->produk;
                $produk->decrement('stok', $item->jumlah);
            }

            // Kosongkan keranjang dari database
            Keranjang::where('user_id', Auth::id())->delete();

            // Kirim notifikasi ke admin
            Notification::route('mail', config('app.admin_email'))->notify(new PesananBaru($pesanan));

            // Kirim notifikasi ke user yang membuat pesanan
            Auth::user()->notify(new PesananCreated($pesanan));
        } else {
            // Jika tidak login, cek keranjang dari session
            $keranjang = session()->get('keranjang', []);

            if (empty($keranjang)) {
                return redirect()->route('checkout.index')->with('error', 'Keranjang kamu kosong.');
            }

            // Prepare items data
            $items = [];
            $total = 0;
            foreach ($keranjang as $item) {
                // Check stock availability for guest users
                $produk = \App\Models\Produk::find($item['id']);
                if ($produk && $produk->stok < $item['jumlah']) {
                    return redirect()->route('checkout.index')->with('error', 'Stok produk ' . $item['nama'] . ' tidak mencukupi.');
                }

                $items[] = [
                    'produk_id' => $item['id'],
                    'nama' => $item['nama'],
                    'harga' => $item['harga'],
                    'gambar' => asset('storage/' . $item['gambar']),
                    'jumlah' => $item['jumlah'],
                    'variasi' => $item['variasi'] ?? null,
                    'subtotal' => $item['harga'] * $item['jumlah'],
                ];
                $total += $item['harga'] * $item['jumlah'];
            }

            // Simpan pesanan ke database
            $pesanan = Pesanan::create([
                'user_id' => null,
                'nama_pemesan' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'metode_pembayaran' => $request->pembayaran,
                'status' => 'pending',
                'items' => $items,
                'total_harga' => $total,
                'catatan' => $request->catatan,
            ]);

            // Kurangi stok produk untuk guest users
            foreach ($keranjang as $item) {
                $produk = \App\Models\Produk::find($item['id']);
                if ($produk) {
                    $produk->decrement('stok', $item['jumlah']);
                }
            }

            // Kosongkan keranjang dari session
            session()->forget('keranjang');
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat! Silakan lihat detail pesanan di halaman pesanan Anda.');
    }
}
