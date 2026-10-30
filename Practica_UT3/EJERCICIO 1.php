<?php
$juegos = [
    [
        "titulo" => "Hades",
        "genero" => "Roguelike",
        "precio" => 24.99,
        "pegi" => 12,
        "stock" => 7
    ],
    [
        "titulo" => "Baldur's Gate 3",
        "genero" => "RPG",
        "precio" => 59.99,
        "pegi" => 18,
        "stock" => 4
    ],
    [
        "titulo" => "Stardew Valley",
        "genero" => "Simulación",
        "precio" => 13.99,
        "pegi" => 7,
        "stock" => 0
    ],
    [
        "titulo" => "Celeste",
        "genero" => "Plataformas",
        "precio" => 19.99,
        "pegi" => 7,
        "stock" => 3
    ],
    [
        "titulo" => "Cyberpunk 2077",
        "genero" => "RPG",
        "precio" => 49.99,
        "pegi" => 18,
        "stock" => 0
    ]
];
$Totaljuegos=count($juegos);
$suma=0;
foreach ($juegos as $juego) {
    $suma += $juego["precio"];
}
$Media = $suma / $Totaljuegos;

/*
1. ¿Por qué foreach es una buena elección para este problema?
Porque nos permite mostrar todo el contenido que hay en la array sin
tener que mostrar la informacion a mano con las posiciones.
2. ¿Qué ocurriría si todos los juegos tuviesen stock 0?
No pasa nada , el progrmaa/calculo seguira funcionando porque no tiene que ver con el stock.

3. ¿Qué variables has necesitado para calcular la media?
He usado 3 : suma , media y totaljuegos .
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
    <style>
        /* Contenedor principal que forma la rejilla */
        .grid-posts {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Crea 2 columnas iguales */
            gap: 20px; /* Espacio de separación entre las tarjetas */
            max-width: 800px;
            margin: 20px auto;
        }

        /* Estilo individual de cada tarjeta (cada "post") */
        .tarjeta-post {
    background-color: #ffffff;
            border: 1px solid #dbdbdb; /* Borde gris suave estilo red social */
            border-radius: 12px;       /* Esquinas redondeadas como en tu dibujo */
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); /* Sombra ligera opcional */
        }

        .tarjeta-post h3 {
    margin-top: 0;
            color: #262626;
        }
    </style>
</head>
<body>


<div class="grid-posts">
    <?php foreach ($juegos as $juego) : ?>

    <div class="tarjeta-post">
        <h3><?=$juego['titulo']?></h3>
        <p>Genero: <?=$juego['genero']?></p>
        <p>Precio: <?=$juego['precio']?></p>
        <p>Pegi: <?=$juego['pegi'] ?></p>
        <p>Stock: <?=$juego['stock'] ?></p>
        <?php if ($juego['precio'] > 40):?>
                <p>«Premium»</p>
        <?php else:?>
                <p>«Estándar»</p>
        <?php endif;?>

    </div>

    <?php endforeach; ?>
    <p>Total de juegos: <?=$Totaljuegos?></p>

    <p>Precio Medio: <?=$Media?></p>
</div>


</body>
</html>