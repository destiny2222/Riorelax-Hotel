<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

  'cloudinary' => [
      'driver' => 'cloudinary',
      'key' => env('CLOUDINARY_KEY'),
      'secret' => env('CLOUDINARY_SECRET'),
      'cloud' => env('CLOUDINARY_CLOUD_NAME'),
      'url' => env('CLOUDINARY_URL'),
      'secure' => (bool) env('CLOUDINARY_SECURE', true),
      'prefix' => env('CLOUDINARY_PREFIX'),
  ],

   'opay' => [
        'merchant_id' => env('OPAY_MERCHANT_ID'),
        'secret_key' => env('OPAY_SECRET_KEY'),
        'base_url' => env('OPAY_BASE_URL', 'https://testapi.opaycheckout.com'),
    ],

    'termii' => [
        'api_key' => env('TERMII_API_KEY'),
        'sender_id' => env('TERMII_SENDER_ID', 'RioRelax'),
        'base_url' => env('TERMII_BASE_URL', 'https://api.termii.com'),
    ],

];
