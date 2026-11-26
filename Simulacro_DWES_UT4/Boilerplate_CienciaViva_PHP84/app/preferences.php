<?php

declare(strict_types=1);

/** Lee y valida las preferencias enviadas por el navegador. */
function currentProgramPreferences(): array
{
    $area = $_COOKIE['cv_area'] ?? 'all';
    $durationBand = $_COOKIE['cv_duration_band'] ?? 'all';

    // TODO: valida los dos valores con las listas de config/app.php.
    // Si un valor falta o no pertenece a la lista, sustitúyelo por all.

    if(!is_string($area)||!in_array($area, config('preferences.areas'), true)){
        $area = 'all';
    }
    if(!is_string($durationBand)||!in_array($durationBand, config('preferences.duration_bands'), true)){
        $durationBand = 'all';
    }
    return [
        'area' => is_string($area) ? $area : 'all',
        'duration_band' => is_string($durationBand) ? $durationBand : 'all',
    ];
}

/** Valida y guarda las dos preferencias durante el tiempo configurado. */
function saveProgramPreferences(array $input): bool
{
    // TODO: valida area y duration_band.
    // Guarda cv_area y cv_duration_band con:
    // expires, path=/, Secure según HTTPS, HttpOnly y SameSite=Lax.
    // Devuelve true solo si las dos llamadas a setcookie() tienen éxito.
   
    $area = $input['area']??null;
    $durationBand = $input['duration_band']??null;
   
    if(!is_string($area)||!in_array($area, config('preferences.areas'), true)
        ||!is_string($durationBand)||!in_array($durationBand, config('preferences.duration_bands'), true)
    ){
        return false;
    }

    $options = [
        'expires' => time() + (int) config('preferences.cookie_lifetime'),
        'path' => '/',
        'secure' => requestIsHttps(),
        'httponly' => true,
        'samesite' => 'Lax',
    ];

    $areaSaved = setcookie('cv_area', $area, $options);
    $durationSaved = setcookie('cv_duration_band', $durationBand, $options);

    return $areaSaved && $durationSaved;

    
}

/** Expira las dos cookies de preferencias. */
function resetProgramPreferences(): void
{
    // TODO: expira las dos cookies con los mismos atributos de creación.
       $options = [
        'expires' => time() - 3600,
        'path' => '/',
        'secure' => requestIsHttps(),
        'httponly' => true,
        'samesite' => 'Lax',
    ];

    setcookie('cv_area', '', $options);
    setcookie('cv_duration_band', '', $options);

    }

/** Filtra las actividades por área y duración, aplicando ambos criterios. */
function filterActivities(array $activities, array $preferences): array
{
    // TODO: aplica los filtros conjuntamente.
    // area=all no restringe el área.
    // duration_band=short significa duración <= 45 minutos.
    // duration_band=long significa duración > 45 minutos.

    $area = $preferences['area'] ?? 'all';
    $durationBand = $preferences['duration_band'] ?? 'all';
    $filtered = [];

    foreach ($activities as $activity) {
        if ($area !== 'all' && $activity['area'] !== $area) {
            continue;
        }

        $minutes = $activity['duration_minutes'];

        if ($durationBand === 'short' && $minutes > 45) {
            continue;
        }

        if ($durationBand === 'long' && $minutes <= 45) {
            continue;
        }

        $filtered[] = $activity;
    }

    return $filtered;
}
