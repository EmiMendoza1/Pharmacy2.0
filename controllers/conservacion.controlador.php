<?php
require_once 'models/conservacion.php';

class ConservacionControlador {
    public function index() {
        $conservaciones = Conservacion::obtenerConservaciones();
        require 'views/conservacion.php';
    }

    public function nuevo() {
        require 'views/form_conservacion.php';
    }

    public function guardar() {
        $data = [
            'conservacion_descri' => $_POST['conservacion_descri'] ?? ''
        ];
        Conservacion::insertar($data);
        echo "<script>window.location.href='index.php?page=conservacion';</script>";
    }

    public function editar() {
        $id_conservacion = $_GET['id'] ?? null;
        if ($id_conservacion) {
            $conservacion = Conservacion::obtenerPorId($id_conservacion);
            require 'views/form_conservacion.php';
        } else {
            echo "<script>window.location.href='index.php?page=conservacion';</script>";
        }
    }

    public function actualizar() {
        $id_conservacion = $_POST['id_conservacion'] ?? null;
        $data = [
            'conservacion_descri' => $_POST['conservacion_descri'] ?? ''
        ];
        Conservacion::actualizar($id_conservacion, $data);
        echo "<script>window.location.href='index.php?page=conservacion';</script>";
    }

    public function eliminar() {
        $id_conservacion = $_GET['id'] ?? null;
        if ($id_conservacion) {
            Conservacion::eliminar($id_conservacion);
        }
        echo "<script>window.location.href='index.php?page=conservacion';</script>";
    }
}
