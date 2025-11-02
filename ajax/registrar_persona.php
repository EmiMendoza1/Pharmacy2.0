<?php
// Controlador AJAX para registrar persona
require_once '../models/persona.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['modal_nombre'] ?? '';
    $apellido = $_POST['modal_apellido'] ?? '';
    $dni = $_POST['modal_dni'] ?? '';
    $direccion = $_POST['modal_direccion'] ?? '';
    $fecha_nac = $_POST['modal_fecha_nac'] ?? '';
    $sexo = $_POST['modal_sexo'] ?? '';
    $id = Persona::insertar($nombre, $apellido, $dni, $direccion, $fecha_nac, $sexo);
    if ($id) {
        echo json_encode(['success' => true, 'id_persona' => $id, 'nombre' => $nombre, 'apellido' => $apellido, 'dni' => $dni]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se pudo registrar la persona']);
    }
    exit;
}
echo json_encode(['success' => false, 'error' => 'Método no permitido']);
