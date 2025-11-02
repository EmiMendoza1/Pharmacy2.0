<?php
require_once 'models/Forma.php';

class FormaControlador {
    public function index() {
        $formaModel = new Forma();
        $formas = $formaModel->listar();
        require 'views/forma.php';
    }

    public function nuevo() {
        require 'views/form_forma.php';
    }

    public function guardar() {
        if (isset($_POST['forma_descri'])) {
            $formaModel = new Forma();
            $formaModel->guardar($_POST['forma_descri']);
        }
        $this->index();
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $formaModel = new Forma();
            $formas = $formaModel->listar();
            $forma = null;
            foreach ($formas as $f) {
                if ($f['id_forma'] == $_GET['id']) {
                    $forma = $f;
                    break;
                }
            }
            require 'views/form_forma.php';
        }
    }

    public function actualizar() {
        if (isset($_POST['id_forma']) && isset($_POST['forma_descri'])) {
            $formaModel = new Forma();
            $formaModel->actualizar($_POST['id_forma'], $_POST['forma_descri']);
        }
        $this->index();
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $formaModel = new Forma();
            $formaModel->eliminar($_GET['id']);
        }
        $this->index();
    }
}
