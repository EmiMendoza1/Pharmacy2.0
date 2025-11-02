<?php
require_once "models/persona.php";

class PersonaControlador {
    public static function index() {
        $resultado = Persona::listar();
        $personas = [];
        while ($row = $resultado->fetch_assoc()) {
            $personas[] = $row;
        }
        include "views/persona.php";
    }

    public static function nuevo() {
        include "views/form_persona.php";
    }

    public static function guardar() {
        $fecha_nac = $_POST['persona_fecha_nac'];
        // Mostrar el valor recibido para depuración
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_nac) || !strtotime($fecha_nac)) {
            echo "<div class='alert alert-danger'>Valor recibido para fecha de nacimiento: <b>" . htmlspecialchars($fecha_nac) . "</b><br>La fecha de nacimiento no es válida. Debe tener formato AAAA-MM-DD.</div>";
            include "views/form_persona.php";
            return;
        }
        $persona = new Persona(
            null,
            $_POST['persona_nombre'],
            $_POST['persona_apellido'],
            $fecha_nac,
            $_POST['persona_dni'],
            $_POST['persona_sexo'],
            $_POST['persona_direccion']
        );
        try {
            $persona->guardar();
            self::index();
            // Redirigir antes de cualquier salida
            //header("Location: index.php?page=persona");
            return;
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
            include "views/form_persona.php";
        }
    }

    public static function editar() {
        $id = $_GET['id'];
        $data = Persona::obtenerPorId($id);
        include "views/form_persona.php";
    }

    public static function actualizar() {
        $persona = new Persona(
            $_POST['id_persona'],
            $_POST['persona_nombre'],
            $_POST['persona_apellido'],
            $_POST['persona_fecha_nac'],
            $_POST['persona_dni'],
            $_POST['persona_sexo'],
            $_POST['persona_direccion']
        );
    $persona->actualizar();
    self::index();
    //header("Location: index.php?page=persona");
    return;
    }

    public static function eliminar() {
        $id = $_GET['id'];
    Persona::eliminar($id);
    self::index();
    //header("Location: index.php?page=persona");
    return;
    }
}
