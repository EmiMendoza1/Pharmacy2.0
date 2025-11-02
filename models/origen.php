<?php
require_once "conexion.php";

class Origen {
    // Listar todos los origenes
    public static function listar() {
        $conexion = new Conexion();
        $query = "SELECT * FROM origen ORDER BY id_origen ASC";
        return $conexion->consultar($query);
    }

    // Insertar un nuevo origen
    public static function insertar($descri) {
        $conexion = new Conexion();
        $query = "INSERT INTO origen (origen_descri) VALUES ('{$descri}')";
        return $conexion->insertar($query);
    }

    // Buscar un origen por ID
    public static function buscarPorId($id) {
        $conexion = new Conexion();
        $query = "SELECT * FROM origen WHERE id_origen = $id";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    // Actualizar un origen
    public static function actualizar($id, $descri) {
        $conexion = new Conexion();
        $query = "UPDATE origen SET origen_descri = '{$descri}' WHERE id_origen = $id";
        return $conexion->actualizar($query);
    }

    // Eliminar un origen
    public static function eliminar($id) {
        $conexion = new Conexion();
        $query = "DELETE FROM origen WHERE id_origen = $id";
        return $conexion->actualizar($query);
    }
}
?>
