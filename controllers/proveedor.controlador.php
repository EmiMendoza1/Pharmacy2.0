<?php
require_once "models/proveedor.php";
require_once "models/persona.php";

class ProveedorControlador {
    public static function index() {
        $resultado = Proveedor::listar();
        $proveedores = [];
        while ($row = $resultado->fetch_assoc()) {
            // Obtener nombre de la persona relacionada si existe
            $personaNombre = '';
            if (!empty($row['rela_persona'])) {
                $persona = Persona::obtenerPorId($row['rela_persona']);
                if ($persona) {
                    $personaNombre = trim(($persona['persona_apellido'] ?? '') . ' ' . ($persona['persona_nombre'] ?? ''));
                }
            }
            $row['persona_nombre'] = $personaNombre;
            $proveedores[] = $row;
        }
        include "views/proveedor.php";
    }

    public static function nuevo() {
        include "views/form_proveedor.php";
    }

    public static function guardar() {
        $proveedor = new Proveedor(
            null,
            $_POST['prov_estado'],
            $_POST['prov_direccion'],
            $_POST['prov_nombre_empresa'],
            $_POST['rela_persona']
        );
        $proveedor->guardar();
    header("Location: index.php?page=proveedores");
    }

    public static function editar() {
        $id = $_GET['id'];
        $data = Proveedor::obtenerPorId($id);
        include "views/form_proveedor.php";
    }

    public static function actualizar() {
        $proveedor = new Proveedor(
            $_POST['id_proveedor'],
            $_POST['prov_estado'],
            $_POST['prov_direccion'],
            $_POST['prov_nombre_empresa'],
            $_POST['rela_persona']
        );
        $proveedor->actualizar();
    header("Location: index.php?page=proveedores");
    }

    public static function eliminar() {
        $id = $_GET['id'];
        Proveedor::eliminar($id);
    header("Location: index.php?page=proveedores");
    }
}
