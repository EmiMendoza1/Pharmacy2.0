<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes</title>
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
        .tabla-contenedor {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(1,85,46,0.08);
            padding: 24px 18px;
            margin-bottom: 0;
        }
    </style>
</head>
<body class="form-producto-page">
<div class="form-producto-container">
    <div class="titulo-listado">Listado de clientes</div>
    <div class="d-flex justify-content-end mb-3">
    <a href="index.php?page=signup_cliente" class="btn btn-success btn-nuevo">+ Nuevo cliente</a>
    </div>
    <div class="tabla-contenedor">
        <table class="table-producto">
            <thead>
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha Alta</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $clientes->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id_cliente'] ?></td>
                        <td><?= $row['persona_nombre'] ?></td>
                        <td><?= $row['persona_apellido'] ?></td>
                        <td><?= $row['cliente_fecha_alta'] ?></td>
                        <td><?= $row['cliente_estado'] ?></td>
                        <td>
                            <a href="index.php?page=cliente&action=editar&id=<?= $row['id_cliente'] ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="index.php?page=cliente&action=eliminar&id=<?= $row['id_cliente'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este cliente?');">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
