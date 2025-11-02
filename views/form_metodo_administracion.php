<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($metodo) ? 'Editar Método de Administración' : 'Nuevo Método de Administración' ?></title>
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
            <?= isset($metodo) ? 'Editar Método de Administración' : 'Nuevo Método de Administración' ?>
        </div>
        <form method="post" action="index.php?page=metodo_administracion&action=<?= isset($metodo) ? 'actualizar' : 'guardar' ?>">
            <?php if(isset($metodo)): ?>
                <input type="hidden" name="id_metodo" value="<?= $metodo['id_metodo'] ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="metodo_administracion_descri" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="metodo_administracion_descri" name="metodo_administracion_descri" maxlength="50" required value="<?= isset($metodo) ? htmlspecialchars($metodo['metodo_descri']) : '' ?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="index.php?page=metodo_administracion" class="btn btn-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
