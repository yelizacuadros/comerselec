<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Usuarios - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC <span style="font-size: 16px; font-weight: normal;">Admin</span></h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                <li><a href="index.php?url=admin/categorias">Gestión Categorías</a></li>
                <li><a href="index.php?url=admin/productos">Gestión Productos</a></li>
                <li><a href="index.php?url=admin/marcas">Gestión Marcas</a></li> 
                <li><a href="index.php?url=admin/proveedores">Gestión Proveedores</a></li>
                <li><a href="index.php?url=admin/panel" style="background-color: rgba(255,255,255,0.1); color: white;">Usuario</a></li>
                <li><a href="index.php?url=admin/panel">Inventario</a></li>
                <li><a href="index.php?url=admin/panel">Facturación</a></li>
                <li><a href="index.php?url=admin/panel">Ventas</a></li>
                <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver Catálogo Público</a></li>
                <li><a href="index.php?url=admin/salir" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside> 

        
        <main class="admin-content">
            <div class="admin-header">
                <h1><?php echo isset($usuario['id']) ? 'Editar' : 'Nuevo'; ?> Usuario</h1>
                <a href="index.php?url=admin/usuarios" class="btn btn-secondary">Volver</a>
            </div>
            <br>
            <div class="text-container" style="background: white; border-radius: 8px; max-width: 450px; margin: 0;">
                <form action="index.php?url=<?php echo isset($usuario['id']) ? 'admin/usuarios_editar&id='.$usuario['id'] : 'admin/usuarios_crear'; ?>" method="POST" id="usuarioForm">
                    <div class="form-group">
                        <label>Nombre de Usuario:</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($usuario['username']) ? htmlspecialchars($usuario['username']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Creación:</label>
                        <input type="datetime-local" name="created_at" id="created_at" class="form-control" value="<?php echo isset($usuario['created_at']) ? date('Y-m-d\TH:i', strtotime($usuario['created_at'])) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Rol:</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">Seleccionar Rol</option>
                            <option value="admin" <?php echo isset($usuario['role']) && $usuario['role'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                            <option value="user" <?php echo isset($usuario['role']) && $usuario['role'] === 'user' ? 'selected' : ''; ?>>Usuario</option>
                            <option value="compras" <?php echo isset($usuario['role']) && $usuario['role'] === 'compras' ? 'selected' : ''; ?>>Compras</option>
                            <option value="ventas" <?php echo isset($usuario['role']) && $usuario['role'] === 'ventas' ? 'selected' : ''; ?>>Ventas</option>
                            <option value="Contabilidad" <?php echo isset($usuario['role']) && $usuario['role'] === 'Contabilidad' ? 'selected' : ''; ?>>Contabilidad</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin: auto; display: block;">Guardar Usuario</button>
                </form>
            </div>
        </main>
    </div>
    <script src="js/main.js"></script>
</body>
</html>