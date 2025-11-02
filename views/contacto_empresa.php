<!-- Listado de Contactos Empresa -->
<div class="container mt-4">
    <h2 class="mb-4">Listado de Contactos Empresa</h2>
    <input class="form-control mb-3" id="buscadorContactoEmpresa" type="text" placeholder="Buscar contacto...">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Valor</th>
                <th>Tipo Contacto</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaContactosEmpresa">
            <?php if (isset($contactos)): ?>
                <?php foreach ($contactos as $c): ?>
                    <tr>
                        <td><?= $c['id_contacto'] ?></td>
                        <td><?= $c['contacto_valor'] ?></td>
                        <td><?= htmlspecialchars($c['tipo_contacto_nombre'] ?? $c['rela_tipo_contacto']) ?></td>
                        <td><?= htmlspecialchars($c['prov_nombre_empresa'] ?? $c['rela_proveedor']) ?></td>
                        <td>
                            <a href="?page=contacto_empresa&action=editar&id=<?= $c['id_contacto'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?page=contacto_empresa&action=eliminar&id=<?= $c['id_contacto'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar contacto?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="?page=contacto_empresa&action=nuevo" class="btn btn-primary">Nuevo Contacto Empresa</a>
</div>
<script>
document.getElementById('buscadorContactoEmpresa').addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll('#tablaContactosEmpresa tr');
    filas.forEach(fila => {
        fila.style.display = fila.textContent.toLowerCase().includes(filtro) ? '' : 'none';
    });
});
</script>
