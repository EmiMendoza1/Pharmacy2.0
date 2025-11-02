<div class="container mt-4">
    <div style="max-width: 520px; margin: 0 auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(1,85,46,0.08); padding: 32px 24px;">
        <h2 class="mb-3" style="color: #01552e; font-weight: bold; text-align: center; text-shadow: 1px 1px 2px #e6ffe6;">
            <?= isset($lote) ? 'Editar lote' : 'Registrar lote' ?>
        </h2>
        <form method="post" action="index.php?page=lote&action=<?= isset($lote) ? 'actualizar' : 'guardar' ?>">
            <?php if(isset($lote)): ?>
                <input type="hidden" name="id_lote" value="<?= $lote['id_lote'] ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="rela_producto" class="form-label">Producto</label>
                <select class="form-select" id="rela_producto" name="rela_producto" required>
                    <option value="">Seleccione...</option>
                    <?php while($p = $productos->fetch_assoc()): ?>
                        <option value="<?= $p['id_producto'] ?>" <?= (isset($lote) && $lote['rela_producto'] == $p['id_producto']) ? 'selected' : '' ?>><?= htmlspecialchars($p['producto_nombre']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidadxlote" class="form-label">Cantidad por lote</label>
                <input type="number" class="form-control" id="cantidadxlote" name="cantidadxlote" required min="1" value="<?= isset($lote) ? $lote['cantidadxlote'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="lote_codigo" class="form-label">Código de lote</label>
                <input type="text" class="form-control" id="lote_codigo" name="lote_codigo" required maxlength="100" value="<?= isset($lote) ? htmlspecialchars($lote['lote_codigo']) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="lote_vencimiento" class="form-label">Vencimiento</label>
                <input type="date" class="form-control" id="lote_vencimiento" name="lote_vencimiento" required value="<?= isset($lote) ? $lote['lote_vencimiento'] : '' ?>">
            </div>
            <button type="submit" class="btn" style="background-color: #01552e; color: #fff; font-weight: bold;">Guardar</button>
            <a href="index.php?page=lote" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
