<!-- Formulario de Proveedor -->
<div class="container mt-4">
    <h2 class="mb-4"><?= isset($data) ? 'Editar' : 'Nuevo' ?> Proveedor</h2>
    <form method="post" action="index.php?page=proveedores&action=guardar" style="width:100%; max-width:500px; margin:auto; background:#fff; border-radius:18px; box-shadow:0 2px 12px rgba(1,85,46,0.08); padding:24px 18px;">
        <?php if (isset($data)): ?>
            <input type="hidden" name="id_proveedor" value="<?= $data['id_proveedor'] ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="prov_estado" class="form-label">Estado</label>
            <select class="form-control" id="prov_estado" name="prov_estado" required>
                <option value="activo" <?= (isset($data) && $data['prov_estado'] == 'activo') ? 'selected' : '' ?>>Activo</option>
                <option value="inactivo" <?= (isset($data) && $data['prov_estado'] == 'inactivo') ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="prov_direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="prov_direccion" name="prov_direccion" value="<?= $data['prov_direccion'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="prov_nombre_empresa" class="form-label">Empresa</label>
            <input type="text" class="form-control" id="prov_nombre_empresa" name="prov_nombre_empresa" value="<?= htmlspecialchars($data['prov_nombre_empresa'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="rela_persona" class="form-label">Persona Relacionada</label>
            <?php
                require_once 'models/persona.php';
                $personas = Persona::obtenerPersonas();
                $selectedId = isset($data) ? ($data['rela_persona'] ?? '') : '';
            ?>
            <select class="form-control" id="rela_persona" name="rela_persona" required>
                <option value="">Selecciona una persona...</option>
                <?php while ($p = $personas->fetch_assoc()): ?>
                    <option value="<?= $p['id_persona'] ?>" <?= ($selectedId == $p['id_persona']) ? 'selected' : '' ?>><?= htmlspecialchars($p['persona_apellido'] . ' ' . $p['persona_nombre']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    <a href="?page=proveedores" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script>
$(document).ready(function() {
    // Si deseas, podemos inicializar Select2 sin AJAX para mejorar UX con las opciones ya renderizadas:
    $('#rela_persona').select2({ width: '100%', placeholder: 'Selecciona una persona...' });
});
</script>
