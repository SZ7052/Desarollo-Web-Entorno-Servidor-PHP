<section >

    <h1>Ejercicio 5</h1>

</section>

<section class="grid">
    <article class="card">
        <h2>Preferencias </h2>
        <p>
            El tema actual es <strong><?= e(validatedTheme()) ?></strong>
        </p>
        <a class="button" href="preferences.php">Cambiar preferencia</a>
    </article>

    <article class="card">
        <h2>Estado de autenticación</h2>
        <?php if ($user === null): ?>
            <p>No hay ningún usuario autenticado.</p>
            <a class="button" href="login.php">Iniciar sesión</a>
        <?php else: ?>
            <p>
                Sesión iniciada como <strong><?= e($user['name']) ?></strong>
                (rol: <?= e($user['role']) ?>).
            </p>
            <a class="button" href="dashboard.php">Abrir dashboard</a>
        <?php endif; ?>
    </article>
</section>




