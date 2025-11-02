
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Marcas</h2>
        <a href="index.php?page=marca&action=nuevo" class="btn btn-success">+ Nueva Marca</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorMarca" class="form-control" placeholder="Buscar marca...">
    </div>
    <table class="table table-bordered table-striped" id="tablaMarcas">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($marcas) && count($marcas) > 0): ?>
                <?php foreach($marcas as $marca): ?>
                    <tr>
                        <td><?= $marca['id_marca'] ?></td>
                        <td><?= $marca['marca_descri'] ?></td>
                        <td>
                            <a href="index.php?page=marca&action=editar&id=<?= $marca['id_marca'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?page=marca&action=eliminar&id=<?= $marca['id_marca'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta marca?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No hay marcas cargadas</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorMarca').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaMarcas tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
