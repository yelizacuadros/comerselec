<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formulario Usuario - COMERSELEC S.A.</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="admin-layout">

            <aside class="admin-sidebar">
                <h2>COMERSELEC <span style="font-size:16px;font-weight:normal;">Admin</span></h2>

                <ul class="admin-nav" style="border-top:3px solid var(--secondary-orange);">
                    <br>
                    <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                    <li><a href="index.php?url=admin/categorias">Gestión Categorías</a></li>
                    <li><a href="index.php?url=admin/productos">Gestión Productos</a></li>
                    <li><a href="index.php?url=admin/panel">Marca</a></li>
                    <li><a href="index.php?url=admin/usuarios" style="background-color: rgba(255,255,255,0.1); color:white;">Usuario</a></li>
                    <li><a href="index.php?url=admin/panel">Proveedor</a></li>
                    <li><a href="index.php?url=admin/panel">Inventario</a></li>
                    <li><a href="index.php?url=admin/panel">Facturación</a></li>
                    <li><a href="index.php?url=admin/panel">Ventas</a></li>
                    <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                    <li><a href="index.php?url=catalogo" target="_blank">Ver Catálogo Público</a></li>
                    <li><a href="index.php?url=admin/salir" style="color:#e74c3c;">Cerrar Sesión</a></li>
                </ul>
            </aside>

            <main class="admin-content">

                <div class="admin-header">
                    <h1>Nuevo Usuario</h1>
                    <a href="index.php?url=admin/usuarios" class="btn btn-secondary">Volver</a>
                </div>

                <br>

                <div class="text-container" style="background:white; border-radius:8px; max-width:350px; min-height:400px; margin:0;">

                    <?php if(isset($error) && !empty($error)): ?>
                        <div style="background:#f8d7da;color:#721c24;padding:10px;margin-bottom:15px;">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($success) && !empty($success)): ?>
                        <div style="background:#d4edda;color:#155724;padding:10px;margin-bottom:15px;">
                            <?= $success ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?url=admin/registro" method="POST">

                        <div class="form-group">
                            <label>Usuario:</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Rol:</label>
                            <select name="role" class="form-control">
                                <option value="Administrador">Administrador</option>
                                <option value="Compras">Compras</option>
                                <option value="Ventas">Ventas</option>
                                <option value="Contabilidad">Contabilidad</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" style="margin:auto; display:block;">
                            Registrar Usuario
                        </button>
                    </form>
                </div>
            </main>
        </div>
        <script src="js/main.js"></script>
    </body>
</html>