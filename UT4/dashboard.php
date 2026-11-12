<?php
require_once __DIR__ . '/includes/bootstrap.php';
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
<body class="bg-<?=  e($theme)?>">
<section>
    <h1>Bienvenido, <?=e($user['name'])?></h1>
    <p>Rol:<?=e($user['role'])?></p>
    <?php if ($user['role'] === 'admin') {?>
        <a href="admin.php"><button>Admin</button></a>
    <?php } ?>
    <a href="logout.php"><button>Cerrar sesión</button></a>
</section>
</body>
</html>
