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
    $Suma = 0;
   foreach ($compo as $precio) {
       $Suma += $precio;
   }
    return $Suma;
}

//echo calcularSubtotal($componentes);

function calcularCosteMontaje(array $compo):float{
if (calcularSubtotal($compo) > 1000 ) {
    return 0;
}
    return 49.99;
}

//echo calcularCosteMontaje($componentes);

function calcularDescuento(array $compo):float{
    $calculodesc=(100-5)/100;
    if(calcularSubtotal($compo) >1200) {
        return (calcularSubtotal($compo)*$calculodesc)*(21/100);
    }
    return 0;
}

//echo calcularDescuento($componentes);
function calcularTotal(array $compo):float
{
$basesiniva= calcularSubtotal($compo) + calcularCosteMontaje($compo) - calcularDescuento($compo);
$iva=$basesiniva * 0.21;
return $basesiniva + $iva;
}

$subtotal=calcularSubtotal($componentes);
$costemontaje=calcularCosteMontaje($componentes);
$descuento=calcularDescuento($componentes);
$basesiniva= calcularSubtotal($componentes) + calcularCosteMontaje($componentes) - calcularDescuento($componentes);
$iva=round($basesiniva * 0.21,2);
$Totalfinal=round(calcularTotal($componentes),2);







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
<div >
<h2>Componentes de pc</h2>

    <ul>
        <?php foreach ($componentes as $c => $value): ?>
            <li>
                <?= htmlspecialchars($c, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> : <?= $value ?> €
            </li>
        <?php endforeach; ?>
    </ul>

</div>
<div>
    <h3>Presupuesto Completo</h3>
   <ul>
       <li>
           Subtotal:   <?= $subtotal ?> €
       </li>
       <li>
            Coste de Montaje:   <?= $costemontaje?> €
       </li>
       <?php if ($descuento>0):?>
           <li>

                Descuento(5%): <?=$descuento?> €

           </li>
       <?php endif ?>
       <li>
        IVA(21%):   <?=$iva?> €
       </li>
       <li>
        PrecioFinal:   <?=$Totalfinal?> €
       </li>
   </ul>
</div>

</body>
</html>
