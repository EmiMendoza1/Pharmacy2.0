<?php
// Listado de usuarios
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Usuarios</h2>
        <a href="index.php?page=usuario&action=nuevo" class="btn btn-success">+ Nuevo usuario</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorUsuario" class="form-control" placeholder="Buscar usuario, persona o rol...">
    </div>
    <table class="table table-bordered table-striped" id="tablaUsuarios">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Persona</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $usuarios->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_usuario'] ?></td>
                <td><?= htmlspecialchars($row['nombre_usuario']) ?></td>
                <td><?= htmlspecialchars($row['persona_nombre'] . ' ' . $row['persona_apellido']) ?></td>
                <td><?= htmlspecialchars($row['nombre_rol']) ?></td>
                <td>
                    <a href="index.php?page=usuario&action=editar&id=<?= $row['id_usuario'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="index.php?page=usuario&action=eliminar&id=<?= $row['id_usuario'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorUsuario').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaUsuarios tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
