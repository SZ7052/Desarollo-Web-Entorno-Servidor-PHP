<?php
    require_once __DIR__ . '/includes/bootstrap.php';
    requireRole('admin');
    $user = currentUser();
    $users = getUsers();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body class="bg-<?=e($theme)?>">
    <h1>Admin</h1>
    <p>Bienvenido,<?=e($user['name'])?></p>
    <table >
        <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>EMAIL</th>
            <th>ROL</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?=e($user['id'])?></td>
            <td><?=e($user['name'])?></td>
            <td><?=e($user['email'])?></td>
            <td><?=e($user['role'])?></td>
        </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
