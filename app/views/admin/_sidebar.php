<?php
$currentUrl = $_GET['url'] ?? 'admin/panel';
$user = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin';
?>
<aside class="admin-sidebar">
    <h2>COMERSELEC<br><span class="sidebar-user"><?php echo $user; ?></span></h2>

    <nav class="sidebar-groups">
        <div class="sidebar-group">
            <span class="sidebar-group-title">Panel</span>
            <ul class="admin-nav">
                <li><a href="index.php?url=admin/panel" class="<?php echo $currentUrl === 'admin/panel' ? 'active' : ''; ?>">Dashboard</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver Catálogo Público</a></li>
            </ul>
        </div>

        <div class="sidebar-group">
            <span class="sidebar-group-title">Operación</span>
            <ul class="admin-nav">
                <li><a href="index.php?url=admin/facturacion" class="<?php echo $currentUrl === 'admin/facturacion' ? 'active' : ''; ?>">Facturación</a></li>
                <li><a href="index.php?url=admin/ventas" class="<?php echo $currentUrl === 'admin/ventas' ? 'active' : ''; ?>">Ventas</a></li>
                <li><a href="index.php?url=admin/inventario" class="<?php echo strpos($currentUrl, 'admin/inventario') === 0 ? 'active' : ''; ?>">Inventario</a></li>
                <li><a href="index.php?url=admin/mensajes" class="<?php echo $currentUrl === 'admin/mensajes' ? 'active' : ''; ?>">Mensajes</a></li>
            </ul>
        </div>

        <div class="sidebar-group">
            <span class="sidebar-group-title">Catálogo</span>
            <ul class="admin-nav">
                <li><a href="index.php?url=admin/productos" class="<?php echo strpos($currentUrl, 'admin/productos') === 0 ? 'active' : ''; ?>">Productos</a></li>
                <li><a href="index.php?url=admin/categorias" class="<?php echo strpos($currentUrl, 'admin/categorias') === 0 ? 'active' : ''; ?>">Categorías</a></li>
                <li><a href="index.php?url=admin/marcas" class="<?php echo strpos($currentUrl, 'admin/marcas') === 0 ? 'active' : ''; ?>">Marcas</a></li>
                <li><a href="index.php?url=admin/proveedores" class="<?php echo strpos($currentUrl, 'admin/proveedores') === 0 ? 'active' : ''; ?>">Proveedores</a></li>
            </ul>
        </div>

        <div class="sidebar-group">
            <span class="sidebar-group-title">Accesos</span>
            <ul class="admin-nav">
                <li><a href="index.php?url=admin/usuarios" class="<?php echo strpos($currentUrl, 'admin/usuarios') === 0 ? 'active' : ''; ?>">Usuarios</a></li>
                <li><a href="index.php?url=admin/salir" class="danger-link">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>
</aside>
