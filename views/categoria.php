
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Categorías</h2>
        <a href="index.php?page=categoria&action=nuevo" class="btn btn-success">+ Nueva Categoría</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorCategoria" class="form-control" placeholder="Buscar categoría...">
    </div>
    <table class="table table-bordered table-striped" id="tablaCategorias">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($categorias) && count($categorias) > 0): ?>
                <?php foreach($categorias as $categoria): ?>
                    <tr>
                        <td><?= $categoria['id_categoria'] ?></td>
                        <td><?= $categoria['categoria_descri'] ?></td>
                        <td>
                            <a href="index.php?page=categoria&action=editar&id=<?= $categoria['id_categoria'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?page=categoria&action=eliminar&id=<?= $categoria['id_categoria'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No hay categorías cargadas</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorCategoria').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaCategorias tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
