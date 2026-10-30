<?php
declare(strict_types=1);
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
                $duracion >= $juegos["duracion"] && $categoria === $juegos["categoria"] && $juegos["disponibles"] >= 1;
    }

    function esCompatiblesincate(
            array $juegos,
            int $numero_jugadores,
            int $duracion
    ):bool{
        return
                $numero_jugadores <= $juegos["jugadoresMax"] && $numero_jugadores >= $juegos["jugadoresMin"] &&
                $duracion >= $juegos["duracion"] && $juegos["disponibles"] >= 1;
    }



$busquedarealizada = ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["numero_jugadores"],$_GET["duracion"]));

$resultados = [];
$errores = [];

$duracion = filter_input (INPUT_GET, "duracion",FILTER_VALIDATE_INT);
$numero_jugadores=filter_input(INPUT_GET, "numero_jugadores",FILTER_VALIDATE_INT);

if ($busquedarealizada) {


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

$nombre="";
$email="";
$edad="";
$estaperfecto=false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");

    function validarNombre(string $nombre): ?string
    {
        if ($nombre === "") {
            return "Nombre es requerido";
        }
        return null;
    }

    $errorNombre = validarNombre($nombre);
    if ($errorNombre) {
        $errores[] = $errorNombre;
    }

    $email = trim($_POST["email"] ?? "");


    function validarEmail(string $email): ?string
    {
        if ($email === "") {
            return "Email es requerido";
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return "Email no válido";
        }
        return null;
    }

    $errorEmail = validarEmail($email);
    if ($errorEmail) {
        $errores[] = $errorEmail;
    }


    $edad = filter_input(
            INPUT_POST,
            "edad",
            FILTER_VALIDATE_INT
    );
    function validarEdad($edad): ?string
    {
        if ($edad === false || $edad === null) {
            return "Edad es requerido";
        }
        if ($edad < 0) {
            return "No puede ser menor que 0";
        }
        return null;
    }

    $errorEdad = validarEdad($edad);
    if ($errorEdad) {
        $errores[] = $errorEdad;
    }

    $estaperfecto = empty($errores);

}
/*
        1. ¿Por qué has utilizado GET para la búsqueda?
    Porque el GET sirve para consultar la información del servidor , sin miedo a tocar nada .
        2. ¿Por qué POST para la reserva?
    Porque el Post te permite enviar los datos del usuario al servidor
    y no aparece nada de información extra en el navegador.
        3. ¿Qué datos recibidos del cliente has tenido que validar?
    He tenido que validar el número de jugadores, la duración , el nombre , el email , la edad y tambien si tenia stock.
        4. ¿Qué diferencia existe entre validar y escapar?
    Validar,ves si tienes correcto los datos que han introducido y escapar es una pequeña preparacion para mostrar los datos .
        5. ¿Qué responsabilidades has separado en funciones?
    He separado en funciones : comprobaciones de GET para ver si hay juegos con las medidas que se pone .
    Y tambien las comprobaciones de POST.
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
<form method="get">
    <div>
    <label for="numero_jugadores">
        Número de Jugadores:
    </label>
    <input type="number"
           id="numero_jugadores"
           name="numero_jugadores"
           value="<?= $numero_jugadores ?? '' ?>"
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
           value="<?= $duracion ?? '' ?>"
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

                    <form method="POST">
                        <div>
                            <label for="nombre">
                            Nombre:
                            </label>
                            <input type="text"
                               id="nombre"
                               name="nombre"
                               minlength="3"
                               value="<?= htmlspecialchars($nombre, ENT_QUOTES, "UTF-8") ?>"
                               required>
                        </div>
                        <div>
                            <label for="email">
                                Email:
                            </label>


                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="<?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?>"
                                   required>
                        </div>
                        <div>
                            <label for="edad">
                                Edad:
                            </label>


                            <input type="number"
                                   id="edad"
                                   name="edad"
                                   value="<?= htmlspecialchars((string)($edad ?: ""), ENT_QUOTES, "UTF-8") ?>"
                                   min="16"
                                   required>

                            <button type="submit" > Confirmar Reserva</button>
                        </div>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No se encontraron Juegos con esos filtros</p>
    <?php endif; ?>
<?php endif; ?>

<?php if(!empty($errores) ): ?>
<div>
    <h3>Errores:</h3>
    <ul>
        <?php foreach ($errores as $e): ?>
        <li><?=$e?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if($estaperfecto):?>
<h2>Esta Bien Hecho!!!</h2>

<p>
    Nombre:
    <?= htmlspecialchars($nombre, ENT_QUOTES, "UTF-8") ?>
</p>
<p>
    Email:
    <?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?>
</p>

<p>
    Edad:
    <?= htmlspecialchars((string)($edad?:""), ENT_QUOTES, "UTF-8") ?>
</p>

<?php endif; ?>

</body>
</html>
