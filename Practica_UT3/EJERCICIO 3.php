<?php
declare(strict_types=1);

$peliculas = [
    ["titulo" => "Dune", "genero" => "Ciencia ficción", "anio" => 2021, "duracion" => 155],
    ["titulo" => "Interstellar", "genero" => "Ciencia ficción", "anio" => 2014, "duracion" => 169],
    ["titulo" => "Parasite", "genero" => "Drama", "anio" => 2019, "duracion" => 132],
    ["titulo" => "The Batman", "genero" => "Acción", "anio" => 2022, "duracion" => 176],
    ["titulo" => "Whiplash", "genero" => "Drama", "anio" => 2014, "duracion" => 106]
];

$genero = $_GET["genero"];
$duracion = $_GET["duracion"];

function esCompatible(
    array $pelicula,
    string $genero,
    int $duracion
):bool{
    return
        $genero === $pelicula["genero"] && $duracion <= $pelicula["duracion"];
}


$resultados = [];
foreach ($peliculas as $pelicula) {
    if(esCompatible($pelicula,$genero,$duracion)){
        $resultados[] = $pelicula;
    }
}

echo





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
    <label for="Genero">
        Genero
    </label>
    <input type="text"
           id="Genero"
           name="Genero"
            required>
    <label for="duracion">
        duracion
    </label>
    <input type="number"
           id="duracion"
           name="duracion"
           min="1" required>
    <button type="submit">Buscar</button>


</form>

</body>
</html>
