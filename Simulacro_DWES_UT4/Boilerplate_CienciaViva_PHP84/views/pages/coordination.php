<section class="card">
    <h1>Panel de coordinación</h1>
    <p>Esta página debe estar protegida en el servidor para el rol coordinator.</p>
    <form method="post" action="/logout.php" class="inline-form">
        <button type="submit" class="secondary">Cerrar sesión</button>
    </form>

    <h2>Todas las reservas</h2>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th scope="col">Participante</th>
                <th scope="col">Actividad</th>
                <th scope="col">Área</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
            </tr>
            </thead>
            <tbody>
            <!-- TODO: recorre $bookings y crea las filas escapando cada dato.
                 Incluye una fila explicativa si el array está vacío. -->
            <?php if ($bookings === []): ?>
    <tr>
        <td colspan="5">No hay reservas.</td>
    </tr>
<?php else: ?>
    <?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?= e($booking['participant']) ?></td>
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
