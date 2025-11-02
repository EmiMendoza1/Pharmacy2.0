<?php
require_once '../models/clientes.php';
header('Content-Type: application/json');
$clientes = Cliente::obtenerClientes();
$lista = [];
while ($row = $clientes->fetch_assoc()) {
    $lista[] = [
        'id' => $row['id_cliente'],
        'nombre' => $row['persona_nombre'] . ' ' . $row['persona_apellido']
    ];
}
echo json_encode($lista);
