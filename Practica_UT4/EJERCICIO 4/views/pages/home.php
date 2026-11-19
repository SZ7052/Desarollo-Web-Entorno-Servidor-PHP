<section class="hero">
    <p class="eyebrow">Proyecto incremental UT4</p>
    <h1>Bienvenido a MeepleClub</h1>
    <p>
        Este proyecto muestra un flujo completo de estado, cookies, sesiones,
        autenticación, autorización, CSRF y depuración en PHP.
    </p>
</section>

<section class="grid">
    <article class="card">
        <h2>Preferencias cliente</h2>
        <p>
            El tema actual es <strong><?= e(validatedTheme()) ?></strong> y se
            mantiene mediante una cookie validada en servidor.
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

<section class="card">
    <h2>Arquitectura del proyecto</h2>
    <p>
        El navegador solo accede directamente a <code>public/</code>. La lógica,
        configuración, vistas y datos quedan fuera del document root.
    </p>
</section>

<section class="card">
    <h2>Qué observar en DevTools</h2>
    <ul>
        <li>La respuesta <code>Set-Cookie</code> al guardar una preferencia.</li>
        <li>La cookie <code>PHPSESSID</code> utilizada por la sesión.</li>
        <li>Los atributos <code>HttpOnly</code> y <code>SameSite</code>.</li>
        <li>Las redirecciones <code>302</code> tras formularios correctos.</li>
        <li>El <code>403</code> cuando un usuario normal intenta abrir Admin.</li>
    </ul>
</section>
