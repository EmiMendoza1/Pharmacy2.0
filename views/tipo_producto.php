
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Tipos de Producto</h2>
        <a href="index.php?page=tipo_producto&action=nuevo" class="btn btn-success">+ Nuevo Tipo de Producto</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorTipoProducto" class="form-control" placeholder="Buscar tipo de producto...">
    </div>
    <table class="table table-bordered table-striped" id="tablaTipoProducto">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if($tipos && $tipos->num_rows > 0): ?>
                <?php while($row = $tipos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_tipo_producto']; ?></td>
                    <td><?php echo $row['tipo_producto_descri']; ?></td>
                    <td>
                        <a href="index.php?page=tipo_producto&action=editar&id=<?php echo $row['id_tipo_producto']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="index.php?page=tipo_producto&action=eliminar&id=<?php echo $row['id_tipo_producto']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este tipo de producto?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No hay tipos de producto cargados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorTipoProducto').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaTipoProducto tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
