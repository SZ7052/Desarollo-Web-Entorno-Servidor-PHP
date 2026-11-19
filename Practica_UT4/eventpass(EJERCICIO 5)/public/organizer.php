<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

requireRole('admin');

render('admin', [
    'title' => 'Administración',
    'user' => currentUser(),
    'allUsers' => users(),
]);