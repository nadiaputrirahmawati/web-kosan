<?php
return [
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true), // Menambah opsi sanitasi
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
    'callback_url' => env('MIDTRANS_CALLBACK_URL'), // Menambah opsi sanitasi
];
