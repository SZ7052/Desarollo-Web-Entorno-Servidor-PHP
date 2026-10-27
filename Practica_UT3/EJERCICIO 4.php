<?php


$nombre ="";
$email = "";
$edad = 0;
$aceptacion_de_normas=false;

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
    <label for="edad">
        Edad:
    </label>
    <input type="number"
           id="edad"
           name="edad"
           min="1" required>
    </div>
    <div>
    <label for="juego">
        Juegos:
    </label>
    <select id="juego" name="juego">
        <option>--Selecciona una--</option>
        <option>"Catan"</option>
        <option>"Carcassonne"</option>
        <option>"Dune: Imperium"</option>
        <option> "Terraforming Mars"</option>
    </select>
    </div>
    <div>
    <label for="niveles">
        Niveles:
    </label>
        <select id="juego" name="juego">
            <option>--Selecciona una--</option>
            <option>"principiante"</option>
            <option>"intermedio"</option>
            <option>"avanzado"</option>
        </select>
    </div>
    <div>
    <label for="acepta">
            Aceptación de normas:
    </label>
    <input type="checkbox"
           id="acepta"
           name="acepta"
           value="1">
    </div>



    <button type="submit" >Enviar</button>



</form>

</body>
</html>
