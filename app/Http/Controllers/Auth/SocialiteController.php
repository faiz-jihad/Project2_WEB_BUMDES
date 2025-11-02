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
                'avatar' => $socialUser->getAvatar(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        }

        // Login r user
        Auth::login($user, true); // Remember the user

        // Redirect to intended page or beranda
        return redirect()->intended('/beranda');
    }
}
