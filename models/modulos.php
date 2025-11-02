<?php // Modelo de módulos del sistema (tabla: modulo)
require_once ('conexion.php'); // Incluye la clase de conexión
class Modulo{ // Define el modelo Modulo
    private $id_modulo; // ID único del módulo
    private $modulo_nombre; // Nombre descriptivo del módulo (ej: Usuarios, Roles)

    public function __construct($id_modulo='', $modulo_nombre=''){ // Constructor con valores opcionales
        $this->id_modulo = $id_modulo; // Asigna ID
        $this->modulo_nombre = $modulo_nombre; // Asigna nombre
    }

    public function traer_modulos_por_perfil($rol_id){ // Devuelve los módulos asignados a un rol
        $conexion = new Conexion(); // Crea conexión
        $query= "SELECT modulo.* FROM modulo INNER JOIN rol_modulo ON rol_modulo.modulo_id = modulo.id_modulo WHERE rol_modulo.rol_id=".$rol_id; // Une módulo con la tabla intermedia
        return $conexion->consultar($query); // Ejecuta y devuelve result set
    }

    public function traer_todos_modulos(){ // Devuelve todos los módulos ordenados por nombre
        $conexion = new Conexion(); // Crea conexión
        $query = "SELECT * FROM modulo ORDER BY modulo_nombre ASC"; // Consulta de listado
        return $conexion->consultar($query); // Ejecuta y devuelve result set (se refiere a los datos obtenidos de la consulta)
    }
}
?>