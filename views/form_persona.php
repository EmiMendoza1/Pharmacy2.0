<!-- Formulario de Persona -->
<div class="container mt-4">
    <h2 class="mb-4"><?= isset($data) ? 'Editar' : 'Nueva' ?> Persona</h2>
    <form method="post" action="?page=persona&action=<?= isset($data) ? 'actualizar' : 'guardar' ?>">
        <?php if (isset($data)): ?>
            <input type="hidden" name="id_persona" value="<?= $data['id_persona'] ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="persona_nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="persona_nombre" name="persona_nombre" value="<?= $data['persona_nombre'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="persona_apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="persona_apellido" name="persona_apellido" value="<?= $data['persona_apellido'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="persona_fecha_nac" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="persona_fecha_nac" name="persona_fecha_nac" value="<?= $data['persona_fecha_nac'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="persona_dni" class="form-label">DNI</label>
            <input type="text" class="form-control" id="persona_dni" name="persona_dni" value="<?= $data['persona_dni'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="persona_sexo" class="form-label">Sexo</label>
                <select class="form-control" id="persona_sexo" name="persona_sexo" required>
                    <option value="">Seleccione...</option>
                    <option value="Femenino" <?= (isset($data['persona_sexo']) && $data['persona_sexo'] == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
                    <option value="Masculino" <?= (isset($data['persona_sexo']) && $data['persona_sexo'] == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                    <option value="Otro" <?= (isset($data['persona_sexo']) && $data['persona_sexo'] == 'Otro') ? 'selected' : '' ?>>Otro</option>
                </select>
        </div>
        <div class="mb-3">
            <label for="persona_direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="persona_direccion" name="persona_direccion" value="<?= $data['persona_direccion'] ?? '' ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="?page=persona" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<div class="form-producto-container">
    <h2 class="mb-4" style="text-align:center;">Nueva Persona</h2>
    <form method="post" action="index.php?page=persona&action=guardar" style="width:100%; max-width:500px; margin:auto; background:#fff; border-radius:18px; box-shadow:0 2px 12px rgba(1,85,46,0.08); padding:24px 18px;">
