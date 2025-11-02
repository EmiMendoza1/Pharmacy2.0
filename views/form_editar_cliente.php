<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="styles/formulario_producto.css">
    <style>
        .titulo-formulario {
            text-align: center;
            margin-bottom: 18px;
            font-size: 2rem;
            color: #01552e;
            font-weight: bold;
        }
    </style>
</head>
<body class="form-producto-page">
    <div class="form-producto-container">
        <div class="titulo-formulario">Editar Cliente</div>
    <form method="post" action="index.php?page=cliente&action=actualizar" style="width:100%; max-width:500px; margin:auto; background:#fff; border-radius:18px; box-shadow:0 2px 12px rgba(1,85,46,0.08); padding:24px 18px;">
            <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">
            <div class="form-grid">
                <div class="input-group">
                    <label for="nombre">Nombre</label>
                    <input required type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($cliente['persona_nombre']) ?>">
                </div>
                <div class="input-group">
                    <label for="apellido">Apellido</label>
                    <input required type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($cliente['persona_apellido']) ?>">
                </div>
                <div class="input-group">
                    <label for="dni">DNI</label>
                    <input required type="number" id="dni" name="dni" value="<?= htmlspecialchars($cliente['persona_dni'] ?? '') ?>">
                </div>
                <div class="input-group">
                    <label for="direccion">Dirección</label>
                    <input required type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($cliente['persona_direccion'] ?? '') ?>">
                </div>
                <div class="input-group">
                    <label for="fecha_nac">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nac" name="fecha_nac" value="<?= htmlspecialchars($cliente['persona_fecha_nac'] ?? '') ?>">
                </div>
                <div class="input-group">
                    <label for="sexo">Sexo</label>
                    <select id="sexo" name="sexo">
                        <option value="">Seleccione</option>
                        <option value="Masculino" <?= ($cliente['persona_sexo'] == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                        <option value="Femenino" <?= ($cliente['persona_sexo'] == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
                        <option value="Otro" <?= ($cliente['persona_sexo'] == 'Otro') ? 'selected' : '' ?>>Otro</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="cliente_estado">Estado</label>
                    <select id="cliente_estado" name="cliente_estado">
                        <option value="Activo" <?= ($cliente['cliente_estado'] == 'Activo') ? 'selected' : '' ?>>Activo</option>
                        <option value="Inactivo" <?= ($cliente['cliente_estado'] == 'Inactivo') ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="index.php?page=cliente" class="btn btn-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
