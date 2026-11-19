<?php
declare(strict_types=1);

$peliculas = [
    ["titulo" => "Interstellar", "genero" => "Ciencia ficción", "anio" => 2014, "duracion" => 169],
    ["titulo" => "Parasite", "genero" => "Drama", "anio" => 2019, "duracion" => 132],
    ["titulo" => "Dune", "genero" => "Ciencia ficción", "anio" => 2021, "duracion" => 155],
    ["titulo" => "The Batman", "genero" => "Acción", "anio" => 2022, "duracion" => 176],
    ["titulo" => "Whiplash", "genero" => "Drama", "anio" => 2014, "duracion" => 106]
];

function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

$resultados = [];
$errorDuracion = null;
$busquedaRealizada = false;

if (isset($_GET["genero"]) || isset($_GET["duracion"])) {
    $busquedaRealizada = true;
    $generoFiltro = trim($_GET["genero"] ?? "");
    $duracionInput = trim($_GET["duracion"] ?? "");

    $duracionMax = filter_var($duracionInput, FILTER_VALIDATE_INT);
    if ($duracionInput !== "" && ($duracionMax === false || $duracionMax < 0)) {
        $errorDuracion = "La duración máxima introducida no es válida.";
    } else {
        foreach ($peliculas as $pelicula) {
            $cumpleGenero = ($generoFiltro === "" || strcasecmp($pelicula["genero"], $generoFiltro) === 0);
            $cumpleDuracion = ($duracionInput === "" || ($duracionMax !== false && $pelicula["duracion"] <= $duracionMax));

            if ($cumpleGenero && $cumpleDuracion) {
                $resultados[] = $pelicula;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3 - Buscador de Películas</title>
</head>
<body>
<h1>Buscador de Películas</h1>
<form method="get">
    <label for="genero">Género:</label>
    <input type="text" id="genero" name="genero" value="<?= e($_GET["genero"] ?? "") ?>">

    <label for="duracion">Duración máxima (min):</label>
    <input type="number" id="duracion" name="duracion" value="<?= e($_GET["duracion"] ?? "") ?>">

    <button type="submit">Filtrar</button>
</form>

<?php if ($errorDuracion): ?>
    <p style="color: red;"><?= e($errorDuracion) ?></p>
<?php elseif ($busquedaRealizada): ?>
    <h2>Resultados</h2>
    <?php if (empty($resultados)): ?>
        <p>No se encontraron películas con los criterios especificados.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($resultados as $p): ?>
                <li><strong><?= e($p["titulo"]) ?></strong> (<?= e($p["genero"]) ?>) - <?= e((string)$p["anio"]) ?> - <?= e((string)$p["duracion"]) ?> min</li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>