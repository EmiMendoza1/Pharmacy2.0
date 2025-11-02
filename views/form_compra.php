<?php
// Formulario de Compra - nuevo/editar
$isEdit = isset($compra) && $compra;
?>
<div class="form-producto-container">
    <h2><?= $isEdit ? 'Editar Compra' : 'Nueva Compra' ?></h2>
    <form method="post" action="index.php?page=compra&action=<?= $isEdit ? 'actualizar&id='.$compra['id_compra'] : 'guardar' ?>">
        <div class="mb-3">
            <label>Fecha</label>
                <input type="date" name="compra_fecha" class="form-control" value="<?= $isEdit ? date('Y-m-d', strtotime($compra['compra_fecha'])) : date('Y-m-d') ?>">
        </div>
        <div class="mb-3">
            <label>Total</label>
            <input type="number" name="compra_total" class="form-control" value="<?= $isEdit ? $compra['compra_total'] : '' ?>">
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="compra_estado" class="form-control">
                <?php $estados = ['pendiente','pagada','anulada'];
                foreach($estados as $e): ?>
                <option value="<?= $e ?>" <?= $isEdit && $compra['compra_estado'] == $e ? 'selected' : '' ?>><?= ucfirst($e) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="rela_proveedor">Proveedor</label>
            <select name="rela_proveedor" id="rela_proveedor" class="form-control">
                <option value="">Seleccione...</option>
                <?php if (isset($proveedores) && is_array($proveedores) && count($proveedores) > 0):
                    foreach($proveedores as $p): ?>
                        <option value="<?= $p['id_proveedor'] ?>" <?= $isEdit && $compra['rela_proveedor'] == $p['id_proveedor'] ? 'selected' : '' ?>><?= htmlspecialchars($p['prov_nombre_empresa']) ?></option>
                    <?php endforeach;
                endif; ?>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit"><?= $isEdit ? 'Actualizar' : 'Guardar' ?></button>
            <a href="?page=compra" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
        </div>
