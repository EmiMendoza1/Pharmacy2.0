<div class="container mt-4">
    <div style="max-width: 520px; margin: 0 auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(1,85,46,0.08); padding: 32px 24px;">
        <h2 class="mb-3" style="color: #01552e; font-weight: bold; text-align: center; text-shadow: 1px 1px 2px #e6ffe6;">
            <?= isset($conservacion) ? 'Editar conservación' : 'Registrar conservación' ?>
        </h2>
        <form method="post" action="index.php?page=conservacion&action=<?= isset($conservacion) ? 'actualizar' : 'guardar' ?>">
            <?php if(isset($conservacion)): ?>
                <input type="hidden" name="id_conservacion" value="<?= $conservacion['id_conservacion'] ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="conservacion_descri" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="conservacion_descri" name="conservacion_descri" required maxlength="50" value="<?= isset($conservacion) ? htmlspecialchars($conservacion['conservacion_descri']) : '' ?>">
            </div>
            <button type="submit" class="btn" style="background-color: #01552e; color: #fff; font-weight: bold;">Guardar</button>
            <a href="index.php?page=conservacion" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
