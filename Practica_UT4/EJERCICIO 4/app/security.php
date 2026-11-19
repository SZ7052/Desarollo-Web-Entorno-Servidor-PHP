<?php

declare(strict_types=1);

/** Escapa un valor para insertarlo de forma segura en HTML. */
function e(string $value): string
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

/** Devuelve (y crea si es necesario) el token CSRF de la sesión actual. */
function csrfToken(): string
{
    if (!isset($_SESSION['csrf']) || !is_string($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf'];
}

/** Compara de forma segura el token recibido con el almacenado en sesión. */
function verifyCsrf(string $token): bool
{
    return isset($_SESSION['csrf'])
        && is_string($_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $token);
}

/** Detiene la petición cuando el token CSRF recibido no es válido. */
function requireValidCsrf(): void
{
    $token = $_POST['csrf'] ?? '';

    if (!is_string($token) || !verifyCsrf($token)) {
        http_response_code(403);
        exit('Petición no válida (CSRF).');
    }
}

/** Detecta HTTPS de forma suficiente para esta práctica local. */
function requestIsHttps(): bool
{
    return !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
}
