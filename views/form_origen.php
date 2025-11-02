<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($origen) ? 'Editar' : 'Nuevo'; ?> Origen</title>
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
    <div class="titulo-formulario"><?php echo isset($origen) ? 'Editar' : 'Nuevo'; ?> Origen</div>
    <form action="index.php?page=origen&action=<?php echo isset($origen) ? 'actualizar' : 'guardar'; ?>" method="POST">
        <?php if (isset($origen)): ?>
            <input type="hidden" name="id_origen" value="<?php echo $origen['id_origen']; ?>">
        <?php endif; ?>
        <div class="input-group">
            <label for="descri" class="form-label">Descripción:</label>
            <input type="text" id="descri" name="origen_descri" class="form-control" value="<?php echo isset($origen) ? $origen['origen_descri'] : ''; ?>" required>
        </div>
        <div class="actions">
            <button type="submit" class="btn btn-primary"><?php echo isset($origen) ? 'Actualizar' : 'Guardar'; ?></button>
            <a href="index.php?page=origen" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>
