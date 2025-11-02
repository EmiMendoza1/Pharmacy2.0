<?php
require_once 'models/clientes.php';
require_once 'models/persona.php';

class ClienteControlador {
    public function index() {
    $clientes = Cliente::obtenerClientes();
    require 'views/listado_clientes.php';
    }

    public function nuevo() {
    $personas = Persona::obtenerPersonas();
    require 'views/form_cliente.php';
    }

    public function guardar() {
        $id_persona = $_POST['rela_persona'] ?? null;
        $estado = $_POST['cliente_estado'] ?? 'Activo';
        if ($id_persona) {
            Cliente::insertar($id_persona, $estado);
        }
        echo "<script>window.location.href='index.php?page=listado_clientes';</script>";
    }

    public function editar() {
        $id_cliente = $_GET['id'] ?? null;
        if ($id_cliente) {
            $cliente = Cliente::obtenerPorId($id_cliente);
            require 'views/form_editar_cliente.php';
        } else {
            echo "<script>window.location.href='index.php?page=cliente';</script>";
        }
    }

    public function actualizar() {
        $id_cliente = $_POST['id_cliente'] ?? null;
        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $dni = $_POST['dni'] ?? '';
        $direccion = $_POST['direccion'] ?? '';
        $fecha_nac = $_POST['fecha_nac'] ?? '';
        $sexo = $_POST['sexo'] ?? '';
        $estado = $_POST['cliente_estado'] ?? 'Activo';
        if ($id_cliente) {
            Cliente::actualizar($id_cliente, $nombre, $apellido, $dni, $direccion, $fecha_nac, $sexo, $estado);
        }
        echo "<script>window.location.href='index.php?page=cliente';</script>";
        exit;
    }

    public function eliminar() {
        $id_cliente = $_GET['id'] ?? null;
        if ($id_cliente) {
            Cliente::eliminar($id_cliente);
        }
        echo "<script>window.location.href='index.php?page=cliente';</script>";
        exit;
    }
}
