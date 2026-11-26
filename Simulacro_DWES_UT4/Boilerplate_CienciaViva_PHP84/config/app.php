<?php

declare(strict_types=1);

return [
    'timezone' => 'Europe/Madrid',
    'session' => [
        'idle_timeout' => 15 * 60,
        'cookie' => [
            'lifetime' => 0,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ],
    ],
    'preferences' => [
        'cookie_lifetime' => 14 * 24 * 60 * 60,
        'areas' => ['all', 'astronomy', 'biology', 'robotics'],
        'duration_bands' => ['all', 'short', 'long'],
    ],
];
