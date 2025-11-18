<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penulis;

class NotifikasiController extends Controller
{
    // Menampilkan daftar notifikasi
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Check if user is a penulis
        $penulis = Penulis::where('email', $user->email)->first();

        if ($penulis) {
            // If user is a penulis, get notifications for the penulis
            $notifications = $penulis->notifications()->paginate(10);
        } else {
            // Otherwise, get notifications for the user
            $notifications = $user->notifications()->paginate(10);
        }



        return view('pages.notifikasi.index', compact('notifications'));
    }

    // Tandai notifikasi tertentu sebagai sudah dibaca
    public function markAsRead($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $penulis = Penulis::where('email', $user->email)->first();

        if ($penulis) {
            $notification = $penulis->notifications()->find($id);
        } else {
            $notification = $user->notifications()->find($id);
        }

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true, 'message' => 'Notifikasi telah ditandai sebagai dibaca']);
        }

        return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan'], 404);
    }

    // Tandai semua notifikasi sebagai sudah dibaca
    public function markAllAsRead()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $penulis = Penulis::where('email', $user->email)->first();

        if ($penulis) {
            $penulis->unreadNotifications->markAsRead();
        } else {
            $user->unreadNotifications->markAsRead();
        }

        return response()->json(['success' => true, 'message' => 'Semua notifikasi telah ditandai sebagai dibaca']);
    }

    // API endpoint to get unread notification count
    public function getUnreadCount()
    {
        $user = Auth::user();
        $penulis = Penulis::where('email', $user->email)->first();

        if ($penulis) {
            $count = $penulis->unreadNotifications->count();
        } else {
            $count = $user->unreadNotifications->count();
        }

        return response()->json(['count' => $count]);
    }
}
