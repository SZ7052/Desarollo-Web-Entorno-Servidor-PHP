<section class="hero">
    <p class="eyebrow">Zona autorizada: admin</p>
    <h1>Administración</h1>
    <p>
        Acceso concedido a <?= e($user['name']) ?> porque el servidor ha
        comprobado el rol almacenado en la sesión.
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
    <p class="technical-note">
        El <code>password_hash</code> no se imprime. Mostrarlo no aporta nada a
        la interfaz y expondría información innecesaria.
    </p>
</section>
