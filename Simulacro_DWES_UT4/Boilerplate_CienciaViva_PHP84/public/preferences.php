<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        resetProgramPreferences();
        redirect('/program.php');
    }

    if (saveProgramPreferences($_POST)) {
        redirect('/program.php');
    }

    $error = 'Selecciona valores válidos para las dos preferencias.';
}

render('preferences', [
    'title' => 'Preferencias del programa',
    'preferences' => currentProgramPreferences(),
    'error' => $error,
]);
