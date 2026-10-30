<?php
require_once __DIR__ . '/includes/bootstrap.php';
$allowedTheme=['light', 'dark'];
$error=null;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $theme=$_POST["theme"]??'';
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
    <link rel="stylesheet" href="assets/styles.css">

</head>
<body>
    <main>
        <section>
            <h1>
                Preferencias
            </h1>
            <?php
            if(isset($error)):  ?>
                <p class="error"><?= e($error) ?></p>
            <?php endif; ?>
            <form action="" method="post">
                <label for="theme">Tema</label>
                <select name="theme" id="theme">
                    <option value="light">Claro</option>
                    <option value="dark">Oscuro</option>
                </select>
                <button type="submit">Guardar preferencias</button>
            </form>
        </section>
    </main>
</body>
</html>
