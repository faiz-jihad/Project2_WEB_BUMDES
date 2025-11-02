<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $pesanans = Pesanan::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            // Untuk guest user, mungkin redirect ke login atau tampilkan pesan
            return redirect()->route('login')->with('info', 'Silakan login untuk melihat pesanan Anda.');
        }

        return view('pages.pesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pesanan dibuat melalui checkout, bukan form create
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pesanan dibuat melalui checkout controller
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Check if user owns this order or is admin
        if (Auth::check()) {
            if ($pesanan->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
                abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
            }
        } else {
            // Guest users can't view orders
            return redirect()->route('login')->with('info', 'Silakan login untuk melihat detail pesanan.');
        }

        return view('pages.pesanan.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Only allow editing if status is pending
        if ($pesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan yang sudah diproses tidak dapat diubah.');
        }

        // Check ownership
        if ($pesanan->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        return view('pages.pesanan.edit', compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Only allow updating if status is pending
        if ($pesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan yang sudah diproses tidak dapat diubah.');
        }

        // Check ownership
        if ($pesanan->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:20',
            'catatan' => 'nullable|string|max:500',
        ]);

        $pesanan->update([
            'nama_pemesan' => $request->nama_pemesan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('pesanan.show', $pesanan->id_pesanan)->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Only allow canceling if status is pending
        if ($pesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan yang sudah diproses tidak dapat dibatalkan.');
        }

        // Check ownership
        if ($pesanan->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $pesanan->update(['status' => 'dibatalkan']);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    /**
     * Mark order as paid (for transfer payments)
     */
    public function markAsPaid($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Only allow if payment method is transfer and status is pending
        if ($pesanan->metode_pembayaran !== 'transfer' || $pesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Tidak dapat menandai pesanan ini sebagai sudah bayar.');
        }

        // Check ownership
        if ($pesanan->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $pesanan->update(['status' => 'sudah_bayar']);

        return redirect()->back()->with('success', 'Pesanan berhasil ditandai sebagai sudah bayar.');
    }

    /**
     * Show order nota/invoice
     */
    public function nota($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Check if user owns this order or is admin
        if (Auth::check()) {
            if ($pesanan->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
                abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
            }
        } else {
            // Guest users can't view orders
            return redirect()->route('login')->with('info', 'Silakan login untuk melihat nota pesanan.');
        }

        return view('pages.nota', compact('pesanan'));
    }
}
