<?php


$nombre ="";
$email = "";
$edad = "";
$juego_principal = "";
$nivel = "";
$aceptacion_de_normas="";


$juegosPermitidos = [
    "Catan",
    "Carcassonne",
    "Dune: Imperium",
    "Terraforming Mars"
];

$nivelesPermitidos = [
    "principiante",
    "intermedio",
    "avanzado"
];

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
<form method="post">
    <div>
    <label for="nombre">
        Nombre:
    </label>
    <input type="text"
           id="nombre"
           name="nombre"
           minlength="3" required>
    </div>
    <div>
    <label for="email">
        Email:
    </label>

    <input type="email"
           id="email"
           name="email"
           min="1" required>
    </div>
    <div>
    <label for="duracion">
        Duración máxima
    </label>
    <input type="number"
           id="duracion"
           name="duracion"
           min="1" required>
    </div>
    <div>
    <label for="duracion">
        Duración máxima
    </label>
    <input type="number"
           id="duracion"
           name="duracion"
           min="1" required>
    </div>
    <div>
    <label for="duracion">
        Duración máxima
    </label>
    <input type="number"
           id="duracion"
           name="duracion"
           min="1" required>
    </div>
    <div>
    <label for="duracion">
        Duración máxima
    </label>
    <input type="number"
           id="duracion"
           name="duracion"
           min="1" required>
    </div>
    <div>
    <label for="duracion">
        Duración máxima
    </label>
    <input type="number"
           id="duracion"
           name="duracion"
           min="1" required>
    </div>

    <button type="submit" >Enviar</button>



</form>

</body>
</html>
