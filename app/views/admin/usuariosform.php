<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Usuarios - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC <span style="font-size: 16px; font-weight: normal;">Admin</span></h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                <li><a href="index.php?url=admin/categorias">GestiÃ³n CategorÃ­as</a></li>
                <li><a href="index.php?url=admin/productos">GestiÃ³n Productos</a></li>
                <li><a href="index.php?url=admin/marcas">GestiÃ³n Marcas</a></li> 
                <li><a href="index.php?url=admin/proveedores">GestiÃ³n Proveedores</a></li>
                <li><a href="index.php?url=admin/panel" style="background-color: rgba(255,255,255,0.1); color: white;">Usuario</a></li>
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
                <h1><?php echo isset($usuario['id']) ? 'Editar' : 'Nuevo'; ?> Usuario</h1>
                <a href="index.php?url=admin/usuarios" class="btn btn-secondary">Volver</a>
            </div>
            <br>
            <div class="text-container" style="background: white; border-radius: 8px; max-width: 350px; height: 410px; margin: 0;">
                <form action="index.php?url=<?php echo isset($usuario['id']) ? 'admin/usuarios_editar&id='.$usuario['id'] : 'admin/usuarios_crear'; ?>" method="POST" id="usuarioForm">
                    <div class="form-group">
                        <label>Nombre de Usuario:</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($usuario['username']) ? htmlspecialchars($usuario['username']) : ''; ?>" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>ContraseÃ±a:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Fecha de CreaciÃ³n:</label>
                        <input type="datetime-local" name="created_at" id="created_at" class="form-control" value="<?php echo isset($usuario['created_at']) ? date('Y-m-d\TH:i', strtotime($usuario['created_at'])) : ''; ?>" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin: auto; display: block;">Guardar Usuario</button>
                </form>
            </div>
        </main>
    </div>
    <script src="public/js/main.js"></script>
</body>
</html>
