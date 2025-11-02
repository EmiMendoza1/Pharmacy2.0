<?php
require_once '../models/persona.php';
header('Content-Type: application/json');
$personas = Persona::obtenerPersonas();
$lista = [];
while ($row = $personas->fetch_assoc()) {
    $lista[] = [
        'id' => $row['id_persona'],
        'nombre' => $row['persona_nombre'] . ' ' . $row['persona_apellido']
    ];
}
echo json_encode($lista);
