<?php
// Falta hacer el Listado de Productos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de usuarios</title>
    <link rel="stylesheet" href="styles/formulario_producto.css">
    <style>
        .btn-nuevo {
            font-size: 0.95rem;
            padding: 7px 16px;
        }
        .titulo-listado {
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
        <div class="titulo-listado">Listado de usuarios</div>
        <div class="d-flex justify-content-end mb-3">
            <a href="index.php?page=signup_admin" class="btn btn-success btn-nuevo">+ Nuevo usuario</a>
        </div>
        <div>
            <?php // ...existing code... ?>
        </div>
    </div>
</body>
</html>