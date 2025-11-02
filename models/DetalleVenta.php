<?php
class DetalleVenta {
    public $id;
    public $venta_id;
    public $producto_id;
    public $cantidad;
    public $precio_unitario;
    public $subtotal;

    public function __construct($id = null, $venta_id = null, $producto_id = null, $cantidad = null, $precio_unitario = null, $subtotal = null) {
        $this->id = $id;
        $this->venta_id = $venta_id;
        $this->producto_id = $producto_id;
        $this->cantidad = $cantidad;
        $this->precio_unitario = $precio_unitario;
        $this->subtotal = $subtotal;
    }

    public static function listarPorVenta($venta_id) {
        // ...implementación para listar detalles de una venta...
    }
    public function guardar() {
        // ...implementación para guardar detalle de venta...
    }
    public function actualizar() {
        // ...implementación para actualizar detalle de venta...
    }
    public static function eliminar($id) {
        // ...implementación para eliminar detalle de venta...
    }
}
