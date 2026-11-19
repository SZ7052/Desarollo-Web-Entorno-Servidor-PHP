<section class="card narrow">
    <h1>Iniciar sesión</h1>

    <?php if ($expired): ?>
        <p class="warning">La sesión ha expirado por inactividad.</p>
    <?php endif; ?>

    <?php if ($error !== null): ?>
        <p class="error"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="post" class="stack">
        <input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>">

        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= e($email) ?>"
            autocomplete="username"
            required
        >

        <label for="password">Contraseña</label>
        <input
            type="password"
            id="password"
            name="password"
            autocomplete="current-password"
            required
        >

        <button type="submit">Entrar</button>
    </form>

    <details class="technical-note">
        <summary>Credenciales de desarrollo</summary>
        <p><code>ada@meeple.local</code> / <code>Admin123!</code></p>
        <p><code>linus@meeple.local</code> / <code>User123!</code></p>
    </details>
</section>

