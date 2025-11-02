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
        <!-- Caja combinada imagen + login -->
        <div class="login-wrapper">
            <!-- Imagen lateral izquierda -->
            <div class="image-side">
                <img src="assets/imagen_lateral.png" style="height: 100%;" alt="Bienvenido a Pharmacy">
            </div>
            <!-- Login principal -->
            <div class="login-container">
                <div class="login-header">
                    <img src="assets/Pharmacy_logo.png" alt="Pharmacy Logo" class="mini-logo">
                    <h1>Pharmacy</h1>
                </div>
                <div class="login-box">
                    <h2>¡Bienvenido de nuevo!</h2>
                    <form action="#" method="POST">
                        <div class="input-group">
                            <label for="nombre_usuario">Username</label>
                            <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Ingrese su nombre de usuario..." required>
                        </div>
                        <div class="input-group">
                            <label for="contrasena">Password</label>
                            <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña..." required>
                        </div>
                        <div class="options">
                            <label><input type="checkbox" name="remember"> Recordar contraseña</label>
                        </div>
                        <button type="submit">Iniciar Sesión</button>
                        <p>¿Todavía no tienes una cuenta? <a href="index.php?page=signup_cliente">Regístrate</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>