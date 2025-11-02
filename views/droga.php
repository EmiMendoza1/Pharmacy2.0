<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Drogas</h2>
        <a href="index.php?page=droga&action=nuevo" class="btn btn-success">+ Nueva Droga</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorDroga" class="form-control" placeholder="Buscar droga...">
    </div>
    <table class="table table-bordered table-striped" id="tablaDrogas">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($drogas) && count($drogas) > 0): ?>
                <?php foreach($drogas as $droga): ?>
                    <tr>
                        <td><?= $droga['droga_descri'] ?></td>
                        <td>
                            <a href="index.php?page=droga&action=editar&id=<?= $droga['id_droga'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?page=droga&action=eliminar&id=<?= $droga['id_droga'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta droga?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center">No hay drogas cargadas</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorDroga').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaDrogas tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
                        </div>
                        <div class="col">
                            <h3 style="color: #01552e; text-decoration: underline; font-weight:bolder; font-family: cambria, serif; text-shadow: 1px 1px 2px #e6ffe6;">Agregar Droga</h3>
                            <form id="form-nueva-droga" action="javascript:void(0);" style="background-color: #e6ffe6; color: #01552e; border-radius: 10px; padding: 15px;">
                                <div class="mb-3">
                                    <label for="nombre_droga" class="form-label">Nombre de droga</label>
                                    <input type="text" name="nombre_droga" class="form-control" id="nombre_droga" required>
                                </div>
                                <button type="submit" class="btn" style="background-color: #01552e; color: #fff; font-weight: bold;">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="assets/js/tablas_maestras.js"></script>
<script src="assets/js/tablas_maestras/droga.js"></script>
</body>
</html>
