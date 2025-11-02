<?php
require_once __DIR__ . '/../models/Compra.php';

class CompraControlador {
    public static function index(){
        $modelo = new Compra();
        $compras = $modelo->listar();
        include 'views/compra.php';
    }

    public static function nuevo(){
        // Cargar proveedores para el select
        require_once __DIR__ . '/../models/proveedor.php';
        $resultado = Proveedor::listar();
        $proveedores = [];
        if ($resultado && $resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) $proveedores[] = $row;
        }
        include 'views/form_compra.php';
    }

    public static function guardar(){
        $modelo = new Compra();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = [
                'compra_fecha' => $_POST['compra_fecha'] ?? date('Y-m-d H:i:s'),
                'compra_total' => $_POST['compra_total'] ?? 0,
                'compra_estado' => $_POST['compra_estado'] ?? 'pendiente',
                'rela_proveedor' => $_POST['rela_proveedor'] ?? 0,
            ];
            $id = $modelo->crear($data);
            header('Location: index.php?page=compra&action=index');
            exit;
        }
    }

    public static function editar($id){
        $modelo = new Compra();
        $compra = $modelo->obtener($id);
        require_once __DIR__ . '/../models/proveedor.php';
        $resultado = Proveedor::listar();
        $proveedores = [];
        if ($resultado && $resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) $proveedores[] = $row;
        }
        include 'views/form_compra.php';
    }

    public static function actualizar($id){
        $modelo = new Compra();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = [
                'compra_fecha' => $_POST['compra_fecha'] ?? date('Y-m-d H:i:s'),
                'compra_total' => $_POST['compra_total'] ?? 0,
                'compra_estado' => $_POST['compra_estado'] ?? 'pendiente',
                'rela_proveedor' => $_POST['rela_proveedor'] ?? 0,
            ];
            $modelo->actualizar($id, $data);
            header('Location: index.php?page=compra&action=index');
            exit;
        }
    }

    public static function eliminar($id){
        $modelo = new Compra();
        $modelo->eliminar($id);
        header('Location: index.php?page=compra&action=index');
        exit;
    }
}

?>
?>
