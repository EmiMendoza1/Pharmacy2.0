<?php
require_once "conexion.php";

class Conservacion {
    public static function obtenerConservaciones() {
        $conexion = new Conexion();
    $sql = "SELECT * FROM conservacion ORDER BY id_conservacion ASC";
        return $conexion->consultar($sql);
    }

    public static function insertar($data) {
        $conexion = new Conexion();
        $sql = "INSERT INTO conservacion (conservacion_descri) VALUES ('{$data['conservacion_descri']}')";
        return $conexion->insertar($sql);
    }

    public static function obtenerPorId($id_conservacion) {
        $conexion = new Conexion();
        $sql = "SELECT * FROM conservacion WHERE id_conservacion = {$id_conservacion}";
        $resultado = $conexion->consultar($sql);
        return $resultado->fetch_assoc();
    }

    public static function actualizar($id_conservacion, $data) {
        $conexion = new Conexion();
        $sql = "UPDATE conservacion SET conservacion_descri='{$data['conservacion_descri']}' WHERE id_conservacion={$id_conservacion}";
        return $conexion->actualizar($sql);
    }

    public static function eliminar($id_conservacion) {
        $conexion = new Conexion();
        $sql = "DELETE FROM conservacion WHERE id_conservacion = {$id_conservacion}";
        return $conexion->eliminar($sql);
    }
}
