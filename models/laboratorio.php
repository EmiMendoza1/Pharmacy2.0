<?php
require_once "conexion.php";

class Laboratorio {
    // Listar todos los laboratorios
    public static function listar() {
        $conexion = new Conexion();
        $query = "SELECT * FROM laboratorio ORDER BY id_laboratorio ASC";
        return $conexion->consultar($query);
    }

    // Insertar un nuevo laboratorio
    public static function insertar($descri) {
        $conexion = new Conexion();
        $query = "INSERT INTO laboratorio (laboratorio_descri) VALUES ('{$descri}')";
        return $conexion->insertar($query);
    }

    // Buscar un laboratorio por ID
    public static function buscarPorId($id) {
        $conexion = new Conexion();
        $query = "SELECT * FROM laboratorio WHERE id_laboratorio = $id";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    // Actualizar un laboratorio
    public static function actualizar($id, $descri) {
        $conexion = new Conexion();
        $query = "UPDATE laboratorio SET laboratorio_descri = '{$descri}' WHERE id_laboratorio = $id";
        return $conexion->actualizar($query);
    }

    // Eliminar un laboratorio
    public static function eliminar($id) {
        $conexion = new Conexion();
        $query = "DELETE FROM laboratorio WHERE id_laboratorio = $id";
        return $conexion->actualizar($query);
    }
}
?>
