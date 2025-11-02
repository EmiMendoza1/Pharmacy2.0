<?php
require_once 'models/conexion.php';
class MedioPago {
    public $id_mediopago;
    public $mediopago_tipo;

    public function __construct($id = null, $tipo = null) {
        $this->id_mediopago = $id;
        $this->mediopago_tipo = $tipo;
    }

    public static function listar() {
        $conexion = new Conexion();
        $sql = "SELECT * FROM mediopago ORDER BY id_mediopago DESC";
        return $conexion->consultar($sql);
    }

    public function guardar() {
        $conexion = new Conexion();
        $tipo = addslashes($this->mediopago_tipo);
        $sql = "INSERT INTO mediopago (mediopago_tipo) VALUES ('{$tipo}')";
        $this->id_mediopago = $conexion->insertar($sql);
        return $this->id_mediopago;
    }

    public function actualizar() {
        $conexion = new Conexion();
        $tipo = addslashes($this->mediopago_tipo);
        $sql = "UPDATE mediopago SET mediopago_tipo = '{$tipo}' WHERE id_mediopago = {$this->id_mediopago}";
        return $conexion->consultar($sql);
    }

    public static function eliminar($id) {
        $conexion = new Conexion();
        $id = intval($id);
        $sql = "DELETE FROM mediopago WHERE id_mediopago = {$id}";
        return $conexion->consultar($sql);
    }

    public static function obtenerPorId($id) {
        $conexion = new Conexion();
        $id = intval($id);
        $sql = "SELECT * FROM mediopago WHERE id_mediopago = {$id} LIMIT 1";
        $resultado = $conexion->consultar($sql);
        return $resultado ? $resultado->fetch_assoc() : null;
    }
}
