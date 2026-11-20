<?php
require_once __DIR__ . '/../app/bootstrap.php';



?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meeple Shop</title>

</head>
<body class="bg-<?= e($theme) ?>">
<?php meepleheader() ?>
<main>
    <section>
        <h1>
            Meeple Shop
        </h1>
        <p>
            Tienda para aficionados a los juegos de mesa
        </p>
    </section>

</main>

</body>
</html>
