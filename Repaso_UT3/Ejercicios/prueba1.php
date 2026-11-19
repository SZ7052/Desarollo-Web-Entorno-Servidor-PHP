<?php
declare(strict_types=1);

// Catálogo de videojuegos
$juegos = [
    [
        "titulo" => "Hades",
        "genero" => "Roguelike",
        "precio" => 24.99,
        "pegi" => 12,
        "stock" => 7
    ],
    [
        "titulo" => "Baldur's Gate 3",
        "genero" => "RPG",
        "precio" => 59.99,
        "pegi" => 18,
        "stock" => 4
    ],
    [
        "titulo" => "Stardew Valley",
        "genero" => "Simulación",
        "precio" => 13.99,
        "pegi" => 7,
        "stock" => 0
    ],
    [
        "titulo" => "Celeste",
        "genero" => "Plataformas",
        "precio" => 19.99,
        "pegi" => 7,
        "stock" => 3
    ],
    [
        "titulo" => "Cyberpunk 2077",
        "genero" => "RPG",
        "precio" => 49.99,
        "pegi" => 18,
        "stock" => 0
    ]
];

/**
 * Función auxiliar para escapar la salida HTML y prevenir XSS
 */
function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

$juegosDisponibles = [];
$sumaPrecios = 0.0;

// Filtrar juegos con stock disponible
foreach ($juegos as $juego) {
    if ($juego["stock"] > 0) {
        $juegosDisponibles[] = $juego;
        $sumaPrecios += $juego["precio"];
    }
}

$totalDisponibles = count($juegosDisponibles);
$precioMedio = $totalDisponibles > 0 ? $sumaPrecios / $totalDisponibles : 0.0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Catálogo de Videojuegos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<h1>Catálogo de Videojuegos Disponibles</h1>
<table>
    <thead>
    <tr>
        <th>Título</th>
        <th>Género</th>
        <th>Precio</th>
        <th>PEGI</th>
        <th>Stock</th>
        <th>Categoría</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($juegosDisponibles as $juego): ?>
        <?php $categoria = $juego["precio"] > 40 ? "Premium" : "Estándar"; ?>
        <tr>
            <td><?= e($juego["titulo"]) ?></td>
            <td><?= e($juego["genero"]) ?></td>
            <td><?= e(number_format($juego["precio"], 2)) ?> €</td>
            <td><?= e((string)$juego["pegi"]) ?></td>
            <td><?= e((string)$juego["stock"]) ?></td>
            <td><?= e($categoria) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<p><strong>Total de juegos disponibles:</strong> <?= $totalDisponibles ?></p>
<p><strong>Precio medio:</strong> <?= number_format($precioMedio, 2) ?> €</p>
</body>
</html>d