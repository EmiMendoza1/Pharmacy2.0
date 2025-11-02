<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($categoria) ? 'Editar Categoría' : 'Nueva Categoría' ?></title>
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
            <?= isset($categoria) ? 'Editar Categoría' : 'Nueva Categoría' ?>
        </div>
        <form method="post" action="index.php?page=categoria&action=<?= isset($categoria) ? 'actualizar' : 'guardar' ?>">
            <?php if(isset($categoria)): ?>
                <input type="hidden" name="id_categoria" value="<?= $categoria['id_categoria'] ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="categoria_descri" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="categoria_descri" name="categoria_descri" maxlength="100" required value="<?= isset($categoria) ? htmlspecialchars($categoria['categoria_descri']) : '' ?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="index.php?page=categoria" class="btn btn-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
