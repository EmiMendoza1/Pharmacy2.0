<?php
// Controlador para de registro desde la vista de los clientes (en la web, quizas se deba cambiar lo de este documento despues)
// Prepara los datos necesarios para el formulario de registro

require_once __DIR__ . '/../models/tipo_contacto.php'; // Incluye el modelo TipoContacto para obtener medios de contacto
require_once __DIR__ . '/../models/roles.php'; // Incluye el modelo Rol (consistencia con admin)

class SignupClienteListadoControlador { // Controlador que prepara datos para el formulario de alta de clientes
    
    // Método principal que prepara los datos para la vista
    public function prepararDatosVista() { // Método principal que reúne datos de la vista
        // Obtener tipos de contacto
        $tipos_contacto = $this->obtenerTiposContacto(); // Lista para el select de tipos de contacto
        
        // Obtener roles disponibles (aunque en el registro de clientes no se muestran, se mantiene por consistencia con el controlador de admin)
        $roles = $this->obtenerRoles(); // Lista de roles (puede no mostrarse, pero queda disponible)
        
        // Devolver todos los datos necesarios para la vista
        return [ // Datos que la vista usará para renderizar
            'tipos_contacto' => $tipos_contacto, // Para poblar el select de tipos de contacto
            'roles' => $roles // Para poblar el select de roles si se necesitara
        ];
    }
    
    // Obtiene todos los tipos de contacto disponibles
    private function obtenerTiposContacto() { // Consulta a la BD y arma un array con tipos de contacto
        $tipos_contacto_result = TipoContacto::listar(); // Usar método estático
        $tipos_contacto = []; // Inicializa el array resultado
        
        if ($tipos_contacto_result) { // Si hay filas en el resultado
            while($row = $tipos_contacto_result->fetch_assoc()) { // Recorre cada fila
                $tipos_contacto[] = $row; // Agrega la fila (id, nombre, etc.) al array
            }
        }
        
        return $tipos_contacto; // Devuelve la lista de tipos de contacto
    }
    
    // Obtiene todos los roles disponibles
    private function obtenerRoles() { // Trae todos los roles disponibles (para consistencia)
        $rolModel = new Rol(); // Instancia del modelo de roles
        $roles_result = $rolModel->traer_roles(); // Consulta general de roles
        $roles = []; // Inicializa el array de roles
        
        if ($roles_result) { // Si hay resultados de la consulta
            while($row = $roles_result->fetch_assoc()) { // Recorre cada fila de rol
                $roles[] = $row; // Agrega el rol al array
            }
        }
        
        return $roles; // Devuelve la lista de roles
    }
}
?>
