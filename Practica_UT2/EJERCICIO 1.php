<?php
$Evento="DevDay Madrid";
$Lugar="Aula Magna";
$Preciodeinscripción=25;
$Aforomáximo=120;
$Inscripcionesactuales=87;
$Eventoabierto=true;

$plazas = $Aforomáximo - $Inscripcionesactuales;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tarea_UT2</title>
</head>
<body>
<h1><?=$Evento?></h1>
<h2><?=$Lugar?> </h2>
<p>
    Precio: <?=$Preciodeinscripción?> €
    <br>
    Aforo máximo: <?=$Aforomáximo?> personas
    <br>
    Inscripciones actuales: <?=$Inscripcionesactuales?> personas
    <br>
    Plazas restantes: <?=$plazas?>
    <br>
</p>
</body>
</html>
