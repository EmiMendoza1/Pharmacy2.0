<?php
require_once('models/tipo_contacto.php');

class TipoContactoControlador {
    public function index() {
        $tipos = TipoContacto::listar();
        include('views/tipo_contacto.php');
    }

    public function nuevo() {
        include('views/form_tipo_contacto.php');
    }

    public function guardar() {
        $nombre = $_POST['tipo_contacto_nombre'];
        TipoContacto::insertar($nombre);
        $this->index();
    }

    public function editar() {
        $id = $_GET['id'];
        $tipo = TipoContacto::buscarPorId($id);
        include('views/form_tipo_contacto.php');
    }

    public function actualizar() {
        $id = $_POST['id_tipo_contacto'];
        $nombre = $_POST['tipo_contacto_nombre'];
        TipoContacto::actualizar($id, $nombre);
        $this->index();
    }

    public function eliminar() {
        $id = $_GET['id'];
        TipoContacto::eliminar($id);
        $this->index();
    }
}
?>
