<?php

declare(strict_types=1);

return [
    'session' => [
        'idle_timeout' => 30 * 60,
        'cookie' => [
            'lifetime' => 0,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ],
    ],
    'themes' => ['light', 'dark'],
];

