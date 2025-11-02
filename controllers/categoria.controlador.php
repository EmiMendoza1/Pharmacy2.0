<?php
require_once 'models/Categoria.php';

class CategoriaControlador {
    public function index() {
        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->listar();
        require 'views/categoria.php';
    }

    public function nuevo() {
        require 'views/form_categoria.php';
    }

    public function guardar() {
        if (isset($_POST['categoria_descri'])) {
            $categoriaModel = new Categoria();
            $categoriaModel->guardar($_POST['categoria_descri']);
        }
        $this->index();
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $categoriaModel = new Categoria();
            $categorias = $categoriaModel->listar();
            $categoria = null;
            foreach ($categorias as $c) {
                if ($c['id_categoria'] == $_GET['id']) {
                    $categoria = $c;
                    break;
                }
            }
            require 'views/form_categoria.php';
        }
    }

    public function actualizar() {
        if (isset($_POST['id_categoria']) && isset($_POST['categoria_descri'])) {
            $categoriaModel = new Categoria();
            $categoriaModel->actualizar($_POST['id_categoria'], $_POST['categoria_descri']);
        }
        $this->index();
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $categoriaModel = new Categoria();
            $categoriaModel->eliminar($_GET['id']);
        }
        $this->index();
    }
}
