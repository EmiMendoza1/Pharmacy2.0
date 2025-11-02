<!-- Formulario de Medio de Pago -->
<div class="container mt-4">
    <h2><?= isset($medio) ? 'Editar' : 'Nuevo' ?> Medio de Pago</h2>
    <form method="post" action="<?= isset($medio) ? 'index.php?page=mediopago&action=actualizar&id=' . $medio['id_mediopago'] : 'index.php?page=mediopago&action=guardar' ?>" style="width:100%; max-width:500px; margin:auto; background:#fff; border-radius:18px; box-shadow:0 2px 12px rgba(1,85,46,0.08); padding:24px 18px;">
        <div class="mb-3">
            <label for="mediopago_tipo" class="form-label">Tipo de Medio de Pago</label>
            <input type="text" class="form-control" id="mediopago_tipo" name="mediopago_tipo" required value="<?= isset($medio) ? htmlspecialchars($medio['mediopago_tipo']) : '' ?>">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="?page=mediopago" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
