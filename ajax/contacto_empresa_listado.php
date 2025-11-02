<?php
require_once '../models/contacto_empresa.php';
header('Content-Type: application/json');
$empresas = ContactoEmpresa::listarEmpresas();
$lista = [];
while ($row = $empresas->fetch_assoc()) {
    $lista[] = [
        'id' => $row['id_contacto'],
        'nombre' => $row['contacto_valor']
    ];
}
echo json_encode($lista);
