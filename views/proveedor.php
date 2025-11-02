<!-- Listado de Proveedores -->
<div class="container mt-4">
    <h2 class="mb-4">Listado de Proveedores</h2>
    <input class="form-control mb-3" id="buscadorProveedor" type="text" placeholder="Buscar proveedor...">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Estado</th>
                <th>Dirección</th>
                <th>Empresa</th>
                <th>Persona Relacionada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaProveedores">
            <?php if (isset($proveedores)): ?>
                <?php foreach ($proveedores as $p): ?>
                    <tr>
                        <td><?= $p['id_proveedor'] ?></td>
                        <td><?= $p['prov_estado'] ?></td>
                        <td><?= $p['prov_direccion'] ?></td>
                        <td><?= $p['prov_nombre_empresa'] ?></td>
                        <td><?= htmlspecialchars($p['persona_nombre'] ?? $p['rela_persona']) ?></td>
                        <td>
                            <a href="?page=proveedores&action=editar&id=<?= $p['id_proveedor'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?page=proveedores&action=eliminar&id=<?= $p['id_proveedor'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar proveedor?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="?page=proveedores&action=nuevo" class="btn btn-primary">Nuevo Proveedor</a>
</div>
<script>
document.getElementById('buscadorProveedor').addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll('#tablaProveedores tr');
    filas.forEach(fila => {
        fila.style.display = fila.textContent.toLowerCase().includes(filtro) ? '' : 'none';
    });
});
</script>
