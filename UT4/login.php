<?php

require_once __DIR__ . '/includes/bootstrap.php';
$theme=$_COOKIE["theme"]??"light";
if(!is_string($theme)||!in_array($theme, ["light", "dark"])){
    $theme="light";
}

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $emailInput=$_POST["email"]??'';
    $passwordInput=$_POST["password"]??'';

    $email=is_string($emailInput)?trim($emailInput):'';
    $password=is_string($passwordInput)?trim($passwordInput):'';


}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles.css">
    <title>Login</title>

</head>
<body class="bg-<?=  e($theme)?>">
<h1>Iniciar sesión</h1>
<form method="POST" action="">
    <label for="email" >Email</label>
    <input type="email" id="email" name="email" placeholder="Email">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Contraseña">

    <button type="submit" >Login</button>
</form>
</body>
</html>
