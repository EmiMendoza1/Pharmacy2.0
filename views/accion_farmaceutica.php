
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Acciones Farmacéuticas</h2>
        <a href="index.php?page=accion_farmaceutica&action=nuevo" class="btn btn-success">+ Nueva Acción</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorAccion" class="form-control" placeholder="Buscar acción...">
    </div>
    <table class="table table-bordered table-striped" id="tablaAcciones">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($acciones) && $acciones->num_rows > 0): ?>
                <?php while($accion = $acciones->fetch_assoc()): ?>
                    <tr>
                        <td><?= $accion['id_accion_farmaceutica'] ?></td>
                        <td><?= $accion['accion_farmaceutica_descri'] ?></td>
                        <td>
                            <a href="index.php?page=accion_farmaceutica&action=editar&id=<?= $accion['id_accion_farmaceutica'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?page=accion_farmaceutica&action=eliminar&id=<?= $accion['id_accion_farmaceutica'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta acción?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No hay acciones cargadas</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorAccion').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaAcciones tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
