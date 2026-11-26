<section class="card narrow">
    <h1>Acceso a CienciaViva</h1>

    <?php if ($expired): ?>
        <p class="message">La sesión ha terminado por inactividad. Vuelve a identificarte.</p>
    <?php endif; ?>

    <?php if ($error !== null): ?>
        <p class="message error"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="post" action="/login.php" class="stack">
        <label for="email">Correo electrónico</label>
        <input id="email" name="email" type="email" value="<?= e($email) ?>" required>

        <label for="password">Contraseña</label>
        <input id="password" name="password" type="password" required>

        <button type="submit">Iniciar sesión</button>
    </form>

    <p>Las cuentas de prueba aparecen en el README.</p>
</section>
