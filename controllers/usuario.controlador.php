<?php
require_once('models/usuarios.php');
require_once(__DIR__ . '/../models/persona.php');
require_once('models/roles.php');

class UsuarioControlador {
    public function index() {
        $usuarios = Usuario::obtenerUsuarios();
        include('views/usuario.php');
    }

    public function nuevo() {
        $personas = Persona::obtenerPersonas();
        $roles = Rol::obtenerRoles();
        include('views/form_usuario.php');
    }

    public function guardar() {
        if (isset($_POST['nombre_usuario'], $_POST['contrasena'], $_POST['rela_persona'], $_POST['rela_rol'])) {
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];
            $rela_persona = $_POST['rela_persona'];
            $rela_rol = $_POST['rela_rol'];
            // Validar si el usuario ya existe
            $usuario_existente = (new Usuario())->setNombre_usuario($nombre_usuario);
            $resultado = (new Usuario())->setNombre_usuario($nombre_usuario)->validar_usuario();
            if ($resultado && $resultado->num_rows > 0) {
                $mensaje = 'El nombre de usuario ya existe.';
                $status = 'danger';
            } else {
                $res = Usuario::insertar($nombre_usuario, $contrasena, $rela_persona, $rela_rol);
                $mensaje = $res ? 'Usuario registrado correctamente.' : 'Error al registrar usuario.';
                $status = $res ? 'success' : 'danger';
            }
            // Mostrar mensaje de confirmación y volver al listado
            echo "<div class='alert alert-$status' role='alert' style='max-width:500px; margin:40px auto 20px auto; text-align:center; font-size:1.2rem;'>$mensaje</div>";
            echo "<script>setTimeout(function(){ window.location.href='index.php?page=usuario'; }, 1800);</script>";
            exit;
        }
        // Si no hay datos, mostrar el formulario
        $this->nuevo();
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuarios = Usuario::obtenerUsuarios();
            $usuario = null;
            while($row = $usuarios->fetch_assoc()) {
                if ($row['id_usuario'] == $id) {
                    $usuario = $row;
                    break;
                }
            }
            $personas = Persona::obtenerPersonas();
            $roles = Rol::obtenerRoles();
            include('views/form_usuario.php');
        }
    }

    public function actualizar() {
        if (isset($_POST['id_usuario'], $_POST['nombre_usuario'], $_POST['contrasena'], $_POST['rela_persona'], $_POST['rela_rol'])) {
            $id_usuario = $_POST['id_usuario'];
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];
            $rela_persona = $_POST['rela_persona'];
            $rela_rol = $_POST['rela_rol'];
            $res = Usuario::actualizarUsuario($id_usuario, $nombre_usuario, $contrasena, $rela_persona, $rela_rol);
            $mensaje = $res ? 'Usuario actualizado correctamente.' : 'Error al actualizar usuario.';
            $status = $res ? 'success' : 'danger';
            echo "<div class='alert alert-$status' role='alert' style='max-width:500px; margin:40px auto 20px auto; text-align:center; font-size:1.2rem;'>$mensaje</div>";
            echo "<script>setTimeout(function(){ window.location.href='index.php?page=usuario'; }, 1800);</script>";
            exit;
        }
        $this->index();
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $id_usuario = $_GET['id'];
            $res = Usuario::eliminarUsuario($id_usuario);
            $mensaje = $res ? 'Usuario eliminado correctamente.' : 'Error al eliminar usuario.';
            $status = $res ? 'success' : 'danger';
            echo "<div class='alert alert-$status' role='alert' style='max-width:500px; margin:40px auto 20px auto; text-align:center; font-size:1.2rem;'>$mensaje</div>";
            echo "<script>setTimeout(function(){ window.location.href='index.php?page=usuario'; }, 1800);</script>";
            exit;
        }
        $this->index();
    }
}
?>
