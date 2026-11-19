<?php

declare(strict_types=1);

const APP_ROOT = __DIR__ . '/..';

/** @var array<string, mixed> $GLOBALS['app_config'] */
$GLOBALS['app_config'] = require APP_ROOT . '/config/app.php';

/**
 * Lee configuración usando claves con punto, por ejemplo: session.idle_timeout.
 */
function config(string $key): mixed
{
    $value = $GLOBALS['app_config'];

    foreach (explode('.', $key) as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            throw new RuntimeException('Configuración no encontrada: ' . $key);
        }

        $value = $value[$segment];
    }

    return $value;
}

require_once APP_ROOT . '/app/security.php';

$isHttps = requestIsHttps();

// Rechaza IDs de sesión que no hayan sido inicializados previamente por PHP.
ini_set('session.use_strict_mode', '1');

$sessionCookie = config('session.cookie');

session_set_cookie_params([
    'lifetime' => (int) $sessionCookie['lifetime'],
    'path' => (string) $sessionCookie['path'],
    'secure' => $isHttps,
    'httponly' => (bool) $sessionCookie['httponly'],
    'samesite' => (string) $sessionCookie['samesite'],
]);

session_start();

require_once APP_ROOT . '/app/auth.php';
require_once APP_ROOT . '/app/view.php';

enforceSessionTimeout((int) config('session.idle_timeout'));

