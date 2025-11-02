<!-- Listado de Personas -->
<div class="container mt-4">
    <h2 class="mb-4">Listado de Personas</h2>
    <input class="form-control mb-3" id="buscadorPersona" type="text" placeholder="Buscar persona...">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Nac.</th>
                <th>DNI</th>
                <th>Sexo</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaPersonas">
            <?php if (isset($personas)): ?>
                <?php foreach ($personas as $p): ?>
                    <tr>
                        <td><?= $p['id_persona'] ?></td>
                        <td><?= $p['persona_nombre'] ?></td>
                        <td><?= $p['persona_apellido'] ?></td>
                        <td><?= $p['persona_fecha_nac'] ?></td>
                        <td><?= $p['persona_dni'] ?></td>
                        <td><?= $p['persona_sexo'] ?></td>
                        <td><?= $p['persona_direccion'] ?></td>
                        <td>
                            <a href="?page=persona&action=editar&id=<?= $p['id_persona'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?page=persona&action=eliminar&id=<?= $p['id_persona'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar persona?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="?page=persona&action=nuevo" class="btn btn-primary">Nueva Persona</a>
</div>
<script>
document.getElementById('buscadorPersona').addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll('#tablaPersonas tr');
    filas.forEach(fila => {
        fila.style.display = fila.textContent.toLowerCase().includes(filtro) ? '' : 'none';
    });
});
</script>
