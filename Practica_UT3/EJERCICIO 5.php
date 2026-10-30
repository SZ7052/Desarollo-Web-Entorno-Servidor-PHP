<?php
$juegos = [
    [
        "id" => 1,
        "nombre" => "Catan",
        "categoria" => "Estrategia",
        "jugadoresMin" => 3,
        "jugadoresMax" => 4,
        "duracion" => 90,
        "edadMinima" => 10,
        "disponibles" => 2
    ],
    [
        "id" => 2,
        "nombre" => "Azul",
        "categoria" => "Abstracto",
        "jugadoresMin" => 2,
        "jugadoresMax" => 4,
        "duracion" => 45,
        "edadMinima" => 8,
        "disponibles" => 1
    ],
    [
        "id" => 3,
        "nombre" => "Dune: Imperium",
        "categoria" => "Estrategia",
        "jugadoresMin" => 1,
        "jugadoresMax" => 4,
        "duracion" => 120,
        "edadMinima" => 14,
        "disponibles" => 0
    ],
    [
        "id" => 4,
        "nombre" => "Cascadia",
        "categoria" => "Familiar",
        "jugadoresMin" => 1,
        "jugadoresMax" => 4,
        "duracion" => 45,
        "edadMinima" => 10,
        "disponibles" => 3
    ],
    [
        "id" => 5,
        "nombre" => "Terraforming Mars",
        "categoria" => "Estrategia",
        "jugadoresMin" => 1,
        "jugadoresMax" => 5,
        "duracion" => 150,
        "edadMinima" => 12,
        "disponibles" => 1
    ]
];

$numero_jugadores=$_GET["numero_jugadores"]??"";
$duracion=$_GET["duracion"]??"";
$categoria=$_GET["categoria"]??"";


    function esCompatibleconcate(
            array $juegos,
            int $numero_jugadores,
            int $duracion,
            string $categoria
    ):bool{
        return
                $numero_jugadores <= $juegos["jugadoresMax"] && $numero_jugadores >= $juegos["jugadoresMin"] &&
                $duracion <= $juegos["duracion"] && $categoria === $juegos["categoria"] && $juegos["disponibles"] >= 1;
    }

    function esCompatiblesincate(
            array $juegos,
            int $numero_jugadores,
            int $duracion,
    ):bool{
        return
                $numero_jugadores <= $juegos["jugadoresMax"] && $numero_jugadores >= $juegos["jugadoresMin"] &&
                $duracion <= $juegos["duracion"] && $juegos["disponibles"] >= 1;
    }



$busquedarealizada = ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["numero_jugadores"],$_GET["duracion"]));

$resultados = [];
$errores = [];

$duracion = filter_input (INPUT_GET, "duracion",FILTER_VALIDATE_INT);
$numero_jugadores=filter_input(INPUT_GET, "numero_jugadores",FILTER_VALIDATE_INT);

if ($busquedarealizada) {
    $genero = trim($_GET["genero"]??"");

    if (!$duracion || $duracion <=0 ) {
        $errores [] = "La duracion no es valida";
    }
    if(!$numero_jugadores || $numero_jugadores <=0 ) {
        $errores [] = "El numero de jugador no es valido";
    }
    if($categoria===""){
        foreach ($juegos as $juego) {
            if (esCompatiblesincate($juego, $numero_jugadores, $duracion)) {
                $resultados[] = $juego;
            }
        }
    }
    else {
        foreach ($juegos as $juego) {
            if (esCompatibleconcate($juego, $numero_jugadores, $duracion, $categoria)) {
                $resultados[] = $juego;
            }
        }
    }
}



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
    <div>
    <label for="numero_jugadores">
        Número de Jugadores:
    </label>
    <input type="number"
           id="numero_jugadores"
           name="numero_jugadores"
           value="<?= $numero_jugadoresInput ?? '' ?>"
           min="1"
           required>
    </div>
    <div>
    <label for="duracion">
        Duración:
    </label>
    <input type="number"
           id="duracion"
           name="duracion"
           value="<?= $duracionInput ?? '' ?>"
           min="1" required>
    <button type="submit">Buscar</button>
    </div>
    <div>
        <label for="categoria">
            Categoría:
        </label>
        <select id="categoria" name="categoria" >
            <option value="">--Selecciona una--</option>
            <option value="Estrategia">"Estrategia"</option>
            <option value="Familiar">"Familiar"</option>
            <option value="Abstracto">"Abstracto"</option>
        </select>
    </div>

</form>

<?php if ($busquedarealizada): ?>
    <h3>Resultados</h3>
    <?php if (!empty($resultados)): ?>
        <ul>
            <?php foreach ($resultados as $p): ?>
                <li>
                    <?= htmlspecialchars($p["nombre"], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                    <?= htmlspecialchars($p["categoria"], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                    <?= $p["jugadoresMin"] ?>-<?= $p["jugadoresMax"] ?>
                    <?= $p["duracion"] ?>
                    <?= $p["edadMinima"] ?>
                    <?= $p["disponibles"] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No se encontraron Juegos con esos filtros</p>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
