<?php


require_once ('../models/usuarios.php'); // Incluye el modelo de usuarios (para poder crear y validar usuarios)
require_once ('../models/roles.php'); // Incluye el modelo de roles (para obtener información del rol del usuario) 

if (session_status() == PHP_SESSION_NONE) { // Si no hay sesión iniciada aún
    session_start(); // Inicia una nueva sesión para poder usar variables de sesión
}

if (isset($_POST['action'])){ // Verifica si se envió un formulario con una acción específica
    if($_POST['action'] =='login'){   // Si la acción es 'login', procesa el inicio de sesión
        $login = new LoginControlador(); // Crea una nueva instancia del controlador de login
        $login->ingresar();             // Ejecuta el método para procesar el inicio de sesión
    }
}


class LoginControlador{ // Clase que maneja toda la lógica del login (inicio de sesión)
    public function ingresar(){ // Método que procesa el intento de inicio de sesión
        $usuario = new Usuario(); // Crea una nueva instancia del modelo Usuario
        $rol = new Rol(); // Crea una nueva instancia del modelo Rol
        $usuario->setNombre_usuario($_POST['nombre_usuario']); // Asigna el nombre de usuario ingresado en el formulario
        
        $resultado = $usuario->validar_usuario(); // Consulta en la BD si existe un usuario con ese nombre
        
        if($resultado->num_rows>0){ // Si existe al menos un usuario con ese nombre
            while($row = $resultado->fetch_assoc()){ // Recorre el resultado (debería ser un único usuario)
                if(password_verify($_POST['contrasena'], $row['contrasena'])){ // Compara la contraseña ingresada con el hash almacenado
                    $_SESSION['nombre_usuario'] = $row['nombre_usuario']; // Guarda el nombre de usuario en la sesión
                    
                    //Obtiene el rol - INICIO-------------------------------------
                    $resultado_roles=$rol->traer_rol($row['rela_rol']); // Busca los datos del rol asociado al usuario
                    while($row_roles = $resultado_roles->fetch_assoc()){ // Recorre el resultado del rol (debería ser uno)
                        $_SESSION['roles_id'] = $row_roles['rol_id']; // Guarda el ID del rol en la sesión
                        $_SESSION['roles_nombre'] = $row_roles['nombre_rol']; // Guarda el nombre del rol en la sesión
                    }
                    //Obtiene el rol - FIN------------------------------------
                    
                    header('Location: ../index.php?page=inicio'); // Redirige al inicio si el login es correcto
                }else{ // Si la contraseña no coincide
                    header('Location: ../index.php?message=Usuario o contraseña incorrectos&status=danger'); // Redirige con error
                }
            }
        }else{ // Si no se encontró ningún usuario con ese nombre
            header('Location: ../index.php?message=Usuario o contraseña incorrectos&status=danger'); // Redirige con error
        }
    }
}
?>