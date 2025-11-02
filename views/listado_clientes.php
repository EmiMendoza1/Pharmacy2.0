
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Clientes</h2>
        <a href="index.php?page=signup_cliente" class="btn btn-success">+ Nuevo cliente</a>
    </div>
    <div class="mb-3">
        <input type="text" id="buscadorCliente" class="form-control" placeholder="Buscar cliente...">
    </div>
    <table class="table table-bordered table-striped" id="tablaClientes">
        <thead class="table-dark">
            <tr>
                <th>ID Cliente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Alta</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($clientes)) { ?>
            <tr>
                <td><?= $row['id_cliente'] ?></td>
                <td><?= $row['persona_nombre'] ?></td>
                <td><?= $row['persona_apellido'] ?></td>
                <td><?= $row['cliente_fecha_alta'] ?></td>
                <td><?= $row['cliente_estado'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('buscadorCliente').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tablaClientes tbody tr');
    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});
</script>
