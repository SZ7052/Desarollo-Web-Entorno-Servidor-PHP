<section>
    <h1>Tickets</h1>

    <?php if ($tickets === []): ?>
        <p>No hay tickets </p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Película</th>
                    <th>Cine</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Asiento</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?= (int) $ticket['id'] ?></td>
                        <td><?= e($ticket['movie']) ?></td>
                        <td><?= e($ticket['cinema']) ?></td>
                        <td><?= e($ticket['date']) ?></td>
                        <td><?= e($ticket['time']) ?></td>
                        <td><?= e($ticket['seat']) ?></td>
                        <td><?= number_format((float) $ticket['price'], 2, ',', '.') ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>