<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

$allowedThemes = config('themes');
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();

    $theme = $_POST['theme'] ?? '';

    if (!is_string($theme) || !in_array($theme, $allowedThemes, true)) {
        $error = 'La preferencia indicada no es válida.';
    } else {
        setcookie(
            'theme',
            $theme,
            [
                'expires' => time() + 30 * 24 * 60 * 60,
                'path' => '/',
                'secure' => requestIsHttps(),
                'httponly' => true,
                'samesite' => 'Lax',
            ]
        );

        // POST/Redirect/GET: la nueva cookie se leerá en la siguiente petición.
        redirect('preferences.php?saved=1');
    }
}

render('preferences', [
    'title' => 'Preferencias',
    'error' => $error,
    'saved' => ($_GET['saved'] ?? '') === '1',
    'currentTheme' => validatedTheme(),
]);
