<?php
// Carga de modelos necesarios
require_once('models/usuarios.php');

// Inicia sesión si no existe
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Definir variables por defecto
$page   = $_GET['page'] ?? 'inicio';    // Página por defecto
$action = $_GET['action'] ?? 'index';   // Acción por defecto

// PROCESAR GUARDADO DE VENTA ANTES DE CUALQUIER SALIDA HTML
if ($page === 'venta' && $action === 'guardar') {
    require_once('controllers/venta.controlador.php');
    $controller = new VentaControlador();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'fecha' => $_POST['fecha'] ?? '',
            'cliente_id' => $_POST['cliente_id'] ?? '',
            'total' => $_POST['total'] ?? '',
        ];
        $detalles = [];
        if (!empty($_POST['detalleVenta'])) {
            $detalles = json_decode($_POST['detalleVenta'], true);
        }
        $controller->guardar($data, $detalles);
    }
    header('Location: index.php?page=venta&action=index');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/signup.css">
    <link rel="stylesheet" href="styles/navbar.css">
</head>

<body>
    <div class="container">

        <?php
        // Mostrar mensajes si existen
        if (isset($_GET['message']) && isset($_GET['status']) && $page !== 'login_sistema') {
            echo '<div class="alert alert-' . $_GET['status'] . '" role="alert">' . $_GET['message'] . '</div>';
        }

        // Array de páginas válidas
        $paginas_validas = [
            'login_sistema',
            'listado_usuario',
            'salida',
            'signup_admin',
            'signup_cliente',
            'listado_clientes',
            'login_web',
            'marca',
            'categoria',
            'forma',
            'metodo_administracion',
            'droga',
            'roles',
            'inicio',
            'producto',
            'tipo_contacto',
            'tipo_producto',
            'origen',
            'laboratorio',
            'accion_farmaceutica',
            'usuario',
            'conservacion',
            'lote',
            'venta',
            'form_venta',
            'cliente',
            'proveedores',
            'caja',
            'contacto_empresa',
            'persona',
            'mediopago',
            'compra'
            ,'auditoria'
        ];

        // Mostrar menú lateral si el usuario tiene rol
        if (isset($_SESSION['roles_nombre'])) {
            include('views/sidebar.php');
        }

        // Verificar acceso a página
        if (in_array($page, $paginas_validas)) {
            // Permitir acceso siempre a login_sistema
            if ($page === 'login_sistema') {
                include('views/login_sistema.php');
            }
            // Permitir acceso a salida (cerrar sesión)
            else if ($page === 'salida') {
                session_destroy();
                echo '<div class="alert alert-success" role="alert" style="max-width: 500px; margin: 40px auto 20px auto; text-align:center; font-size:1.2rem;">¡Sesión cerrada correctamente!<br>Serás redirigido al login en unos segundos...</div>';
                echo "<script>setTimeout(function(){ window.location.href='index.php?page=login_sistema'; }, 2000);</script>";
            }
            // Permitir acceso a signup_cliente (formulario de registro de cliente)
            else if ($page === 'signup_cliente' && isset($_SESSION['nombre_usuario'])) {
                require_once('controllers/cliente.controlador.php');
                $controller = new ClienteControlador();
                $controller->nuevo(); // Muestra solo el formulario
            }
            // Permitir acceso a listado_clientes (listado de clientes)
            else if ($page === 'listado_clientes' && isset($_SESSION['nombre_usuario'])) {
                require_once('controllers/cliente.controlador.php');
                $controller = new ClienteControlador();
                $controller->index(); // Muestra solo el listado
            }
            // El resto de páginas requieren sesión
            else if (isset($_SESSION['nombre_usuario'])) {
                switch ($page) {
                    // removed duplicate 'compras' route (use 'compra')
                        case 'compra':
                            require_once('controllers/compra.controlador.php');
                            $action = $_GET['action'] ?? 'index';
                            switch ($action) {
                                case 'index':
                                    CompraControlador::index();
                                    break;
                                case 'nuevo':
                                    CompraControlador::nuevo();
                                    break;
                                case 'guardar':
                                    CompraControlador::guardar();
                                    break;
                                case 'editar':
                                    if (isset($_GET['id'])) CompraControlador::editar($_GET['id']);
                                    break;
                                case 'actualizar':
                                    if (isset($_GET['id'])) CompraControlador::actualizar($_GET['id']);
                                    break;
                                case 'eliminar':
                                    if (isset($_GET['id'])) CompraControlador::eliminar($_GET['id']);
                                    break;
                                default:
                                    CompraControlador::index();
                                    break;
                            }
                            break;
                    case 'caja':
                        require_once('controllers/caja.controlador.php');
                        $actionCaja = $_GET['action'] ?? 'index';
                        switch ($actionCaja) {
                            case 'index':
                                CajaControlador::index();
                                break;
                                case 'auditoria':
                                    require_once('controllers/auditoria.controlador.php');
                                    AuditoriaControlador::index();
                                    break;
                            case 'nuevo':
                                CajaControlador::nuevo();
                                break;
                            case 'guardar':
                                CajaControlador::guardar();
                                break;
                            case 'ver':
                                if (isset($_GET['id'])) CajaControlador::ver($_GET['id']);
                                break;
                            case 'movimientoGuardar':
                                CajaControlador::movimientoGuardar();
                                break;
                            case 'cerrar':
                                CajaControlador::cerrar();
                                break;
                            default:
                                CajaControlador::index();
                                break;
                        }
                        break;
                    case 'mediopago':
                        require_once('controllers/mediopago.controlador.php');
                        $action = $_GET['action'] ?? 'index';
                        $id = $_GET['id'] ?? null;
                        switch ($action) {
                            case 'index':
                                MedioPagoControlador::index();
                                break;
                            case 'nuevo':
                                MedioPagoControlador::nuevo();
                                break;
                            case 'guardar':
                                MedioPagoControlador::guardar();
                                break;
                            case 'editar':
                                if ($id) {
                                    MedioPagoControlador::editar($id);
                                }
                                break;
                            case 'actualizar':
                                if ($id) {
                                    MedioPagoControlador::actualizar($id);
                                }
                                break;
                            case 'eliminar':
                                if ($id) {
                                    MedioPagoControlador::eliminar($id);
                                }
                                break;
                            default:
                                MedioPagoControlador::index();
                                break;
                        }
                        break;
                    case 'venta':
                        require_once('controllers/venta.controlador.php');
                        $controller = new VentaControlador();
                        $action = $_GET['action'] ?? 'index';
                        switch ($action) {
                            case 'index':
                                include('views/venta.php');
                                break;
                            case 'nuevo':
                                $controller->nuevo(); // Esto carga los productos y clientes para el formulario
                                break;
                            case 'guardar':
                                // Procesar datos del formulario de venta (ya procesado antes del HTML)
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'eliminar':
                                if (isset($_GET['id'])) {
                                    $controller->eliminar($_GET['id']);
                                    header('Location: index.php?page=venta&action=index');
                                    exit;
                                }
                                break;
                            case 'detalle':
                                include('views/detalle_venta.php');
                                break;
                            default:
                                include('views/venta.php');
                                break;
                        }
                        break;
                    case 'form_venta':
                        require_once('controllers/venta.controlador.php');
                        $controller = new VentaControlador();
                        $controller->nuevo(); // Siempre llama a nuevo para cargar datos
                        break;
                    case 'persona':
                        require_once('controllers/persona.controlador.php');
                        $actionPersona = $_GET['action'] ?? 'index';
                        switch ($actionPersona) {
                            case 'index':
                                PersonaControlador::index();
                                break;
                            case 'nuevo':
                                PersonaControlador::nuevo();
                                break;
                            case 'guardar':
                                PersonaControlador::guardar();
                                break;
                            case 'editar':
                                PersonaControlador::editar();
                                break;
                            case 'actualizar':
                                PersonaControlador::actualizar();
                                break;
                            case 'eliminar':
                                PersonaControlador::eliminar();
                                break;
                            default:
                                PersonaControlador::index();
                                break;
                        }
                        break;
                    case 'contacto_empresa':
                        require_once('controllers/contacto_empresa.controlador.php');
                        $actionContacto = $_GET['action'] ?? 'index';
                        switch ($actionContacto) {
                            case 'index':
                                ContactoEmpresaControlador::index();
                                break;
                            case 'nuevo':
                                ContactoEmpresaControlador::nuevo();
                                break;
                            case 'guardar':
                                ContactoEmpresaControlador::guardar();
                                break;
                            case 'editar':
                                ContactoEmpresaControlador::editar();
                                break;
                            case 'actualizar':
                                ContactoEmpresaControlador::actualizar();
                                break;
                            case 'eliminar':
                                ContactoEmpresaControlador::eliminar();
                                break;
                            default:
                                ContactoEmpresaControlador::index();
                                break;
                        }
                        break;
                    case 'proveedores':
                        require_once('controllers/proveedor.controlador.php');
                        $actionProveedor = $_GET['action'] ?? 'index';
                        switch ($actionProveedor) {
                            case 'index':
                                ProveedorControlador::index();
                                break;
                            case 'nuevo':
                                ProveedorControlador::nuevo();
                                break;
                            case 'guardar':
                                ProveedorControlador::guardar();
                                break;
                            case 'editar':
                                ProveedorControlador::editar();
                                break;
                            case 'actualizar':
                                ProveedorControlador::actualizar();
                                break;
                            case 'eliminar':
                                ProveedorControlador::eliminar();
                                break;
                            default:
                                ProveedorControlador::index();
                                break;
                        }
                        break;
                    case 'form_venta':
                        require_once('controllers/venta.controlador.php');
                        $controller = new VentaControlador();
                        $controller->nuevo();
                        break;
                    case 'droga':
                        require_once('controllers/droga.controlador.php');
                        $controller = new DrogaControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;
                    // ...existing code...
                    case 'conservacion':
                        require_once('controllers/conservacion.controlador.php');
                        $controller = new ConservacionControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'lote':
                        require_once('controllers/lote.controlador.php');
                        $controller = new LoteControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;
                    case 'usuario':
                        require_once('controllers/usuario.controlador.php');
                        $controller = new UsuarioControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'roles':
                        require_once('controllers/roles.listado.controlador.php');
                        $rolesControlador = new RolesListadoControlador();
                        $viewData = $rolesControlador->prepararDatosVista();
                        include('views/roles.php');
                        break;

                    case 'signup_admin':
                        require_once('controllers/signup_admin.listado.controlador.php');
                        $signupAdminControlador = new SignupAdminListadoControlador();
                        $viewData = $signupAdminControlador->prepararDatosVista();
                        include('views/signup_admin.php');
                        break;


                    case 'producto':
                        require "controllers/producto.controlador.php";
                        $controller = new ProductoControlador();

                        switch ($action) {
                            case 'index':
                                $resultado = $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $resultado = $controller->index();
                                break;
                        }
                        
                        break;

                    case 'tipo_contacto':
                        require "controllers/tipo_contacto.controlador.php";
                        $controller = new TipoContactoControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'tipo_producto':
                        require "controllers/tipo_producto.controlador.php";
                        $controller = new TipoProductoControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'origen':
                        require "controllers/origen.controlador.php";
                        $controller = new OrigenControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'laboratorio':
                        require "controllers/laboratorio.controlador.php";
                        $controller = new LaboratorioControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'marca':
                        require "controllers/marca.controlador.php";
                        $controller = new MarcaControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'metodo_administracion':
                        require "controllers/metodo_administracion.controlador.php";
                        $controller = new MetodoAdministracionControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'forma':
                        require "controllers/forma.controlador.php";
                        $controller = new FormaControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'categoria':
                        require "controllers/categoria.controlador.php";
                        $controller = new CategoriaControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'accion_farmaceutica':
                        require "controllers/accion_farmaceutica.controlador.php";
                        $controller = new AccionFarmaceuticaControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            case 'editar':
                                $controller->editar();
                                break;
                            case 'actualizar':
                                $controller->actualizar();
                                break;
                            case 'eliminar':
                                $controller->eliminar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    case 'cliente':
                        require "controllers/cliente.controlador.php";
                        $controller = new ClienteControlador();
                        switch ($action) {
                            case 'index':
                                $controller->index();
                                break;
                            case 'nuevo':
                                $controller->nuevo();
                                break;
                            case 'guardar':
                                $controller->guardar();
                                break;
                            default:
                                $controller->index();
                                break;
                        }
                        break;

                    default:
                        //$controller->listar();
                        include('views/inicio.php');
                        break;
                }
            } // <-- cierre correcto del else if (isset($_SESSION['nombre_usuario']))
            // Si no hay sesión y la página es inicio, mostrar login en vez de 403
            else if ($page === 'inicio') {
                include('views/login_sistema.php');
            }
            else {
                // Usuario no logueado -> acceso denegado
                include('views/403.php');
            }
        } else {
            // Página inválida -> error 404
            include('views/404.php');
        }
        ?>

    </div>

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>