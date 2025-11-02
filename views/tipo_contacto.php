
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Tipos de Contacto</h2>
        <a href="index.php?page=tipo_contacto&action=nuevo" class="btn btn-success">+ Nuevo Tipo de Contacto</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorTipoContacto" class="form-control" placeholder="Buscar tipo de contacto...">
    </div>
    <table class="table table-bordered table-striped" id="tablaTipoContacto">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if($tipos && $tipos->num_rows > 0): ?>
                <?php while($row = $tipos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_tipo_contacto']; ?></td>
                    <td><?php echo $row['tipo_contacto_nombre']; ?></td>
                    <td>
                        <a href="index.php?page=tipo_contacto&action=editar&id=<?php echo $row['id_tipo_contacto']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="index.php?page=tipo_contacto&action=eliminar&id=<?php echo $row['id_tipo_contacto']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este tipo de contacto?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No hay tipos de contacto cargados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorTipoContacto').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaTipoContacto tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
