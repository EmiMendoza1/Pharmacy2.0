<?php
// Controlador AJAX para gestión de métodos de administración
// Recibe peticiones, valida inputs, invoca al modelo y devuelve JSON
header('Content-Type: application/json'); // Informa que la respuesta es JSON
require_once __DIR__ . '/../../models/MetodoAdministracion.php'; // Incluye el modelo Método de Administración

// Inicializar respuesta por defecto
$respuesta = [ // Estructura base de la respuesta
    'success' => false, // Estado por defecto
    'mensaje' => 'Acción no válida', // Mensaje por defecto para acciones desconocidas
    'data' => [] // Espacio para datos de retorno
];

// Obtener parámetros de la petición
$accion = $_POST['accion'] ?? $_GET['accion'] ?? ''; // Determina la acción a realizar
$nombre = $_POST['nombre_metodo'] ?? ''; // Nombre del método (alta/edición)
$busqueda = $_GET['busqueda'] ?? ''; // Texto de filtro para listado
$id = $_POST['id_metodo'] ?? ''; // ID del método (edición/eliminación)

// Instanciar modelo
$metodoModel = new MetodoAdministracion(); // Instancia del modelo para consultas y operaciones

try { // Bloque try-catch para manejar excepciones
    // Procesar según la acción solicitada
    switch ($accion) { // Flujo principal según la acción
        case 'guardar':
            // Validar que el nombre no esté vacío
            if (empty(trim($nombre))) {
                $respuesta['mensaje'] = 'El nombre es requerido';
                break;
            }
            
            // Guardar método
            $resultado = $metodoModel->guardar($nombre); // Inserta el método y devuelve su ID
            if ($resultado) {
                $respuesta = [ // Confirmación de alta exitosa
                    'success' => true,
                    'mensaje' => 'Método guardado exitosamente',
                    'id' => $resultado
                ];
            } else {
                $respuesta['mensaje'] = 'Error al guardar el método';
            }
            break;
            
        case 'editar':
            // Validar que id y nombre no estén vacíos
            if (empty($id) || empty(trim($nombre))) {
                $respuesta['mensaje'] = 'ID y nombre son requeridos';
                break;
            }
            
            // Actualizar método
            $resultado = $metodoModel->actualizar($id, $nombre); // Actualiza el registro en BD
            if ($resultado) {
                $respuesta = [ // Respuesta de éxito de actualización
                    'success' => true,
                    'mensaje' => 'Método actualizado exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al actualizar el método';
            }
            break;
            
        case 'eliminar':
            // Validar que id no esté vacío
            if (empty($id)) {
                $respuesta['mensaje'] = 'ID es requerido';
                break;
            }
            
            // Eliminar método
            $resultado = $metodoModel->eliminar($id); // Elimina por ID
            if ($resultado) {
                $respuesta = [ // Confirma la eliminación exitosa
                    'success' => true,
                    'mensaje' => 'Método eliminado exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al eliminar el método';
            }
            break;
            
        default:
            // Si no hay acción específica o es 'listar', devolver listado
            $metodos = $metodoModel->listar($busqueda); // Consulta listado de métodos de administración
            $respuesta = [ // Respuesta con datos
                'success' => true,
                'data' => $metodos
            ];
            break;
    }
} catch (Exception $e) { // Si ocurre una excepción, armar respuesta de error
    // Capturar cualquier error y devolver mensaje
    $respuesta = [ // Respuesta de error estandarizada
        'success' => false,
        'mensaje' => 'Error en el servidor: ' . $e->getMessage()
    ];
}

// Devolver respuesta como JSON
echo json_encode($respuesta); // Envía la respuesta codificada como JSON
?>
