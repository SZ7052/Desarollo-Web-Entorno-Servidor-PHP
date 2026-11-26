<section>
    <h1>Programa científico</h1>
    <p>Filtros: <?= e($preferences['area']) ?> · <?= e($preferences['duration_band']) ?></p>
    <p><a href="/preferences.php">Cambiar preferencias</a></p>

    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th scope="col">Actividad</th>
                <th scope="col">Área</th>
                <th scope="col">Formato</th>
                <th scope="col">Duración (min)</th>
                <th scope="col">Estado</th>
            </tr>
            </thead>
            <tbody>
            <!-- TODO: recorre $activities con foreach, escapa sus valores con e()
                 y crea una fila vacía explicativa con colspan=5. -->

                <?php if ($activities === []): ?>
    <tr>
        <td colspan="5">No hay actividades que coincidan con los filtros.</td>
    </tr>
<?php else: ?>
    <?php foreach ($activities as $activity): ?>
        <tr>
            <td><?= e($activity['title']) ?></td>
            <td><?= e($activity['area']) ?></td>
            <td><?= e($activity['format']) ?></td>
            <td><?= e($activity['duration_minutes']) ?></td>
            <td><?= e($activity['status']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
