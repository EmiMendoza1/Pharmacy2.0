<!-- Formulario de Contacto Empresa -->
<div class="container mt-4">
    <h2 class="mb-4"><?= isset($data) ? 'Editar' : 'Nuevo' ?> Contacto Empresa</h2>
    <form method="post" action="?page=contacto_empresa&action=<?= isset($data) ? 'actualizar' : 'guardar' ?>">
        <?php if (isset($data)): ?>
            <input type="hidden" name="id_contacto" value="<?= $data['id_contacto'] ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="contacto_valor" class="form-label">Valor</label>
            <input type="text" class="form-control" id="contacto_valor" name="contacto_valor" value="<?= $data['contacto_valor'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="rela_tipo_contacto" class="form-label">Tipo de Contacto</label>
            <?php
                require_once 'models/tipo_contacto.php';
                $tipos = TipoContacto::listar();
            ?>
            <select class="form-control" id="rela_tipo_contacto" name="rela_tipo_contacto" required style="width:100%">
                <option value="">Selecciona un tipo...</option>
                <?php while ($t = $tipos->fetch_assoc()): ?>
                    <option value="<?= $t['id_tipo_contacto'] ?>" <?= (isset($data) && $data['rela_tipo_contacto'] == $t['id_tipo_contacto']) ? 'selected' : '' ?>><?= htmlspecialchars($t['tipo_contacto_nombre']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="rela_proveedor" class="form-label">Proveedor</label>
            <?php
                require_once 'models/proveedor.php';
                $proveedores = Proveedor::listar();
                $selectedId = isset($data) ? ($data['rela_proveedor'] ?? '') : '';
            ?>
            <select class="form-control" id="rela_proveedor" name="rela_proveedor" required style="width:100%">
                <option value="">Selecciona un proveedor...</option>
                <?php while ($p = $proveedores->fetch_assoc()): ?>
                    <option value="<?= $p['id_proveedor'] ?>" <?= ($selectedId == $p['id_proveedor']) ? 'selected' : '' ?>><?= htmlspecialchars($p['prov_nombre_empresa']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="?page=contacto_empresa" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script>
$(document).ready(function() {
    $('#rela_tipo_contacto').select2({
        width: '100%',
        placeholder: 'Buscar tipo de contacto...'
    });
    // Inicializar Select2 para proveedor (renderizado en servidor)
    $('#rela_proveedor').select2({ width: '100%', placeholder: 'Buscar proveedor...' });
});
</script>
