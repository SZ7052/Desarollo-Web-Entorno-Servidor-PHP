<?php
declare(strict_types=1);

$peliculas = [
    ["titulo" => "Dune", "genero" => "Ciencia ficción", "anio" => 2021, "duracion" => 155],
    ["titulo" => "Interstellar", "genero" => "Ciencia ficción", "anio" => 2014, "duracion" => 169],
    ["titulo" => "Parasite", "genero" => "Drama", "anio" => 2019, "duracion" => 132],
    ["titulo" => "The Batman", "genero" => "Acción", "anio" => 2022, "duracion" => 176],
    ["titulo" => "Whiplash", "genero" => "Drama", "anio" => 2014, "duracion" => 106]
];

$genero = $_GET["genero"]??"";
$duracion = $_GET["duracion"]??"";

function esCompatible(
    array $pelicula,
    string $genero,
    int $duracion
):bool{
    return
        $genero === $pelicula["genero"] && $duracion <= $pelicula["duracion"];
}

$resultados = [];
$error=null;
$busquedarealizada = isset($_GET["genero"],$_GET["duracion"]);

$duracion = filter_input (INPUT_GET, "duracion",FILTER_VALIDATE_INT);

if ($busquedarealizada) {
    $genero = trim($_GET["genero"]??"");

    if (!$duracion || $duracion <=0 ) {
        $error = "La duracion no es valida";
    } else {

        foreach ($peliculas as $pelicula) {
            if (esCompatible($pelicula, $genero, $duracion)) {
                $resultados[] = $pelicula;
            }
        }
    }
}



/*1. ¿Por qué GET es más apropiado que POST para este caso?
2. ¿Qué ventaja tiene que la consulta aparezca en la URL?
3. ¿Qué información procedente del cliente estás validando?*/


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
<form method="get">
    <label for="genero">
        Genero
    </label>
    <input type="text"
           id="genero"
           name="genero"
           value="<?= htmlspecialchars($genero ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
            required>
    <label for="duracion">
        duracion
    </label>
    <input type="number"
           id="duracion"
           name="duracion"
           value="<?= $duracionInput ?? '' ?>"
           min="1" required>
    <button type="submit">Buscar</button>

    <?php if ($error): ?>
        <p ><?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
    <?php elseif ($busquedarealizada): ?>
        <h3>Resultados</h3>
        <?php if (!empty($resultados)): ?>
            <ul>
                <?php foreach ($resultados as $p): ?>
                    <li>
                        <?= htmlspecialchars($p['titulo'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                        (<?= $p['anio'] ?>)
                        - Género: <?= htmlspecialchars($p['genero'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>,
                        Duración: <?= $p['duracion'] ?> min
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron películas</p>
        <?php endif; ?>
    <?php endif; ?>

</form>

</body>
</html>
