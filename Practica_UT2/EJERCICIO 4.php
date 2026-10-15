<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo "<h1>Diagnóstico del Entorno PHP</h1>";


echo "<p><strong>Versión de PHP:</strong> " . phpversion() . "</p>";


$displayErrorsStatus = ini_get('display_errors');
echo "<p><strong>Configuración display_errors:</strong> " . ($displayErrorsStatus ? 'Activado (1)' : 'Desactivado (0)') . "</p>";


$metodoHttp = $_SERVER['REQUEST_METHOD'] ?? 'Desconocido';
echo "<p><strong>Método HTTP:</strong> " . htmlspecialchars($metodoHttp) . "</p>";


$uriSolicitada = $_SERVER['REQUEST_URI'] ?? 'Desconocida';
echo "<p><strong>URI Solicitada:</strong> " . htmlspecialchars($uriSolicitada) . "</p>";

echo "<h2>Prueba de errores:</h2>";

echo $variableNoDefinida;