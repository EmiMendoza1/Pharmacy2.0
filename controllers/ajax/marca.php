<?php
// Controlador AJAX para gestión de marcas
// Recibe peticiones, valida inputs, invoca al modelo y devuelve JSON
header('Content-Type: application/json'); // La salida será JSON
require_once __DIR__ . '/../../models/Marca.php'; // Incluye el modelo Marca para acceso a datos

// Inicializar respuesta por defecto
$respuesta = [ // Estructura por defecto de la respuesta
    'success' => false, // Indica estado de la operación
    'mensaje' => 'Acción no válida', // Mensaje por defecto
    'data' => [] // Contenedor para datos a retornar
];

// Obtener parámetros de la petición
$accion = $_POST['accion'] ?? $_GET['accion'] ?? ''; // Acción requerida por el cliente
$nombre = $_POST['nombre_marca'] ?? ''; // Nombre de la marca (alta/edición)
$busqueda = $_GET['busqueda'] ?? ''; // Filtro de búsqueda (listar)
$id = $_POST['id_marca'] ?? ''; // ID de la marca (edición/eliminación)

// Instanciar modelo
$marcaModel = new Marca(); // Instancia del modelo Marca

try { // Bloque para capturar excepciones
    
    switch ($accion) { // Según la acción recibida...:
        case 'guardar':
            // Validar que el nombre no esté vacío
            if (empty(trim($nombre))) {
                $respuesta['mensaje'] = 'El nombre es requerido';
                break;
            }
            
            // Guardar marca
            $resultado = $marcaModel->guardar($nombre); // Inserta la marca y devuelve el ID generado
            if ($resultado) {
                $respuesta = [ // Arma respuesta de éxito
                    'success' => true,
                    'mensaje' => 'Marca guardada exitosamente',
                    'id' => $resultado
                ];
            } else {
                $respuesta['mensaje'] = 'Error al guardar la marca';
            }
            break;
            
        case 'editar':
            // Validar que id y nombre no estén vacíos
            if (empty($id) || empty(trim($nombre))) {
                $respuesta['mensaje'] = 'ID y nombre son requeridos';
                break;
            }
            
            // Actualizar marca
            $resultado = $marcaModel->actualizar($id, $nombre); // Actualiza el registro indicado
            if ($resultado) {
                $respuesta = [ // Respuesta de éxito
                    'success' => true,
                    'mensaje' => 'Marca actualizada exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al actualizar la marca';
            }
            break;
            
        case 'eliminar':
            // Validar que id no esté vacío
            if (empty($id)) {
                $respuesta['mensaje'] = 'ID es requerido';
                break;
            }
            
            // Eliminar marca
            $resultado = $marcaModel->eliminar($id); // Elimina el registro por su ID
            if ($resultado) {
                $respuesta = [ // Confirma eliminación
                    'success' => true,
                    'mensaje' => 'Marca eliminada exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al eliminar la marca';
            }
            break;
            
        default:
            // Si no hay acción específica o es 'listar', devolver listado
            $marcas = $marcaModel->listar($busqueda); // Obtiene el listado de marcas
            $respuesta = [ // Respuesta con la data
                'success' => true,
                'data' => $marcas
            ];
            break;
    }
} catch (Exception $e) { // Manejo de errores
    // Capturar cualquier error y devolver mensaje
    $respuesta = [ // Respuesta de error estandarizada
        'success' => false,
        'mensaje' => 'Error en el servidor: ' . $e->getMessage()
    ];
}

// Devolver respuesta como JSON
echo json_encode($respuesta); // Devuelve el JSON al cliente
?>
