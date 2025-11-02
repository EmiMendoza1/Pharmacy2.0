
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Productos</h2>
        <a href="index.php?page=producto&action=nuevo" class="btn btn-success">+ Nuevo producto</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorProducto" class="form-control" placeholder="Buscar producto...">
    </div>
    <table class="table table-bordered table-striped" id="tablaProductos">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Código Barra</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($resultado) && $resultado->num_rows > 0): ?>
                <?php while($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_producto'] ?></td>
                        <td><?= $row['producto_nombre'] ?></td>
                        <td><?= $row['producto_codigobarra'] ?></td>
                        <td>$<?= number_format($row['producto_preciounitario'], 2, ',', '.') ?></td>
                        <td><?= $row['producto_cantidad'] ?></td>
                        <td><?= $row['producto_estado'] ?></td>
                        <td>
                            <a href="index.php?page=producto&action=editar&id=<?= $row['id_producto'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?page=producto&action=eliminar&id=<?= $row['id_producto'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No hay productos cargados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorProducto').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaProductos tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>