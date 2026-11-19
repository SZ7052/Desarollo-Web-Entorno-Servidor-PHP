<section class="card narrow">
    <h1>Preferencias</h1>
    <p>La selección se almacena en una cookie del navegador durante 30 días.</p>

    <?php if ($saved): ?>
        <p class="success">Preferencia guardada correctamente.</p>
    <?php endif; ?>

    <?php if ($error !== null): ?>
        <p class="error"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="post" class="stack">
        <input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>">

        <label for="theme">Tema</label>
        <select id="theme" name="theme">
            <option value="light" <?= $currentTheme === 'light' ? 'selected' : '' ?>>Claro</option>
            <option value="dark" <?= $currentTheme === 'dark' ? 'selected' : '' ?>>Oscuro</option>
        </select>

        <button type="submit">Guardar preferencia</button>
    </form>

    <div class="technical-note">
        <strong>Prueba:</strong> modifica manualmente la cookie <code>theme</code>
        desde DevTools. El servidor volverá al valor seguro <code>light</code>.
    </div>
</section>
