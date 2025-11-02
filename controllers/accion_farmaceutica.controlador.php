<?php
require_once 'models/AccionFarmaceutica.php';

class AccionFarmaceuticaControlador {
    public function index() {
        $accionModel = new AccionFarmaceutica();
        $acciones = $accionModel->listar();
        require 'views/accion_farmaceutica.php';
    }

    public function nuevo() {
        require 'views/form_accion_farmaceutica.php';
    }

    public function guardar() {
        if (isset($_POST['accion_farmaceutica_descri'])) {
            $accionModel = new AccionFarmaceutica();
            $accionModel->insertar($_POST['accion_farmaceutica_descri']);
        }
        $this->index();
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $accionModel = new AccionFarmaceutica();
            $acciones = $accionModel->listar();
            $accion = null;
            foreach ($acciones as $a) {
                if ($a['id_accion_farmaceutica'] == $_GET['id']) {
                    $accion = $a;
                    break;
                }
            }
            require 'views/form_accion_farmaceutica.php';
        }
    }

    public function actualizar() {
        if (isset($_POST['id_accion_farmaceutica']) && isset($_POST['accion_farmaceutica_descri'])) {
            $accionModel = new AccionFarmaceutica();
            $accionModel->actualizar($_POST['id_accion_farmaceutica'], $_POST['accion_farmaceutica_descri']);
        }
        $this->index();
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $accionModel = new AccionFarmaceutica();
            $accionModel->eliminar($_GET['id']);
        }
        $this->index();
    }
}
