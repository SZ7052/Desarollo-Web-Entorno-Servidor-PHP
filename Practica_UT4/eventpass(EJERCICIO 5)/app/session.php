<?php

session_start();

function usuarioEstaLogueado(): bool
{
    return isset($_SESSION['usuario_id']);
}

function usuarioId(): ?int
{
    return $_SESSION['usuario_id'] ?? null;
}

function cerrarSesion(): void
{
    $_SESSION = [];
    session_destroy();
}
