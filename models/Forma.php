<?php
// Modelo para la gestión de formas farmacéuticas
require_once __DIR__ . '/conexion.php';

class Forma {
    private $id_forma;
    private $forma_descri;
    
    // Constructor de la clase
    public function __construct($id_forma = '', $forma_descri = '') {
        $this->id_forma = $id_forma;
        $this->forma_descri = $forma_descri;
    }
    
    // Lista todas las formas o filtra por búsqueda
    public function listar($busqueda = '') {
        $conexion = new Conexion();
        $where = '';
        
        if ($busqueda) {
            $busqueda = addslashes($busqueda); // Protección básica
            $where = "WHERE forma_descri LIKE '%{$busqueda}%'";
        }
        
    $query = "SELECT * FROM forma {$where} ORDER BY id_forma ASC";
        $resultado = $conexion->consultar($query);
        
        $formas = [];
        while ($row = $resultado->fetch_assoc()) {
            $formas[] = [
                'id_forma' => $row['id_forma'],
                'forma_descri' => $row['forma_descri']
            ];
        }
        
        return $formas;
    }
    
    // Guarda una nueva forma en la base de datos
    public function guardar($nombre) {
        if (!$nombre) {
            return false;
        }
        
        $conexion = new Conexion();
        $nombre = addslashes($nombre); // Protección básica
        $query = "INSERT INTO forma (forma_descri) VALUES ('{$nombre}')";
        
        return $conexion->insertar($query);
    }
    
    // Actualiza una forma existente por su ID
    public function actualizar($id, $nombre) {
        if (!$id || !$nombre) {
            return false;
        }
        
        $conexion = new Conexion();
        $id = intval($id); // Asegurar que es un entero
        $nombre = addslashes($nombre); // Protección básica
        $query = "UPDATE forma SET forma_descri='{$nombre}' WHERE id_forma={$id}";
        
        return $conexion->actualizar($query);
    }
    
    // Elimina una forma por su ID
    public function eliminar($id) {
        if (!$id) {
            return false;
        }
        
        $conexion = new Conexion();
        $id = intval($id); // Asegurar que es un entero
        $query = "DELETE FROM forma WHERE id_forma={$id}";
        
        return $conexion->actualizar($query);
    }
    
    // Getters y Setters
    public function getId() {
        return $this->id_forma;
    }
    
    public function setId($id) {
        $this->id_forma = $id;
        return $this;
    }
    
    public function getDescripcion() {
        return $this->forma_descri;
    }
    
    public function setDescripcion($descripcion) {
        $this->forma_descri = $descripcion;
        return $this;
    }
}
?>
