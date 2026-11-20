<?php
declare(strict_types=1);
require_once __DIR__ .'/security.php';

$theme=$_COOKIE["theme"]??"light";
if(!is_string($theme)||!in_array($theme, ["light", "dark"])){
    $theme="light";
}

setcookie("theme", $theme, [
    "expires" => time() + 30 * 24 * 60 * 60,
    "path" => "/",
    "secure" => requestIsHTTPS(),
    "httponly" => true,
    "samesite" => "Lax"
]);

require_once __DIR__ . '/navigation.php';
require_once __DIR__ . '/../views/header.php';