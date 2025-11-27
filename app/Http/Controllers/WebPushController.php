<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use App\Models\User; // atau model Penulis kalau perlu

class WebPushController extends Controller
{
    public function saveSubscription(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'endpoint' => $request->endpoint,
            'p256dh' => $request->keys['p256dh'],
            'auth' => $request->keys['auth'],
        ]);

        return response()->json(['success' => true]);
    }

    public function sendPush($userId)
    {
        $user = User::find($userId);

        if (!$user || !$user->endpoint) {
            return "User not subscribed.";
        }

        $subscription = Subscription::create([
            "endpoint" => $user->endpoint,
            "publicKey" => $user->p256dh,
            "authToken" => $user->auth,
        ]);

        $webPush = new WebPush([
            "VAPID" => [
                "subject" => "mailto:admin@example.com",
                "publicKey" => config("webpush.vapid.public_key"),
                "privateKey" => config("webpush.vapid.private_key"),
            ]
        ]);

        $payload = json_encode([
            "title" => "Notifikasi Baru!",
            "body" => "Ada notifikasi baru di sistem.",
            "url" => url("/notifikasi")
        ]);

        $webPush->sendOneNotification($subscription, $payload);

        return "Push sent.";
    }
}
