<?php
    require_once __DIR__ . '/includes/bootstrap.php';
    $theme=$_COOKIE["theme"]??"light";
    if(!is_string($theme)||!in_array($theme, ["light", "dark"])){
        $theme="light";
    }
    $_SESSION['visitas'] = ($_SESSION['visitas'] ?? 0) + 1;
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meeple Shop</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="bg-<?= e($theme) ?>">

<main>
    <section>
        <h1>
            Meeple Shop
        </h1>
        <p>
            Tienda para aficionados a los juegos de mesa
        </p>
    </section>
    <a class="button" href="preferences.php">Ir a preferencias</a>
    <p>Nos han visitado:<?= $_SESSION['visitas']?>veces</p>
</main>

</body>
</html>
