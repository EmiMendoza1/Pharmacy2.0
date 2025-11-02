<?php
// Modelo para la gestión de marcas
require_once __DIR__ . '/conexion.php';

class Marca {
    private $id_marca;
    private $marca_descri;
    
    // Constructor de la clase
    public function __construct($id_marca = '', $marca_descri = '') {
        $this->id_marca = $id_marca;
        $this->marca_descri = $marca_descri;
    }
    
    // Lista todas las marcas o filtra por búsqueda
    public function listar($busqueda = '') {
        $conexion = new Conexion();
        $where = '';
        
        if ($busqueda) {
            $busqueda = addslashes($busqueda); // Protección básica
            $where = "WHERE marca_descri LIKE '%{$busqueda}%'";
        }
        
    $query = "SELECT * FROM marca {$where} ORDER BY id_marca ASC";
        $resultado = $conexion->consultar($query);
        
        $marcas = [];
        while ($row = $resultado->fetch_assoc()) {
            $marcas[] = [
                'id_marca' => $row['id_marca'],
                'marca_descri' => $row['marca_descri']
            ];
        }
        
        return $marcas;
    }
    
    // Guarda una nueva marca en la base de datos
    public function guardar($nombre) {
        if (!$nombre) {
            return false;
        }
        
        $conexion = new Conexion();
        $nombre = addslashes($nombre); // Protección básica
        $query = "INSERT INTO marca (marca_descri) VALUES ('{$nombre}')";
        
        return $conexion->insertar($query);
    }
    
    // Actualiza una marca existente por su ID
    public function actualizar($id, $nombre) {
        if (!$id || !$nombre) {
            return false;
        }
        
        $conexion = new Conexion();
        $id = intval($id); // Asegurar que es un entero
        $nombre = addslashes($nombre); // Protección básica
        $query = "UPDATE marca SET marca_descri='{$nombre}' WHERE id_marca={$id}";
        
        return $conexion->actualizar($query);
    }
    
    // Elimina una marca por su ID
    public function eliminar($id) {
        if (!$id) {
            return false;
        }
        
        $conexion = new Conexion();
        $id = intval($id); // Asegurar que es un entero
        $query = "DELETE FROM marca WHERE id_marca={$id}";
        
        return $conexion->actualizar($query);
    }
    
    // Getters y Setters
    public function getId() {
        return $this->id_marca;
    }
    
    public function setId($id) {
        $this->id_marca = $id;
        return $this;
    }
    
    public function getDescripcion() {
        return $this->marca_descri;
    }
    
    public function setDescripcion($descripcion) {
        $this->marca_descri = $descripcion;
        return $this;
    }
}
?>
