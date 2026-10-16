<?php
//ficha de un videojuego
$Nombre="Gotyland";
$numerojuego=1;
$preciojuego=20.26;
$Enstock=true;
$mensajestock=$Enstock?"Disponible":"No disponible";
$descuentovip=20;
$descripcion= [
    "pegi" => 12,
    "genero" => "RPG",
    "subgenero" => "Roguelite",
    "calificacion" => 100
];
$calculodesc=(100-20)/100;
$preciodescuento=round($preciojuego*$calculodesc,2);
$esganador=false;
if ($numerojuego===1){
    $esganador=true;
}else{
    $esganador=false;
}
$mensajeganador=$esganador?"Es el GOTY":"participante del Goty";
$juegostotal="100";
$juegostotalNum=(int)$juegostotal;
$uriSolicitada = $_SERVER['REQUEST_URI'] ;


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
<h1>MI JUEGO: <?=$Nombre?></h1>
<h2><?=$mensajeganador?> de 2026 </h2>
<p>
    <b>Estado : <?=$mensajestock?> en todos los paises</b>
</p>
<p style="font-size: 20px;">
    <b> Precio : <?=$preciojuego?> €</b>

<p style="font-size: 20px;">
    <b> Descuento de VIP : <?=$descuentovip?> %</b>
</p>
<p style="font-size: 22px;">
    <b>Precio con descuento : <?=$preciodescuento?> €</b>
</p>
<p style="font-size: 18px;">Descripción</p>
<p>
    <em>Pegi : <?=$descripcion["pegi"]?>
    <br>
    Genero : <?=$descripcion["genero"]?>
    <br>
    Subgenero : <?=$descripcion["subgenero"]?>
    <br>
        Calificacion : <?=$descripcion["calificacion"]?></em>
</p>

    <h3>Ganador entre los <?=$juegostotal?> participantes del GOTY 2026.</h3>

<p>
    <em>Link para una DEMO : </em><?=$uriSolicitada?>
</p>
</body>
</html>


<!--
1. ¿Qué estructura de datos has escogido y por qué?
He usado la array asociativo porque me lo pide la tarea y en este caso viene bien para la descripcion general de los juegos.
2. ¿Qué conversión de tipos has realizado?
He usado conversión de tipos de un String a int , en este caso de juegos total porque puede que se opere con ella ,en analisis de datos.
3. ¿Qué comparación has utilizado y qué devuelve?
La comparación lo he usado en un if y devuelve un boolean porque el if en teoria es para filtrar los ganadores del Goty.
4. ¿Qué parte del archivo se ejecuta en servidor?
Toda la parte PHP , donde tiene el programa y los datos.
5. ¿Qué termina recibiendo el navegador?
En este caso el HTML con los valores que quieres que muestre del PHP.
6. ¿Para qué serviría Composer si el proyecto creciese?
El composer tendria gran funcion porque si crece usariamos gran cantidad de librerias y se necesitaria un control de versiones.
-->
