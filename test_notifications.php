<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing notification API endpoints...\n\n";

// Test 1: Unauthenticated access
echo "Test 1: Unauthenticated access to /api/notifications/unread-count\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/notifications/unread-count');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'X-Requested-With: XMLHttpRequest'
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "HTTP Code: $httpCode\n";
echo "Response: $response\n\n";

// Test 2: Authenticated access (simulate login)
echo "Test 2: Authenticated access to /api/notifications/unread-count\n";
// First, we need to login via the web interface to get session cookies
// For now, let's test the controller directly in PHP

$user = \App\Models\User::first();
\Auth::login($user);

$controller = new \App\Http\Controllers\NotifikasiController();
$count = $controller->getUnreadCount();
$data = $count->getData();
echo "Unread count: " . $data->count . "\n\n";

echo "Test 3: Authenticated access to /api/notifications\n";
$notifications = $controller->getNotifications();
$notifData = $notifications->getData();
echo "Success: " . ($notifData->success ? 'true' : 'false') . "\n";
echo "Notifications count: " . count($notifData->notifications) . "\n";
if (count($notifData->notifications) > 0) {
    echo "First notification message: " . $notifData->notifications[0]->message . "\n";
}
echo "\n";

// Test 4: Test with penulis user if exists
$penulis = \App\Models\Penulis::first();
if ($penulis) {
    echo "Test 4: Testing with penulis user\n";
    $user = \App\Models\User::where('email', $penulis->Username)->first();
    if ($user) {
        \Auth::login($user);
        $count = $controller->getUnreadCount();
        $data = $count->getData();
        echo "Penulis unread count: " . $data->count . "\n";
    } else {
        echo "No user found for penulis\n";
    }
} else {
    echo "No penulis found\n";
}

echo "\nTesting completed.\n";
