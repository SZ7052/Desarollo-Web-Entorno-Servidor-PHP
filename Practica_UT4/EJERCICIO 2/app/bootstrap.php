<?php
declare(strict_types=1);
require_once __DIR__ .'/security.php';



ini_set('session.use_strict_mode', 1);



session_set_cookie_params([
    'httponly' => true,
    'secure' => requestIsHTTPS(),
    'samesite' => 'Lax',
    'path' => '/',
    'lifetime' => 0,

]);



session_start();


$_SESSION['visit_count'] = ($_SESSION['visit_count'] ?? 0) + 1;
$_SESSION['last_activity'] = time();

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/navigation.php';
require_once __DIR__ . '/../views/header.php';
require_once __DIR__ . '/../views/visita.php';