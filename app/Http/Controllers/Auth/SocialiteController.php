<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    /**
     * Redirect user to the OAuth provider
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback from the OAuth provider
     */
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors([
                'msg' => 'Gagal login dengan ' . ucfirst($provider) . '. Silakan coba lagi.'
            ]);
        }

        $existingUser = User::where('email', $socialUser->getEmail())->first();

        if ($existingUser) {
            if ($existingUser->provider !== $provider) {
                $existingUser->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar() ?? $existingUser->avatar,
                ]);
            }
            $user = $existingUser;
        } else {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'No Name',
                'email' => $socialUser->getEmail() ?? 'noemail_' . $socialUser->getId() . '@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt(Str::random(16)),
                'avatar' => $socialUser->getAvatar() ?? 'pp.jpg',
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        }

        // Login the user
        Auth::login($user, true); // Remember the user

        // Redirect based on role for admin/penulis users
        if ($user->role === 'admin' || $user->role === 'penulis') {
            return redirect()->route('dashboard.choice');
        }

        // Redirect to intended page or beranda for regular users
        return redirect()->intended(route('beranda'))->with('success', 'Login berhasil! Selamat datang kembali.');
    }
}
