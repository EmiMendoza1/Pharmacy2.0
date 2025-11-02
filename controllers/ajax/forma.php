<?php
// Controlador AJAX para gestión de formas farmacéuticas
// Recibe peticiones, valida inputs, invoca al modelo y devuelve JSON
header('Content-Type: application/json'); // Indica que el contenido de respuesta será JSON
require_once __DIR__ . '/../../models/Forma.php'; // Incluye el modelo Forma para operaciones de datos

// Inicializar respuesta por defecto
$respuesta = [ // Estructura base de la respuesta al cliente
    'success' => false, // Estado por defecto: fallo
    'mensaje' => 'Acción no válida', // Mensaje por defecto
    'data' => [] // Datos devueltos (si corresponde)
];

// Obtener parámetros de la petición
$accion = $_POST['accion'] ?? $_GET['accion'] ?? ''; // Nombre de la acción a ejecutar
$nombre = $_POST['nombre_forma'] ?? ''; // Nombre de la forma farmacéutica
$busqueda = $_GET['busqueda'] ?? ''; // Texto de filtro para listado
$id = $_POST['id_forma'] ?? ''; // Identificador del registro para editar/eliminar

// Instanciar modelo
$formaModel = new Forma(); // Instancia del modelo Forma para interactuar con la BD

try { // Inicia bloque de manejo de excepciones
    
    switch ($accion) { // Según la acción recibida...:
        case 'guardar':
            // Validar que el nombre no esté vacío
            if (empty(trim($nombre))) {
                $respuesta['mensaje'] = 'El nombre es requerido';
                break;
            }
            
            // Guardar forma
            $resultado = $formaModel->guardar($nombre); // Inserta el registro y devuelve el ID generado
            if ($resultado) {
                $respuesta = [ // Confirma el alta exitosa
                    'success' => true,
                    'mensaje' => 'Forma guardada exitosamente',
                    'id' => $resultado
                ];
            } else {
                $respuesta['mensaje'] = 'Error al guardar la forma';
            }
            break;
            
        case 'editar':
            // Validar que id y nombre no estén vacíos
            if (empty($id) || empty(trim($nombre))) {
                $respuesta['mensaje'] = 'ID y nombre son requeridos';
                break;
            }
            
            // Actualizar forma
            $resultado = $formaModel->actualizar($id, $nombre); // Realiza la actualización del registro
            if ($resultado) {
                $respuesta = [ // Reporta éxito en edición
                    'success' => true,
                    'mensaje' => 'Forma actualizada exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al actualizar la forma';
            }
            break;
            
        case 'eliminar':
            // Validar que id no esté vacío
            if (empty($id)) {
                $respuesta['mensaje'] = 'ID es requerido';
                break;
            }
            
            // Eliminar forma
            $resultado = $formaModel->eliminar($id); // Borra el registro por ID
            if ($resultado) {
                $respuesta = [ // Confirma la eliminación
                    'success' => true,
                    'mensaje' => 'Forma eliminada exitosamente'
                ];
            } else {
                $respuesta['mensaje'] = 'Error al eliminar la forma';
            }
            break;
            
        default:
            // Si no hay acción específica o es 'listar', devolver listado
            $formas = $formaModel->listar($busqueda); // Obtiene listado, aplicando filtro si corresponde
            $respuesta = [ // Arma la respuesta de listado
                'success' => true,
                'data' => $formas
            ];
            break;
    }
} catch (Exception $e) { // Captura excepciones y responde en formato controlado
    // Capturar cualquier error y devolver mensaje
    $respuesta = [ // Estructura estándar de error
        'success' => false,
        'mensaje' => 'Error en el servidor: ' . $e->getMessage()
    ];
}

// Devolver respuesta como JSON
echo json_encode($respuesta); // Imprime el JSON como salida
?>
