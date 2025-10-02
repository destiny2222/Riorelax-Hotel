<?php

return [
    'base_url' => env('OPAY_BASE_URL', 'https://api.opayweb.com'), // or sandbox URL
    'merchant_id' => env('OPAY_MERCHANT_ID'),
    'public_key' => env('OPAY_PUBLIC_KEY'),
    'private_key' => env('OPAY_PRIVATE_KEY'),
];