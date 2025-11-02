<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
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

        return view('pages.keranjang', compact('keranjang', 'total'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'variasi' => 'nullable|string'
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        if (Auth::check()) {
            // Jika user login, simpan ke database
            $existingItem = Keranjang::where('user_id', Auth::id())
                ->where('produk_id', $produk->id)
                ->where('variasi', $request->variasi ?? null)
                ->first();

            if ($existingItem) {
                $existingItem->increment('jumlah');
                $message = 'Jumlah produk berhasil ditambahkan';
            } else {
                Keranjang::create([
                    'user_id' => Auth::id(),
                    'produk_id' => $produk->id,
                    'jumlah' => 1,
                    'variasi' => $request->variasi ?? null,
                ]);
                $message = 'Produk berhasil ditambahkan ke keranjang';
            }
        } else {
            // Jika tidak login, simpan ke session
            $keranjang = session()->get('keranjang', []);
            $id = $produk->id . ($request->variasi ?? '');

            if (isset($keranjang[$id])) {
                $keranjang[$id]['jumlah']++;
                $message = 'Jumlah produk berhasil ditambahkan';
            } else {
                $keranjang[$id] = [
                    'id' => $produk->id,
                    'nama' => $produk->nama,
                    'harga' => $produk->harga,
                    'gambar' => $produk->gambar,
                    'variasi' => $request->variasi ?? null,
                    'jumlah' => 1,
                ];
                $message = 'Produk berhasil ditambahkan ke keranjang';
            }

            session()->put('keranjang', $keranjang);
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function hapus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'variasi' => 'nullable|string'
        ]);

        if (Auth::check()) {
            // Jika user login, hapus dari database
            $keranjangItem = Keranjang::where('user_id', Auth::id())
                ->where('produk_id', $request->id)
                ->where('variasi', $request->variasi ?? null)
                ->first();

            if ($keranjangItem) {
                $keranjangItem->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil dihapus dari keranjang'
                ]);
            }
        } else {
            // Jika tidak login, hapus dari session
            $keranjang = session()->get('keranjang', []);
            $id = $request->id . ($request->variasi ?? '');

            if (isset($keranjang[$id])) {
                unset($keranjang[$id]);
                session()->put('keranjang', $keranjang);
                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil dihapus dari keranjang'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan di keranjang'
        ]);
    }

    public function get()
    {
        $total_items = 0;
        $items = [];

        if (Auth::check()) {
            // Jika user login, ambil dari database
            $keranjangItems = Keranjang::where('user_id', Auth::id())
                ->with('produk')
                ->get();

            foreach ($keranjangItems as $item) {
                $items[] = [
                    'nama' => $item->produk->nama,
                    'gambar' => $item->produk->gambar,
                    'harga' => $item->produk->harga,
                    'jumlah' => $item->jumlah,
                    'variasi' => $item->variasi,
                ];
                $total_items += $item->jumlah;
            }
        } else {
            // Jika tidak login, ambil dari session
            $keranjang = session()->get('keranjang', []);
            foreach ($keranjang as $item) {
                $items[] = $item;
                $total_items += $item['jumlah'];
            }
        }

        return response()->json([
            'total_items' => $total_items,
            'items' => $items
        ]);
    }

    public function updateJumlah(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'variasi' => 'nullable|string'
        ]);

        if (Auth::check()) {
            // Jika user login, update di database
            $keranjangItem = Keranjang::where('user_id', Auth::id())
                ->where('produk_id', $request->id)
                ->where('variasi', $request->variasi ?? null)
                ->first();

            if ($keranjangItem) {
                $keranjangItem->update(['jumlah' => $request->jumlah]);
                return response()->json([
                    'success' => true,
                    'message' => 'Jumlah produk berhasil diperbarui'
                ]);
            }
        } else {
            // Jika tidak login, update di session
            $keranjang = session()->get('keranjang', []);
            $id = $request->id . ($request->variasi ?? '');

            if (isset($keranjang[$id])) {
                $keranjang[$id]['jumlah'] = $request->jumlah;
                session()->put('keranjang', $keranjang);
                return response()->json([
                    'success' => true,
                    'message' => 'Jumlah produk berhasil diperbarui'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan di keranjang'
        ]);
    }
}
