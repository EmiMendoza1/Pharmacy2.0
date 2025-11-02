<?php
require_once('conexion.php');

class Persona {
    // Inserta una nueva persona y retorna el id
    public static function insertar($nombre, $apellido, $dni, $direccion, $fecha_nac, $sexo) {
        $conexion = new Conexion();
        $nombre = addslashes($nombre);
        $apellido = addslashes($apellido);
        $dni = addslashes($dni);
        $direccion = addslashes($direccion);
        $fecha_nac = addslashes($fecha_nac);
        $sexo = addslashes($sexo);
        $sql = "INSERT INTO persona (persona_nombre, persona_apellido, persona_fecha_nac, persona_dni, persona_sexo, persona_direccion) VALUES ('{$nombre}', '{$apellido}', '{$fecha_nac}', '{$dni}', '{$sexo}', '{$direccion}')";
        return $conexion->insertar($sql);
    }
    private $id_persona;
    private $persona_nombre;
    private $persona_apellido;
    private $persona_fecha_nac;
    private $persona_dni;
    private $persona_sexo;
    // ...existing code...

    // Obtener todas las personas (para selects, etc)
    public static function obtenerPersonas() {
        $conexion = new Conexion();
        return $conexion->consultar("SELECT * FROM persona ORDER BY persona_apellido, persona_nombre");
    }
    private $persona_direccion;

        public function __construct($id = null, $nombre = '', $apellido = '', $fecha_nac = '', $dni = '', $sexo = '', $direccion = '') {
            $this->id_persona = $id;
            $this->persona_nombre = $nombre;
            $this->persona_apellido = $apellido;
            $this->persona_fecha_nac = $fecha_nac;
            $this->persona_dni = $dni;
            $this->persona_sexo = $sexo;
            $this->persona_direccion = $direccion;
        }

        public static function listar() {
            $conexion = new Conexion();
            $sql = "SELECT * FROM persona ORDER BY id_persona DESC";
            return $conexion->consultar($sql);
        }

        public static function obtenerPorId($id) {
            $conexion = new Conexion();
            $sql = "SELECT * FROM persona WHERE id_persona = {$id}";
            $res = $conexion->consultar($sql);
            return $res->fetch_assoc();
        }

        public function guardar() {
            // Validar que la fecha sea válida antes de guardar
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->persona_fecha_nac) || !strtotime($this->persona_fecha_nac)) {
                throw new Exception("La fecha de nacimiento no es válida: " . $this->persona_fecha_nac);
            }
            $conexion = new Conexion();
            $sql = "INSERT INTO persona (persona_nombre, persona_apellido, persona_fecha_nac, persona_dni, persona_sexo, persona_direccion) VALUES ('{$this->persona_nombre}', '{$this->persona_apellido}', '{$this->persona_fecha_nac}', '{$this->persona_dni}', '{$this->persona_sexo}', '{$this->persona_direccion}')";
            return $conexion->insertar($sql);
        }

        public function actualizar() {
            $conexion = new Conexion();
            $sql = "UPDATE persona SET persona_nombre='{$this->persona_nombre}', persona_apellido='{$this->persona_apellido}', persona_fecha_nac='{$this->persona_fecha_nac}', persona_dni='{$this->persona_dni}', persona_sexo='{$this->persona_sexo}', persona_direccion='{$this->persona_direccion}' WHERE id_persona={$this->id_persona}";
            return $conexion->actualizar($sql);
        }

        public static function eliminar($id) {
            $conexion = new Conexion();
            $sql = "DELETE FROM persona WHERE id_persona = {$id}";
            return $conexion->eliminar($sql);
        }

        public function getIdPersona() { return $this->id_persona; }
        public function setIdPersona($id) { $this->id_persona = $id; return $this; }
        public function getNombre() { return $this->persona_nombre; }
        public function setNombre($nombre) { $this->persona_nombre = $nombre; return $this; }
        public function getApellido() { return $this->persona_apellido; }
        public function setApellido($apellido) { $this->persona_apellido = $apellido; return $this; }
        public function getFechaNac() { return $this->persona_fecha_nac; }
        public function setFechaNac($fecha) { $this->persona_fecha_nac = $fecha; return $this; }
        public function getDni() { return $this->persona_dni; }
        public function setDni($dni) { $this->persona_dni = $dni; return $this; }
        public function getSexo() { return $this->persona_sexo; }
        public function setSexo($sexo) { $this->persona_sexo = $sexo; return $this; }
        public function getDireccion() { return $this->persona_direccion; }
        public function setDireccion($direccion) { $this->persona_direccion = $direccion; return $this; }
    }
?>