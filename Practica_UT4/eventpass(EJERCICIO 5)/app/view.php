<?php

declare(strict_types=1);


function render(string $view, array $data = []): void
{
    $viewFile = APP_ROOT . '/views/pages/' . $view . '.php';

    if (!is_file($viewFile)) {
        throw new RuntimeException('Vista no encontrada: ' . $view);
    }

    extract($data, EXTR_SKIP);

    require APP_ROOT . '/views/layout/header.php';
    require $viewFile;
    require APP_ROOT . '/views/layout/footer.php';
}

function validatedTheme(): string
{
    $allowedThemes = config('themes');
    $theme = $_COOKIE['theme'] ?? 'light';

    if (!is_string($theme) || !in_array($theme, $allowedThemes, true)) {
        return 'light';
    }

    return $theme;
}

function validatedSize(): string
{
    $allowedSizes = ['normal', 'compact'];
    $size = $_COOKIE['size'] ?? 'normal';

    if (!is_string($size) || !in_array($size, $allowedSizes, true)) {
        return 'normal';
    }

    return $size;
}