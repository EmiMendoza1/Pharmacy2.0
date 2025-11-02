<?php
require_once "models/Venta.php";
require_once "models/DetalleVenta.php";

class VentaControlador {
    public static function listar() {
        return Venta::listar();
    }
    public static function obtener($id) {
        return Venta::obtenerPorId($id);
    }
    public static function guardar($data, $detalles) {
        // Si no se seleccionó cliente, usar el cliente genérico
        $cliente_id = $data['cliente_id'];
        if (empty($cliente_id)) {
            // Buscar el cliente genérico (por ejemplo, id_cliente = 1)
            require_once 'models/clientes.php';
            $clienteGenerico = Cliente::obtenerClienteGenerico();
            $cliente_id = $clienteGenerico ? $clienteGenerico['id_cliente'] : 1;
        }
        // Guardar venta y sus detalles
        $venta = new Venta(null, $data['fecha'], $cliente_id, $data['total']);
        // Si se ingresó nombre manual, guardarlo en la venta (requiere campo en BD)
        if (!empty($data['cliente_manual'])) {
            $venta->cliente_manual = $data['cliente_manual'];
        }
        $venta->guardar();
        foreach ($detalles as $detalle) {
            $id_producto = isset($detalle['id']) ? $detalle['id'] : null;
            $cantidad = isset($detalle['cantidad']) ? $detalle['cantidad'] : 0;
            $precio_unitario = isset($detalle['precio']) ? $detalle['precio'] : 0;
            $subtotal = isset($detalle['subtotal']) ? $detalle['subtotal'] : 0;
            $d = new DetalleVenta(null, $venta->id, $id_producto, $cantidad, $precio_unitario, $subtotal);
            $d->guardar();
        }
        return $venta;
    }
        public static function nuevo() {
            require_once 'models/producto.php';
            require_once 'models/clientes.php';
            require_once 'models/Mediopago.php';
            $productos = Producto::listar();
            $clientes = Cliente::obtenerClientes();
            $mediopagos = MedioPago::listar();
            require 'views/form_venta.php';
        }
    public static function actualizar($id, $data, $detalles) {
        $venta = Venta::obtenerPorId($id);
        if ($venta) {
            $venta->fecha = $data['fecha'];
            $venta->cliente_id = $data['cliente_id'];
            $venta->total = $data['total'];
            $venta->actualizar();
            // Actualizar detalles (simplificado)
            // ...
            return $venta;
        }
        return null;
    }
    public static function eliminar($id) {
        // Eliminar detalles primero
        require_once 'models/conexion.php';
        $conexion = new Conexion();
        $conexion->eliminar("DELETE FROM detalle_venta WHERE venta_id = {$id}");
        // Eliminar venta
        return Venta::eliminar($id);
    }

    public static function editar() {
        // Obtener datos de la venta
        $id = $_GET['id'] ?? null;
        if (!$id) return;
        $venta = Venta::obtenerPorId($id);
        // Obtener detalles
        $detalles = DetalleVenta::listarPorVenta($id);
    // Obtener productos, clientes y medios de pago para el formulario
    require_once 'models/producto.php';
    require_once 'models/clientes.php';
    require_once 'models/Mediopago.php';
    $productos = Producto::listar();
    $clientes = Cliente::obtenerClientes();
    $mediopagos = MedioPago::listar();
    require 'views/form_venta.php';
    }
    public static function listarDetalles($venta_id) {
        return DetalleVenta::listarPorVenta($venta_id);
    }
}
