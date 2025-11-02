<?php // Script de validación en vivo (a través de AJAX) para formularios (respuesta en JSON)
require_once __DIR__ . '/../models/usuarios.php'; // Carga el modelo Usuario para consultar existencia de datos
header('Content-Type: application/json'); // Indica que la respuesta será JSON

$tipo = $_POST['tipo'] ?? ''; // Tipo de dato a validar: 'usuario' | 'dni' | 'email'
$valor = $_POST['valor'] ?? ''; // Valor concreto a verificar (texto ingresado por el usuario)
$respuesta = ['disponible' => true, 'mensaje' => '']; // Respuesta por defecto: disponible y sin mensaje de error

if (!$tipo || !$valor) { // Si falta el tipo o el valor, no se puede validar
    echo json_encode(['disponible' => false, 'mensaje' => 'Datos incompletos']); // Devuelve error por datos faltantes
    exit; // Corta la ejecución para no continuar
}

$usuarios = new Usuario(); // Instancia el modelo para consultar en la base de datos

switch ($tipo) { // Selecciona qué validar según el tipo recibido
    case 'usuario': // Validación de nombre de usuario único
        if ($usuarios->existeUsuario($valor)) { // Consulta si ya existe ese nombre de usuario
            $respuesta = [ // Si existe, no está disponible
                'disponible' => false,
                'mensaje' => 'Ese nombre de usuario ya existe, por favor ingrese otro.'
            ];
        }
        break; // Termina este caso
    case 'dni': // Validación de DNI único
        if ($usuarios->existeDNI($valor)) { // Consulta si ya existe ese DNI
            $respuesta = [ // Si existe, no está disponible
                'disponible' => false,
                'mensaje' => 'La persona con ese DNI ya está registrada.'
            ];
        }
        break; // Termina este caso
    case 'email': // Validación de email único
        if ($usuarios->existeEmail($valor)) { // Consulta si ya existe ese email
            $respuesta = [ // Si existe, no está disponible
                'disponible' => false,
                'mensaje' => 'Ese Gmail ya existe, por favor ingrese otro.'
            ];
        }
        break; // Termina este caso
}
echo json_encode($respuesta); // Devuelve el resultado de la validación en formato JSON
