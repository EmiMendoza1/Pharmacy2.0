<?php
require_once "conexion.php";

class Proveedor {
    public $id_proveedor;
    public $prov_estado;
    public $prov_direccion;
    public $prov_nombre_empresa;
    public $rela_persona;

    public function __construct($id_proveedor = null, $prov_estado = null, $prov_direccion = null, $prov_nombre_empresa = null, $rela_persona = null) {
        $this->id_proveedor = $id_proveedor;
        $this->prov_estado = $prov_estado;
        $this->prov_direccion = $prov_direccion;
        $this->prov_nombre_empresa = $prov_nombre_empresa;
        $this->rela_persona = $rela_persona;
    }

    public static function listar() {
        $conexion = new Conexion();
        $sql = "SELECT * FROM proveedor";
        return $conexion->consultar($sql);
    }

    public static function obtenerPorId($id) {
        $conexion = new Conexion();
        $sql = "SELECT * FROM proveedor WHERE id_proveedor = {$id}";
        $res = $conexion->consultar($sql);
        return $res->fetch_assoc();
    }

    public function guardar() {
        $conexion = new Conexion();
        $sql = "INSERT INTO proveedor (prov_estado, prov_direccion, prov_nombre_empresa, rela_persona) VALUES ('{$this->prov_estado}', '{$this->prov_direccion}', '{$this->prov_nombre_empresa}', {$this->rela_persona})";
        return $conexion->insertar($sql);
    }

    public function actualizar() {
        $conexion = new Conexion();
        $sql = "UPDATE proveedor SET prov_estado='{$this->prov_estado}', prov_direccion='{$this->prov_direccion}', prov_nombre_empresa='{$this->prov_nombre_empresa}', rela_persona={$this->rela_persona} WHERE id_proveedor={$this->id_proveedor}";
        return $conexion->actualizar($sql);
    }

    public static function eliminar($id) {
        $conexion = new Conexion();
        $sql = "DELETE FROM proveedor WHERE id_proveedor = {$id}";
        return $conexion->eliminar($sql);
    }
}
