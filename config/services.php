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

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'didit' => [
            'base_url' => env('DIDIT_BASE_URL'),
            'auth_url' => env('DIDIT_AUTH_URL'),
            'client_id' => env('DIDIT_CLIENT_ID'),
            'client_secret' => env('DIDIT_CLIENT_SECRET'),
     ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'stripe' => [
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'didit' => [
        'client_id'     => env('DIDIT_CLIENT_ID'),
        'client_secret' => env('DIDIT_CLIENT_SECRET'),
        'base_url'      => env('DIDIT_BASE_URL', 'https://apx.didit.me'),
        'auth_url'      => env('DIDIT_AUTH_URL', 'https://auth.didit.me'),
        'webhook_secret'=> env('DIDIT_WEBHOOK_SECRET'),
    ],

];
