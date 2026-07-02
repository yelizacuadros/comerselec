<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC Admin</h2>
            <ul class="admin-nav">
                <li><a href="index.php?action=dashboard">Dashboard</a></li>
                <li><a href="index.php?action=categories">Gestión Categorías</a></li>
                <li><a href="index.php?action=products">Gestión Productos</a></li>
                <li><a href="index.php?action=catalog" target="_blank">Ver Catálogo Público</a></li>
                <li><a href="index.php?action=logout" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Dashboard</h1>
                <div>Usuario Activo</div>
            </div>
            
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <h3>Bienvenido al Panel de Administración</h3>
                <p style="margin-top: 10px;">Desde aquí puedes gestionar todo el inventario de materiales eléctricos. Los cambios que realices se reflejarán automáticamente en el catálogo público.</p>
                <br>
                <div style="display: flex; gap: 20px;">
                    <a href="index.php?action=categories_add" class="btn btn-primary">Añadir Categoría</a>
                    <a href="index.php?action=products_add" class="btn btn-secondary">Añadir Producto</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
