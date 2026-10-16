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

    foreach ($juegos as $juego) {


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

<!-- Cuadrícula con 4 tarjetas de ejemplo -->
<div class="grid-posts">

    <div class="tarjeta-post">
        <h3>GOTYland - Edición Estándar</h3>
        <p>Precio : 20.26 €</p>
        <p>Descuento : 20%</p>
    </div>

    <div class="tarjeta-post">
        <h3>GOTYland - Expansión</h3>
        <p>Precio : 15.00 €</p>
        <p>Descuento : 10%</p>
    </div>

    <div class="tarjeta-post">
        <h3>GOTYland - Pase VIP</h3>
        <p>Precio : 10.00 €</p>
        <p>Descuento : 50%</p>
    </div>

    <div class="tarjeta-post">
        <h3>GOTYland - Bundle Completo</h3>
        <p>Precio : 35.00 €</p>
        <p>Descuento : 30%</p>
    </div>

</div>

</body>
</html>
