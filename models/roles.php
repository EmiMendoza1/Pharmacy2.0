<?php
// Incluye el archivo de conexión a la base de datos para poder realizar operaciones con la BD
require_once ('conexion.php');

// Clase que maneja todas las operaciones relacionadas con los roles de usuario
// Un rol define qué permisos y módulos puede acceder un usuario en el sistema
class Rol{
    // Método estático para obtener todos los roles
    public static function obtenerRoles() {
        $conexion = new Conexion();
        $sql = "SELECT id_rol, nombre_rol FROM rol ORDER BY nombre_rol ASC";
        return $conexion->consultar($sql);
    }
    // Variable privada que almacena el identificador único del rol en la base de datos
    private $id_rol;
    // Variable privada que almacena el nombre del rol (ej: Administrador, Cliente, Vendedor)
    private $nombre_rol;

    // Constructor de la clase - se ejecuta cuando se crea un nuevo objeto Rol
    // Los parámetros son opcionales (tienen valores por defecto vacíos)
    public function __construct($id_rol='', $nombre_rol=''){
        $this->id_rol = $id_rol; // Asigna el ID del rol a la propiedad de la clase
        $this->nombre_rol = $nombre_rol; // Asigna el nombre del rol a la propiedad de la clase
    }

    // Método para obtener todos los roles de la base de datos
    public function traer_roles(){
        $conexion = new Conexion(); // Crea una nueva instancia de la clase Conexion
        $query = "SELECT * FROM rol"; // Consulta SQL para obtener todos los roles
        return $conexion->consultar($query); // Ejecuta la consulta y retorna todos los roles
    }

    // Método para obtener un rol específico por su ID
    public function traer_rol($id_rol){
        $conexion = new Conexion(); // Crea una nueva instancia de la clase Conexion
        $id_rol = intval($id_rol); // Convierte el ID a entero para mayor seguridad
        // Consulta SQL para obtener un rol específico, renombrando campos para claridad
        $query = "SELECT id_rol as rol_id, nombre_rol FROM rol WHERE id_rol = {$id_rol}";
        return $conexion->consultar($query); // Ejecuta la consulta y retorna el rol
    }

    /**
     * Método unificado para guardar roles
     * 
     * @param string|null $nombre_rol Nombre del rol (opcional, si no se proporciona usa el valor del atributo)
     * @return int ID del rol insertado
     */
    public function guardar($nombre_rol = null){
        $conexion = new Conexion(); // Crea una nueva instancia de la clase Conexion
        
        // Usar el parámetro si se proporciona, de lo contrario usar el atributo de la clase
        // Esto permite flexibilidad en cómo se llama al método
        $nombre = $nombre_rol !== null ? $nombre_rol : $this->nombre_rol;
        
        // Sanear el valor para prevenir inyección SQL
        // addslashes escapa caracteres especiales que podrían ser maliciosos
        $nombre = addslashes($nombre);
        
        // Construye la consulta SQL para insertar un nuevo rol
        $query = "INSERT INTO rol (nombre_rol) VALUES ('{$nombre}')";
        return $conexion->insertar($query); // Ejecuta la consulta y retorna el ID del nuevo rol
    }

    // Método para actualizar los datos de un rol existente
    public function actualizar_rol($id_rol, $nombre_rol) {
        $conexion = new Conexion(); // Crea una nueva instancia de la clase Conexion
        $id_rol = intval($id_rol); // Convierte el ID a entero para mayor seguridad
        $nombre_rol = addslashes($nombre_rol); // Protección contra inyección SQL
        // Construye la consulta SQL para actualizar el rol
        $query = "UPDATE rol SET nombre_rol='{$nombre_rol}' WHERE id_rol={$id_rol}";
        return $conexion->actualizar($query); // Ejecuta la consulta y retorna true/false según el resultado
    }
    
    // Método para asignar módulos a un rol específico
    // Los módulos definen qué funcionalidades puede acceder un usuario con ese rol
    public function asignar_modulos_a_rol($id_rol, $modulos) {
        $conexion = new Conexion(); // Crea una nueva instancia de la clase Conexion
        $id_rol = intval($id_rol); // Convierte el ID a entero para mayor seguridad
        
        // Eliminar asignaciones previas del rol
        // Esto asegura que solo tenga los módulos que se le asignan ahora
        $conexion->actualizar("DELETE FROM rol_modulo WHERE rol_id={$id_rol}");
        
        // Insertar nuevas asignaciones de módulos al rol
        foreach ($modulos as $modulo_id) { // Recorre cada módulo que se quiere asignar
            $modulo_id = intval($modulo_id); // Convierte el ID del módulo a entero
            // Inserta la relación entre el rol y el módulo en la tabla intermedia
            $conexion->insertar("INSERT INTO rol_modulo (rol_id, modulo_id) VALUES ({$id_rol}, {$modulo_id})");
        }
    }
}
?>