<?php

function enforceSessionTimeout(int $timeout): void
{
    if (!isAuthenticated()) {
        return;
    }

    $now = time();
    $lastActivity = $_SESSION['last_activity'] ?? $now;

    if (!is_int($lastActivity)) {
        $lastActivity = $now;
    }

    if (($now - $lastActivity) > $timeout) {
        logoutUser();
        redirect('login.php?expired=1');
    }

    $_SESSION['last_activity'] = $now;
}
