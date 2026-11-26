<?php

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit('Herramienta disponible solo desde la línea de comandos.');
}

$password = $argv[1] ?? null;

if (!is_string($password) || $password === '') {
    fwrite(STDERR, "Uso: php tools/generate_hash.php \"contraseña\"\n");
    exit(1);
}

echo password_hash($password, PASSWORD_DEFAULT) . PHP_EOL;
