<?php
require_once __DIR__ . '/conexion.php';

class Caja {
    private $db;

    public function __construct(){
        $this->db = new Conexion();
    }

    public function listar(){
        $sql = "SELECT * FROM caja ORDER BY apertura_fecha DESC";
        return $this->db->consultar($sql);
    }

    public function obtener($id){
        $id = intval($id);
        $sql = "SELECT * FROM caja WHERE id_caja = {$id} LIMIT 1";
        $res = $this->db->consultar($sql);
        if ($res && $res->num_rows > 0) return $res->fetch_assoc();
        return null;
    }

    public function abrir($data){
        $nombre = addslashes($data['caja_nombre'] ?? 'Caja Principal');
        $usuario = intval($data['usuario_apertura'] ?? 0);
        $monto = number_format(floatval($data['apertura_monto'] ?? 0), 2, '.', '');
        // Si no hay usuario válido, insertar NULL en usuario_apertura
        $usuario_sql = $usuario > 0 ? $usuario : 'NULL';
        $sql = "INSERT INTO caja (caja_nombre, usuario_apertura, apertura_monto) VALUES ('{$nombre}', {$usuario_sql}, {$monto})";
        $id = $this->db->insertar($sql);

        // Insertar auditoría de apertura
        $detalle = addslashes("Apertura monto: {$monto}");
        $usuario_audit = $usuario > 0 ? $usuario : 'NULL';
        $sqlAudit = "INSERT INTO caja_auditoria (entidad, entidad_id, accion, detalle, usuario_id) VALUES ('caja', {$id}, 'abrir', '{$detalle}', {$usuario_audit})";
        $this->db->insertar($sqlAudit);

        return $id;
    }

    public function cerrar($id, $data){
        $id = intval($id);
        $usuario_cierre = intval($data['usuario_cierre'] ?? 0);
        $cierre_monto = number_format(floatval($data['cierre_monto'] ?? 0), 2, '.', '');
        $usuario_cierre_sql = $usuario_cierre > 0 ? $usuario_cierre : 'NULL';
        $sql = "UPDATE caja SET usuario_cierre={$usuario_cierre_sql}, cierre_fecha=NOW(), cierre_monto={$cierre_monto}, estado='cerrada' WHERE id_caja={$id}";
        $res = $this->db->actualizar($sql);

        if ($res) {
            // Insertar auditoría de cierre
            $detalle = addslashes("Cierre monto: {$cierre_monto}");
            $usuario_audit = $usuario_cierre > 0 ? $usuario_cierre : 'NULL';
            $sqlAudit = "INSERT INTO caja_auditoria (entidad, entidad_id, accion, detalle, usuario_id) VALUES ('caja', {$id}, 'cerrar', '{$detalle}', {$usuario_audit})";
            $this->db->insertar($sqlAudit);
        }

        return $res;
    }
}

?>
