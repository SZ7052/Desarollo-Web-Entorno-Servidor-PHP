<?php
declare(strict_types=1);

$componentes = [
    "procesador" => 249.90,
    "placabase" => 149.50,
    "ram" => 89.90,
    "grafica" => 499.99,
    "ssd" => 79.95,
    "fuente" => 99.90
];

function calcularSubtotal(array $componentes): float {
    $subtotal = 0.0;
    foreach ($componentes as $precio) {
        $subtotal += $precio;
    }
    return $subtotal;
}

function calcularCosteMontaje(float $subtotal): float {
    return $subtotal > 1000.0 ? 0.0 : 49.99;
}

function calcularDescuento(float $subtotal): float {
    return $subtotal > 1200.0 ? $subtotal * 0.05 : 0.0;
}

function calcularTotal(float $subtotal, float $montaje, float $descuento): float {
    $baseImponible = $subtotal + $montaje - $descuento;
    return $baseImponible * 1.21;
}

function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

// Procesamiento de datos
$subtotal = calcularSubtotal($componentes);
$montaje = calcularCosteMontaje($subtotal);
$descuento = calcularDescuento($subtotal);
$baseImponible = $subtotal + $montaje - $descuento;
$iva = $baseImponible * 0.21;
$precioFinal = calcularTotal($subtotal, $montaje, $descuento);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Simulador de Presupuesto PC</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .resumen { max-width: 400px; background: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
    </style>
</head>
<body>
<h1>Simulador de Presupuesto de Montaje de PC</h1>
<div class="resumen">
    <h3>Componentes:</h3>
    <ul>
        <?php foreach ($componentes as $nombre => $precio): ?>
            <li><?= e(ucfirst($nombre)) ?>: <?= e(number_format($precio, 2)) ?> €</li>
        <?php endforeach; ?>
    </ul>
    <hr>
    <p><strong>Subtotal:</strong> <?= number_format($subtotal, 2) ?> €</p>
    <p><strong>Montaje:</strong> <?= number_format($montaje, 2) ?> €</p>
    <p><strong>Descuento:</strong> -<?= number_format($descuento, 2) ?> €</p>
    <p><strong>IVA (21%):</strong> <?= number_format($iva, 2) ?> €</p>
    <h2>Precio Final: <?= number_format($precioFinal, 2) ?> €</h2>
</div>
</body>
</html>
