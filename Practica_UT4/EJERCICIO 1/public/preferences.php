<?php
require_once __DIR__ . '/../app/bootstrap.php';
$allowedTheme=['light', 'dark'];
$idiomas=['es', 'en'];
$elementos=[10,20,30];

$errores=[];

$theme=$_COOKIE["theme"]??"light";
$idioma=$_COOKIE["idioma"]??"es";
$elemento=$_COOKIE["elementos"]??10;

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $theme=$_POST["theme"]??'';
    $idioma=$_POST["idioma"]??"";
    $elemento=$_POST["elementos"]??"";
    if(!in_array($theme, $allowedTheme)) {
        $error= 'El tema elegido no es valido';
    }else{
        setcookie("theme", $theme,[
            "expires" => time()+(86400*30),
            "path" => "/",
            "secure" => requestIsHTTPS(),
            "httponly" => true,
            "samesite" => "Lax",
        ]);
    }
    if(!is_string($theme)||!in_array($theme, ["light", "dark"])){
        $theme="light";
    }
    if(!in_array($idioma, $idiomas)){
        $error= 'El idioma no es valido';
    }else{
        setcookie("idioma", $idioma,[
            "expires" => time()+(86400*30),
            "path" => "/",
            "secure" => requestIsHTTPS(),
            "httponly" => true,
            "samesite" => "Lax",
        ]);
    }
    if(!in_array($elemento, $elementos)){
        $error= 'El numero de elementos no es valido';
    }else{
        setcookie("elemento", $elemento,[
            "expires" => time()+(86400*30),
            "path" => "/",
            "secure" => requestIsHTTPS(),
            "httponly" => true,
            "samesite" => "Lax",
        ]);
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
    <title>Meeple Shop - Preferencias</title>
    <link rel="stylesheet" href="../assets/style.css">

</head>
<body class="bg-<?= e($theme) ?>">

<main>
    <section>
        <h1>
            Preferencias
        </h1>
        <?php
        if(!empty($error)):  ?>
            <?php foreach($errores as $error):  ?>
                <p class="error"><?= e($error) ?></p>
            <?php endforeach;?>
        <?php endif; ?>
        <form action="" method="post">
            <label for="theme">Tema</label>
            <select name="theme" id="theme">
                <option value="light">Claro</option>
                <option value="dark">Oscuro</option>
            </select>
            <label for="idioma" >Idioma</label>
            <select name="idioma" id="idioma">
                <option value="es">Español</option>
                <option value="en">Ingles</option>
            </select>
            <label for="numero_elementos">Número de elementos</label>
            <select name="numero_elementos" id="numero_elementos">
                <option value=10>10</option>
                <option value=20>20</option>
                <option value=50>50</option>
            </select>
            <button type="submit">Guardar preferencias</button>
        </form>
    </section>

</main>
</body>
</html>
