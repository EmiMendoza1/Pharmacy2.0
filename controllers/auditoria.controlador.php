<?php
require_once __DIR__ . '/../models/conexion.php';

class AuditoriaControlador {
    public static function index(){
        $db = new Conexion();

        // Leer filtros desde GET y sanitizar
        $entidad = isset($_GET['entidad']) ? addslashes(trim($_GET['entidad'])) : '';
        $accion = isset($_GET['accion']) ? addslashes(trim($_GET['accion'])) : '';
        $usuario_id = isset($_GET['usuario_id']) ? intval($_GET['usuario_id']) : 0;
        $fecha_from = isset($_GET['fecha_from']) ? trim($_GET['fecha_from']) : '';
        $fecha_to = isset($_GET['fecha_to']) ? trim($_GET['fecha_to']) : '';

        $wheres = [];
        if ($entidad !== '') $wheres[] = "ca.entidad = '{$entidad}'";
        if ($accion !== '') $wheres[] = "ca.accion = '{$accion}'";
        if ($usuario_id > 0) $wheres[] = "ca.usuario_id = {$usuario_id}";
        // Validar fechas YYYY-MM-DD simple
        if ($fecha_from !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_from)) {
            $wheres[] = "ca.creado_en >= '{$fecha_from} 00:00:00'";
        }
        if ($fecha_to !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_to)) {
            $wheres[] = "ca.creado_en <= '{$fecha_to} 23:59:59'";
        }

        $where_sql = '';
        if (count($wheres) > 0) $where_sql = 'WHERE ' . implode(' AND ', $wheres);

        // Paginación
        $page = max(1, intval($_GET['page'] ?? 1));
        $limit = 50;
        $offset = ($page - 1) * $limit;

        // Total
        $countSql = "SELECT COUNT(*) AS c FROM caja_auditoria ca {$where_sql}";
        $countRes = $db->consultar($countSql);
        $total = 0;
        if ($countRes && $countRes->num_rows > 0) {
            $row = $countRes->fetch_assoc();
            $total = intval($row['c']);
        }

        $total_pages = ($total > 0) ? ceil($total / $limit) : 1;

        $sql = "SELECT ca.*, p.persona_nombre, p.persona_apellido FROM caja_auditoria ca LEFT JOIN persona p ON ca.usuario_id = p.id_persona {$where_sql} ORDER BY ca.creado_en DESC LIMIT {$limit} OFFSET {$offset}";
        $res = $db->consultar($sql);
        $auditorias = [];
        if ($res && $res->num_rows > 0) {
            while($r = $res->fetch_assoc()) $auditorias[] = $r;
        }

        // Pasar datos a la vista
        $filters = [
            'entidad' => $entidad,
            'accion' => $accion,
            'usuario_id' => $usuario_id,
            'fecha_from' => $fecha_from,
            'fecha_to' => $fecha_to,
        ];
        $pagination = [
            'page' => $page,
            'limit' => $limit,
            'total' => $total,
            'total_pages' => $total_pages,
        ];

        include 'views/auditoria.php';
    }
}

?>