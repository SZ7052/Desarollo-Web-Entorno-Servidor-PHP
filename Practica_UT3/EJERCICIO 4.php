<?php
declare(strict_types=1);

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

$errores=[];

$nombre=trim($_POST["nombre"]??"");

function validarNombre(string $nombre):?string{
    if($nombre === ""){
       return "Nombre es requerido";
    }
    if (mb_strlen($nombre)<3 ){
        return "Nombre debe tener al menos 3 caracteres";
    }
    return null;
}
$errorNombre=validarNombre($nombre);
if($errorNombre){
    $errores[]=$errorNombre;
}

$email=trim($_POST["email"]??"");


function validarEmail(string $email):?string{
    if($email === ""){
        return "Email es requerido";
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return "Email no válido";
    }
    return null;
}
$errorEmail=validarEmail($email);
if($errorEmail){
    $errores[]=$errorEmail;
}


$edad= filter_input(
        INPUT_POST,
        "edad",
        FILTER_VALIDATE_INT
);
function validarEdad($edad):?string{
    if($edad === false || $edad === null){
        return "Edad es requerido";
    }
    if($edad < 16){
        return "Tiene que ser mayor a 16";
    }
    return null;
}
$errorEdad=validarEdad($edad);
if($errorEdad){
    $errores[]=$errorEdad;
}

$aceptacion_de_normas=isset($_POST["acepta"]);
function validarAceptacionDeNormas(bool $aceptacion_de_normas):?string{
    if(!$aceptacion_de_normas){
        return "Aceptacion es requerido";
    }
    return null;
}
$errorAceptacion=validarAceptacionDeNormas($aceptacion_de_normas);
if($errorAceptacion){
    $errores[]=$errorAceptacion;
}

$juegos = $_POST["juegos"]??"";

function validarjuegos(
        array $juegosPermitidos,
        string $juegos
):?string{
     if(!in_array($juegos, $juegosPermitidos, true)){
        return "No es un juego valido";
    }
    return null;

}


$errorJuegos=validarJuegos($juegosPermitidos, $juegos);
if($errorJuegos){
    $errores[]=$errorJuegos;
}

$niveles = $_POST["niveles"]??"";

function validarNiveles(
        array $nivelesPermitidos,
        string $niveles
):?string{
    if(!in_array($niveles,$nivelesPermitidos,true)){
        return "No es un nivel valido";
    }
    return null;
}



$errorNiveles=validarNiveles($nivelesPermitidos,$niveles);
if($errorNiveles){
    $errores[]=$errorNiveles;
}

$estaperfecto = ($_SERVER["REQUEST_METHOD"] === "POST") && empty($errores);




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
<h1>Formulario</h1>
<form method="post">
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
    </div>
    <div>
    <label for="juegos">
        Juegos:
    </label>
    <select id="juegos" name="juegos" required>
        <option value="">--Selecciona una--</option>
        <option value="Catan">"Catan"</option>
        <option value="Carcassonne">"Carcassonne"</option>
        <option value="Dune: Imperium">"Dune: Imperium"</option>
        <option value="Terraforming Mars"> "Terraforming Mars"</option>
    </select>
    </div>
    <div>
    <label for="niveles">
        Niveles:
    </label>
        <select id="niveles" name="niveles" required >
            <option value="">--Selecciona una--</option>
            <option value="principiante">"principiante"</option>
            <option value="intermedio">"intermedio"</option>
            <option value="avanzado">"avanzado"</option>
        </select>
    </div>
    <div>
    <label for="acepta">
            Aceptación de normas:
    </label>
    <input type="checkbox"
           id="acepta"
           name="acepta"
           value="1" required>
    </div>



    <button type="submit" >Enviar</button>
</form>

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

            <p>
                Juego:
                <?= htmlspecialchars($juegos, ENT_QUOTES, "UTF-8") ?>
            </p>

            <p>
                Nivel:
                <?= htmlspecialchars($niveles, ENT_QUOTES, "UTF-8") ?>
            </p>

            <p>Aceptaste Las Normas.</p>


    <?php endif; ?>


</body>
</html>
