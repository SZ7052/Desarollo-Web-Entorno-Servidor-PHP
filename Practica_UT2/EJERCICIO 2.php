<?php
$precioNoche="72.50";
$numeroNoches="4";
$descuento=35;
$gastosGestion=12.50;
$cuatro=4;

$precioNocheNum=(float)$precioNoche;
$numeroNochesNum=(int)$numeroNoches;


$costeinicial=$precioNocheNum*$numeroNochesNum;
var_dump($costeinicial);
$calculodesc=(100-$descuento)/100;
var_dump($calculodesc);
$descuentoInicial=$costeinicial*$calculodesc;
var_dump($descuentoInicial);
$importefinal=$descuentoInicial+$gastosGestion;
var_dump($importefinal);

var_dump($cuatro==$numeroNoches);//true
var_dump($cuatro===$numeroNoches);//false
/*Es porque el $numeroNoches esta en formato de String y en la comparación
flexible '=='solo compara el valor q es 4 pero en la comparación estricta '==='
compara el valor y el tipo y este caso son un String y un int. */
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
<h1>Hotel Transylvania</h1>
<h2>Recibo<h2>
<ul>
    <li>El coste inicial son : <?=$costeinicial?> €</li>
    <li>Aplicando el descuento son : <?=$descuentoInicial?> €</li>
    <li>Los gastos de gestión son : <?=$gastosGestion?> €</li>
    <li>IMPORTE TOTAL :  <?=$importefinal?> €</li>
</ul>
</body>
</html>
