<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Silakan login untuk melihat pesanan Anda.');
        }

        $pesanans = Pesanan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.pesanan.index', compact('pesanans'));
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show($uuid)
    {
        $pesanan = Pesanan::where('uuid', $uuid)->firstOrFail();

        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Silakan login untuk melihat detail pesanan.');
        }

        if ($pesanan->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->view('layouts.403page', [], 403);
        }

        return view('pages.pesanan.show', compact('pesanan'));
    }

    public function edit($uuid)
    {
        $pesanan = Pesanan::where('uuid', $uuid)->firstOrFail();

        if ($pesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan yang sudah diproses tidak dapat diubah.');
        }

        if (!Auth::check() || ($pesanan->user_id !== Auth::id() && Auth::user()->role !== 'admin')) {
            return response()->view('layouts.403page', [], 403);
        }

        return view('pages.pesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, $uuid)
    {
        $pesanan = Pesanan::where('uuid', $uuid)->firstOrFail();

        if ($pesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan yang sudah diproses tidak dapat diubah.');
        }

        if (!Auth::check() || ($pesanan->user_id !== Auth::id() && Auth::user()->role !== 'admin')) {
            return response()->view('layouts.403page', [], 403);
        }

        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:20',
            'catatan' => 'nullable|string|max:500',
        ]);

        $pesanan->update($request->only(['nama_pemesan', 'alamat', 'no_hp', 'catatan']));

        return redirect()->route('pesanan.show', $pesanan->uuid)->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $pesanan = Pesanan::where('uuid', $uuid)->firstOrFail();

        if ($pesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan yang sudah diproses tidak dapat dibatalkan.');
        }

        if (!Auth::check() || ($pesanan->user_id !== Auth::id() && Auth::user()->role !== 'admin')) {
            return response()->view('layouts.403page', [], 403);
        }

        foreach ($pesanan->items as $item) {
            $produk = Produk::find($item['produk_id']);
            if ($produk) {
                $produk->increment('stok', $item['jumlah']);
            }
        }

        $pesanan->update(['status' => 'dibatalkan']);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function markAsPaid($uuid)
    {
        $pesanan = Pesanan::where('uuid', $uuid)->firstOrFail();

        if ($pesanan->metode_pembayaran !== 'transfer' || $pesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Tidak dapat menandai pesanan ini sebagai sudah bayar.');
        }

        if (!Auth::check() || ($pesanan->user_id !== Auth::id() && Auth::user()->role !== 'admin')) {
            return response()->view('layouts.403page', [], 403);
        }

        $pesanan->update(['status' => 'sudah_bayar']);

        return redirect()->back()->with('success', 'Pesanan berhasil ditandai sebagai sudah bayar.');
    }

    public function nota($uuid)
    {
        $pesanan = Pesanan::where('uuid', $uuid)->firstOrFail();

        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Silakan login untuk melihat nota pesanan.');
        }

        if ($pesanan->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->view('layouts.403page', [], 403);
        }

        return view('pages.nota', compact('pesanan'));
    }
}
