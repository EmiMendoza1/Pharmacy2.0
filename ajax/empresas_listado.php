<?php
require_once '../models/proveedor.php';
header('Content-Type: application/json');
$empresas = Proveedor::listar();
$lista = [];
while ($row = $empresas->fetch_assoc()) {
    $lista[] = [
        'id' => $row['id_proveedor'],
        'nombre' => $row['prov_nombre_empresa']
    ];
}
echo json_encode($lista);