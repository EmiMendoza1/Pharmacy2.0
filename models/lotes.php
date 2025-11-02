<?php
require_once "conexion.php";

class Lote {
    public static function obtenerLotes() {
        $conexion = new Conexion();
    $sql = "SELECT l.*, p.producto_nombre FROM lotes l INNER JOIN producto p ON l.rela_producto = p.id_producto ORDER BY l.id_lote ASC";
        return $conexion->consultar($sql);
    }

    public static function insertar($data) {
        $conexion = new Conexion();
        $sql = "INSERT INTO lotes (rela_producto, cantidadxlote, lote_codigo, lote_vencimiento) VALUES ('{$data['rela_producto']}', '{$data['cantidadxlote']}', '{$data['lote_codigo']}', '{$data['lote_vencimiento']}')";
        return $conexion->insertar($sql);
    }

    public static function obtenerPorId($id_lote) {
        $conexion = new Conexion();
        $sql = "SELECT * FROM lotes WHERE id_lote = {$id_lote}";
        $resultado = $conexion->consultar($sql);
        return $resultado->fetch_assoc();
    }

    public static function actualizar($id_lote, $data) {
        $conexion = new Conexion();
        $sql = "UPDATE lotes SET rela_producto='{$data['rela_producto']}', cantidadxlote='{$data['cantidadxlote']}', lote_codigo='{$data['lote_codigo']}', lote_vencimiento='{$data['lote_vencimiento']}' WHERE id_lote={$id_lote}";
        return $conexion->actualizar($sql);
    }

    public static function eliminar($id_lote) {
        $conexion = new Conexion();
        $sql = "DELETE FROM lotes WHERE id_lote = {$id_lote}";
        return $conexion->eliminar($sql);
    }
}
