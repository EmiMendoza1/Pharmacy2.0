<?php
// Controlador para la barra de navegación
// Prepara los datos de módulos según el rol del usuario

require_once __DIR__ . '/../models/modulos.php'; // Incluye el modelo que permite consultar módulos disponibles por rol

class NavbarControlador { // Define la clase del controlador de la barra de navegación
    
    public function prepararDatosVista() { // Método principal que prepara los datos para la vista       
        if (!isset($_SESSION['roles_id'])) { // Verifica si hay sesión iniciada y rol asignado
            return ['modulos_array' => []]; // Si no hay, se retorna un array vacío
        }
        
        $modulos_array = $this->obtenerModulosPorRol($_SESSION['roles_id']); // Se obtiene los módulos asignados al rol del usuario
        
        return [ // Devuelve un array asociativo con los datos que consumirá la vista
            'modulos_array' => $modulos_array // Se retorna el array de módulos asignados al rol, para que la vista pueda mostrarlos
        ]; // Cierra el array de respuesta
    }    // Fin del método prepararDatosVista

    private function obtenerModulosPorRol($rolId) {                  // Obtiene los módulos asignados a un rol específico
        $moduloModel = new Modulo();                                // Crea una instancia del modelo Modulo para acceder a la base de datos
        $modulos = $moduloModel->traer_modulos_por_perfil($rolId); // Trae desde la BD los módulos permitidos para el rol indicado
        
        $modulos_array = []; // Inicializa el arreglo donde se guardarán los nombres de módulos
        if ($modulos && $modulos->num_rows > 0) { // Si hay resultados (si modulos existe y tiene filas...), se recorren para construir el array final 
            while ($row = $modulos->fetch_assoc()) { // Recorre cada fila del resultado
                $modulos_array[] = $row['modulo_nombre']; // Agrega el nombre del módulo a la lista
            }
        }
        
        return $modulos_array; // Devuelve la lista simple de nombres de módulos
    }
}
?>
