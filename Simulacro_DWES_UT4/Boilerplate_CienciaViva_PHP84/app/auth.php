<?php

declare(strict_types=1);

/** Lee las cuentas de prueba almacenadas como un array PHP. */
function users(): array
{
    return require APP_ROOT . '/data/users.php';
}

/** Busca una cuenta por email, ignorando espacios laterales y mayúsculas. */
function findUserByEmail(array $allUsers, string $email): ?array
{
    $email = strtolower(trim($email));

    foreach ($allUsers as $user) {
        if (strtolower((string) $user['email']) === $email) {
            return $user;
        }
    }

    return null;
}

function isAuthenticated(): bool
{
    return isset($_SESSION['user']) && is_array($_SESSION['user']);
}

function currentUser(): ?array
{
    return isAuthenticated() ? $_SESSION['user'] : null;
}

function hasRole(string $role): bool
{
    $user = currentUser();

    return $user !== null && ($user['role'] ?? null) === $role;
}

/** Inicia el estado de sesión después de validar las credenciales. */
function loginUser(array $user): void
{
    // TODO: regenera el identificador.
    // Guarda en sesión solo id, name y role, más last_activity.
    // No copies password_hash.
     session_regenerate_id(true);

    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'role' => $user['role'],
    ];

    $_SESSION['last_activity'] = time();
}

function requireAuth(): void
{
    // TODO: redirige a /login.php si no existe una sesión autenticada.
    if (!isAuthenticated()) {
        redirect('/login.php');
    }
    }

function requireRole(string $role): void
{
    // TODO: exige autenticación y responde HTTP 403 si el rol no coincide.
    requireAuth();

    if (!hasRole($role)) {
        http_response_code(403);
        exit('Acceso prohibido.');
    }
    }

function logoutUser(): void
{
    // TODO: vacía y destruye la sesión, y expira su cookie identificadora.
 $_SESSION = [];

    $cookieParams = session_get_cookie_params();

    $cookieOptions = [
        'expires' => time() - 42000,
        'path' => $cookieParams['path'],
        'secure' => $cookieParams['secure'],
        'httponly' => $cookieParams['httponly'],
        'samesite' => $cookieParams['samesite'],
    ];

    if ($cookieParams['domain'] !== '') {
        $cookieOptions['domain'] = $cookieParams['domain'];
    }

    setcookie(session_name(), '', $cookieOptions);
    session_destroy();
    }

function enforceSessionTimeout(int $timeout): void
{
    // TODO: si la sesión ha vencido, cierra sesión y redirige a
    // /login.php?expired=1. Si continúa activa, actualiza last_activity.
if (!isAuthenticated()) {
        return;
    }

    $lastActivity = $_SESSION['last_activity'] ?? null;

    if (!is_int($lastActivity) || time() - $lastActivity >= $timeout) {
        logoutUser();
        redirect('/login.php?expired=1');
    }

    $_SESSION['last_activity'] = time();
    }
