<?php
require_once 'models/clientes.php';
require_once 'models/persona.php';
require_once 'models/tipo_contacto.php';
require_once 'models/contacto_persona.php';

class SignupClienteControlador {
    public function nuevo($mensaje = '', $status = '') {
        // Preparar datos para el formulario
        $tipos_contacto = TipoContacto::listar();
        $tipos = [];
        if ($tipos_contacto) {
            while($row = $tipos_contacto->fetch_assoc()) {
                $tipos[] = $row;
            }
        }
        $viewData = [ 'tipos_contacto' => $tipos ];
        if ($mensaje) {
            $viewData['mensaje'] = $mensaje;
            $viewData['status'] = $status;
        }
        require 'views/signup_cliente.php';
    }

    public function guardar() {
        // Validar y guardar datos del cliente
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $dni = trim($_POST['dni'] ?? '');
        $direccion = trim($_POST['direccion'] ?? '');
        $fecha_nac = trim($_POST['fecha_nac'] ?? '');
        $sexo = trim($_POST['sexo'] ?? '');
        $usuario = trim($_POST['usuario'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm_password = trim($_POST['confirm-password'] ?? '');
        $contactos = $_POST['contacto_valor'] ?? [];
        $tipos_contacto = $_POST['tipo_contacto'] ?? [];

        $errores = [];
        if (!$nombre) $errores[] = 'El nombre es obligatorio.';
        if (!$apellido) $errores[] = 'El apellido es obligatorio.';
        if (!$dni) $errores[] = 'El DNI es obligatorio.';
        if (!$usuario) $errores[] = 'El nombre de usuario es obligatorio.';
        if (!$password) $errores[] = 'La contraseña es obligatoria.';
        if ($password !== $confirm_password) $errores[] = 'Las contraseñas no coinciden.';
        if (empty($contactos) || empty($tipos_contacto)) $errores[] = 'Debe ingresar al menos un contacto.';

        if (!empty($errores)) {
            $mensaje = implode('<br>', $errores);
            $this->nuevo($mensaje, 'danger');
            return;
        }

        // Guardar persona
        $id_persona = Persona::insertar($nombre, $apellido, $dni, $direccion, $fecha_nac, $sexo, $usuario, $password);
        if ($id_persona) {
            // Guardar cliente
            $id_cliente = Cliente::insertar($id_persona);
            // Guardar contactos
            foreach ($contactos as $i => $valor) {
                $tipo = $tipos_contacto[$i] ?? null;
                if ($tipo && $valor) {
                    ContactoPersona::insertar($id_persona, $tipo, $valor);
                }
            }
            $mensaje = '¡Cliente registrado correctamente!';
            $status = 'success';
        } else {
            $mensaje = 'Error al registrar el cliente. Intente nuevamente.';
            $status = 'danger';
        }
        $this->nuevo($mensaje, $status);
    }
}
