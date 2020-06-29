<?php

return [
    'users' => [
        'db-connection' => env('SOLUTION_LOCALE_USER_CONNECTION', "mysql"),
    ],

    'ultra-local' => [
        'enabled' => env('SOLUTION_LOCALE_ULTRA_ENABLED', false),
        'rcm_ids' => explode(',', env('SOLUTION_LOCALE_ULTRA_RCM_IDS', '')),
        'region_ids' =>
        explode(',', env('SOLUTION_LOCALE_ULTRA_REGION_IDS', '')),
    ],

    'services' => [
        'google' => [
            'places' => [
                'api' => [
                    'key' => env('GOOGLE_PLACES_API_KEY', false)
                ],
            ],
        ],
    ]
];
