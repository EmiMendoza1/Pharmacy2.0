<?php // Formulario de usuario ?>
<div class="form-producto-container">
    <h2 class="mb-3" style="color: #01552e; font-weight: bold; text-align: center; text-shadow: 1px 1px 2px #e6ffe6;">
        <?= isset($usuario) ? 'Editar usuario' : 'Registrar usuario' ?>
    </h2>
    <form id="formUsuario" method="post" action="index.php?page=usuario&action=<?= isset($usuario) ? 'actualizar' : 'guardar' ?>" style="width:100%; max-width:500px; margin:auto;">
        <?php if(isset($usuario)): ?>
            <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required minlength="4" value="<?= isset($usuario) ? htmlspecialchars($usuario['nombre_usuario']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required minlength="6" value="">
            <?php if(isset($usuario)): ?>
                <small class="form-text text-muted">Si no deseas cambiar la contraseña, deja este campo vacío.</small>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="rela_persona" class="form-label">Persona</label>
            <select class="form-select" id="rela_persona" name="rela_persona" required>
                <option value="">Seleccione...</option>
                <?php while($p = $personas->fetch_assoc()): ?>
                    <option value="<?= $p['id_persona'] ?>" <?= (isset($usuario) && $usuario['rela_persona'] == $p['id_persona']) ? 'selected' : '' ?>><?= htmlspecialchars($p['persona_nombre'] . ' ' . $p['persona_apellido']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="rela_rol" class="form-label">Rol</label>
            <select class="form-select" id="rela_rol" name="rela_rol" required>
                <option value="">Seleccione...</option>
                <?php while($r = $roles->fetch_assoc()): ?>
                    <option value="<?= $r['id_rol'] ?>" <?= (isset($usuario) && $usuario['rela_rol'] == $r['id_rol']) ? 'selected' : '' ?>><?= htmlspecialchars($r['nombre_rol']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
            <button type="submit" class="btn" style="background-color: #01552e; color: #fff; font-weight: bold;">Guardar</button>
            <a href="index.php?page=usuario" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
<script src="assets/js/validar_usuario.js"></script>
