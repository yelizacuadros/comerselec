<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario CategorÃ­a - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC <span style="font-size: 16px; font-weight: normal;">Admin</span></h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                <li><a href="index.php?url=admin/categorias" style="background-color: rgba(255,255,255,0.1); color: white;">GestiÃ³n CategorÃ­as</a></li>
                <li><a href="index.php?url=admin/productos">GestiÃ³n Productos</a></li>
                <li><a href="index.php?url=admin/marcas">GestiÃ³n Marcas</a></li>
                <li><a href="index.php?url=admin/proveedores">GestiÃ³n Proveedores</a></li>
                <li><a href="index.php?url=admin/usuarios">Usuario</a></li> 
                <li><a href="index.php?url=admin/inventario">Inventario</a></li>
                <li><a href="index.php?url=admin/panel">FacturaciÃ³n</a></li> 
                <li><a href="index.php?url=admin/panel">Ventas</a></li>
                <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver CatÃ¡logo PÃºblico</a></li>
                <li><a href="index.php?url=admin/salir" style="color: #e74c3c;">Cerrar SesiÃ³n</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1><?php echo isset($category['id']) ? 'Editar' : 'Nueva'; ?> CategorÃ­a</h1>
                <a href="index.php?url=admin/categorias" class="btn btn-secondary">Volver</a>
            </div>
            <br>
            <div class="text-container" style="background: white; border-radius: 8px; max-width: 450px; margin: 0;">
                <form action="index.php?url=<?php echo isset($category['id']) ? 'admin/categorias_editar&id='.$category['id'] : 'admin/categorias_crear'; ?>" method="POST" id="categoryForm">
                    <div class="form-group">
                        <label>Nombre de la CategorÃ­a:</label>
                        <input type="text" name="name" id="cat_name" class="form-control" value="<?php echo isset($category['name']) ? htmlspecialchars($category['name']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>DescripciÃ³n:</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo isset($category['description']) ? htmlspecialchars($category['description']) : ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin: auto; display: block;">Guardar CategorÃ­a</button>
                </form>
            </div>
        </main>
    </div>
    <script src="public/js/main.js"></script>
</body>
</html>
