<?php
/*Nivel 2: Normal - El Menú del Día (Arrays, Bucles y Funciones)

Misión: Tienes un array multidimensional de platos de un restaurante (cada plato tiene nombre,
 precio y un booleano esVegetariano).

Lógica: Crea una función tipada filtrarVegetarianos(array $menu): array que reciba el menú completo
y devuelva un nuevo array solo con los platos donde esVegetariano sea true.

Requisitos: Usa un bucle foreach dentro de la función. Debajo, llama a tu función
y usa otro foreach para imprimir en el HTML una lista (<ul>) con los nombres y precios de los platos resultantes.
*/




/**
 * 1. Definimos los datos: Un array multidimensional con los platos del restaurante
 * (Cada plato asociativo tiene: nombre, precio y esVegetariano).
 */
$menuRestaurante = [
    [
        "nombre" => "Ensalada César",
        "precio" => 8.50,
        "esVegetariano" => false
    ],
    [
        "nombre" => "Crema de Verduras",
        "precio" => 6.00,
        "esVegetariano" => true
    ],
    [
        "nombre" => "Entrecot de Ternera",
        "precio" => 18.90,
        "esVegetariano" => false
    ],
    [
        "nombre" => "Risotto de Setas",
        "precio" => 12.50,
        "esVegetariano" => true
    ],
    [
        "nombre" => "Paella de Verduras",
        "precio" => 11.00,
        "esVegetariano" => true
    ]
];

/**
 * 2. Función de lógica de negocio (Bloque 4 y 10):
 * Recibe el menú completo y devuelve un nuevo array únicamente con los platos vegetarianos.
 * Cumple con la regla de una sola responsabilidad.
 */
function filtrarVegetarianos(array $menu): array {
    $platosVegetarianos = [];

    // Usamos un bucle foreach para recorrer el array multidimensional (Bloque 3)
    foreach ($menu as $plato) {
        // Como 'esVegetariano' ya es booleano, evaluamos directamente sin comparar con true (Bloque 1)
        if ($plato["esVegetariano"]) {
            $platosVegetarianos[] = $plato; // Acumulamos en el nuevo array
        }
    }

    return $platosVegetarianos;
}

// Llamamos a la función para obtener los platos filtrados
$menuVegetariano = filtrarVegetarianos($menuRestaurante);

/**
 * Función auxiliar para escapar la salida HTML y prevenir XSS (Bloque 6)
 */
function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Vegetariano del Día</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 500px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        ul { padding-left: 20px; }
        li { margin-bottom: 8px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Platos Vegetarianos Disponibles</h2>

    <ul>
        <?php foreach ($menuVegetariano as $plato): ?>
            <!-- 3. Usamos otro foreach para imprimir dinámicamente los elementos en el HTML (Bloque 3 y 10) -->
            <li>
                <strong><?= e($plato["nombre"]) ?></strong> -
                <span><?= e(number_format($plato["precio"], 2)) ?> €</span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>