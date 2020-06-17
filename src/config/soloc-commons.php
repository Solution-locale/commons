<?php

return [
    'ultra-local' => [
        'enabled' => env('SOLUTION_LOCALE_ULTRA_ENABLED', false),
        'rcm_ids' => explode(',', env('SOLUTION_LOCALE_ULTRA_RCM_IDS', '')),
        'region_ids' => explode(',', env('SOLUTION_LOCALE_ULTRA_REGION_IDS', '')),
    ],
    'database' => [
        'connection' => env('SOLUTION_LOCALE_DB_CONNECTION', 'mysql'),
    ]
];
