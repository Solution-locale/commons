<?php

return [
    'ultra-local' => [
        'enabled' => env('SOLUTION_LOCALE_ULTRA_ENABLED', false),
        'rcm_ids' => explode(',', env('SOLUTION_LOCALE_ULTRA_RCM_IDS', '')),
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
