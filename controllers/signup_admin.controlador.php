<?php // Controlador que procesa el formulario de alta de administradores

require_once('../models/conexion.php'); // Conexión a la BD (por consistencia, aunque los modelos la crean internamente)
require_once('../models/persona.php'); // Modelo Persona: datos personales
require_once('../models/usuarios.php'); // Modelo Usuario: credenciales y relación con persona/rol
require_once('../models/roles.php'); // Modelo Rol: para relacionar el usuario con un rol
require_once('../models/contacto_persona.php'); // Modelo ContactoPersona: medios de contacto

if (session_status() == PHP_SESSION_NONE) { // Si todavía no hay sesión iniciada
    session_start(); // Inicia la sesión (podría usarse para mensajes o auditoría)
}

if (isset($_POST['action']) && $_POST['action'] === 'registrar') { // Si el formulario envió la acción registrar
    $controller = new SignupAdminController(); // Instancia el controlador
    $controller->registrar(); // Ejecuta el flujo de registro
}

class SignupAdminController
{
    public function registrar()
    {
        // Validar contraseña: ambas deben existir y coincidir
        if (!isset($_POST['password'], $_POST['confirm-password']) || $_POST['password'] !== $_POST['confirm-password']) {
            header('Location: ../index.php?page=signup_admin&message=Las contraseñas no coinciden&status=danger'); // Redirige con error
            exit; // Detiene ejecución
        }

        // Normalizar y asignar variables (trim elimina espacios en extremos)
        $nombre = trim($_POST['nombre']); // Nombre de la persona
        $apellido = trim($_POST['apellido']); // Apellido de la persona
        $dni = trim($_POST['dni']); // Documento
        $fecha_nac = $_POST['fecha_nac']; // Fecha de nacimiento (YYYY-MM-DD)
        $direccion = trim($_POST['direccion']); // Domicilio
        $sexo = $_POST['sexo']; // Sexo (valor del select)

        // Crear y guardar persona
        $persona = new Persona($nombre, $apellido, $fecha_nac, $dni, $sexo, $direccion); // Instancia con datos
        $id_persona = $persona->guardar(); // Inserta y obtiene ID de persona

        if (!$id_persona) { // Si falló la inserción de persona
            header('Location: ../index.php?page=signup_admin&message=Error al guardar datos de persona&status=danger'); // Redirige con error
            exit;
        }

        // Crear y guardar usuario asociado a la persona
        $usuario_model = new Usuario(); // Instancia del modelo usuario
        $usuario_model->setNombre_usuario(trim($_POST['usuario'])); // Asigna nombre de usuario
        $usuario_model->setContrasena(trim($_POST['password'])); // Asigna contraseña (se encripta en el modelo)
        $usuario_model->setRela_persona($id_persona); // Asocia a la persona creada
        $usuario_model->setRela_rol((int)$_POST['rol']); // Asigna el rol seleccionado
        $id_usuario = $usuario_model->guardar(); // Inserta usuario y obtiene ID

        if (!$id_usuario) { // Si falló la inserción de usuario
            header('Location: ../index.php?page=signup_admin&message=Error al guardar usuario&status=danger'); // Redirige con error
            exit; // Detiene ejecución
        }

        // Guardar contactos (puede haber múltiples filas en el formulario)
        if (isset($_POST['tipo_contacto'], $_POST['contacto_valor']) && is_array($_POST['tipo_contacto'])) { // Verifica que existan arrays
            foreach ($_POST['tipo_contacto'] as $index => $tipo) { // Recorre cada tipo
                $valor = trim($_POST['contacto_valor'][$index]); // Toma el valor correspondiente
                if ($tipo && $valor) { // Solo guarda si ambos existen
                    $contacto = new ContactoPersona($tipo, $valor, $id_persona); // Instancia del contacto
                    $contacto->guardar(); // Inserta el contacto
                }
            }
        }

        header('Location: ../index.php?page=listado_usuario&message=Usuario registrado correctamente&status=success'); // Redirige con éxito
        exit; // Finaliza
    }
}
