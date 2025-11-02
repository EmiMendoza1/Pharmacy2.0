<?php
// Modelo para la gestión de métodos de administración
require_once __DIR__ . '/conexion.php';

class MetodoAdministracion {
    private $id_metodo_administracion;
    private $metodo_administracion_descri;
    
    // Constructor de la clase
    public function __construct($id_metodo_administracion = '', $metodo_administracion_descri = '') {
        $this->id_metodo_administracion = $id_metodo_administracion;
        $this->metodo_administracion_descri = $metodo_administracion_descri;
    }
    
    // Lista todos los métodos o filtra por búsqueda
    public function listar($busqueda = '') {
        $conexion = new Conexion();
        $where = '';
        
        if ($busqueda) {
            $busqueda = addslashes($busqueda); // Protección básica
            $where = "WHERE metodo_administracion_descri LIKE '%{$busqueda}%'";
        }
        
        $query = "SELECT * FROM metodo_administracion {$where} ORDER BY id_metodo_administracion ASC";
        $resultado = $conexion->consultar($query);
        
        $metodos = [];
        while ($row = $resultado->fetch_assoc()) {
            $metodos[] = [
                'id_metodo' => $row['id_metodo_administracion'],
                'metodo_descri' => $row['metodo_administracion_descri']
            ];
        }
        
        return $metodos;
    }
    
    // Guarda un nuevo método en la base de datos
    public function guardar($nombre) {
        if (!$nombre) {
            return false;
        }
        
        $conexion = new Conexion();
        $nombre = addslashes($nombre); // Protección básica
        $query = "INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('{$nombre}')";
        
        return $conexion->insertar($query);
    }
    
    // Actualiza un método existente por su ID
    public function actualizar($id, $nombre) {
        if (!$id || !$nombre) {
            return false;
        }
        
        $conexion = new Conexion();
        $id = intval($id); // Asegurar que es un entero
        $nombre = addslashes($nombre); // Protección básica
        $query = "UPDATE metodo_administracion SET metodo_administracion_descri='{$nombre}' WHERE id_metodo_administracion={$id}";
        
        return $conexion->actualizar($query);
    }
    
    // Elimina un método por su ID
    public function eliminar($id) {
        if (!$id) {
            return false;
        }
        
        $conexion = new Conexion();
        $id = intval($id); // Asegurar que es un entero
        $query = "DELETE FROM metodo_administracion WHERE id_metodo_administracion={$id}";
        
        return $conexion->actualizar($query);
    }
    
    // Getters y Setters
    public function getId() {
        return $this->id_metodo_administracion;
    }
    
    public function setId($id) {
        $this->id_metodo_administracion = $id;
        return $this;
    }
    
    public function getDescripcion() {
        return $this->metodo_administracion_descri;
    }
    
    public function setDescripcion($descripcion) {
        $this->metodo_administracion_descri = $descripcion;
        return $this;
    }
}
?>
