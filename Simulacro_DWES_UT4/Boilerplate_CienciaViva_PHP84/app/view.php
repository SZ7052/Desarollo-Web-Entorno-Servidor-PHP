<?php

declare(strict_types=1);

/** Incluye una vista dentro de la cabecera y el pie comunes. */
function render(string $page, array $data = []): void
{
    $viewFile = APP_ROOT . '/views/pages/' . $page . '.php';

    if (!is_file($viewFile)) {
        throw new RuntimeException('Vista no encontrada: ' . $page);
    }

    $title = (string) ($data['title'] ?? 'CienciaViva');
    extract($data, EXTR_SKIP);

    require APP_ROOT . '/views/layout/header.php';
    require $viewFile;
    require APP_ROOT . '/views/layout/footer.php';
}
