<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

requireRole('organizer');

render('organizer', [
    'title' => 'Panel de Organizer',
    'user' => currentUser(),
    'allUsers' => users(),
]);