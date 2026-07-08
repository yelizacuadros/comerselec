<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Proveedor - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
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
            <li><a href="index.php?url=admin/categorias">GestiÃ³n CategorÃ­as</a></li>
            <li><a href="index.php?url=admin/productos">GestiÃ³n Productos</a></li>
            <li><a href="index.php?url=admin/marcas">GestiÃ³n Marcas</a></li>
            <li>
                <a href="index.php?url=admin/proveedores" 
                style="background-color: rgba(255,255,255,0.1); color: white;">
                    GestiÃ³n Proveedores
                </a>
            </li>
            <li><a href="index.php?url=admin/usuarios">Usuario</a></li>
            <li><a href="index.php?url=admin/inventario">Inventario</a></li>
            <li><a href="index.php?url=admin/panel">FacturaciÃ³n</a></li>
            <li><a href="index.php?url=admin/panel">Ventas</a></li>
            <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
            <li><a href="index.php?url=catalogo" target="_blank">Ver CatÃ¡logo PÃºblico</a></li>
            <li>
                <a href="index.php?url=admin/salir" style="color:#e74c3c;">
                    Cerrar SesiÃ³n
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
            <!-- Verifica si existe un error enviado por el controlador y lo muestra al usuario -->
            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>
            <form 
                action="index.php?url=<?php echo isset($proveedor['id_proveedor']) 
                ? 'admin/proveedores_editar&id='.$proveedor['id_proveedor'] 
                : 'admin/proveedores_crear'; ?>" 
                method="POST" 
                id="proveedorForm">
                <div class="form-group">
                    <label>
                        Nombre del Proveedor:
                    </label>
                    <input 
                        type="text"
                        id="nombre_proveedor"
                        name="nombre"
                        class="form-control"
                        maxlength="100"
                        value="<?php echo isset($proveedor['nombre']) 
                        ? htmlspecialchars($proveedor['nombre']) 
                        : ''; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>
                        TelÃ©fono:
                    </label>
                    <input 
                        type="text"
                        id="telefono_proveedor"
                        name="telefono"
                        class="form-control"
                        maxlength="15"
                        value="<?php echo isset($proveedor['telefono']) 
                        ? htmlspecialchars($proveedor['telefono']) 
                        : ''; ?>"
                        required>
                </div>


                <div class="form-group">
                    <label>
                        Correo:
                    </label>
                    <input 
                        type="email"
                        id="correo_proveedor"
                        name="correo"
                        class="form-control"
                        value="<?php echo isset($proveedor['correo']) 
                        ? htmlspecialchars($proveedor['correo']) 
                        : ''; ?>"
                        required>
                </div>


                <div class="form-group">
                    <label>
                        DirecciÃ³n:
                    </label>
                    <textarea
                        id="direccion_proveedor"
                        name="direccion"
                        class="form-control"
                        rows="4"
                        maxlength="255"
                        required><?php echo isset($proveedor['direccion']) 
                        ? htmlspecialchars($proveedor['direccion']) 
                        : ''; ?></textarea>
                </div>
                <button 
                    type="submit" 
                    class="btn btn-primary" 
                    style="margin:auto; display:block;">

                    Guardar Proveedor
                </button>
            </form>
        </div>
    </main>
</div>
<script src="public/js/main.js"></script>
</body>
</html>
