<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::first();
echo 'User: ' . $user->name . PHP_EOL;
echo 'Total notifications: ' . $user->notifications()->count() . PHP_EOL;
echo 'Unread notifications: ' . $user->unreadNotifications()->count() . PHP_EOL;

$notifications = $user->notifications()->latest()->limit(5)->get();
echo PHP_EOL . 'Latest 5 notifications:' . PHP_EOL;
foreach ($notifications as $notification) {
    echo '- ' . $notification->data['message'] . ' (' . $notification->created_at->diffForHumans() . ')' . PHP_EOL;
}
