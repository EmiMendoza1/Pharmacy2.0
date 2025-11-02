<?php
// Controlador AJAX para gestión de drogas
// Recibe peticiones, valida inputs, invoca al modelo y devuelve JSON
header('Content-Type: application/json'); // Define que la respuesta será JSON para el cliente
require_once __DIR__ . '/../../models/Droga.php'; // Incluye el modelo Droga para acceso a datos

// Inicializar respuesta por defecto
$respuesta = [ // Estructura base de respuesta
    'success' => false, // Estado de la operación
    'mensaje' => 'Acción no válida', // Mensaje por defecto
    'data' => [] // Datos de retorno (si corresponde)
];

// Obtener parámetros de la petición
$accion = $_POST['accion'] ?? $_GET['accion'] ?? ''; // Acción requerida por el cliente
$nombre = $_POST['nombre_droga'] ?? ''; // Nombre de la droga (para alta/edición)
$busqueda = $_GET['busqueda'] ?? ''; // Filtro de búsqueda (para listar)
$id = $_POST['id_droga'] ?? ''; // Identificador de la droga (para editar/eliminar)

// Instanciar modelo
$drogaModel = new Droga(); // Instancia del modelo Droga

try { // Intenta ejecutar la lógica y captura errores inesperados
    
    switch ($accion) { // Determina el flujo según la acción
        case 'guardar':
            // Validar que el nombre no esté vacío
            if (empty(trim($nombre))) {
                $respuesta['mensaje'] = 'El nombre es requerido';
                break;
            }
            
            // Guardar droga
            $resultado = $drogaModel->guardar($nombre); // Inserta la droga y devuelve el ID
            if ($resultado) {
                $respuesta = [ // Construye la respuesta exitosa
                    'success' => true,
                    'mensaje' => 'Droga guardada exitosamente',
                    'id' => $resultado
                ];
            } else {
                $respuesta['mensaje'] = 'Error al guardar la droga';
            }
            break;
            
        case 'editar':
            // Validar que id y nombre no estén vacíos
            if (empty($id) || empty(trim($nombre))) {
                $respuesta['mensaje'] = 'ID y nombre son requeridos';
                break;
            }
            
            // Actualizar droga
            $resultado = $drogaModel->actualizar($id, $nombre); // Actualiza el registro indicado
            if ($resultado) {
                $respuesta = [ // Respuesta de éxito de actualización
                    'success' => true,
                    'mensaje' => 'Droga actualizada exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al actualizar la droga';
            }
            break;
            
        case 'eliminar':
            // Validar que id no esté vacío
            if (empty($id)) {
                $respuesta['mensaje'] = 'ID es requerido';
                break;
            }
            
            // Eliminar droga
            $resultado = $drogaModel->eliminar($id); // Elimina el registro por su ID
            if ($resultado) {
                $respuesta = [ // Respuesta de eliminación exitosa
                    'success' => true,
                    'mensaje' => 'Droga eliminada exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al eliminar la droga';
            }
            break;
            
        default:
            // Si no hay acción específica o es 'listar', devolver listado
            $drogas = $drogaModel->listar($busqueda); // Consulta el listado (posible filtro)
            $respuesta = [ // Respuesta con datos listados
                'success' => true,
                'data' => $drogas
            ];
            break;
    }
} catch (Exception $e) { // Si algo falla, capturar y reportar
    // Capturar cualquier error y devolver mensaje
    $respuesta = [ // Respuesta estandarizada de error
        'success' => false,
        'mensaje' => 'Error en el servidor: ' . $e->getMessage()
    ];
}

// Devolver respuesta como JSON
echo json_encode($respuesta); // Imprime la respuesta en formato JSON
?> 
