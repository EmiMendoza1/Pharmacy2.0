<?php // Controlador que recibe el POST del formulario de Roles y ejecuta acciones en BD
require_once __DIR__ . '/../models/roles.php'; // Modelo Rol: CRUD de roles
require_once __DIR__ . '/../models/modulos.php'; // Modelo Modulo: lectura de módulos (para asignaciones)

$rolModel = new Rol(); // Instancia para operar sobre la tabla rol
$moduloModel = new Modulo(); // Instancia por consistencia (aquí no se usa directamente)

$action = $_POST['action'] ?? ''; // Acción a realizar: 'guardar' | 'actualizar'
$rol_id = $_POST['rol_id'] ?? null; // ID del rol (para actualizar)
$nombre_rol = $_POST['nombre_rol'] ?? ''; // Nombre del rol a guardar/actualizar
$modulos = $_POST['modulo_id'] ?? []; // Array de IDs de módulos seleccionados en el formulario

if ($action === 'guardar' && $nombre_rol) { // Si se solicitó crear un rol y se envió nombre
    $nuevo_id = $rolModel->guardar($nombre_rol); // Inserta el rol y obtiene su ID
    if ($nuevo_id && $modulos) { // Si hay módulos seleccionados
        $rolModel->asignar_modulos_a_rol($nuevo_id, $modulos); // Asigna los módulos al nuevo rol
    }
    header('Location: ../index.php?page=roles'); // Redirige a la vista de roles
    exit; // Finaliza el script
}
if ($action === 'actualizar' && $rol_id && $nombre_rol) { // Si se solicitó actualizar un rol existente
    $rolModel->actualizar_rol($rol_id, $nombre_rol); // Actualiza el nombre del rol
    $rolModel->asignar_modulos_a_rol($rol_id, $modulos); // Reasigna los módulos enviados
    header('Location: ../index.php?page=roles'); // Redirige a la vista de roles
    exit; // Finaliza el script
}