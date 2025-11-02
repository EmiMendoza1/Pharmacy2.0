<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($forma) ? 'Editar Forma' : 'Nueva Forma' ?></title>
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
            <?= isset($forma) ? 'Editar Forma' : 'Nueva Forma' ?>
        </div>
        <form method="post" action="index.php?page=forma&action=<?= isset($forma) ? 'actualizar' : 'guardar' ?>">
            <?php if(isset($forma)): ?>
                <input type="hidden" name="id_forma" value="<?= $forma['id_forma'] ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="forma_descri" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="forma_descri" name="forma_descri" maxlength="50" required value="<?= isset($forma) ? htmlspecialchars($forma['forma_descri']) : '' ?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="index.php?page=forma" class="btn btn-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
