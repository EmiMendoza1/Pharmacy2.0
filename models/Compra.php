<?php
require_once __DIR__ . '/conexion.php';

class Compra {
    private $db;

    public function __construct(){
        $this->db = new Conexion();
    }

    public function listar(){
        $sql = "SELECT * FROM compras ORDER BY compra_fecha DESC";
        return $this->db->consultar($sql);
    }

    public function obtener($id){
        $id = intval($id);
        $sql = "SELECT * FROM compras WHERE id_compra = {$id} LIMIT 1";
        $res = $this->db->consultar($sql);
        if ($res && $res->num_rows > 0) {
            return $res->fetch_assoc();
        }
        return null;
    }

    public function crear($data){
        $fecha = $data['compra_fecha'] ?? date('Y-m-d H:i:s');
        $total = intval($data['compra_total'] ?? 0);
        $estado = addslashes($data['compra_estado'] ?? 'pendiente');
        $proveedor = intval($data['rela_proveedor'] ?? 0);

    // Si no se pasa detalle de compra, insertar NULL en rela_detalle_compra
    $sql = "INSERT INTO compras (compra_fecha, compra_total, compra_estado, rela_proveedor, rela_detalle_compra) VALUES ('{$fecha}', {$total}, '{$estado}', {$proveedor}, NULL)";
        return $this->db->insertar($sql); // retorna id insertado
    }

    public function actualizar($id, $data){
        $id = intval($id);
        $fecha = $data['compra_fecha'] ?? date('Y-m-d H:i:s');
        $total = intval($data['compra_total'] ?? 0);
        $estado = isset($data['compra_estado']) ? addslashes($data['compra_estado']) : '';
        $proveedor = intval($data['rela_proveedor'] ?? 0);

        $sql = "UPDATE compras SET compra_fecha = '{$fecha}', compra_total = {$total}, compra_estado = '{$estado}', rela_proveedor = {$proveedor} WHERE id_compra = {$id}";
        return $this->db->actualizar($sql);
    }

    public function eliminar($id){
        $id = intval($id);
        $sql = "DELETE FROM compras WHERE id_compra = {$id}";
        return $this->db->eliminar($sql);
    }
}


?>
