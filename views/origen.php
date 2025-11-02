
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Orígenes</h2>
        <a href="index.php?page=origen&action=nuevo" class="btn btn-success">+ Nuevo Origen</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorOrigen" class="form-control" placeholder="Buscar origen...">
    </div>
    <table class="table table-bordered table-striped" id="tablaOrigenes">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if($origenes && $origenes->num_rows > 0): ?>
                <?php while($row = $origenes->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_origen']; ?></td>
                    <td><?php echo $row['origen_descri']; ?></td>
                    <td>
                        <a href="index.php?page=origen&action=editar&id=<?php echo $row['id_origen']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="index.php?page=origen&action=eliminar&id=<?php echo $row['id_origen']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este origen?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No hay orígenes cargados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorOrigen').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaOrigenes tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
