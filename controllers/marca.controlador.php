<?php
require_once 'models/Marca.php';

class MarcaControlador {
    public function index() {
        $marcaModel = new Marca();
        $marcas = $marcaModel->listar();
        require 'views/marca.php';
    }

    public function nuevo() {
        require 'views/form_marca.php';
    }

    public function guardar() {
        if (isset($_POST['marca_descri'])) {
            $marcaModel = new Marca();
            $marcaModel->guardar($_POST['marca_descri']);
        }
        $this->index();
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $marcaModel = new Marca();
            $marcas = $marcaModel->listar();
            $marca = null;
            foreach ($marcas as $m) {
                if ($m['id_marca'] == $_GET['id']) {
                    $marca = $m;
                    break;
                }
            }
            require 'views/form_marca.php';
        }
    }

    public function actualizar() {
        if (isset($_POST['id_marca']) && isset($_POST['marca_descri'])) {
            $marcaModel = new Marca();
            $marcaModel->actualizar($_POST['id_marca'], $_POST['marca_descri']);
        }
        $this->index();
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $marcaModel = new Marca();
            $marcaModel->eliminar($_GET['id']);
        }
        $this->index();
    }
}
