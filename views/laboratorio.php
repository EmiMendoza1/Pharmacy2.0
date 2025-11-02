
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Laboratorios</h2>
        <a href="index.php?page=laboratorio&action=nuevo" class="btn btn-success">+ Nuevo Laboratorio</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorLaboratorio" class="form-control" placeholder="Buscar laboratorio...">
    </div>
    <table class="table table-bordered table-striped" id="tablaLaboratorios">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if($laboratorios && $laboratorios->num_rows > 0): ?>
                <?php while($row = $laboratorios->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_laboratorio']; ?></td>
                    <td><?php echo $row['laboratorio_descri']; ?></td>
                    <td>
                        <a href="index.php?page=laboratorio&action=editar&id=<?php echo $row['id_laboratorio']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="index.php?page=laboratorio&action=eliminar&id=<?php echo $row['id_laboratorio']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este laboratorio?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No hay laboratorios cargados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorLaboratorio').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaLaboratorios tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
