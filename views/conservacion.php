<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Conservación</h2>
        <a href="index.php?page=conservacion&action=nuevo" class="btn btn-success">+ Nueva Conservación</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorConservacion" class="form-control" placeholder="Buscar conservación...">
    </div>
    <table class="table table-bordered table-striped" id="tablaConservacion">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $conservaciones->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_conservacion'] ?></td>
                <td><?= htmlspecialchars($row['conservacion_descri']) ?></td>
                <td>
                    <a href="index.php?page=conservacion&action=editar&id=<?= $row['id_conservacion'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="index.php?page=conservacion&action=eliminar&id=<?= $row['id_conservacion'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este registro?');">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorConservacion').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaConservacion tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
