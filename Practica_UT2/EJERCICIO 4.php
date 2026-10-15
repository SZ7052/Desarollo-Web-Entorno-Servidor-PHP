<?php
$version=phpversion();

error_reporting(E_ALL);
ini_set('display_errors', '1');

$displayErrorsvisu = ini_get('display_errors');

$metodoHttp = $_SERVER['REQUEST_METHOD'] ;

$uriSolicitada = $_SERVER['REQUEST_URI'] ;


//prueba de pequeño error con una variable sin asignar
//Solucion: Asignar la variable.
//$Error="No hay Error";
echo $Error;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Diagnóstico del Entorno PHP</h1>
<p>Versión de PHP: <?=$version?> </p>
<p>display_errors: <?=$displayErrorsvisu?></p>
<p>Método HTTP: <?=$metodoHttp?></p>
<p>URI Solicitada: <?=$uriSolicitada?></p>
<p>Mensaje Error: <?=$Error?></p>

</body>
</html>
