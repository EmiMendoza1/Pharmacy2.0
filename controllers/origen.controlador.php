<?php
require_once('models/origen.php');

class OrigenControlador {
    public function index() {
        $origenes = Origen::listar();
        include('views/origen.php');
    }

    public function nuevo() {
        include('views/form_origen.php');
    }

    public function guardar() {
        $descri = $_POST['origen_descri'];
        Origen::insertar($descri);
        $this->index();
    }

    public function editar() {
        $id = $_GET['id'];
        $origen = Origen::buscarPorId($id);
        include('views/form_origen.php');
    }

    public function actualizar() {
        $id = $_POST['id_origen'];
        $descri = $_POST['origen_descri'];
        Origen::actualizar($id, $descri);
        $this->index();
    }

    public function eliminar() {
        $id = $_GET['id'];
        Origen::eliminar($id);
        $this->index();
    }
}
?>
