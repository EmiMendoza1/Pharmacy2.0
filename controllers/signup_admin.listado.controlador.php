<?php
// Controlador para la vista de registro de administradores
// Prepara los datos necesarios para el formulario de registro

require_once __DIR__ . '/../models/tipo_contacto.php'; // Incluye el modelo TipoContacto para consultar tipos de contacto
require_once __DIR__ . '/../models/roles.php'; // Incluye el modelo Rol para consultar roles disponibles

class SignupAdminListadoControlador { // Controlador que prepara datos para el formulario de alta de administradores
    
    
    public function prepararDatosVista() { // Método principal que junta toda la información para la vista
        // Obtener tipos de contacto
        $tipos_contacto = $this->obtenerTiposContacto(); // Lista de medios de contacto (teléfono, email, etc.)
        
        // Obtener roles disponibles
        $roles = $this->obtenerRoles();
        
        // Devolver todos los datos necesarios para la vista
        return [ // Devuelve los datos en un array asociativo
            'tipos_contacto' => $tipos_contacto, // Datos para poblar el select de tipos de contacto
            'roles' => $roles // Datos para poblar el select de roles
        ];
    }
    
    // Obtiene todos los tipos de contacto disponibles
    private function obtenerTiposContacto() { // Consulta la tabla de tipos de contacto y devuelve un array PHP
        $tipoContactoModel = new TipoContacto(); // Crea instancia del modelo de tipo de contacto
        $tipos_contacto_result = $tipoContactoModel->getAll(); // Ejecuta la consulta para obtenerlos todos
        $tipos_contacto = []; // Inicializa el array resultado
        
        if ($tipos_contacto_result) { // Si hay resultados en la consulta
            while($row = $tipos_contacto_result->fetch_assoc()) { // Recorre cada fila obtenida
                $tipos_contacto[] = $row; // Agrega la fila tal cual al array (id y nombre del tipo)
            }
        }
        
        return $tipos_contacto; // Devuelve lista de tipos de contacto
    }
    
    // Obtiene todos los roles disponibles
    private function obtenerRoles() { // Consulta la tabla de roles para poblar el select de la vista
        $rolModel = new Rol(); // Instancia del modelo de roles
        $roles_result = $rolModel->traer_roles(); // Ejecuta consulta de todos los roles
        $roles = []; // Inicializa el array de roles
        
        if ($roles_result) { // Si hay resultados
            while($row = $roles_result->fetch_assoc()) { // Recorre cada rol obtenido
                $roles[] = $row; // Agrega la fila de rol al array resultado
            }
        }
        
        return $roles; // Devuelve la lista de roles disponibles
    }
}
?>
