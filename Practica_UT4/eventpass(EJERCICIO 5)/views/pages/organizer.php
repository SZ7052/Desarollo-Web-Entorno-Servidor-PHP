<section class="hero">
    <p class="eyebrow">Zona autorizada: Organizer</p>
    <h1>Panel de Organizer</h1>
    <p>
        Acceso concedido a <?= e($user['name']) ?> 
    </p>
</section>

<section class="card">
    <h2>Usuarios de desarrollo</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allUsers as $listedUser): ?>
            <tr>
                <td><?= (int) $listedUser['id'] ?></td>
                <td><?= e($listedUser['name']) ?></td>
                <td><?= e($listedUser['email']) ?></td>
                <td><?= e($listedUser['role']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</section>
