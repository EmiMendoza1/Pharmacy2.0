<?php
require_once "conexion.php";

class Cliente {
    // Método para obtener el cliente genérico (anónimo)
    public static function obtenerClienteGenerico() {
    $conexion = new Conexion();
    // Buscar el cliente cuyo rela_persona apunte a una persona genérica
    // Suponiendo que existe una persona con nombre 'Genérico' en la tabla persona
    $sql = "SELECT c.* FROM cliente c INNER JOIN persona p ON c.rela_persona = p.id_persona WHERE p.persona_nombre = 'Genérico' LIMIT 1";
    $resultado = $conexion->consultar($sql);
    return $resultado ? $resultado->fetch_assoc() : null;
    }
    // Método estático para obtener todos los clientes
    public static function obtenerClientes() {
        $conexion = new Conexion();
    $sql = "SELECT c.id_cliente, c.cliente_fecha_alta, c.cliente_estado, 
               p.persona_nombre, p.persona_apellido
        FROM cliente c
        INNER JOIN persona p ON c.rela_persona = p.id_persona
        ORDER BY c.id_cliente DESC";

        $resultado = $conexion->consultar($sql);

        return $resultado;
    }

    // Método para insertar un cliente
    public static function insertar($id_persona, $estado = 'Activo') {
        $conexion = new Conexion();
        $id_persona = intval($id_persona);
        $estado = addslashes($estado);
        $sql = "INSERT INTO cliente (rela_persona, cliente_fecha_alta, cliente_estado) VALUES ({$id_persona}, NOW(), '{$estado}')";
        return $conexion->insertar($sql);
    }

    // Método para obtener un cliente por ID
    public static function obtenerPorId($id_cliente) {
        $conexion = new Conexion();
        $id_cliente = intval($id_cliente);
        $sql = "SELECT c.*, p.* FROM cliente c INNER JOIN persona p ON c.rela_persona = p.id_persona WHERE c.id_cliente = {$id_cliente}";
        $resultado = $conexion->consultar($sql);
        return $resultado->fetch_assoc();
    }

    // Método para actualizar un cliente
    public static function actualizar($id_cliente, $nombre, $apellido, $dni, $direccion, $fecha_nac, $sexo, $estado) {
        $conexion = new Conexion();
        $id_cliente = intval($id_cliente);
        $nombre = addslashes($nombre);
        $apellido = addslashes($apellido);
        $dni = addslashes($dni);
        $direccion = addslashes($direccion);
        $fecha_nac = addslashes($fecha_nac);
        $sexo = addslashes($sexo);
        $estado = addslashes($estado);
        // Actualiza persona
        $sql_persona = "UPDATE persona SET persona_nombre='{$nombre}', persona_apellido='{$apellido}', persona_dni='{$dni}', persona_direccion='{$direccion}', persona_fecha_nac='{$fecha_nac}', persona_sexo='{$sexo}' WHERE id_persona = (SELECT rela_persona FROM cliente WHERE id_cliente = {$id_cliente})";
        $conexion->actualizar($sql_persona);
        // Actualiza cliente
        $sql_cliente = "UPDATE cliente SET cliente_estado='{$estado}' WHERE id_cliente = {$id_cliente}";
        return $conexion->actualizar($sql_cliente);
    }

    // Método para eliminar un cliente
    public static function eliminar($id_cliente) {
        $conexion = new Conexion();
        $id_cliente = intval($id_cliente);
        // Elimina el cliente
        $sql = "DELETE FROM cliente WHERE id_cliente = {$id_cliente}";
        return $conexion->eliminar($sql);
    }
}
?>
