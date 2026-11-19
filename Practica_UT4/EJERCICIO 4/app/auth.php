<?php

declare(strict_types=1);

/** @return array<int, array{id:int,name:string,email:string,password_hash:string,role:string}> */
function users(): array
{
    /** @var array<int, array{id:int,name:string,email:string,password_hash:string,role:string}> $users */
    $users = require APP_ROOT . '/data/users.php';

    return $users;
}

/** @return array{id:int,name:string,email:string,password_hash:string,role:string}|null */
function findUserByEmail(array $users, string $email): ?array
{
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return $user;
        }
    }

    return null;
}

function isAuthenticated(): bool
{
    return isset($_SESSION['user']) && is_array($_SESSION['user']);
}

/** @return array{id:int,name:string,email:string,role:string}|null */
function currentUser(): ?array
{
    if (!isAuthenticated()) {
        return null;
    }

    /** @var array{id:int,name:string,email:string,role:string} $user */
    $user = $_SESSION['user'];

    return $user;
}

function redirect(string $location): never
{
    header('Location: ' . $location);
    exit;
}

function requireAuth(): void
{
    if (!isAuthenticated()) {
        redirect('login.php');
    }
}

function hasRole(string $role): bool
{
    $user = currentUser();

    return $user !== null && $user['role'] === $role;
}

function requireRole(string $role): void
{
    requireAuth();

    if (!hasRole($role)) {
        http_response_code(403);
        exit('403 - Acceso no autorizado.');
    }
}

/**
 * Guarda únicamente los datos mínimos necesarios para identificar al usuario.
 * El hash de contraseña no se copia a la sesión.
 */
function loginUser(array $user): void
{
    session_regenerate_id(true);

    $_SESSION['user'] = [
        'id' => (int) $user['id'],
        'name' => (string) $user['name'],
        'email' => (string) $user['email'],
        'role' => (string) $user['role'],
    ];

    $_SESSION['last_activity'] = time();

    // Renovamos el token CSRF al elevar el contexto a usuario autenticado.
    unset($_SESSION['csrf']);
    csrfToken();
}

/**
 * Elimina datos de sesión, destruye el almacenamiento servidor y expira
 * la cookie que transporta el identificador de sesión.
 */
function logoutUser(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            [
                'expires' => time() - 42000,
                'path' => $params['path'] ?: '/',
                'domain' => $params['domain'],
                'secure' => (bool) $params['secure'],
                'httponly' => (bool) $params['httponly'],
                'samesite' => $params['samesite'] ?: 'Lax',
            ]
        );
    }

    session_destroy();
}

/** Aplica expiración por inactividad únicamente a usuarios autenticados. */
function enforceSessionTimeout(int $timeout): void
{
    if (!isAuthenticated()) {
        return;
    }

    $now = time();
    $lastActivity = $_SESSION['last_activity'] ?? $now;

    if (!is_int($lastActivity)) {
        $lastActivity = $now;
    }

    if (($now - $lastActivity) > $timeout) {
        logoutUser();
        redirect('login.php?expired=1');
    }

    $_SESSION['last_activity'] = $now;
}
