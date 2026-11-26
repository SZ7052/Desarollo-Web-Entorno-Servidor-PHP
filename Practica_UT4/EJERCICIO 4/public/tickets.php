<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

requireAuth();

if (!hasRole('admin') && !hasRole('agent')) {
    http_response_code(403);
    exit('403 - Acceso no autorizado.');
}

$tickets = require APP_ROOT . '/data/ticketss.php';


render('tickets', [
    'title' => 'Tickets',
    'user' => currentUser(),
    'tickets'=>$tickets,
]);
