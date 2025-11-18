<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$berita = App\Models\Berita::where('status', 'pending')->first();
if ($berita) {
    echo 'Found pending berita: ' . $berita->Judul . PHP_EOL;
    $berita->penulis->notify(new App\Notifications\BeritaStatusUpdated($berita, 'approved'));
    echo 'Notification sent to penulis' . PHP_EOL;

    $user = App\Models\User::where('name', $berita->penulis->nama_penulis)->first();
    if ($user) {
        $user->notify(new App\Notifications\BeritaStatusUpdated($berita, 'approved'));
        echo 'Notification sent to user' . PHP_EOL;
        echo 'User notifications: ' . $user->notifications()->count() . PHP_EOL;
    }
} else {
    echo 'No pending berita found' . PHP_EOL;
}
