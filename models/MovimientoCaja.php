<?php
require_once __DIR__ . '/conexion.php';

class MovimientoCaja {
    private $db;

    public function __construct(){
        $this->db = new Conexion();
    }

    public function listarPorCaja($id_caja){
        $id = intval($id_caja);
        $sql = "SELECT mc.*, p.persona_nombre, p.persona_apellido FROM movimiento_caja mc LEFT JOIN persona p ON mc.creado_por = p.id_persona WHERE mc.rela_caja = {$id} ORDER BY mc.creado_en DESC";
        return $this->db->consultar($sql);
    }

    public function crear($data){
        $rela_caja = intval($data['rela_caja'] ?? 0);
        $tipo = addslashes($data['tipo'] ?? 'ingreso');
        $monto = number_format(floatval($data['monto'] ?? 0), 2, '.', '');
        $forma = addslashes($data['forma_pago'] ?? 'efectivo');
        $descripcion = addslashes($data['descripcion'] ?? '');
        $creado_por = intval($data['creado_por'] ?? 0);
        $creado_por_sql = $creado_por > 0 ? $creado_por : 'NULL';

        $sql = "INSERT INTO movimiento_caja (rela_caja, tipo, monto, forma_pago, descripcion, creado_por) VALUES ({$rela_caja}, '{$tipo}', {$monto}, '{$forma}', '{$descripcion}', {$creado_por_sql})";
        $id = $this->db->insertar($sql);

        // Insertar auditoría del movimiento (detalle en JSON)
        $detalleArr = [
            'tipo' => $tipo,
            'monto' => $monto,
            'forma_pago' => $forma,
            'descripcion' => $descripcion
        ];
        $detalle = addslashes(json_encode($detalleArr));
        $usuario_audit = $creado_por > 0 ? $creado_por : 'NULL';
        $sqlAudit = "INSERT INTO caja_auditoria (entidad, entidad_id, accion, detalle, usuario_id) VALUES ('movimiento_caja', {$id}, 'crear', '{$detalle}', {$usuario_audit})";
        $this->db->insertar($sqlAudit);

        return $id;
    }
}

?>
