<?php

declare(strict_types=1);

/** Escapa texto dinámico antes de insertarlo en HTML. */
function e(mixed $value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

/** Indica si la petición actual utiliza HTTPS. */
function requestIsHttps(): bool
{
    return !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
}

/** Envía una redirección y termina la petición. */
function redirect(string $location, int $status = 303): never
{
    header('Location: ' . $location, true, $status);
    exit;
}
