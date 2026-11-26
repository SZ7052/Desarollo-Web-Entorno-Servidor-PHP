<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

if (isAuthenticated()) {
    redirect(hasRole('coordinator') ? '/coordination.php' : '/agenda.php');
}

$email = '';
$error = null;
$expired = ($_GET['expired'] ?? '') === '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO: recoge email y password de forma segura.
    // Valida el formato, busca la cuenta con findUserByEmail(users(), $email)
    // y comprueba la contraseña con password_verify().
    // Usa el mismo error para email desconocido o password incorrecta.
    // Si acierta: loginUser($user) y redirige según el rol.
     $emailInput = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $email = is_string($emailInput) ? trim($emailInput) : '';

    if (
        !is_string($password)
        || filter_var($email, FILTER_VALIDATE_EMAIL) === false
    ) {
        $error = 'Correo o contraseña incorrectos.';
    } else {
        $user = findUserByEmail(users(), $email);

        if (
            $user === null
            || !password_verify($password, $user['password_hash'])
        ) {
            $error = 'Correo o contraseña incorrectos.';
        } else {
            loginUser($user);

            redirect(
                $user['role'] === 'coordinator'
                    ? '/coordination.php'
                    : '/agenda.php'
            );
        }
    }

    }

render('login', [
    'title' => 'Acceso',
    'email' => $email,
    'error' => $error,
    'expired' => $expired,
]);
