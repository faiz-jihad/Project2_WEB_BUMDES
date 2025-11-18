<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Check if user logged in via social provider (Google)
        if ($user->provider) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Akun ini login menggunakan ' . ucfirst($user->provider) . '. Tidak dapat reset password melalui email.']);
        }

        // Generate reset token
        $token = Password::createToken($user);

        // Create reset URL
        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $request->email,
        ], false));

        // Send custom email
        try {
            Mail::to($request->email)->send(new ResetPasswordMail($resetUrl, $user));
            return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Gagal mengirim email. Silakan coba lagi.']);
        }
    }
}
