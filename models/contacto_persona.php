<?php // Modelo de contacto de una persona (tabla: contacto_persona)

require_once('conexion.php'); // Incluye la clase de conexión a la BD

class ContactoPersona { // Define el modelo ContactoPersona
    private $id_contacto; // ID único del contacto
    private $contacto_valor; // Valor del contacto (ej: email, teléfono)
    private $rela_tipo_contacto; // Relación al tipo de contacto 
    private $rela_persona; // Relación a la persona 

    public function __construct($tipo = '', $valor = '', $personaId = '') { // Constructor con parámetros opcionales
        $this->contacto_valor = $valor; // Asigna el valor del contacto
        $this->rela_tipo_contacto = $tipo; // Asigna el ID del tipo de contacto
        $this->rela_persona = $personaId; // Asigna el ID de la persona
    }

    public function guardar() { // Inserta el contacto en la base de datos
        $conexion = new Conexion(); // Crea la conexión
        $query = "INSERT INTO contacto_persona (contacto_valor, rela_tipo_contacto, rela_persona) " . // Arma la consulta de inserción
                "VALUES ('{$this->contacto_valor}', '{$this->rela_tipo_contacto}', '{$this->rela_persona}')";
        return $conexion->insertar($query); // Ejecuta la inserción y devuelve el ID generado
    }

    // Método estático para insertar contacto
    public static function insertar($id_persona, $tipo, $valor) {
        $conexion = new Conexion();
        $tipo = addslashes($tipo);
        $valor = addslashes($valor);
        $id_persona = intval($id_persona);
        $query = "INSERT INTO contacto_persona (contacto_valor, rela_tipo_contacto, rela_persona) VALUES ('{$valor}', '{$tipo}', '{$id_persona}')";
        return $conexion->insertar($query);
    }

    public function setTipoContacto($tipo) { // Setter del tipo de contacto (rela)
        $this->rela_tipo_contacto = $tipo; // Asigna el nuevo valor
        return $this; // Permite encadenamiento de métodos
    }

    public function setValor($valor) { // Setter del valor del contacto
        $this->contacto_valor = $valor; // Asigna el nuevo valor
        return $this; // Permite encadenamiento de métodos
    }

    public function setPersonaId($personaId) { // Setter del ID de persona (rela)
        $this->rela_persona = $personaId; // Asigna el nuevo valor
        return $this; // Permite encadenamiento de métodos
    }

    public function getIdContacto() { // Devuelve el ID del contacto
        return $this->id_contacto; // Retorna la propiedad privada
    }
}
?>