<?php
require_once('models/tipo_producto.php');

class TipoProductoControlador {
    public function index() {
        $tipos = TipoProducto::listar();
        include('views/tipo_producto.php');
    }

    public function nuevo() {
        include('views/form_tipo_producto.php');
    }

    public function guardar() {
        $descri = $_POST['tipo_producto_descri'];
        TipoProducto::insertar($descri);
        $this->index();
    }

    public function editar() {
        $id = $_GET['id'];
        $tipo = TipoProducto::buscarPorId($id);
        include('views/form_tipo_producto.php');
    }

    public function actualizar() {
        $id = $_POST['id_tipo_producto'];
        $descri = $_POST['tipo_producto_descri'];
        TipoProducto::actualizar($id, $descri);
        $this->index();
    }

    public function eliminar() {
        $id = $_GET['id'];
        TipoProducto::eliminar($id);
        $this->index();
    }
}
?>
