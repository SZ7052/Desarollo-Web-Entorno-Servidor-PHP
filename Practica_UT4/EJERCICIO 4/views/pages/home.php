<section >

    <h1>Bienvenido al Ejercicio 4</h1>

</section>

<section >

    <article >
        <h2>Estado de autenticación</h2>
        <?php if ($user === null): ?>
            <p>No hay ningún usuario autenticado.</p>
            <a class="button" href="login.php">Iniciar sesión</a>
        <?php else: ?>
            <p>
                Sesión iniciada como <strong><?= e($user['name']) ?></strong>
                (rol: <?= e($user['role']) ?>).
            </p>

        <?php endif; ?>
    </article>
</section>


