<section class="card narrow">
    <h1>Preferencias del programa</h1>
    <p>La selección se conservará durante 14 días en este navegador.</p>

    <?php if ($error !== null): ?>
        <p class="message error"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="post" action="/preferences.php" class="stack">
        <label for="area">Área científica</label>
        <select id="area" name="area">
            <option value="all" <?= ($preferences['area'] ?? 'all') === 'all' ? 'selected' : '' ?>>Todas</option>
            <option value="astronomy" <?= ($preferences['area'] ?? '') === 'astronomy' ? 'selected' : '' ?>>Astronomía</option>
            <option value="biology" <?= ($preferences['area'] ?? '') === 'biology' ? 'selected' : '' ?>>Biología</option>
            <option value="robotics" <?= ($preferences['area'] ?? '') === 'robotics' ? 'selected' : '' ?>>Robótica</option>
        </select>

        <label for="duration_band">Duración</label>
        <select id="duration_band" name="duration_band">
            <option value="all" <?= ($preferences['duration_band'] ?? 'all') === 'all' ? 'selected' : '' ?>>Cualquier duración</option>
            <option value="short" <?= ($preferences['duration_band'] ?? '') === 'short' ? 'selected' : '' ?>>Hasta 45 minutos</option>
            <option value="long" <?= ($preferences['duration_band'] ?? '') === 'long' ? 'selected' : '' ?>>Más de 45 minutos</option>
        </select>

        <div class="button-row">
            <button type="submit">Guardar selección</button>
            <button type="submit" name="reset" value="1" class="secondary">Restablecer</button>
        </div>
    </form>
</section>
