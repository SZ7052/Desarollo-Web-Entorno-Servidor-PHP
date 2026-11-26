<section class="hero">
    <h1>Hola, <?= e($user['name']) ?></h1>
    <p>
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
    </article>

    <article class="card">
        <h2>Autorización</h2>
        <?php if (hasRole('organizer')): ?>
            <p>Tu rol permite acceder al panel de administración.</p>
            <a class="button" href="organizer.php">Abrir administración</a>
        <?php else: ?>
            <p>Tu usuario no tiene privilegios de administración.</p>
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
