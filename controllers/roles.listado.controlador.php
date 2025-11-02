<?php
// Controlador para la vista de roles
// Acá obtenemos todos los roles y sus módulos:

require_once __DIR__ . '/../models/roles.php'; // Incluye el modelo Rol para consultar roles en la base de datos
require_once __DIR__ . '/../models/modulos.php'; // Incluye el modelo Modulo para consultar módulos asociados a roles

class RolesListadoControlador { // Clase controlador responsable de preparar datos de la vista de roles
    
    // Método principal que prepara los datos para la vista
    public function prepararDatosVista() { // Método principal: junta todos los datos necesarios para la vista de roles
        $rolModel = new Rol();           // Instancia del modelo de roles para realizar consultas
        $moduloModel = new Modulo();   // Instancia del modelo de módulos para realizar consultas relacionadas (->obtener los módulos asociados a los roles)
        
        // Datos para la tabla de roles
        $rolesListado = $this->obtenerRolesConModulos($rolModel, $moduloModel); // Lista de roles con sus módulos asociados
        
        // Datos para el formulario
        $todosModulos = $this->obtenerTodosModulos($moduloModel); // Lista completa de todos los módulos disponibles (para formulario de edición)
        
        // Datos para edición si se proporciona un ID (es decir, si viene el parámetro "rol_id" por URL para editar un rol específico)
        $rolEditar = null; // Inicializa el rol a editar (si corresponde)
        $modulosSeleccionados = []; // Inicializa la lista de módulos actualmente asignados a ese rol
        
        if (isset($_GET['rol_id'])) { // Si viene un parámetro por URL para editar un rol específico...
            $rolEditar = $this->obtenerRolParaEditar($rolModel, $_GET['rol_id']); // Carga los datos del rol
            $modulosSeleccionados = $this->obtenerModulosSeleccionados($moduloModel, $_GET['rol_id']); // Carga los módulos seleccionados
        }
        
        // Devolver todos los datos necesarios para la vista
        return [ // Devuelve todos los datos que la vista necesita para renderizar la pantalla
            'roles' => $rolesListado,                           // Tabla/Lista de roles con sus módulos correspondientes
            'modulos' => $todosModulos,                        // Lista de módulos disponibles para asignar
            'rol_editar' => $rolEditar,                       // Datos del rol que se está editando (si aplica)
            'modulos_seleccionados' => $modulosSeleccionados // Módulos actualmente asignados al rol en edición (si aplica)
        ];
    }
    
    // Obtiene todos los roles con sus módulos asociados (solución al problema N+1)
    private function obtenerRolesConModulos($rolModel, $moduloModel) { // Recopila roles y les agrega sus módulos
        $roles = [];                                                  // Array asociativo que indexará roles por su ID (es decir, el ID de cada rol será la "clave" de cada rol)
        $rolesResult = $rolModel->traer_roles();                     // Consulta de todos los roles en la base de datos
        
        // Primero obtenemos todos los roles
        while ($rol = $rolesResult->fetch_assoc()) {   // Recorre cada rol obtenido
            $roles[$rol['id_rol']] = [                // Guarda el rol en el array, indexado por su ID
                'id_rol' => $rol['id_rol'],          // ID del rol
                'nombre_rol' => $rol['nombre_rol'], // Nombre del rol
                'modulos' => [] // Inicializa array de módulos asociados a este rol
            ];
        }
        
        // Si no hay roles, devolvemos un array vacío
        if (empty($roles)) { // Si no hay roles, devolvemos un array vacío para simplificar la vista
            return [];
        }
        
        // Ahora obtenemos los módulos para cada rol en una sola consulta
        // Para cada rol, obtenemos sus módulos
        foreach ($roles as $id_rol => $rol) { // Para cada rol, buscamos sus módulos asociados
            $modulosResult = $moduloModel->traer_modulos_por_perfil($id_rol); // Consulta módulos del rol
            while ($modulo = $modulosResult->fetch_assoc()) {                // Recorre cada módulo encontrado
                $roles[$id_rol]['modulos'][] = $modulo['modulo_nombre'];    // Agrega el nombre del módulo al listado del rol
            }
        }
        
        return array_values($roles); // Convierte el array asociativo a indexado (útil para iterar en la vista)
    }
    
    // Obtiene todos los módulos disponibles
    private function obtenerTodosModulos($moduloModel) { // Devuelve la lista completa de módulos del sistema
        $modulos = []; // Array asociativo que indexará módulos por su ID (es decir, el ID de cada módulo será la "clave" de cada módulo)
        $modulosResult = $moduloModel->traer_todos_modulos(); // Consulta general de módulos
        
        if ($modulosResult) {                                   // Si hay resultados, lo transformamos en un array PHP
            while ($modulo = $modulosResult->fetch_assoc()) {  // Recorre cada registro
                $modulos[] = $modulo;                         // Agrega la fila tal cual (id y nombre del módulo, etc.)
            }
        }
        
        return $modulos; // Devuelve el array de módulos
    }
    
    // Obtiene los datos de un rol específico para editar
    private function obtenerRolParaEditar($rolModel, $rolId) { // Trae una fila específica de rol por ID
        $rolResult = $rolModel->traer_rol($rolId);            // Ejecuta la consulta del rol indicado
        if ($rolResult && $rolResult->num_rows > 0) {        // Si existe, devuelve la fila como array asociativo
            return $rolResult->fetch_assoc();
        }
        return null; // Si no existe, devuelve null para indicar ausencia
    }
    
    // Obtiene los módulos seleccionados para un rol específico
    private function obtenerModulosSeleccionados($moduloModel, $rolId) {   // Lista los módulos ya asignados al rol
        $modulosSeleccionados = [];                                       // Inicializa array asociativo
        $modulosResult = $moduloModel->traer_modulos_por_perfil($rolId); // Consulta BD por módulos del rol
        
        if ($modulosResult) {                                  // Si hay resultados, recorrer y acumular
            while ($modulo = $modulosResult->fetch_assoc()) { // Recorre cada registro de módulo
                $modulosSeleccionados[] = $modulo;           // Agrega el módulo a la lista/el array
            }
        }
        
        return $modulosSeleccionados; // Devuelve la lista de módulos asignados al rol
    }
}
?>
