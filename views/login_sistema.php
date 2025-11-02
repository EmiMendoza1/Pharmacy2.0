<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy - Iniciar Sesión</title>
    <link rel="stylesheet" href="styles/login.css">
    
</head>
<body>
    <div style="width:100%; max-width:100vw; display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100vh;">
        <?php if(isset($_GET['message'])): ?>
            <div id="login-alert" class="alert alert-<?php echo $_GET['status']; ?>" role="alert" style="max-width: 500px; margin: 40px auto 20px auto; text-align:center;">
                <?php echo $_GET['message']; ?>
            </div>
            <script>
                setTimeout(function(){
                var alert = document.getElementById('login-alert');
                if(alert) alert.style.display = 'none';
                }, 2500);
            </script>
        <?php endif; ?>
        
        <!-- Caja combinada imagen + login -->
        <div class="login-wrapper">

            <!-- Imagen lateral izquierda -->
            <div class="image-side">
                <img src="assets/imagen_lateral1.png" style="height: 100%;" alt="Bienvenido a Pharmacy">
            </div>

            <!-- Login principal -->
            <div class="login-container">

                <div class="login-header">
                    <img src="assets/logonuevo.png" alt="Pharmacy Logo" class="mini-logo">

                    <h1>Pharmacy</h1>

                </div>

                <div class="login-box">
                    <h2>¡Bienvenido al sistema!</h2>
                    <form action="controllers/login.controlador.php" method="POST">
                        <input type="hidden" name="action" value="login">
                        <div class="input-group">
                            <label for="nombre_usuario">Username</label>
                            <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Ingrese su nombre de usuario..." >
                            <span class="error" id="error-nombre_usuario"></span>
                        </div>

                        <div class="input-group">
                            <label for="contrasena">Password</label>
                            <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña..." >
                            <span class="error" id="error-contrasena"></span>
                        </div>

                        <div class="options">
                            <label><input type="checkbox" name="remember"> Recordar contraseña</label>
                        </div>

                        <button type="submit">Iniciar Sesión</button>

                    </form>
                </div>

            </div>

        </div>
    </div>
<script src="assets/js/validaciones.js"></script>
</body>
</html>