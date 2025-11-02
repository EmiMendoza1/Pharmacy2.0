
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Métodos de Administración</h2>
        <a href="index.php?page=metodo_administracion&action=nuevo" class="btn btn-success">+ Nuevo Método</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorMetodo" class="form-control" placeholder="Buscar método...">
    </div>
    <table class="table table-bordered table-striped" id="tablaMetodos">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($metodos) && count($metodos) > 0): ?>
                <?php foreach($metodos as $metodo): ?>
                    <tr>
                        <td><?= $metodo['id_metodo'] ?></td>
                        <td><?= $metodo['metodo_descri'] ?></td>
                        <td>
                            <a href="index.php?page=metodo_administracion&action=editar&id=<?= $metodo['id_metodo'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?page=metodo_administracion&action=eliminar&id=<?= $metodo['id_metodo'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este método?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No hay métodos cargados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorMetodo').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaMetodos tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
