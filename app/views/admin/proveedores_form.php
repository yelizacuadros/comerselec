<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Proveedor - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="admin-layout">
    <aside class="admin-sidebar">
        <h2>
            COMERSELEC 
            <span style="font-size: 16px; font-weight: normal;">
                Admin
            </span>
        </h2>
        <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
            <br>
            <li><a href="index.php?url=admin/panel">Dashboard</a></li>
            <li><a href="index.php?url=admin/categorias">Gestión Categorías</a></li>
            <li><a href="index.php?url=admin/productos">Gestión Productos</a></li>
            <li><a href="index.php?url=admin/marcas">Gestión Marcas</a></li>
            <li>
                <a href="index.php?url=admin/proveedores" 
                style="background-color: rgba(255,255,255,0.1); color: white;">
                    Gestión Proveedores
                </a>
            </li>
            <li><a href="index.php?url=admin/usuarios">Usuario</a></li>
            <li><a href="index.php?url=admin/panel">Inventario</a></li>
            <li><a href="index.php?url=admin/panel">Facturación</a></li>
            <li><a href="index.php?url=admin/panel">Ventas</a></li>
            <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
            <li><a href="index.php?url=catalogo" target="_blank">Ver Catálogo Público</a></li>
            <li>
                <a href="index.php?url=admin/salir" style="color:#e74c3c;">
                    Cerrar Sesión
                </a>
            </li>
        </ul>
    </aside>



    <main class="admin-content">
        <div class="admin-header">
            <h1>
                <?php echo isset($proveedor['id_proveedor']) ? 'Editar' : 'Nuevo'; ?> Proveedor
            </h1>
            <a href="index.php?url=admin/proveedores" class="btn btn-secondary">
                Volver
            </a>
        </div>
        <br>
        <div class="text-container" style="background:white; border-radius:8px; max-width:450px; margin:0;">
            <form action="index.php?url=<?php echo isset($proveedor['id_proveedor']) ? 'admin/proveedores_editar&id='.$proveedor['id_proveedor'] : 'admin/proveedores_crear'; ?>" 
                  method="POST" 
                  id="proveedorForm">
                <div class="form-group">
                    <label>Nombre del Proveedor:</label>
                    <input 
                        type="text" 
                        name="nombre" 
                        class="form-control"
                        value="<?php echo isset($proveedor['nombre']) ? htmlspecialchars($proveedor['nombre']) : ''; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Teléfono:</label>
                    <input 
                        type="text" 
                        name="telefono" 
                        class="form-control"
                        value="<?php echo isset($proveedor['telefono']) ? htmlspecialchars($proveedor['telefono']) : ''; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Correo:</label>
                    <input 
                        type="email" 
                        name="correo" 
                        class="form-control"
                        value="<?php echo isset($proveedor['correo']) ? htmlspecialchars($proveedor['correo']) : ''; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Dirección:</label>
                    <textarea 
                        name="direccion" 
                        class="form-control" 
                        rows="4"
                        required><?php echo isset($proveedor['direccion']) ? htmlspecialchars($proveedor['direccion']) : ''; ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="margin:auto; display:block;">
                    Guardar Proveedor
                </button>
            </form>
        </div>
    </main>
</div>
<script src="js/main.js"></script>
</body>
</html>