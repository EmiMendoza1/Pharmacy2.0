<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($tipo) ? 'Editar' : 'Nuevo'; ?> Tipo de Contacto</title>
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
    <div class="titulo-formulario"><?php echo isset($tipo) ? 'Editar' : 'Nuevo'; ?> Tipo de Contacto</div>
    <form action="index.php?page=tipo_contacto&action=<?php echo isset($tipo) ? 'actualizar' : 'guardar'; ?>" method="POST">
        <?php if (isset($tipo)): ?>
            <input type="hidden" name="id_tipo_contacto" value="<?php echo $tipo['id_tipo_contacto']; ?>">
        <?php endif; ?>
        <div class="input-group">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="tipo_contacto_nombre" class="form-control" value="<?php echo isset($tipo) ? $tipo['tipo_contacto_nombre'] : ''; ?>" required>
        </div>
        <div class="actions">
            <button type="submit" class="btn btn-primary"><?php echo isset($tipo) ? 'Actualizar' : 'Guardar'; ?></button>
            <a href="index.php?page=tipo_contacto" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>
