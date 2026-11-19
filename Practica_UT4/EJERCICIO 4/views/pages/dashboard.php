<section class="hero">
    <p class="eyebrow">Zona autenticada</p>
    <h1>Hola, <?= e($user['name']) ?></h1>
    <p>
        El servidor ha recuperado tu identidad desde <code>$_SESSION</code>.
        Tu rol actual es <strong><?= e($user['role']) ?></strong>.
    </p>
</section>

<section class="grid">
    <article class="card">
        <h2>Datos de sesión utilizados</h2>
        <ul>
            <li>ID de usuario: <?= (int) $user['id'] ?></li>
            <li>Email: <?= e($user['email']) ?></li>
            <li>Rol: <?= e($user['role']) ?></li>
        </ul>
        <p>La contraseña y su hash no se almacenan en la sesión.</p>
    </article>

    <article class="card">
        <h2>Autorización</h2>
        <?php if (hasRole('admin')): ?>
            <p>Tu rol permite acceder al panel de administración.</p>
            <a class="button" href="admin.php">Abrir administración</a>
        <?php else: ?>
            <p>Tu usuario no tiene privilegios de administración.</p>
            <p>Prueba a escribir manualmente <code>/admin.php</code>.</p>
        <?php endif; ?>
    </article>
</section>

<section class="card narrow">
    <h2>Cerrar sesión</h2>
    <form action="logout.php" method="post">
        <input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>">
        <button type="submit" class="danger">Cerrar sesión</button>
    </form>
</section>

