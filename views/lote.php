<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lotes</h2>
        <a href="index.php?page=lote&action=nuevo" class="btn btn-success">+ Nuevo Lote</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorLote" class="form-control" placeholder="Buscar lote, producto o código...">
    </div>
    <table class="table table-bordered table-striped" id="tablaLotes">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Código</th>
                <th>Vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $lotes->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_lote'] ?></td>
                <td><?= htmlspecialchars($row['producto_nombre']) ?></td>
                <td><?= $row['cantidadxlote'] ?></td>
                <td><?= htmlspecialchars($row['lote_codigo']) ?></td>
                <td><?= $row['lote_vencimiento'] ?></td>
                <td>
                    <a href="index.php?page=lote&action=editar&id=<?= $row['id_lote'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="index.php?page=lote&action=eliminar&id=<?= $row['id_lote'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este lote?');">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorLote').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaLotes tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
