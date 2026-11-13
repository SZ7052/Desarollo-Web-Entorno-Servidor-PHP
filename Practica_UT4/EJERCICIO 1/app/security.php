<?php
function e(string $value):string {
    return htmlspecialchars($value, ENT_QUOTES,'UTF-8');
}

function requestIsHTTPS(): bool {
    return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
}