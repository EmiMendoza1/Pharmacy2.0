<?php
class Venta {
    public $id;
    public $fecha;
    public $cliente_id;
    public $total;
    public $cliente_manual;

    public function __construct($id = null, $fecha = null, $cliente_id = null, $total = null) {
    $this->id = $id;
    $this->fecha = $fecha;
    $this->cliente_id = $cliente_id;
    $this->total = $total;
    $this->cliente_manual = null;
    }

    public static function listar() {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $sql = "SELECT v.id, v.fecha, v.cliente_id, v.total, p.persona_nombre, p.persona_apellido FROM venta v INNER JOIN cliente c ON v.cliente_id = c.id_cliente INNER JOIN persona p ON c.rela_persona = p.id_persona ORDER BY v.id DESC";
        return $conexion->consultar($sql);
    }
    public static function obtenerPorId($id) {
        // ...implementación para obtener venta por id...
    }
    public function guardar() {
    require_once 'conexion.php';
    $conexion = new Conexion();
    $fecha = addslashes($this->fecha);
    $cliente_id = intval($this->cliente_id);
    $total = floatval($this->total);
    $cliente_manual = $this->cliente_manual ? "'" . addslashes($this->cliente_manual) . "'" : 'NULL';
    $sql = "INSERT INTO venta (fecha, cliente_id, total, cliente_manual) VALUES ('{$fecha}', {$cliente_id}, {$total}, {$cliente_manual})";
    $this->id = $conexion->insertar($sql);
    return $this->id;
    }
    public function actualizar() {
        // ...implementación para actualizar venta...
    }
    public static function eliminar($id) {
        // ...implementación para eliminar venta...
    }
}
