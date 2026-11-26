<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

requireRole('coordinator');

$bookings = require APP_ROOT . '/data/bookings.php';

render('coordination', [
    'title' => 'Coordinación',
    'bookings' => $bookings,
]);
