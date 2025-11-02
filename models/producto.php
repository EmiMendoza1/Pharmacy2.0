<?php
require_once "conexion.php";

class Producto {

    // Listar todos los productos
    public static function listar() {
        $conexion = new Conexion();
    $query = "SELECT * FROM producto ORDER BY id_producto DESC";
        return $conexion->consultar($query);
    }

    // Alias para lotes
    public static function obtenerProductos() {
        return self::listar();
    }

    // Insertar un nuevo producto
    public static function insertar($data) {
        $conexion = new Conexion();

        $query = "INSERT INTO producto (
            producto_nombre, producto_codigobarra, producto_preciounitario, 
            producto_cantidad, producto_cantidadmin, producto_descripcion, 
            producto_fecha_alta, producto_estado, producto_cod_nroregistro, 
            producto_potencia, producto_presentacion, rela_tipoproducto, 
            rela_tipoventa, rela_alfabeta, rela_accion_farmaceutica, 
            rela_categoria, rela_marca, rela_droga, rela_forma, 
            rela_metodo_administracion, rela_origen, rela_laboratorio, 
            rela_conservacion
        ) VALUES (
            '{$data['producto_nombre']}', '{$data['producto_codigobarra']}', '{$data['producto_preciounitario']}',
            '{$data['producto_cantidad']}', '{$data['producto_cantidadmin']}', '{$data['producto_descripcion']}',
            '{$data['producto_fecha_alta']}', '{$data['producto_estado']}', " . 
            (empty($data['producto_cod_nroregistro']) ? "NULL" : "'{$data['producto_cod_nroregistro']}'") . ",
            " . (empty($data['producto_potencia']) ? "NULL" : "'{$data['producto_potencia']}'") . ",
            " . (empty($data['producto_presentacion']) ? "NULL" : "'{$data['producto_presentacion']}'") . ",
            '{$data['rela_tipoproducto']}', '{$data['rela_tipoventa']}', '{$data['rela_alfabeta']}',
            " . (empty($data['rela_accion_farmaceutica']) ? "NULL" : "'{$data['rela_accion_farmaceutica']}'") . ",
            " . (empty($data['rela_categoria']) ? "NULL" : "'{$data['rela_categoria']}'") . ",
            " . (empty($data['rela_marca']) ? "NULL" : "'{$data['rela_marca']}'") . ",
            " . (empty($data['rela_droga']) ? "NULL" : "'{$data['rela_droga']}'") . ",
            " . (empty($data['rela_forma']) ? "NULL" : "'{$data['rela_forma']}'") . ",
            " . (empty($data['rela_metodo_administracion']) ? "NULL" : "'{$data['rela_metodo_administracion']}'") . ",
            " . (empty($data['rela_origen']) ? "NULL" : "'{$data['rela_origen']}'") . ",
            " . (empty($data['rela_laboratorio']) ? "NULL" : "'{$data['rela_laboratorio']}'") . ",
            " . (empty($data['rela_conservacion']) ? "NULL" : "'{$data['rela_conservacion']}'") . "
        )";

        return $conexion->insertar($query);
    }

    // Buscar un producto por ID
    public static function buscarPorId($id) {
        $conexion = new Conexion();
        $query = "SELECT * FROM producto WHERE id_producto = $id";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    // Actualizar un producto
    public static function actualizar($id, $data) {
        $conexion = new Conexion();

        $query = "UPDATE producto SET 
            producto_nombre = '{$data['producto_nombre']}',
            producto_codigobarra = '{$data['producto_codigobarra']}',
            producto_preciounitario = '{$data['producto_preciounitario']}',
            producto_cantidad = '{$data['producto_cantidad']}',
            producto_cantidadmin = '{$data['producto_cantidadmin']}',
            producto_descripcion = '{$data['producto_descripcion']}',
            producto_estado = '{$data['producto_estado']}',
            producto_cod_nroregistro = " . (empty($data['producto_cod_nroregistro']) ? "NULL" : "'{$data['producto_cod_nroregistro']}'") . ",
            producto_potencia = " . (empty($data['producto_potencia']) ? "NULL" : "'{$data['producto_potencia']}'") . ",
            producto_presentacion = " . (empty($data['producto_presentacion']) ? "NULL" : "'{$data['producto_presentacion']}'") . ",
            rela_tipoproducto = '{$data['rela_tipoproducto']}',
            rela_tipoventa = '{$data['rela_tipoventa']}',
            rela_alfabeta = '{$data['rela_alfabeta']}',
            rela_accion_farmaceutica = " . (empty($data['rela_accion_farmaceutica']) ? "NULL" : "'{$data['rela_accion_farmaceutica']}'") . ",
            rela_categoria = " . (empty($data['rela_categoria']) ? "NULL" : "'{$data['rela_categoria']}'") . ",
            rela_marca = " . (empty($data['rela_marca']) ? "NULL" : "'{$data['rela_marca']}'") . ",
            rela_droga = " . (empty($data['rela_droga']) ? "NULL" : "'{$data['rela_droga']}'") . ",
            rela_forma = " . (empty($data['rela_forma']) ? "NULL" : "'{$data['rela_forma']}'") . ",
            rela_metodo_administracion = " . (empty($data['rela_metodo_administracion']) ? "NULL" : "'{$data['rela_metodo_administracion']}'") . ",
            rela_origen = " . (empty($data['rela_origen']) ? "NULL" : "'{$data['rela_origen']}'") . ",
            rela_laboratorio = " . (empty($data['rela_laboratorio']) ? "NULL" : "'{$data['rela_laboratorio']}'") . ",
            rela_conservacion = " . (empty($data['rela_conservacion']) ? "NULL" : "'{$data['rela_conservacion']}'") . "
        WHERE id_producto = $id";

        return $conexion->actualizar($query);
    }

    // Eliminar producto
    public static function eliminar($id) {
        $conexion = new Conexion();
        $query = "DELETE FROM producto WHERE id_producto = $id";
        return $conexion->actualizar($query);
    }
}