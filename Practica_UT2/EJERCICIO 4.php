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
<!--
1. ¿Qué función cumple php.ini?
Es un archivo que define las configuraciones del interprete de PHP.
2. ¿Qué diferencia existe entre ini_get() e ini_set()?
El ini_get() coge el valor actual de una configuracion.
Y el ini_set() modifica el valor de una configuracion.
Todo en el script de ahora , sin tocar el php.ini original.
3. ¿Qué hace error_reporting(E_ALL)?
Le dices a PHP que te avise de todos los errores existentes hasta ahora , importante para poder verlo y arreglarlo a tiempo durante el desarrollo.
4. ¿Por qué la configuración utilizada durante desarrollo puede ser
inadecuada para producción?
Porque mostrar informacion extra al usuario es peligroso , le enseñas las configuraciones , rutas , detalles y etc.
5. ¿Qué información proporciona $_SERVER que esté relacionada con lo
aprendido sobre HTTP en la UT1?
Que refleja los metadatos sobre las peticiones aprendidos de la UT1,en este caso GET o la uri del protocolo HTTP.
-->
</body>
</html>
