<?php
// Listado de Cajas
?>
<div class="container mt-4">
    <h2 class="mb-4">Cajas</h2>
    <a href="index.php?page=caja&action=nuevo" class="btn btn-success mb-3">+ Abrir Caja</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apertura</th>
                <th>Monto Apertura</th>
                <th>Estado</th>
                <th>Monto Cierre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($cajas) && count($cajas) > 0): foreach($cajas as $c): ?>
            <tr>
                <td><?= $c['id_caja'] ?></td>
                <td><?= htmlspecialchars($c['caja_nombre']) ?></td>
                <td><?= $c['apertura_fecha'] ?></td>
                <td><?= number_format($c['apertura_monto'], 2) ?></td>
                <td><?= $c['estado'] ?></td>
                <td>
                    <?php if ($c['estado'] === 'cerrada'): ?>
                        <?= number_format($c['cierre_monto'] ?? 0, 2) ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?page=caja&action=ver&id=<?= $c['id_caja'] ?>" class="btn btn-primary btn-sm">Ver</a>
                    <?php if ($c['estado'] === 'abierta'): ?>
                        <!-- Redirigir a la vista de la caja para ingresar monto de cierre -->
                        <a href="index.php?page=caja&action=ver&id=<?= $c['id_caja'] ?>" class="btn btn-danger btn-sm" style="margin-left:6px;">Cerrar</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="7" class="text-center">No hay cajas registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
