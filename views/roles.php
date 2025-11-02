<?php
// Vista de roles - Solo muestra los datos proporcionados por el controlador
// No contiene lógica de negocio ni consultas a la base de datos

// Los datos vienen del controlador
$roles = $viewData['roles'] ?? [];
$modulos = $viewData['modulos'] ?? [];
$rol_editar = $viewData['rol_editar'] ?? null;
$modulos_seleccionados = $viewData['modulos_seleccionados'] ?? [];
?>
<div class="container">
    <h2 style="color: #01552e; font-weight:bolder; font-family: cambria, serif; text-shadow: 1px 1px 2px #e6ffe6;">Listado de Roles y Módulos</h2>
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Rol</th>
                        <th>Módulos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($roles as $rol): ?>
                        <tr>
                            <td><?= htmlspecialchars($rol['nombre_rol']) ?></td>
                            <td>
                                <?= implode('<br>', array_map('htmlspecialchars', $rol['modulos'])) ?>
                            </td>
                            <td>
                                <a href="index.php?page=roles&rol_id=<?= $rol['id_rol'] ?>" class="btn btn-success">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col">
            <h3 style="color: #01552e; text-decoration: underline; font-weight:bolder; font-family: cambria, serif; text-shadow: 1px 1px 2px #e6ffe6;">Crear/Editar Rol</h3>
            <form method="post" action="controllers/roles.controlador.php" style="background-color: #e6ffe6; color: #01552e; border-radius: 10px; padding: 15px;">
                <?php if ($rol_editar): ?>
                    <input type="hidden" name="action" value="actualizar" />
                    <input type="hidden" name="rol_id" value="<?= $_GET['rol_id'] ?>" />
                <?php else: ?>
                    <input type="hidden" name="action" value="guardar" />
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label">Nombre de rol</label>
                    <input type="text" name="nombre_rol" class="form-control" value="<?= $rol_editar ? htmlspecialchars($rol_editar['nombre_rol']) : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Módulos</label>
                    <div style="background-color: #f2f2f2; border-radius: 10px; padding: 12px; box-shadow: 0 2px 8px rgba(1,85,46,0.08);">
                        <select multiple class="form-select" name="modulo_id[]" id="id_modulos" style="background-color: #e6e6fa; color: #01552e; font-weight: 500; border: 1px solid #01552e;">
                            <?php foreach($modulos as $mod): 
                                $selected = false;
                                foreach($modulos_seleccionados as $mod_sel) {
                                    if ($mod['id_modulo'] == $mod_sel['id_modulo']) {
                                        $selected = true;
                                        break;
                                    }
                                }
                            ?>
                                <option value="<?= $mod['id_modulo'] ?>" <?= $selected ? 'selected' : '' ?>><?= htmlspecialchars($mod['modulo_nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn" style="background-color: #01552e; color: #fff; font-weight: bold;">Guardar</button>
            </form>
        </div>
    </div>
</div>