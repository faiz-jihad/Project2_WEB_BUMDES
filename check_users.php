<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = App\Models\User::all();

echo "Users:\n";
foreach ($users as $u) {
    echo $u->name . ' (' . $u->email . ') - ' . $u->role . "\n";
}
