<?php
require_once __DIR__ . '/../models/Caja.php';
require_once __DIR__ . '/../models/MovimientoCaja.php';
require_once __DIR__ . '/../models/usuarios.php';

class CajaControlador {
    public static function index(){
        $modelo = new Caja();
        $resultado = $modelo->listar();
        $cajas = [];
        if ($resultado && $resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) $cajas[] = $row;
        }
        include 'views/caja.php';
    }

    public static function nuevo(){
        include 'views/form_apertura_caja.php';
    }

    // Devuelve el id de persona asociado al usuario en sesión o 0 si no hay match
    private static function getSessionPersona(){
        $usuario_persona = 0;
        if (isset($_SESSION['rela_persona'])) {
            $usuario_persona = intval($_SESSION['rela_persona']);
            return $usuario_persona;
        }
        if (isset($_SESSION['nombre_usuario'])) {
            $u = new Usuario();
            $u->setNombre_usuario($_SESSION['nombre_usuario']);
            $res = $u->validar_usuario();
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $usuario_persona = intval($row['rela_persona'] ?? 0);
            }
        }
        return $usuario_persona;
    }

    public static function guardar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $modelo = new Caja();
            $usuario_persona = self::getSessionPersona();
            $data = [
                'caja_nombre' => $_POST['caja_nombre'] ?? 'Caja Principal',
                'usuario_apertura' => $usuario_persona,
                'apertura_monto' => $_POST['apertura_monto'] ?? 0
            ];
            $id = $modelo->abrir($data);
            header('Location: index.php?page=caja&action=index');
            exit;
        }
    }

    public static function ver($id){
        $modelo = new Caja();
        $id = intval($id);
        $caja = $modelo->obtener($id);
        if (!$caja) {
            header('Location: index.php?page=caja&action=index');
            exit;
        }

        $movModel = new MovimientoCaja();
        $movimientos = [];
        $res = $movModel->listarPorCaja($id);
        if ($res && $res->num_rows > 0) {
            while($r = $res->fetch_assoc()) $movimientos[] = $r;
        }

        include 'views/ver_caja.php';
    }

    public static function movimientoGuardar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $movModel = new MovimientoCaja();
            $creador = self::getSessionPersona();
            $data = [
                'rela_caja' => $_POST['rela_caja'] ?? 0,
                'tipo' => $_POST['tipo'] ?? 'ingreso',
                'monto' => $_POST['monto'] ?? 0,
                'forma_pago' => $_POST['forma_pago'] ?? 'efectivo',
                'descripcion' => $_POST['descripcion'] ?? '',
                'creado_por' => $creador
            ];
            $movModel->crear($data);
            header('Location: index.php?page=caja&action=ver&id=' . intval($_POST['rela_caja']));
            exit;
        }
    }

    public static function cerrar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $modelo = new Caja();
            $id = intval($_POST['id_caja'] ?? 0);

            // 1) Verificar que la caja exista y esté abierta
            $caja = $modelo->obtener($id);
            if (!$caja) {
                header('Location: index.php?page=caja&action=index');
                exit;
            }
            if (($caja['estado'] ?? '') !== 'abierta') {
                $err = 'La caja no está en estado abierta y no puede cerrarse.';
                header('Location: index.php?page=caja&action=ver&id=' . $id . '&error=' . urlencode($err));
                exit;
            }

            // 2) Validar monto enviado
            $cierre_monto = floatval($_POST['cierre_monto'] ?? 0);
            if ($cierre_monto < 0) {
                $err = 'El monto de cierre debe ser mayor o igual a 0.';
                header('Location: index.php?page=caja&action=ver&id=' . $id . '&error=' . urlencode($err));
                exit;
            }

            // 3) Calcular monto esperado = apertura + (sum movimientos)
            $apertura = floatval($caja['apertura_monto'] ?? 0);
            $movModel = new MovimientoCaja();
            $res = $movModel->listarPorCaja($id);
            $sum = 0.0;
            if ($res && $res->num_rows > 0) {
                while($r = $res->fetch_assoc()){
                    $monto = floatval($r['monto'] ?? 0);
                    $tipo = $r['tipo'] ?? 'ingreso';
                    if ($tipo === 'ingreso') $sum += $monto; else $sum -= $monto;
                }
            }
            $expected = round($apertura + $sum, 2);
            $submitted = round($cierre_monto, 2);
            // permitir una pequeña tolerancia por redondeo
            if (abs($submitted - $expected) > 0.01) {
                $err = 'El monto de cierre no coincide con el cálculo real. Monto esperado: ' . number_format($expected, 2);
                header('Location: index.php?page=caja&action=ver&id=' . $id . '&error=' . urlencode($err));
                exit;
            }

            // 4) Si pasó validaciones, proceder a cierre
            $usuario_persona = self::getSessionPersona();

            $data = [
                'usuario_cierre' => $usuario_persona,
                'cierre_monto' => $cierre_monto
            ];
            $modelo->cerrar($id, $data);
            header('Location: index.php?page=caja&action=index');
            exit;
        }
    }
}

?>
