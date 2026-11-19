<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

if (isAuthenticated()) {
    redirect('dashboard.php');
}

$email = '';
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();

    $emailInput = $_POST['email'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    $email = is_string($emailInput) ? trim($emailInput) : '';
    $password = is_string($passwordInput) ? $passwordInput : '';

    // Mismo mensaje para usuario inexistente, email inválido o contraseña errónea.
    $error = 'Email o contraseña incorrectos.';

    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        $user = findUserByEmail(users(), $email);

        if (
            $user !== null
            && password_verify($password, $user['password_hash'])
        ) {
            loginUser($user);
            redirect('dashboard.php');
        }
    }
}

render('login', [
    'title' => 'Login',
    'email' => $email,
    'error' => $error,
    'expired' => ($_GET['expired'] ?? '') === '1',
]);
