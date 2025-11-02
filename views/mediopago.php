<!-- Listado de Medios de Pago -->
<div class="container mt-4">
    <h2>Medios de Pago</h2>
    <a href="?page=mediopago&action=nuevo" class="btn btn-primary mb-3">Nuevo Medio de Pago</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($medios && $medios->num_rows > 0): ?>
                <?php while($m = $medios->fetch_assoc()): ?>
                    <tr>
                        <td><?= $m['id_mediopago'] ?></td>
                        <td><?= htmlspecialchars($m['mediopago_tipo']) ?></td>
                        <td>
                            <a href="?page=mediopago&action=editar&id=<?= $m['id_mediopago'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="?page=mediopago&action=eliminar&id=<?= $m['id_mediopago'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar medio de pago?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3">No hay medios de pago registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
