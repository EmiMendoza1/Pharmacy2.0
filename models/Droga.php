<?php
// Modelo para la gestión de drogas
require_once __DIR__ . '/conexion.php';

class Droga {
    // Obtiene una droga por su ID
    public function obtenerPorId($id) {
        $conexion = new Conexion();
        $id = intval($id);
        $query = "SELECT * FROM droga WHERE id_droga = {$id}";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }
    private $id_droga;
    private $droga_descri;
    
    // Constructor de la clase
    public function __construct($id_droga = '', $droga_descri = '') {
        $this->id_droga = $id_droga;
        $this->droga_descri = $droga_descri;
    }
    
    // Lista todas las drogas o filtra por búsqueda
    public function listar($busqueda = '') {
        $conexion = new Conexion();
        $where = '';
        
        if ($busqueda) {
            $busqueda = addslashes($busqueda); // Protección básica
            $where = "WHERE droga_descri LIKE '%{$busqueda}%'";
        }
        
    $query = "SELECT * FROM droga {$where} ORDER BY id_droga ASC";
        $resultado = $conexion->consultar($query);
        
        $drogas = [];
        while ($row = $resultado->fetch_assoc()) {
            $drogas[] = [
                'id_droga' => $row['id_droga'],
                'droga_descri' => $row['droga_descri']
            ];
        }
        
        return $drogas;
    }
    
    // Guarda una nueva droga en la base de datos
    public function guardar($nombre) {
        if (!$nombre) {
            return false;
        }
        
        $conexion = new Conexion();
        $nombre = addslashes($nombre); // Protección básica
        $query = "INSERT INTO droga (droga_descri) VALUES ('{$nombre}')";
        
        return $conexion->insertar($query);
    }
    
    // Actualiza una droga existente por su ID
    public function actualizar($id, $nombre) {
        if (!$id || !$nombre) {
            return false;
        }
        
        $conexion = new Conexion();
        $id = intval($id); // Asegurar que es un entero
        $nombre = addslashes($nombre); // Protección básica
        $query = "UPDATE droga SET droga_descri='{$nombre}' WHERE id_droga={$id}";
        
        return $conexion->actualizar($query);
    }
    
    // Elimina una droga por su ID
    public function eliminar($id) {
        if (!$id) {
            return false;
        }
        
        $conexion = new Conexion();
        $id = intval($id); // Asegurar que es un entero
        $query = "DELETE FROM droga WHERE id_droga={$id}";
        
        return $conexion->actualizar($query);
    }
    
    // Getters y Setters
    public function getId() {
        return $this->id_droga;
    }
    
    public function setId($id) {
        $this->id_droga = $id;
        return $this;
    }
    
    public function getDescripcion() {
        return $this->droga_descri;
    }
    
    public function setDescripcion($descripcion) {
        $this->droga_descri = $descripcion;
        return $this;
    }
}
?>
