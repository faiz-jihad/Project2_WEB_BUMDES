<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::where('email', 'faizaku1@gmail.com')->first();

if ($user) {
    echo 'User: ' . $user->name . PHP_EOL;
    echo 'Notifications count: ' . $user->notifications()->count() . PHP_EOL;
    $paginated = $user->notifications()->paginate(10);
    echo 'Paginated count: ' . $paginated->count() . PHP_EOL;
    echo 'Total: ' . $paginated->total() . PHP_EOL;

    // Check if user is logged in via session
    echo 'Auth check: ' . (auth()->check() ? 'Logged in' : 'Not logged in') . PHP_EOL;
    echo 'Auth user: ' . (auth()->user() ? auth()->user()->name : 'None') . PHP_EOL;
} else {
    echo 'User not found' . PHP_EOL;
}
