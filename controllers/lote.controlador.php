<?php
require_once 'models/lotes.php';
require_once 'models/producto.php';

class LoteControlador {
    public function index() {
        $lotes = Lote::obtenerLotes();
        require 'views/lote.php';
    }

    public function nuevo() {
        $productos = Producto::obtenerProductos();
        require 'views/form_lote.php';
    }

    public function guardar() {
        $data = [
            'rela_producto' => $_POST['rela_producto'] ?? '',
            'cantidadxlote' => $_POST['cantidadxlote'] ?? '',
            'lote_codigo' => $_POST['lote_codigo'] ?? '',
            'lote_vencimiento' => $_POST['lote_vencimiento'] ?? '',
        ];
        Lote::insertar($data);
        echo "<script>window.location.href='index.php?page=lote';</script>";
    }

    public function editar() {
        $id_lote = $_GET['id'] ?? null;
        if ($id_lote) {
            $lote = Lote::obtenerPorId($id_lote);
            $productos = Producto::obtenerProductos();
            require 'views/form_lote.php';
        } else {
            echo "<script>window.location.href='index.php?page=lote';</script>";
        }
    }

    public function actualizar() {
        $id_lote = $_POST['id_lote'] ?? null;
        $data = [
            'rela_producto' => $_POST['rela_producto'] ?? '',
            'cantidadxlote' => $_POST['cantidadxlote'] ?? '',
            'lote_codigo' => $_POST['lote_codigo'] ?? '',
            'lote_vencimiento' => $_POST['lote_vencimiento'] ?? '',
        ];
        Lote::actualizar($id_lote, $data);
        echo "<script>window.location.href='index.php?page=lote';</script>";
    }

    public function eliminar() {
        $id_lote = $_GET['id'] ?? null;
        if ($id_lote) {
            Lote::eliminar($id_lote);
        }
        echo "<script>window.location.href='index.php?page=lote';</script>";
    }
}
