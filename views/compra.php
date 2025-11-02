<?php
// Listado de Compras
?>
<div class="table-responsive">
    <h2 class="mb-4">Listado de Compras</h2>
    <a href="index.php?page=compra&action=nuevo" class="btn btn-success mb-3">+ Nueva Compra</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($compras && $compras->num_rows > 0):
                while($compra = $compras->fetch_assoc()): ?>
                <tr>
                    <td><?= $compra['id_compra'] ?></td>
                    <td><?= $compra['compra_fecha'] ?></td>
                    <td><?= $compra['compra_total'] ?></td>
                    <td><?= $compra['compra_estado'] ?></td>
                    <td><?= $compra['rela_proveedor'] ?></td>
                    <td>
                        <a href="?page=compra&action=editar&id=<?= $compra['id_compra'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="?page=compra&action=eliminar&id=<?= $compra['id_compra'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta compra?')">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile;
            else: ?>
                <tr><td colspan="6" class="text-center">No hay compras registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

