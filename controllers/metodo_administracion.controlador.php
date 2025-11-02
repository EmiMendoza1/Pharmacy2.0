<?php
require_once 'models/MetodoAdministracion.php';

class MetodoAdministracionControlador {
    public function index() {
        $metodoModel = new MetodoAdministracion();
        $metodos = $metodoModel->listar();
        require 'views/metodo_administracion.php';
    }

    public function nuevo() {
        require 'views/form_metodo_administracion.php';
    }

    public function guardar() {
        if (isset($_POST['metodo_administracion_descri'])) {
            $metodoModel = new MetodoAdministracion();
            $metodoModel->guardar($_POST['metodo_administracion_descri']);
        }
        $this->index();
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $metodoModel = new MetodoAdministracion();
            $metodos = $metodoModel->listar();
            $metodo = null;
            foreach ($metodos as $m) {
                if ($m['id_metodo'] == $_GET['id']) {
                    $metodo = $m;
                    break;
                }
            }
            require 'views/form_metodo_administracion.php';
        }
    }

    public function actualizar() {
        if (isset($_POST['id_metodo']) && isset($_POST['metodo_administracion_descri'])) {
            $metodoModel = new MetodoAdministracion();
            $metodoModel->actualizar($_POST['id_metodo'], $_POST['metodo_administracion_descri']);
        }
        $this->index();
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $metodoModel = new MetodoAdministracion();
            $metodoModel->eliminar($_GET['id']);
        }
        $this->index();
    }
}
