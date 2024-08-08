<?php

// config for EtsvThor/LaravelCashRegisterBridge
return [
    'service_id' => env('CASHREGISTER_SERVICE_ID'),
    'secret' => env('CASHREGISTER_SECRET'),
    'base_url' => env('CASHREGISTER_BASE_URL', 'https://finances.thor.edu'),

    'push_product_items_on_sync' => false,
];
