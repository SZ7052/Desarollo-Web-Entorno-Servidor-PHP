<?php
declare(strict_types=1);
require_once __DIR__ .'/security.php';

$theme=$_COOKIE["theme"]??"light";
if(!is_string($theme)||!in_array($theme, ["light", "dark"])){
    $theme="light";
}

session_set_cookie_params([
    'httponly' => true,
    'secure' => requestIsHTTPS(),
    'samesite' => 'Lax',
    'path' => '/',
    'lifetime' => 0,

]);