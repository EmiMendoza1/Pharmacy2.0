<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Cliente</title>
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
        <div class="titulo-formulario">Nuevo Cliente</div>
        <form method="post" action="index.php?page=cliente&action=guardar">
            <div class="form-grid">
                <!-- Campo Persona: select con el listado de personas -->
                <div class="input-group">
                    <label for="rela_persona">Persona</label>
                    <select id="rela_persona" name="rela_persona" required>
                        <option value="">Seleccione...</option>
                        <?php if (isset($personas) && $personas): ?>
                            <?php while($p = $personas->fetch_assoc()): ?>
                                <option value="<?= $p['id_persona'] ?>"><?= htmlspecialchars($p['persona_nombre'] . ' ' . $p['persona_apellido']) ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="input-group">
                    <label for="cliente_estado">Estado</label>
                    <select id="cliente_estado" name="cliente_estado">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="fecha_alta">Fecha de Alta</label>
                    <input type="date" id="fecha_alta" name="fecha_alta" required>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="index.php?page=cliente" class="btn btn-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
