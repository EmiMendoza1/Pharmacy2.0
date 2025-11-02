<?php
require_once(__DIR__ . '/../models/Droga.php');

class DrogaControlador {
    public function index() {
        $drogaModel = new Droga();
        $drogas = $drogaModel->listar();
        include(__DIR__ . '/../views/droga.php');
    }

    public function nuevo() {
        include(__DIR__ . '/../views/form_droga.php');
    }

    public function guardar() {
        if (isset($_POST['droga_descri'])) {
            $drogaModel = new Droga();
            $drogaModel->guardar($_POST['droga_descri']);
            header('Location: index.php?page=droga&message=Droga+creada+correctamente&status=success');
            exit;
        }
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $drogaModel = new Droga();
            $droga = $drogaModel->obtenerPorId($_GET['id']);
            include(__DIR__ . '/../views/form_droga.php');
        }
    }

    public function actualizar() {
        if (isset($_POST['id_droga']) && isset($_POST['droga_descri'])) {
            $drogaModel = new Droga();
            $drogaModel->actualizar($_POST['id_droga'], $_POST['droga_descri']);
            header('Location: index.php?page=droga&message=Droga+actualizada+correctamente&status=success');
            exit;
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $drogaModel = new Droga();
            $drogaModel->eliminar($_GET['id']);
            header('Location: index.php?page=droga&message=Droga+eliminada+correctamente&status=success');
            exit;
        }
    }
}
