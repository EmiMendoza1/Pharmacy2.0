<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($marca) ? 'Editar Marca' : 'Nueva Marca' ?></title>
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
            <?= isset($marca) ? 'Editar Marca' : 'Nueva Marca' ?>
        </div>
            <form method="post" action="index.php?page=marca&action=guardar" style="width:100%; max-width:500px; margin:auto; background:#fff; border-radius:18px; box-shadow:0 2px 12px rgba(1,85,46,0.08); padding:24px 18px;">
            <?php if(isset($marca)): ?>
                <input type="hidden" name="id_marca" value="<?= $marca['id_marca'] ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="marca_descri" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="marca_descri" name="marca_descri" maxlength="50" required value="<?= isset($marca) ? htmlspecialchars($marca['marca_descri']) : '' ?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="index.php?page=marca" class="btn btn-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
