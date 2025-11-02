<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($laboratorio) ? 'Editar' : 'Nuevo'; ?> Laboratorio</title>
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
<body class="form-producto-page" style="background-color: #e9f5e9;">
    <div class="form-producto-container">
        <h2 class="mb-4" style="text-align:center;">Nuevo Laboratorio</h2>
        <form action="index.php?page=laboratorio&action=<?php echo isset($laboratorio) ? 'actualizar' : 'guardar'; ?>" method="POST" style="width:100%; max-width:500px; margin:auto;">
        <?php if (isset($laboratorio)): ?>
            <input type="hidden" name="id_laboratorio" value="<?php echo $laboratorio['id_laboratorio']; ?>">
        <?php endif; ?>
        <div class="input-group">
            <label for="descri" class="form-label">Descripción:</label>
            <input type="text" id="descri" name="laboratorio_descri" class="form-control" value="<?php echo isset($laboratorio) ? $laboratorio['laboratorio_descri'] : ''; ?>" required>
        </div>
        <div class="actions">
            <button type="submit" class="btn btn-primary"><?php echo isset($laboratorio) ? 'Actualizar' : 'Guardar'; ?></button>
            <a href="index.php?page=laboratorio" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>
