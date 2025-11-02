
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Formas</h2>
        <a href="index.php?page=forma&action=nuevo" class="btn btn-success">+ Nueva Forma</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorForma" class="form-control" placeholder="Buscar forma...">
    </div>
    <table class="table table-bordered table-striped" id="tablaFormas">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($formas) && count($formas) > 0): ?>
                <?php foreach($formas as $forma): ?>
                    <tr>
                        <td><?= $forma['id_forma'] ?></td>
                        <td><?= $forma['forma_descri'] ?></td>
                        <td>
                            <a href="index.php?page=forma&action=editar&id=<?= $forma['id_forma'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?page=forma&action=eliminar&id=<?= $forma['id_forma'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta forma?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No hay formas cargadas</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorForma').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaFormas tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
