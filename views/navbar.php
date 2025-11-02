<?php
// Vista de la barra de navegación - Solo muestra los datos proporcionados por el controlador (No contiene lógica de negocio ni consultas a la base de datos)

// Verifica si ya hay una sesión iniciada, si no la hay, inicia una nueva sesión (Las sesiones permiten mantener información del usuario entre páginas)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Los datos vienen del controlador - Obtiene el array de módulos disponibles para el usuario (Si no existe el array, se inicializa como vacío para evitar errores) 
$modulos_array = $viewData['modulos_array'] ?? []; // ?? es un operador ternario que permite asignar un valor por defecto, sirve para que: si no existe el array, se inicialice como vacío.
?>


<header><!-- Encabezado de la página que contiene la barra de navegación -->

    <nav class="custom-navbar"> <!-- Barra de navegación personalizada -->
    
        <div class="navbar-container">  <!-- Contenedor principal de la barra de navegación -->
        
            <a class="navbar-logo" href="index.php"> <!-- Logo de la farmacia que funciona como enlace a la página principal -->               
                <img src="assets/logonuevo.png" alt="Pharmacy Logo"> <!-- Imagen del logo de la farmacia -->
            </a>
        
            <ul class="navbar-links"> <!-- Lista de enlaces de navegación -->
            
                <?php if (!empty($modulos_array)): ?> <!-- Verifica si el usuario tiene módulos asignados -->

                    <!-- Si tiene acceso al MÓDULO DE PRODUCTOS... -->     
                    <?php if (in_array('Productos', $modulos_array)): ?>               
                        <li><a href="index.php?page=producto">Productos</a></li> <!-- Enlace directo a la página de productos -->
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE USUARIOS -->
                    <?php if (in_array('Usuarios', $modulos_array)): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="usuariosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuarios</a>
                            <ul class="dropdown-menu" aria-labelledby="usuariosDropdown">
                                <li><a class="dropdown-item" href="index.php?page=usuario&action=nuevo">Registrar usuario</a></li>
                                <li><a class="dropdown-item" href="index.php?page=usuario">Listado de usuarios</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE CLIENTES -->
                    <?php if (in_array('Clientes', $modulos_array)): ?>                   
                        <li class="nav-item dropdown"> <!-- Menú desplegable-->
                            <a class="nav-link dropdown-toggle" id="clientesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Clientes</a>
                            <ul class="dropdown-menu" aria-labelledby="clientesDropdown">                               
                                <li><a class="dropdown-item" href="index.php?page=signup_cliente">Registrar cliente</a></li> <!-- Enlace para registrar nuevos clientes -->                               
                                <li><a class="dropdown-item" href="index.php?page=listado_clientes">Listado de clientes</a></li> <!-- Enlace para ver el listado de clientes -->
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE FIDELIZACIÓN -->
                    <?php if (in_array('Fidelización', $modulos_array)): ?>                       
                        <li><a href="index.php?page=fidelizacion">Fidelización</a></li> <!-- Enlace directo a la página de fidelización -->
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE PROVEEDORES -->
                    <?php if (in_array('Proveedores', $modulos_array)): ?>                       
                        <li><a href="index.php?page=proveedores">Proveedores</a></li> <!-- Enlace directo a la página de proveedores -->
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE VENTAS -->
                    <?php if (in_array('Ventas', $modulos_array)): ?>                       
                        <li><a href="index.php?page=venta">Ventas</a></li> <!-- Enlace directo a la página de ventas -->
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE COMPRAS -->
                    <?php if (in_array('Compras', $modulos_array)): ?>                       
                        <li><a href="index.php?page=compras">Compras</a></li> <!-- Enlace directo a la página de compras -->
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE CAJA -->
                    <?php if (in_array('Caja', $modulos_array)): ?>                       
                        <li><a href="index.php?page=caja">Caja</a></li> <!-- Enlace directo a la página de caja -->
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE REPORTES -->
                    <?php if (in_array('Reportes', $modulos_array)): ?>                       
                        <li><a href="index.php?page=reportes">Reportes</a></li> <!-- Enlace directo a la página de reportes -->
                    <?php endif; ?>
                    <!-- Si tiene acceso al MÓDULO DE REPORTES o CAJA mostrar Auditorías -->
                    <?php if (in_array('Reportes', $modulos_array) || in_array('Caja', $modulos_array)): ?>
                        <li><a href="index.php?page=auditoria">Auditorías</a></li>
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE PRODUCTOS para mostrar tablas maestras de productos-->
                    <?php if (in_array('Productos', $modulos_array)): ?>                       
                        <li class="nav-item dropdown"> <!--Menú desplegable-->
                            <a class="nav-link dropdown-toggle" id="tablasMaestrasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tablas Maestras</a> <!-- Botón que activa el menú desplegable -->
                            <ul class="dropdown-menu" aria-labelledby="tablasMaestrasDropdown">                               
                                <li><a class="dropdown-item" href="index.php?page=marca">Marca</a></li>
                                <li><a class="dropdown-item" href="index.php?page=categoria">Categoría</a></li>
                                <li><a class="dropdown-item" href="index.php?page=forma">Forma</a></li>
                                <li><a class="dropdown-item" href="index.php?page=metodo_administracion">Método de administración</a></li>
                                <li><a class="dropdown-item" href="index.php?page=droga">Droga</a></li>
                                <li><a class="dropdown-item" href="index.php?page=lote">Lotes</a></li>
                                <li><a class="dropdown-item" href="index.php?page=tipo_contacto">Tipo de Contacto</a></li>
                                <li><a class="dropdown-item" href="index.php?page=tipo_producto">Tipo de Producto</a></li>
                                <li><a class="dropdown-item" href="index.php?page=origen">Origen</a></li>
                                <li><a class="dropdown-item" href="index.php?page=laboratorio">Laboratorio</a></li>
                                <li><a class="dropdown-item" href="index.php?page=accion_farmaceutica">Acción Farmacéutica</a></li>
                                <li><a class="dropdown-item" href="index.php?page=conservacion">Conservación</a></li>
                                <li><a class="dropdown-item" href="index.php?page=mediopago">Medios de pago</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Si tiene acceso al MÓDULO DE ROLES -->
                    <?php if (in_array('Roles', $modulos_array)): ?>                
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="rolesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Roles</a>
                            <ul class="dropdown-menu" aria-labelledby="rolesDropdown">                               
                                <li><a class="dropdown-item" href="index.php?page=roles">Listado y carga de Roles</a></li> <!-- Enlace a la página de roles, para gestionar roles de usuario -->
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Acceso directo al módulo Empresa -->
                    <li><a href="index.php?page=contacto_empresa">Empresa</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="personaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Personas</a>
                        <ul class="dropdown-menu" aria-labelledby="personaDropdown">
                            <li><a class="dropdown-item" href="index.php?page=persona&action=nuevo">Alta de Persona</a></li>
                            <li><a class="dropdown-item" href="index.php?page=persona">Listado de Personas</a></li>
                        </ul>
                    </li>
                    
                <?php endif; ?>
                
                <!-- Enlace para cerrar sesión - siempre visible para usuarios logueados -->
                <li><a href="views/salida.php" class="logout-link">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>
</header>