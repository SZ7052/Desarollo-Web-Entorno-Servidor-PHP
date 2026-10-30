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