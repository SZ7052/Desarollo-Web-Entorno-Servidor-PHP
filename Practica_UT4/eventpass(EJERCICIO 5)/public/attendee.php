<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

requireAuth();

render('attendee', [
    'title' => 'Zona privada',
    'user' => currentUser(),
]);
