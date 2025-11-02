<!-- Listado de Ventas -->
<div class="container mt-4">
    <h2 class="mb-4">Listado de Ventas</h2>
    <input class="form-control mb-3" id="buscadorVenta" type="text" placeholder="Buscar venta...">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaVentas">
            <?php
            require_once 'controllers/venta.controlador.php';
            $ventas = VentaControlador::listar();
            if ($ventas && $ventas->num_rows > 0):
                while($venta = $ventas->fetch_assoc()): ?>
                    <tr>
                        <td><?= $venta['id'] ?></td>
                        <td><?= $venta['fecha'] ?></td>
                        <td><?= htmlspecialchars($venta['persona_nombre'] . ' ' . $venta['persona_apellido']) ?></td>
                        <td>$<?= number_format($venta['total'], 2) ?></td>
                        <td>
                            <a href="?page=venta&action=editar&id=<?= $venta['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="?page=venta&action=eliminar&id=<?= $venta['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta venta?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile;
            else: ?>
                <tr><td colspan="5" class="text-center">No hay ventas registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="?page=form_venta" class="btn btn-primary">Nueva Venta</a>
</div>
<script src="assets/js/tablas_maestras.js"></script>
<script>
    document.getElementById('buscadorVenta').addEventListener('keyup', function() {
        let filtro = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaVentas tr');
        filas.forEach(fila => {
            fila.style.display = fila.textContent.toLowerCase().includes(filtro) ? '' : 'none';
        });
    });
</script>
