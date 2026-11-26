<?php

declare(strict_types=1);


function e(string $value): string
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}


function csrfToken(): string
{
    if (!isset($_SESSION['csrf']) || !is_string($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf'];
}


function verifyCsrf(string $token): bool
{
    return isset($_SESSION['csrf'])
        && is_string($_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $token);
}


function requireValidCsrf(): void
{
    $token = $_POST['csrf'] ?? '';

    if (!is_string($token) || !verifyCsrf($token)) {
        http_response_code(403);
        exit('Petición no válida (CSRF).');
    }
}


function requestIsHttps(): bool
{
    return !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
}
