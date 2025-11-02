<?php
class Usuario {
    private $nombre_usuario;

    // Setter para nombre_usuario
    public function setNombre_usuario($nombre_usuario) {
        $this->nombre_usuario = $nombre_usuario;
        return $this;
    }

    // Método para validar usuario (login)
    public function validar_usuario() {
        $conexion = new Conexion();
        $nombre_usuario = addslashes($this->nombre_usuario);
        $sql = "SELECT * FROM usuario WHERE nombre_usuario = '{$nombre_usuario}'";
        return $conexion->consultar($sql);
    }

    // Método estático para insertar usuario
    public static function insertar($nombre_usuario, $contrasena, $rela_persona, $rela_rol) {
        $conexion = new Conexion();
        $nombre_usuario = addslashes($nombre_usuario);
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $rela_persona = intval($rela_persona);
        $rela_rol = intval($rela_rol);
        $sql = "INSERT INTO usuario (nombre_usuario, contrasena, rela_persona, rela_rol) VALUES ('{$nombre_usuario}', '{$contrasena}', {$rela_persona}, {$rela_rol})";
        return $conexion->insertar($sql);
    }

    // Método estático para obtener todos los usuarios
    public static function obtenerUsuarios() {
        $conexion = new Conexion();
        $sql = "SELECT u.id_usuario, u.nombre_usuario, u.contrasena, u.rela_persona, u.rela_rol, p.persona_nombre, p.persona_apellido, r.nombre_rol
        FROM usuario u
        INNER JOIN persona p ON u.rela_persona = p.id_persona
        INNER JOIN rol r ON u.rela_rol = r.id_rol
        ORDER BY u.id_usuario DESC";
        return $conexion->consultar($sql);
    }

    // Método estático para actualizar usuario
    public static function actualizarUsuario($id_usuario, $nombre_usuario, $contrasena, $rela_persona, $rela_rol) {
        $conexion = new Conexion();
        $id_usuario = intval($id_usuario);
        $nombre_usuario = addslashes($nombre_usuario);
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $rela_persona = intval($rela_persona);
        $rela_rol = intval($rela_rol);
        $sql = "UPDATE usuario SET nombre_usuario='{$nombre_usuario}', contrasena='{$contrasena}', rela_persona={$rela_persona}, rela_rol={$rela_rol} WHERE id_usuario={$id_usuario}";
        return $conexion->actualizar($sql);
    }

    // Método estático para eliminar usuario
    public static function eliminarUsuario($id_usuario) {
        $conexion = new Conexion();
        $id_usuario = intval($id_usuario);
        $sql = "DELETE FROM usuario WHERE id_usuario={$id_usuario}";
        return $conexion->eliminar($sql);
    }
}