<?php

declare(strict_types=1);

$pageTitle = isset($title) && is_string($title) ? $title : 'MeepleClub';
$theme = validatedTheme();
$size = validatedsize();
$layoutUser = currentUser();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> · MeepleClub</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="theme-<?= e($theme) ?> size-<?= e($size) ?>">
<header class="site-header">
    <div>
        <a class="brand" href="index.php">Ejercicio 5</a>
    </div>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="preferences.php">Preferencias</a>
        <?php if ($layoutUser === null): ?>
            <a href="login.php">Login</a>
        <?php else: ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="attendee.php">Zona attendees</a>
            <?php if ($layoutUser['role'] === 'organizer'): ?>
                <a href="organizer.php">Organizer</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>
</header>
<main class="container">
