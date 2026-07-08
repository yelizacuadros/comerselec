<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Categoría - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC <span style="font-size: 16px; font-weight: normal;">Admin</span></h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                <li><a href="index.php?url=admin/categorias" style="background-color: rgba(255,255,255,0.1); color: white;">Gestión Categorías</a></li>
                <li><a href="index.php?url=admin/productos">Gestión Productos</a></li>
                <li><a href="index.php?url=admin/marcas">Gestión Marcas</a></li>
                <li><a href="index.php?url=admin/proveedores">Gestión Proveedores</a></li>
                <li><a href="index.php?url=admin/usuarios">Usuario</a></li> 
                <li><a href="index.php?url=admin/inventario">Inventario</a></li>
                <li><a href="index.php?url=admin/panel">Facturación</a></li> 
                <li><a href="index.php?url=admin/panel">Ventas</a></li>
                <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver Catálogo Público</a></li>
                <li><a href="index.php?url=admin/salir" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1><?php echo isset($category['id']) ? 'Editar' : 'Nueva'; ?> Categoría</h1>
                <a href="index.php?url=admin/categorias" class="btn btn-secondary">Volver</a>
            </div>
            <br>
            <div class="text-container" style="background: white; border-radius: 8px; max-width: 450px; margin: 0;">
                <form action="index.php?url=<?php echo isset($category['id']) ? 'admin/categorias_editar&id='.$category['id'] : 'admin/categorias_crear'; ?>" method="POST" id="categoryForm">
                    <div class="form-group">
                        <label>Nombre de la Categoría:</label>
                        <input type="text" name="name" id="cat_name" class="form-control" value="<?php echo isset($category['name']) ? htmlspecialchars($category['name']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción:</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo isset($category['description']) ? htmlspecialchars($category['description']) : ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin: auto; display: block;">Guardar Categoría</button>
                </form>
            </div>
        </main>
    </div>
    <script src="public/js/main.js"></script>
</body>
</html>
