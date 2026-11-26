<section class="card">
    <h1>Mi agenda</h1>
    <p>Sesión iniciada como <strong><?= e($user['name']) ?></strong>.</p>
    <form method="post" action="/logout.php" class="inline-form">
        <button type="submit" class="secondary">Cerrar sesión</button>
    </form>

    <h2>Mis actividades reservadas</h2>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th scope="col">Actividad</th>
                <th scope="col">Área</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
            </tr>
            </thead>
            <tbody>
            <!-- TODO: recorre $bookings. Muestra los datos indicados en el examen,
                 escapa cada valor con e() y gestiona la tabla vacía. -->
            <?php if ($bookings === []): ?>
    <tr>
        <td colspan="4">No tienes reservas.</td>
    </tr>
<?php else: ?>
    <?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?= e($booking['activity']) ?></td>
            <td><?= e($booking['area']) ?></td>
            <td><?= e($booking['date']) ?></td>
            <td><?= e($booking['status']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>

            </tbody>
        </table>
    </div>
</section>
