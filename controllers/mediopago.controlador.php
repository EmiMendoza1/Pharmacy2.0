<?php
require_once 'models/Mediopago.php';
class MedioPagoControlador {
    public static function index() {
        $medios = MedioPago::listar();
        require 'views/mediopago.php';
    }
    public static function nuevo() {
        require 'views/form_mediopago.php';
    }
    public static function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['mediopago_tipo'] ?? '';
            $medio = new MedioPago(null, $tipo);
            $medio->guardar();
            header('Location: index.php?page=mediopago');
            exit;
        }
    }
    public static function editar($id) {
        $medio = MedioPago::obtenerPorId($id);
        require 'views/form_mediopago.php';
    }
    public static function actualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['mediopago_tipo'] ?? '';
            $medio = new MedioPago($id, $tipo);
            $medio->actualizar();
            header('Location: index.php?page=mediopago');
            exit;
        }
    }
    public static function eliminar($id) {
        MedioPago::eliminar($id);
        header('Location: index.php?page=mediopago');
        exit;
    }
}
