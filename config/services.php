<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],


    'github' => [
       'client_id' => 'da10286ae9662fa416b1',
       'client_secret' => '380cd64b7c0c982b9f5e8c3a6ef6082b6c1dfdcd',
       'redirect' => 'http://127.0.0.1:8000/login/github/callback',
    ],
    'google' => [
         'client_id' => '36088723743-3soshl8pe4ab5s564gduls5i8m9m7fij.apps.googleusercontent.com',
         'client_secret' => 'ZfSuQZTv1LAfv8DZBNN5aIsl',
         'redirect' => 'http://127.0.0.1:8000/login/google/callback',
],

];
