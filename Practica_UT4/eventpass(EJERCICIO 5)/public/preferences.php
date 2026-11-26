<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

$allowedThemes = config('themes');
$allowedSizes = ['normal', 'compact'];
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();

    if (isset($_POST['reset'])) {
        $options = [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => requestIsHttps(),
            'httponly' => true,
            'samesite' => 'Lax',
        ];

        setcookie('theme', '', $options);
        setcookie('size', '', $options);

        redirect('preferences.php?reset=1');
    }

    $theme = $_POST['theme'] ?? '';
    $size = $_POST['size'] ?? '';

    $validTheme = is_string($theme)
        && in_array($theme, $allowedThemes, true);

    $validSize = is_string($size)
        && in_array($size, $allowedSizes, true);

    if (!$validTheme || !$validSize) {
        $error = 'Una de las preferencias indicadas no es válida.';
    } else {
        $options = [
            'expires' => time() + 30 * 24 * 60 * 60,
            'path' => '/',
            'secure' => requestIsHttps(),
            'httponly' => true,
            'samesite' => 'Lax',
        ];

        setcookie('theme', $theme, $options);
        setcookie('size', $size, $options);

        redirect('preferences.php?saved=1');
    }
}

render('preferences', [
    'title' => 'Preferencias',
    'error' => $error,
    'saved' => ($_GET['saved'] ?? '') === '1',
    'reset' => ($_GET['reset'] ?? '') === '1',
    'currentTheme' => validatedTheme(),
    'currentSize' => validatedSize(),
]);