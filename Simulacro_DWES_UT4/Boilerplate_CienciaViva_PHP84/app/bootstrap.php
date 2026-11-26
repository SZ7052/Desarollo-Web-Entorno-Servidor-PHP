<?php

declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));

$GLOBALS['app_config'] = require APP_ROOT . '/config/app.php';

/** Obtiene un valor de configuración usando claves separadas por puntos. */
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

date_default_timezone_set((string) config('timezone'));

require_once APP_ROOT . '/app/security.php';

ini_set('session.use_strict_mode', '1');

$sessionCookie = config('session.cookie');

session_set_cookie_params([
    'lifetime' => (int) $sessionCookie['lifetime'],
    'path' => (string) $sessionCookie['path'],
    'secure' => requestIsHttps(),
    'httponly' => (bool) $sessionCookie['httponly'],
    'samesite' => (string) $sessionCookie['samesite'],
]);

session_start();

require_once APP_ROOT . '/app/auth.php';
require_once APP_ROOT . '/app/preferences.php';
require_once APP_ROOT . '/app/view.php';

// Comprueba si una sesión autenticada ha superado el tiempo de inactividad.
enforceSessionTimeout((int) config('session.idle_timeout'));
