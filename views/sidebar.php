<?php
?>
<!-- Menú lateral con clase y estructura recomendada -->
<nav class="sidebar">
    <ul class="sidebar-menu">
        <li><a href="index.php?page=inicio" class="sidebar-btn">Inicio</a></li>
        <li>
            <a href="#" class="sidebar-btn" onclick="toggleRegistrarMenu()">Registrar</a>
            <ul id="registrar-submenu" class="sidebar-submenu" style="display:none; padding-left:0;">
                <li><a href="index.php?page=persona" class="sidebar-btn submenu-btn">Persona</a></li>
                <li><a href="index.php?page=cliente" class="sidebar-btn submenu-btn">Cliente</a></li>
                <li><a href="index.php?page=usuario" class="sidebar-btn submenu-btn">Usuario</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="sidebar-btn" onclick="toggleTablasMenu()">Tablas Maestras</a>
            <ul id="tablas-submenu" class="sidebar-submenu" style="display:none; padding-left:0;">
                <li><a href="index.php?page=categoria" class="sidebar-btn submenu-btn">Categorías</a></li>
                <li><a href="index.php?page=droga" class="sidebar-btn submenu-btn">Drogas</a></li>
                <li><a href="index.php?page=forma" class="sidebar-btn submenu-btn">Formas</a></li>
                <li><a href="index.php?page=marca" class="sidebar-btn submenu-btn">Marcas</a></li>
                <li><a href="index.php?page=metodo_administracion" class="sidebar-btn submenu-btn">Métodos de Administración</a></li>
                <li><a href="index.php?page=tipo_contacto" class="sidebar-btn submenu-btn">Tipo de Contacto</a></li>
            </ul>
        </li>
        <li><a href="index.php?page=producto" class="sidebar-btn">Productos</a></li>
        <li><a href="index.php?page=roles" class="sidebar-btn">Roles</a></li>
        <li><a href="index.php?page=mediopago" class="sidebar-btn">Medios de Pago</a></li>
    <li><a href="index.php?page=venta" class="sidebar-btn">Ventas</a></li>
    <li><a href="index.php?page=compra" class="sidebar-btn">Compras</a></li>
    <li><a href="index.php?page=caja" class="sidebar-btn">Caja</a></li>
    <li><a href="index.php?page=auditoria" class="sidebar-btn">Auditorías</a></li>
    <li><a href="index.php?page=proveedores" class="sidebar-btn">Proveedores</a></li>
    <li><a href="index.php?page=contacto_empresa" class="sidebar-btn">Empresa</a></li>
    <li style="margin-top:32px;"><a href="index.php?page=salida" class="sidebar-btn">Cerrar sesión</a></li>
    </ul>
</nav>
<script>
function toggleRegistrarMenu() {
    var submenu = document.getElementById('registrar-submenu');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
}
function toggleTablasMenu() {
    var submenu = document.getElementById('tablas-submenu');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
}
</script>