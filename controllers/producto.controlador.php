<?php
require_once "models/producto.php";

class ProductoControlador {

    // Mostrar listado de productos
    public function index() {
        $resultado = Producto::listar();
        include "views/producto.php";
    }

    // Mostrar formulario de nuevo producto
    public function nuevo() {
        include "views/form_producto.php";
    }

    // Guardar nuevo producto
    public function guardar() {
        $data = [
            "producto_nombre"        => $_POST['producto_nombre'],
            "producto_codigobarra"   => $_POST['producto_codigobarra'],
            "producto_preciounitario"=> $_POST['producto_preciounitario'],
            "producto_cantidad"      => $_POST['producto_cantidad'],
            "producto_cantidadmin"   => $_POST['producto_cantidadmin'],
            "producto_descripcion"   => $_POST['producto_descripcion'],
            "producto_fecha_alta"    => date("Y-m-d"),
            "producto_estado"        => $_POST['producto_estado'],
            "producto_cod_nroregistro"=> $_POST['producto_cod_nroregistro'] ?? null,
            "producto_potencia"      => $_POST['producto_potencia'] ?? null,
            "producto_presentacion"  => $_POST['producto_presentacion'] ?? null,
            "rela_tipoproducto"      => $_POST['rela_tipoproducto'],
            "rela_tipoventa"         => $_POST['rela_tipoventa'],
            "rela_alfabeta"          => $_POST['rela_alfabeta'],
            "rela_accion_farmaceutica"=> $_POST['rela_accion_farmaceutica'] ?? null,
            "rela_categoria"         => $_POST['rela_categoria'] ?? null,
            "rela_marca"             => $_POST['rela_marca'] ?? null,
            "rela_droga"             => $_POST['rela_droga'] ?? null,
            "rela_forma"             => $_POST['rela_forma'] ?? null,
            "rela_metodo_administracion"=> $_POST['rela_metodo_administracion'] ?? null,
            "rela_origen"            => $_POST['rela_origen'] ?? null,
            "rela_laboratorio"       => $_POST['rela_laboratorio'] ?? null,
            "rela_conservacion"      => $_POST['rela_conservacion'] ?? null
        ];

        Producto::insertar($data);
        $this->index();
    }

    // Mostrar formulario de edición
    public function editar() {
        $id = $_GET['id'];
        $producto = Producto::buscarPorId($id);
        include "views/form_editar_producto.php";
    }

    // Actualizar un producto
    public function actualizar() {
        $id = $_POST['id_producto'];
        $data = [
            "producto_nombre"        => $_POST['producto_nombre'],
            "producto_codigobarra"   => $_POST['producto_codigobarra'],
            "producto_preciounitario"=> $_POST['producto_preciounitario'],
            "producto_cantidad"      => $_POST['producto_cantidad'],
            "producto_cantidadmin"   => $_POST['producto_cantidadmin'],
            "producto_descripcion"   => $_POST['producto_descripcion'],
            "producto_estado"        => $_POST['producto_estado'],
            "producto_cod_nroregistro"=> $_POST['producto_cod_nroregistro'] ?? null,
            "producto_potencia"      => $_POST['producto_potencia'] ?? null,
            "producto_presentacion"  => $_POST['producto_presentacion'] ?? null,
            "rela_tipoproducto"      => $_POST['rela_tipoproducto'],
            "rela_tipoventa"         => $_POST['rela_tipoventa'],
            "rela_alfabeta"          => $_POST['rela_alfabeta'],
            "rela_accion_farmaceutica"=> $_POST['rela_accion_farmaceutica'] ?? null,
            "rela_categoria"         => $_POST['rela_categoria'] ?? null,
            "rela_marca"             => $_POST['rela_marca'] ?? null,
            "rela_droga"             => $_POST['rela_droga'] ?? null,
            "rela_forma"             => $_POST['rela_forma'] ?? null,
            "rela_metodo_administracion"=> $_POST['rela_metodo_administracion'] ?? null,
            "rela_origen"            => $_POST['rela_origen'] ?? null,
            "rela_laboratorio"       => $_POST['rela_laboratorio'] ?? null,
            "rela_conservacion"      => $_POST['rela_conservacion'] ?? null
        ];

        Producto::actualizar($id, $data);
        $this->index();
    }

    // Eliminar producto
    public function eliminar() {
        $id = $_GET['id'];
        Producto::eliminar($id);
        $this->index();
    }
}