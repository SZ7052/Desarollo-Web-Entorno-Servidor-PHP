<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/bootstrap.php';

$activities = require APP_ROOT . '/data/activities.php';
$preferences = currentProgramPreferences();
$filteredActivities = filterActivities($activities, $preferences);

render('program', [
    'title' => 'Programa científico',
    'preferences' => $preferences,
    'activities' => $filteredActivities,
]);
