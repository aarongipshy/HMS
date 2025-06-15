<?php

return [
    'key' => env('MAILJET_APIKEY'),
    'secret' => env('MAILJET_SECRET'), // Changed from MAILJET_APISECRET to MAILJET_SECRET
    'transactional' => [
        'call' => true,
        'options' => [
            'url' => env('MAILJET_ENDPOINT', 'api.mailjet.com'),
            'version' => 'v3.1',
            'call' => true,
            'secured' => true
        ]
    ],
    'common' => [
        'call' => true,
        'options' => [
            'url' => env('MAILJET_ENDPOINT', 'api.mailjet.com'),
            'version' => 'v3',
            'call' => true,
            'secured' => true
        ]
    ]
];