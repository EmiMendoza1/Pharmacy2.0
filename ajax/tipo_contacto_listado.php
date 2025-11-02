<?php
require_once '../models/tipo_contacto.php';
header('Content-Type: application/json');
$tipos = TipoContacto::listar();
$lista = [];
while ($row = $tipos->fetch_assoc()) {
    // Devolvemos tanto los nombres usados por select2 (id/nombre)
    // como los campos originales del proyecto (id_tipo_contacto/tipo_contacto_nombre)
    $lista[] = [
        'id_tipo_contacto' => $row['id_tipo_contacto'],
        'tipo_contacto_nombre' => $row['tipo_contacto_nombre'],
        'id' => $row['id_tipo_contacto'],
        'nombre' => $row['tipo_contacto_nombre']
    ];
}
echo json_encode($lista);
