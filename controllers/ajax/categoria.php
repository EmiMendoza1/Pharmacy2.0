<?php
// Controlador AJAX para gestión de categorías
// Recibe peticiones, valida inputs, invoca al modelo y devuelve JSON
header('Content-Type: application/json'); // Define que la respuesta será en formato JSON
require_once __DIR__ . '/../../models/Categoria.php'; // Incluye el modelo Categoria para operar con la base de datos

// Inicializar respuesta por defecto
$respuesta = [ // Estructura base de la respuesta
    'success' => false, // Indicador de éxito de la operación
    'mensaje' => 'Acción no válida', // Mensaje por defecto si no se reconoce la acción
    'data' => [] // Datos adicionales que pueda devolver la operación
];

// Obtener parámetros de la petición
$accion = $_POST['accion'] ?? $_GET['accion'] ?? ''; // Determina la acción solicitada (guardar, editar, eliminar, listar)
$nombre = $_POST['nombre_categoria'] ?? ''; // Nombre de la categoría recibida por POST
$busqueda = $_GET['busqueda'] ?? ''; // Texto de búsqueda para el listado
$id = $_POST['id_categoria'] ?? ''; // ID de la categoría para editar/eliminar

// Instanciar modelo
$categoriaModel = new Categoria(); // Instancia del modelo para interactuar con la BD

try { // Manejo de errores para capturar excepciones del servidor
    
    switch ($accion) { // Según la acción recibida...:
        case 'guardar':
            // Validar que el nombre no esté vacío
            if (empty(trim($nombre))) {
                $respuesta['mensaje'] = 'El nombre es requerido';
                break;
            }
            
            // Guardar categoría
            $resultado = $categoriaModel->guardar($nombre); // Inserta la nueva categoría y devuelve el ID
            if ($resultado) {
                $respuesta = [ // Arma respuesta de éxito
                    'success' => true, // Operación exitosa
                    'mensaje' => 'Categoría guardada exitosamente', // Mensaje de confirmación
                    'id' => $resultado // Devuelve el ID generado
                ];
            } else {
                $respuesta['mensaje'] = 'Error al guardar la categoría';
            }
            break;
            
        case 'editar':
            // Validar que id y nombre no estén vacíos
            if (empty($id) || empty(trim($nombre))) {
                $respuesta['mensaje'] = 'ID y nombre son requeridos';
                break;
            }
            
            // Actualizar categoría
            $resultado = $categoriaModel->actualizar($id, $nombre); // Actualiza el registro con el nuevo nombre
            if ($resultado) {
                $respuesta = [ // Respuesta de éxito en actualización
                    'success' => true,
                    'mensaje' => 'Categoría actualizada exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al actualizar la categoría';
            }
            break;
            
        case 'eliminar':
            // Validar que id no esté vacío
            if (empty($id)) {
                $respuesta['mensaje'] = 'ID es requerido';
                break;
            }
            
            // Eliminar categoría
            $resultado = $categoriaModel->eliminar($id); // Elimina el registro indicado por ID
            if ($resultado) {
                $respuesta = [ // Respuesta de éxito en eliminación
                    'success' => true,
                    'mensaje' => 'Categoría eliminada exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al eliminar la categoría';
            }
            break;
            
        default:
            // Si no hay acción específica o es 'listar', devolver listado
            $categorias = $categoriaModel->listar($busqueda); // Obtiene el listado filtrado por búsqueda (si aplica)
            $respuesta = [ // Arma la respuesta de listado
                'success' => true,
                'data' => $categorias
            ];
            break;
    }
} catch (Exception $e) { // Captura cualquier excepción lanzada durante el proceso
    // Capturar cualquier error y devolver mensaje
    $respuesta = [ // Estructura de error estándar
        'success' => false,
        'mensaje' => 'Error en el servidor: ' . $e->getMessage()
    ];
}

// Devolver respuesta como JSON
echo json_encode($respuesta); // Convierte el array de respuesta a JSON y lo imprime
?>
