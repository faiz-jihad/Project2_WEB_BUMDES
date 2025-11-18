<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function kirim(Request $request)
    {
        // Validate the form data
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|max:2000',
        ]);

        try {
            // Send the email
            Mail::to(config('mail.contact_email', 'info@bumdesmadusari.id'))->send(
                new ContactMessage($request->all())
            );

            // Return success response
            return back()->with('success', 'Pesan Anda telah berhasil dikirim! Kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Contact form error: ' . $e->getMessage());

            // Return error response
            return back()->with('error', 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi atau hubungi kami langsung.');
        }
    }
}
