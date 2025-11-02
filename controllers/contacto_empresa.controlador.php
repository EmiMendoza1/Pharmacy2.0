<?php
require_once "models/contacto_empresa.php";

class ContactoEmpresaControlador {
    public static function index() {
        $resultado = ContactoEmpresa::listar();
        $contactos = [];
        while ($row = $resultado->fetch_assoc()) {
            $contactos[] = $row;
        }
        include "views/contacto_empresa.php";
    }

    public static function nuevo() {
        include "views/form_contacto_empresa.php";
    }

    public static function guardar() {
        $contacto = new ContactoEmpresa(
            null,
            $_POST['contacto_valor'],
            $_POST['rela_tipo_contacto'],
            $_POST['rela_proveedor']
        );
        $contacto->guardar();
        header("Location: index.php?page=contacto_empresa");
    }

    public static function editar() {
        $id = $_GET['id'];
        $data = ContactoEmpresa::obtenerPorId($id);
        include "views/form_contacto_empresa.php";
    }

    public static function actualizar() {
        $contacto = new ContactoEmpresa(
            $_POST['id_contacto'],
            $_POST['contacto_valor'],
            $_POST['rela_tipo_contacto'],
            $_POST['rela_proveedor']
        );
        $contacto->actualizar();
        header("Location: index.php?page=contacto_empresa");
    }

    public static function eliminar() {
        $id = $_GET['id'];
        ContactoEmpresa::eliminar($id);
        header("Location: index.php?page=contacto_empresa");
    }
}
