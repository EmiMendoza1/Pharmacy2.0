<?php
require_once "conexion.php";

class TipoProducto {
    // Listar todos los tipos de producto
    public static function listar() {
        $conexion = new Conexion();
        $query = "SELECT * FROM tipo_producto ORDER BY id_tipo_producto ASC";
        return $conexion->consultar($query);
    }

    // Insertar un nuevo tipo de producto
    public static function insertar($descri) {
        $conexion = new Conexion();
        $query = "INSERT INTO tipo_producto (tipo_producto_descri) VALUES ('{$descri}')";
        return $conexion->insertar($query);
    }

    // Buscar un tipo de producto por ID
    public static function buscarPorId($id) {
        $conexion = new Conexion();
        $query = "SELECT * FROM tipo_producto WHERE id_tipo_producto = $id";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    // Actualizar un tipo de producto
    public static function actualizar($id, $descri) {
        $conexion = new Conexion();
        $query = "UPDATE tipo_producto SET tipo_producto_descri = '{$descri}' WHERE id_tipo_producto = $id";
        return $conexion->actualizar($query);
    }

    // Eliminar un tipo de producto
    public static function eliminar($id) {
        $conexion = new Conexion();
        $query = "DELETE FROM tipo_producto WHERE id_tipo_producto = $id";
        return $conexion->actualizar($query);
    }
}
?>
