<?php
require_once('models/laboratorio.php');

class LaboratorioControlador {
    public function index() {
        $laboratorios = Laboratorio::listar();
        include('views/laboratorio.php');
    }

    public function nuevo() {
        include('views/form_laboratorio.php');
    }

    public function guardar() {
        $descri = $_POST['laboratorio_descri'];
        Laboratorio::insertar($descri);
        $this->index();
    }

    public function editar() {
        $id = $_GET['id'];
        $laboratorio = Laboratorio::buscarPorId($id);
        include('views/form_laboratorio.php');
    }

    public function actualizar() {
        $id = $_POST['id_laboratorio'];
        $descri = $_POST['laboratorio_descri'];
        Laboratorio::actualizar($id, $descri);
        $this->index();
    }

    public function eliminar() {
        $id = $_GET['id'];
        Laboratorio::eliminar($id);
        $this->index();
    }
}
?>
