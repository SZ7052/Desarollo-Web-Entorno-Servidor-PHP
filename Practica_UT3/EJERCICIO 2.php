<?php
declare(strict_types=1);

$componentes = [
    "procesador" => 249.90,
    "placaBase" => 149.50,
    "ram" => 89.90,
    "grafica" => 499.99,
    "ssd" => 79.95,
    "fuente" => 99.90
];



function calcularSubtotal(array $compo):float{
    $longitud=count($compo);
    $Suma = 0;
   foreach ($compo as $comp) {
       $Suma += $comp;
   }
    return $Suma;
}

//echo calcularSubtotal($componentes);

function calcularCosteMontaje(array $compo):float{
    $CosteMontaje = 0;
    $PrecioMontaje = 49.99;

if (calcularSubtotal($compo) > 1000 ) {
    $CosteMontaje  = calcularSubtotal($compo);

}else{
    $CosteMontaje=calcularSubtotal($compo)+$PrecioMontaje;

}
    return $CosteMontaje;

}

//echo calcularCosteMontaje($componentes);

function calcularDescuento(array $compo):float{
    $calculodesc=(100-5)/100;
    $PrecioDescuento = 0;
    if(calcularSubtotal($compo) >1200) {
        $PrecioDescuento = (calcularSubtotal($compo)*$calculodesc)*(21/100);
    }else{
        $PrecioDescuento=calcularSubtotal($compo) * ((21+100)/100);
    }
    return $PrecioDescuento;
}

//echo calcularDescuento($componentes);
function calcularTotal(array $compo):float{
$PrecioFinal = 0;
$PrecioFinal=calcularDescuento($compo);
return $PrecioFinal;
}



/*

1. ¿Qué ventaja aporta que las funciones devuelvan valores en vez de realizar echo?

2. ¿Qué responsabilidades has separado?

3. Si mañana cambia el precio del montaje, ¿qué parte del programa tendrías que modificar?
Ninguna
*/

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



</body>
</html>
