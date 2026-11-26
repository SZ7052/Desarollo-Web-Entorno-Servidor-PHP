<?php



require_once __DIR__ . '/../app/bootstrap.php';
$user=currentUser();

if($_SERVER["REQUEST_METHOD"]==="POST"){

    $alias=$_POST["alias"]??'';

    $alias=is_string($alias)?trim($alias):'';

    if ($alias === '') {
        $error = 'El alias no puede estar vacío.';
    } else {
        login($alias);
        redirect('dashboard.php');
    }

    



}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login</title>

</head>
<body >
<?php meepleheader($user) ?>
<h1>Iniciar sesión</h1>
<?php if (isset($error)): ?>
<p class="error"><?=e($error)?></p>
<?php endif ?>
<form method="POST" action="">
    <label for="alias" >Alias</label>
    <input type="text" id="alias" name="alias" placeholder="Alias">


    <button type="submit" >Login</button>
</form>
</body>
</html>
