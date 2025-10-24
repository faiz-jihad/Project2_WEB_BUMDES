<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    // Menampilkan daftar notifikasi
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        $notifications = $user->notifications()->paginate(10);

        return view('pages.notifikasi.index', compact('notifications'));
    }

    // Tandai notifikasi tertentu sebagai sudah dibaca
    public function markAsRead($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return back();
    }

    // Tandai semua notifikasi sebagai sudah dibaca
    public function markAllAsRead()
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications->markAsRead();
        }

        return back();
    }
}
