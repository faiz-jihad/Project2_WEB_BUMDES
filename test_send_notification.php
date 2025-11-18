<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::where('email', 'faizaku1@gmail.com')->first();

if ($user) {
    $user->notify(new App\Notifications\TestNotification());
    echo 'Test notification sent to user: ' . $user->name . PHP_EOL;

    // Check notifications after sending
    echo 'Total notifications: ' . $user->notifications()->count() . PHP_EOL;
    echo 'Unread notifications: ' . $user->unreadNotifications()->count() . PHP_EOL;
} else {
    echo 'User not found' . PHP_EOL;
}
