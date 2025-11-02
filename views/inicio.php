<?php
// No session_start() aca, pq ya se debe haber iniciado en index.php
if (!isset($_SESSION['nombre_usuario'])) {
    header('Location: index.php?page=login_sistema');
    exit;
}
$usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a Pharmacy</title>
    <link rel="stylesheet" href="styles/formulario_producto.css">
    <style>
        body.inicio-farmacia {
            min-height: 100vh;
            background: linear-gradient(135deg, #e6fff2 60%, #b2f7c1 100%);
            background-repeat: no-repeat;
            background-position: top right;
            background-size: 180px;
        }
        .inicio-container {
            background: rgba(255,255,255,0.95);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(13, 255, 86, 0.15);
            max-width: 600px;
            margin: 60px auto;
            padding: 40px 30px;
            text-align: center;
        }
        .inicio-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 18px;
        }
        .inicio-logo img {
            width: 90px;
            height: auto;
        }
        .inicio-container h1 {
            color: #01552e;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .inicio-container p {
            color: #013818;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .inicio-container .btn {
            background: #01552e;
            color: #fff;
            border-radius: 8px;
            padding: 12px 32px;
            font-size: 1.1rem;
            margin: 10px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .inicio-container .btn:hover {
            background: #037003;
        }
    </style>
</head>
<body class="inicio-farmacia">
    <div class="inicio-container">
        <div class="inicio-logo">
            <img src="assets/logonuevo.png" alt="Pharmacy Logo">
        </div>
        <h1>Bienvenido a Pharmacy</h1>
        <p>Gestión integral de productos, clientes y procesos para farmacias.<br>
        Accede a los módulos desde el menú superior y comienza a administrar tu farmacia de manera eficiente y segura.</p>
        <a href="index.php?page=producto" class="btn">Ir a Productos</a>
        <a href="index.php?page=signup_cliente" class="btn">Registrar Cliente</a>
        <a href="index.php?page=roles" class="btn">Ver Roles</a>
    </div>
</body>
</html>
