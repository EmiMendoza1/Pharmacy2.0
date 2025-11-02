<?php
require_once "conexion.php";

class ContactoEmpresa {
    public $id_contacto;
    public $contacto_valor;
    public $rela_tipo_contacto;
    public $rela_proveedor;

    public function __construct($id_contacto = null, $contacto_valor = null, $rela_tipo_contacto = null, $rela_proveedor = null) {
        $this->id_contacto = $id_contacto;
        $this->contacto_valor = $contacto_valor;
        $this->rela_tipo_contacto = $rela_tipo_contacto;
        $this->rela_proveedor = $rela_proveedor;
    }

    public static function listar() {
        $conexion = new Conexion();
        // Hacemos JOIN para traer el nombre del tipo de contacto y el nombre de la empresa/proveedor
        $sql = "SELECT ce.*, tc.tipo_contacto_nombre, p.prov_nombre_empresa 
                FROM contacto_empresa ce 
                LEFT JOIN tipo_contacto tc ON ce.rela_tipo_contacto = tc.id_tipo_contacto 
                LEFT JOIN proveedor p ON ce.rela_proveedor = p.id_proveedor 
                ORDER BY ce.id_contacto DESC";
        return $conexion->consultar($sql);
    }

    public static function obtenerPorId($id) {
        $conexion = new Conexion();
        $sql = "SELECT * FROM contacto_empresa WHERE id_contacto = {$id}";
        $res = $conexion->consultar($sql);
        return $res->fetch_assoc();
    }

    public function guardar() {
        $conexion = new Conexion();
        $sql = "INSERT INTO contacto_empresa (contacto_valor, rela_tipo_contacto, rela_proveedor) VALUES ('{$this->contacto_valor}', {$this->rela_tipo_contacto}, {$this->rela_proveedor})";
        return $conexion->insertar($sql);
    }

    public function actualizar() {
        $conexion = new Conexion();
        $sql = "UPDATE contacto_empresa SET contacto_valor='{$this->contacto_valor}', rela_tipo_contacto={$this->rela_tipo_contacto}, rela_proveedor={$this->rela_proveedor} WHERE id_contacto={$this->id_contacto}";
        return $conexion->actualizar($sql);
    }

    public static function eliminar($id) {
        $conexion = new Conexion();
        $sql = "DELETE FROM contacto_empresa WHERE id_contacto = {$id}";
        return $conexion->eliminar($sql);
    }

    public static function listarEmpresas() {
        $conexion = new Conexion();
        $sql = "SELECT id_contacto, contacto_valor FROM contacto_empresa ORDER BY contacto_valor ASC";
        return $conexion->consultar($sql);
    }
}
