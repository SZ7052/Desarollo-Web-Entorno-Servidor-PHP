<?php
declare(strict_types=1);

$juegos = [
    ["id" => 1, "nombre" => "Catan", "categoria" => "Estrategia", "jugadoresMin" => 3, "jugadoresMax" => 4, "duracion" => 90, "edadMinima" => 10, "disponibles" => 2],
    ["id" => 2, "nombre" => "Azul", "categoria" => "Abstracto", "jugadoresMin" => 2, "jugadoresMax" => 4, "duracion" => 45, "edadMinima" => 8, "disponibles" => 1],
    ["id" => 3, "nombre" => "Dune: Imperium", "categoria" => "Estrategia", "jugadoresMin" => 1, "jugadoresMax" => 4, "duracion" => 120, "edadMinima" => 14, "disponibles" => 1],
    ["id" => 4, "nombre" => "Cascadia", "categoria" => "Familiar", "jugadoresMin" => 1, "jugadoresMax" => 4, "duracion" => 45, "edadMinima" => 10, "disponibles" => 3],
    ["id" => 5, "nombre" => "Terraforming Mars", "categoria" => "Estrategia", "jugadoresMin" => 1, "jugadoresMax" => 5, "duracion" => 150, "edadMinima" => 12, "disponibles" => 1]
];

function buscarJuegoPorId(array $catalogo, int $id): ?array {
    foreach ($catalogo as $juego) {
        if ($juego["id"] === $id) {
            return $juego;
        }
    }
    return null;
}

function esCompatible(array $juego, int $jugadores, int $durMax, string $categoria): bool {
    $cumpleJugadores = ($jugadores >= $juego["jugadoresMin"] && $jugadores <= $juego["jugadoresMax"]);
    $cumpleDuracion = ($juego["duracion"] <= $durMax);
    $cumpleCategoria = ($categoria === "" || strcasecmp($juego["categoria"], $categoria) === 0);
    $tieneStock = ($juego["disponibles"] > 0);

    return $cumpleJugadores && $cumpleDuracion && $cumpleCategoria && $tieneStock;
}

function e(string $val): string {
    return htmlspecialchars($val, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

$resultadosBusqueda = [];
$busquedaEjecutada = false;
$mensajeReserva = "";
$erroresReserva = [];

// 1. Procesar Búsqueda GET
$jugadoresBusqueda = filter_input(INPUT_GET, "jugadores", FILTER_VALIDATE_INT) ?: 0;
$duracionBusqueda = filter_input(INPUT_GET, "duracion_max", FILTER_VALIDATE_INT) ?: 999;
$categoriaBusqueda = trim($_GET["categoria"] ?? "");

if (isset($_GET["jugadores"])) {
    $busquedaEjecutada = true;
    foreach ($juegos as $juego) {
        if (esCompatible($juego, $jugadoresBusqueda, $duracionBusqueda, $categoriaBusqueda)) {
            $resultadosBusqueda[] = $juego;
        }
    }
}

// 2. Procesar Reserva POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombreReserva = trim($_POST["nombre"] ?? "");
    $emailReserva = trim($_POST["email"] ?? "");
    $edadReserva = filter_input(INPUT_POST, "edad", FILTER_VALIDATE_INT);
    $idJuegoReserva = filter_input(INPUT_POST, "juego_id", FILTER_VALIDATE_INT);

    if ($nombreReserva === "") $erroresReserva[] = "El nombre es obligatorio.";
    if (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) === false) $erroresReserva[] = "El email no es válido.";
    if ($edadReserva === false || $edadReserva === null) $erroresReserva[] = "La edad debe ser un número entero.";

    $juegoEncontrado = $idJuegoReserva ? buscarJuegoPorId($juegos, $idJuegoReserva) : null;
    if (!$juegoEncontrado) {
        $erroresReserva[] = "El juego seleccionado no existe en el catálogo.";
    } else {
        if ($juegoEncontrado["disponibles"] <= 0) {
            $erroresReserva[] = "No quedan unidades disponibles para este juego.";
        }
        if ($edadReserva !== false && $edadReserva !== null && $edadReserva < $juegoEncontrado["edadMinima"]) {
            $erroresReserva[] = "Se requiere una edad mínima de {$juegoEncontrado["edadMinima"]} años para reservar este juego.";
        }
    }

    if (empty($erroresReserva)) {
        $mensajeReserva = "¡Reserva completada con éxito para <strong>" . e($nombreReserva) . "</strong> del juego <strong>" . e($juegoEncontrado["nombre"]) . "</strong>!";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5 - Gestor de Ludoteca</title>
</head>
<body>
<h1>Buscador y Reserva de Juegos de Mesa</h1>
<form method="get">
    <label>Jugadores: <input type="number" name="jugadores" min="1" value="<?= e($_GET["jugadores"] ?? "") ?>" required></label>
    <label>Duración máx (min): <input type="number" name="duracion_max" min="1" value="<?= e($_GET["duracion_max"] ?? "") ?>" required></label>
    <label>Categoría: <input type="text" name="categoria" value="<?= e($_GET["categoria"] ?? "") ?>"></label>
    <button type="submit">Buscar Juegos</button>
</form>

<?php if ($busquedaEjecutada): ?>
    <h2>Resultados de Búsqueda</h2>
    <?php if (empty($resultadosBusqueda)): ?>
        <p>No se encontraron juegos que coincidan con los criterios.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($resultadosBusqueda as $j): ?>
                <li>
                    <strong><?= e($j["nombre"]) ?></strong> (<?= e($j["categoria"]) ?>) -
                    Jugadores: <?= $j["jugadoresMin"] ?>-<?= $j["jugadoresMax"] ?> |
                    Duración: <?= $j["duracion"] ?> min |
                    Edad mín: <?= $j["edadMinima"] ?> |
                    Disponibles: <?= $j["disponibles"] ?>

                    <form method="post" style="display:inline; margin-left:15px; border-left: 2px solid #ccc; padding-left: 10px;">
                        <input type="hidden" name="juego_id" value="<?= $j["id"] ?>">
                        <input type="text" name="nombre" placeholder="Nombre" required style="width: 100px;">
                        <input type="email" name="email" placeholder="Email" required style="width: 130px;">
                        <input type="number" name="edad" placeholder="Edad" required style="width: 50px;">
                        <button type="submit">Reservar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<?php if (!empty($mensajeReserva)): ?>
    <div style="background: #dff0d8; padding: 15px; margin-top: 20px; border-radius: 4px;"><?= $mensajeReserva ?></div>
<?php endif; ?>

<?php if (!empty($erroresReserva)): ?>
    <div style="background: #f2dede; color: #a94442; padding: 15px; margin-top: 20px; border-radius: 4px;">
        <ul>
            <?php foreach ($erroresReserva as $err): ?>
                <li><?= e($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
</body>
</html>
