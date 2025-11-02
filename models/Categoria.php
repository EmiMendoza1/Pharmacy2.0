<?php // Modelo para la gestión de categorías (tabla: categoria)
require_once __DIR__ . '/conexion.php'; // Incluye la clase de conexión para ejecutar consultas

class Categoria { // Define el modelo Categoria
    private $id_categoria; // ID único de la categoría en la base de datos
    private $categoria_descri; // Descripción o nombre de la categoría
    
    // Constructor de la clase
    public function __construct($id_categoria = '', $categoria_descri = '') { // Permite crear el objeto con valores opcionales
        $this->id_categoria = $id_categoria; // Asigna el ID recibido (si hay)
        $this->categoria_descri = $categoria_descri; // Asigna la descripción recibida (si hay)
    }
    
    // Lista todas las categorías o filtra por búsqueda
    public function listar($busqueda = '') { // Retorna un array simple de categorías
        $conexion = new Conexion(); // Crea una conexión a la base de datos
        $where = ''; // Condición dinámica para filtrar por búsqueda
        
        if ($busqueda) { // Si se envió un texto para buscar
            $busqueda = addslashes($busqueda); // Protección básica contra inyección
            $where = "WHERE categoria_descri LIKE '%{$busqueda}%'"; // Arma el filtro por coincidencia parcial
        }
        
    $query = "SELECT * FROM categoria {$where} ORDER BY id_categoria ASC"; // Consulta SQL de listado
        $resultado = $conexion->consultar($query); // Ejecuta la consulta y obtiene un result set
        
        $categorias = []; // Inicializa el array de salida
        while ($row = $resultado->fetch_assoc()) { // Recorre cada fila del resultado
            $categorias[] = [ // Convierte la fila en un array asociativo simple
                'id_categoria' => $row['id_categoria'], // ID de la categoría
                'categoria_descri' => $row['categoria_descri'] // Descripción de la categoría
            ];
        }
        
        return $categorias; // Devuelve el listado como array de arrays
    }
    
    // Guarda una nueva categoría en la base de datos
    public function guardar($nombre) { // Inserta una nueva fila y retorna su ID
        if (!$nombre) { // Si no hay nombre, no se puede guardar
            return false; // Indica fallo
        }
        
        $conexion = new Conexion(); // Crea la conexión
        $nombre = addslashes($nombre); // Sanea el nombre
        $query = "INSERT INTO categoria (categoria_descri) VALUES ('{$nombre}')"; // Arma la consulta de inserción
        
        return $conexion->insertar($query); // Ejecuta y devuelve el ID insertado
    }
    
    // Actualiza una categoría existente por su ID
    public function actualizar($id, $nombre) { // Retorna true/false según resultado
        if (!$id || !$nombre) { // Validación básica de parámetros
            return false; // Falla si falta alguno
        }
        
        $conexion = new Conexion(); // Conexión a la BD
        $id = intval($id); // Asegura que el ID sea entero
        $nombre = addslashes($nombre); // Sanea el nombre
        $query = "UPDATE categoria SET categoria_descri='{$nombre}' WHERE id_categoria={$id}"; // Arma la actualización
        
        return $conexion->actualizar($query); // Ejecuta y devuelve true/false
    }
    
    // Elimina una categoría por su ID
    public function eliminar($id) { // Retorna true/false
        if (!$id) { // Si no se envía ID
            return false; // Falla la operación
        }
        
        $conexion = new Conexion(); // Conexión a la BD
        $id = intval($id); // Asegura que sea entero
        $query = "DELETE FROM categoria WHERE id_categoria={$id}"; // Arma el delete
        
        return $conexion->actualizar($query); // Ejecuta y devuelve true/false
    }
    
    // Getters y Setters
    public function getId() { // Devuelve el ID actual del objeto
        return $this->id_categoria; // Retorna la propiedad privada
    }
    
    public function setId($id) { // Establece el ID del objeto
        $this->id_categoria = $id; // Asigna el valor a la propiedad privada
        return $this; // Permite encadenamiento de métodos
    }
    
    public function getDescripcion() { // Devuelve la descripción actual
        return $this->categoria_descri; // Retorna la propiedad privada
    }
    
    public function setDescripcion($descripcion) { // Establece la descripción
        $this->categoria_descri = $descripcion; // Asigna el valor a la propiedad privada
        return $this; // Permite encadenamiento de métodos
    }
}
?>
