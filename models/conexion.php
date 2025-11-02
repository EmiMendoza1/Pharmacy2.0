<?php
// Acá se crea la clase que maneja la conexión con la base de datos MySQL (Esta clase es fundamental para que el sistema pueda comunicarse con la base de datos)
require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

class Conexion {
    private $_con;
    private $servidor;
    private $usuario;
    private $password;
    private $base_datos;

    public function __construct(){
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        $this->servidor = $_ENV['DB_HOST'];
        $this->usuario = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->base_datos = $_ENV['DB_NAME'];
    }

   // Método para establecer la conexión con la base de datos
    public function conectar(){ 
        // Crea una nueva conexión MySQL usando los parámetros configurados: 
        $this->_con = new mysqli($this->servidor, $this->usuario, $this->password, $this->base_datos); // (mysqli es la extensión de PHP para trabajar con bases de datos MySQL)
    }

    // Método para cerrar la conexión con la base de datos
    public function desconectar(){
        $this->_con->close(); // Cierra la conexión activa para liberar recursos
    }

    // Método para ejecutar consultas SELECT (solo para leer datos)
    public function consultar($query){ 
        $this->conectar();                        // Establecemos la conexión para la consulta
        $resultado = $this->_con->query($query); // Ejecutamos la consulta SQL y guardamos el resultado
        $this->desconectar();                   // Cerramos la conexión para liberar recursos
        return $resultado;                     // Retornamos el resultado de la consulta (datos obtenidos)
    }

    // Método para ejecutar consultas INSERT (para insertar nuevos registros)
    public function insertar($query){
        $this->conectar();             // Establecemos la conexión para el insert
        $this->_con->query($query);   // Ejecutamos la consulta SQL de inserción
        $id= $this->_con->insert_id; // Obtenemos el ID del último registro insertado
        $this->desconectar();       // Realizamos la desconexión para liberar recursos
        return $id;                // Retornamos el ID del nuevo registro insertado
    }

    // Método para ejecutar consultas UPDATE (para actualizar registros existentes)
    public function actualizar($query){
        $this->conectar();                        // Establecemos la conexión
        $resultado = $this->_con->query($query); // Ejecutamos la consulta SQL de actualización
        $this->desconectar();                   // Cerramos la conexión
        return $resultado;                     // Retornamos el resultado de la operación (true/false). True: si se actualiza el registro, False: si no se actualiza.
    }
    // Método para ejecutar consultas DELETE (para eliminar registros)
    public function eliminar($query){
        $this->conectar();
        $resultado = $this->_con->query($query);
        $this->desconectar();
        return $resultado;
    }
}
?>