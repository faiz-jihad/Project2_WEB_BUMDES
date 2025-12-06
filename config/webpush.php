<?php

return [

    /*
    |--------------------------------------------------------------------------
    | VAPID
    |--------------------------------------------------------------------------
    |
    | These are the keys used for authentication with WebPush servers.
    | You can generate them using the following command:
    |
    | php artisan webpush:vapid
    |
    */

    'vapid' => [
        'subject' => env('VAPID_SUBJECT', 'mailto:example@yourdomain.org'),
        'public_key' => env('VAPID_PUBLIC_KEY'),
        'private_key' => env('VAPID_PRIVATE_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | WebPush GCM / FCM
    |--------------------------------------------------------------------------
    |
    | If you're using Firebase Cloud Messaging, place your key here.
    |
    */

    'gcm' => [
        'key' => env('GCM_SERVER_KEY'),
    ],

];
