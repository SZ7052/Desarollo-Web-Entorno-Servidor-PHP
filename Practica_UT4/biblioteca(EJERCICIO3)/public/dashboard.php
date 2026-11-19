<?php
require_once __DIR__ . '/../app/bootstrap.php';
$user = currentUser();
if(!$user){
    redirect("login.php");
}


?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles.css">
    <title>DashBoard</title>

</head>
<body >
<section>
    <h1>Bienvenido, <?=e($user['name'])?></h1>
    <a href="logout.php"><button>Cerrar sesión</button></a>
</section>
</body>
</html>