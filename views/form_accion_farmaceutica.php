<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($accion) ? 'Editar Acción Farmacéutica' : 'Nueva Acción Farmacéutica' ?></title>
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
        <div class="titulo-formulario">
            <?= isset($accion) ? 'Editar Acción Farmacéutica' : 'Nueva Acción Farmacéutica' ?>
        </div>
        <form method="post" action="index.php?page=accion_farmaceutica&action=<?= isset($accion) ? 'actualizar' : 'guardar' ?>">
            <?php if(isset($accion)): ?>
                <input type="hidden" name="id_accion_farmaceutica" value="<?= $accion['id_accion_farmaceutica'] ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="accion_farmaceutica_descri" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="accion_farmaceutica_descri" name="accion_farmaceutica_descri" maxlength="50" required value="<?= isset($accion) ? htmlspecialchars($accion['accion_farmaceutica_descri']) : '' ?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="index.php?page=accion_farmaceutica" class="btn btn-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
