<?php
class AccionFarmaceutica {
    public static function listar() {
        require_once 'models/conexion.php';
        $conexion = new Conexion();
        $sql = "SELECT * FROM accion_farmaceutica ORDER BY id_accion_farmaceutica ASC";
        return $conexion->consultar($sql);
    }

    public static function obtenerPorId($id) {
        require_once 'models/conexion.php';
        $conexion = new Conexion();
        $id = intval($id);
        $sql = "SELECT * FROM accion_farmaceutica WHERE id_accion_farmaceutica = {$id}";
        $resultado = $conexion->consultar($sql);
        return $resultado->fetch_assoc();
    }

    public static function insertar($descri) {
        require_once 'models/conexion.php';
        $conexion = new Conexion();
        $descri = addslashes($descri);
        $sql = "INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('{$descri}')";
        return $conexion->insertar($sql);
    }

    public static function actualizar($id, $descri) {
        require_once 'models/conexion.php';
        $conexion = new Conexion();
        $id = intval($id);
        $descri = addslashes($descri);
        $sql = "UPDATE accion_farmaceutica SET accion_farmaceutica_descri = '{$descri}' WHERE id_accion_farmaceutica = {$id}";
        return $conexion->actualizar($sql);
    }

    public static function eliminar($id) {
        require_once 'models/conexion.php';
        $conexion = new Conexion();
        $id = intval($id);
        $sql = "DELETE FROM accion_farmaceutica WHERE id_accion_farmaceutica = {$id}";
        return $conexion->actualizar($sql);
    }
}
