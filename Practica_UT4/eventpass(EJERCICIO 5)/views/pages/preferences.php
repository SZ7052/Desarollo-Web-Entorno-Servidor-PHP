<section class="card narrow">
    <h1>Preferencias</h1>

    <?php if ($saved): ?>
        <p class="success">Preferencia guardada correctamente.</p>
    <?php endif; ?>

    <?php if ($reset): ?>
        <p class="success">Preferencias restablecidas.</p>
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

        <label for="size">Tamaño de interfaz</label>
        <select id="size" name="size">
            <option value="normal" <?= $currentSize === 'normal' ? 'selected' : '' ?>>Normal</option>
            <option value="compact" <?= $currentSize === 'compact' ? 'selected' : '' ?>>Compacto</option>
        </select>

        <button type="submit">Guardar preferencia</button>
        <button type="submit" name="reset" value="1">Restablecer preferencias</button>
    </form>
</section>