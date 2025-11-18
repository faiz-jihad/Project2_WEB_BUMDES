<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::where('email', 'faizaku1@gmail.com')->first();

if ($user) {
    echo "User: " . $user->name . " (" . $user->email . ")\n";
    echo "Role: " . $user->role . "\n";

    $notifications = $user->notifications()->unread()->get();
    echo "Unread notifications: " . $notifications->count() . "\n";

    foreach ($notifications as $notif) {
        echo "- " . $notif->data['message'] . " (" . $notif->created_at . ")\n";
    }

    $penulis = App\Models\Penulis::where('Username', $user->email)->first();
    if ($penulis) {
        echo "\nPenulis: " . $penulis->nama_penulis . "\n";
        $penulisNotifications = $penulis->notifications()->unread()->get();
        echo "Unread notifications: " . $penulisNotifications->count() . "\n";

        foreach ($penulisNotifications as $notif) {
            echo "- " . $notif->data['message'] . " (" . $notif->created_at . ")\n";
        }
    }
} else {
    echo "User not found\n";
}
