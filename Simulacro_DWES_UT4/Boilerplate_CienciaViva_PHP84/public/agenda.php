<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

requireAuth();

$user = currentUser();
$allBookings = require APP_ROOT . '/data/bookings.php';
$bookings = [];

// El controlador entrega a la vista solo las reservas de la sesión actual.
foreach ($allBookings as $booking) {
    if ($booking['user_id'] === $user['id']) {
        $bookings[] = $booking;
    }
}

render('agenda', [
    'title' => 'Mi agenda',
    'user' => $user,
    'bookings' => $bookings,
]);
