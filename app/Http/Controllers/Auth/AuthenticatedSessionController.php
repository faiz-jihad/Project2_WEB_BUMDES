<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Migrasi keranjang dari session ke database jika ada
        $this->migrateCartToDatabase();

        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === 'admin' || $user->role === 'penulis') {
            // Jika admin atau penulis, arahkan ke halaman pilihan dashboard
            return redirect()->route('dashboard.choice');
        }

        // Arahkan ke halaman beranda untuk user biasa
        return redirect()->intended(route('beranda'))->with('success', 'Login berhasil! Selamat datang kembali.');
    }

    /**
     * Migrasi keranjang dari session ke database
     */
    private function migrateCartToDatabase()
    {
        $sessionCart = session()->get('keranjang', []);

        if (!empty($sessionCart)) {
            foreach ($sessionCart as $item) {
                $existingItem = \App\Models\Keranjang::where('user_id', Auth::id())
                    ->where('produk_id', $item['id'])
                    ->where('variasi', $item['variasi'] ?? null)
                    ->first();

                if ($existingItem) {
                    $existingItem->update(['jumlah' => $existingItem->jumlah + $item['jumlah']]);
                } else {
                    \App\Models\Keranjang::create([
                        'user_id' => Auth::id(),
                        'produk_id' => $item['id'],
                        'jumlah' => $item['jumlah'],
                        'variasi' => $item['variasi'] ?? null,
                    ]);
                }
            }

            // Hapus keranjang dari session setelah migrasi
            session()->forget('keranjang');
        }
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman login
        return redirect()->route('login');
    }
}
