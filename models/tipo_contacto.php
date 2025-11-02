<?php // Modelo de tipo de contacto (tabla: tipo_contacto)
require_once('conexion.php'); // Incluye la clase de conexión

class TipoContacto { // Define el modelo TipoContacto
    // Listar todos los tipos de contacto
    public static function listar() {
        $conexion = new Conexion();
        $query = "SELECT * FROM tipo_contacto ORDER BY id_tipo_contacto ASC";
        return $conexion->consultar($query);
    }

    // Insertar un nuevo tipo de contacto
    public static function insertar($nombre) {
        $conexion = new Conexion();
        $query = "INSERT INTO tipo_contacto (tipo_contacto_nombre) VALUES ('{$nombre}')";
        return $conexion->insertar($query);
    }

    // Buscar un tipo de contacto por ID
    public static function buscarPorId($id) {
        $conexion = new Conexion();
        $query = "SELECT * FROM tipo_contacto WHERE id_tipo_contacto = $id";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    // Actualizar un tipo de contacto
    public static function actualizar($id, $nombre) {
        $conexion = new Conexion();
        $query = "UPDATE tipo_contacto SET tipo_contacto_nombre = '{$nombre}' WHERE id_tipo_contacto = $id";
        return $conexion->actualizar($query);
    }

    // Eliminar un tipo de contacto
    public static function eliminar($id) {
        $conexion = new Conexion();
        $query = "DELETE FROM tipo_contacto WHERE id_tipo_contacto = $id";
        return $conexion->actualizar($query);
    }
}
?>