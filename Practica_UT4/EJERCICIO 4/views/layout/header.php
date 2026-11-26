<?php

declare(strict_types=1);

$pageTitle = isset($title) && is_string($title) ? $title : 'MeepleClub';
$theme = validatedTheme();
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
<body class="theme-<?= e($theme) ?>">
<header class="site-header">

    <nav>
        <a href="index.php">Inicio</a>
        <?php if ($layoutUser === null): ?>
            <a href="login.php">Login</a>
        <?php else: ?>
            <a href="dashboard.php">Dashboard</a>
            <?php if ($layoutUser['role'] === 'admin'): ?>
                <a href="admin.php">Admin</a>
            <?php endif; ?>
            <?php if ($layoutUser['role'] === 'admin' || $layoutUser['role'] === 'agent'): ?>
                <a href="tickets.php">Tickets</a>
            <?php endif; ?>

        <?php endif; ?>
    </nav>
</header>
<main class="container">

