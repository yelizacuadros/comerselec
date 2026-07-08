<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formulario Inventario - COMERSELEC S.A.</title>
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body>

    <?php $products = $products ?? []; ?>

    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC <span style="font-size:16px; color:var(--light-blue); font-weight:normal;">Admin</span></h2>

            <ul class="admin-nav" style="border-top:3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                <li><a href="index.php?url=admin/categorias">GestiÃ³n CategorÃ­as</a></li>
                <li><a href="index.php?url=admin/productos">GestiÃ³n Productos</a></li>
                <li><a href="index.php?url=admin/marcas">GestiÃ³n Marcas</a></li>
                <li><a href="index.php?url=admin/proveedores">GestiÃ³n Proveedores</a></li>
                <li><a href="index.php?url=admin/usuarios">Usuario</a></li>
                <li><a href="index.php?url=admin/inventario" style="background-color: rgba(255,255,255,0.1); color:white;">Inventario</a></li>
                <li><a href="index.php?url=admin/panel">FacturaciÃ³n</a></li>
                <li><a href="index.php?url=admin/panel">Ventas</a></li>
                <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver CatÃ¡logo PÃºblico</a></li>
                <li><a href="index.php?url=admin/salir" style="color:#e74c3c;">Cerrar SesiÃ³n</a></li>
            </ul>
        </aside>

        <main class="admin-content">

            <div class="admin-header">
                <h1><?php echo isset($inventario['id_inventario']) ? 'Editar' : 'Nuevo'; ?> Inventario</h1>
                <a href="index.php?url=admin/inventario" class="btn btn-secondary">Volver</a>
            </div>

            <br>

            <div class="text-container" style="background:white; border-radius:8px; max-width:600px; margin:0;">
                <form action="index.php?url=<?php echo isset($inventario['id_inventario']) ? 'admin/inventario_editar&id='.$inventario['id_inventario'] : 'admin/inventario_crear'; ?>" method="POST" id="inventarioForm">
                    <div class="form-group">
                        <label>Producto:</label>
                        <?php if(isset($inventario['id_inventario'])): ?>
                            <input type="text"
                                class="form-control"
                                value="<?php echo htmlspecialchars($inventario['name']); ?>"
                                readonly>
                            <input type="hidden"
                                name="id_producto"
                                value="<?php echo $inventario['id_producto']; ?>">
                        <?php else: ?>

                            <select name="id_producto" id="inv_producto" class="form-control" required>
                                <option value="">Seleccione un producto</option>
                                <?php foreach($products as $p): ?>
                                    <option value="<?php echo $p['id']; ?>">
                                        <?php echo htmlspecialchars($p['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Stock:</label>
                        <input
                            type="number"
                            id="inv_stock"
                            name="stock"
                            min="0"
                            class="form-control"
                            value="<?php echo isset($inventario['stock']) ? $inventario['stock'] : 0; ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label>UbicaciÃ³n:</label>
                        <input
                            type="text"
                            id="inv_ubicacion"
                            name="ubicacion"
                            class="form-control"
                            value="<?php echo isset($inventario['ubicacion']) ? htmlspecialchars($inventario['ubicacion']) : ''; ?>"
                            required>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary" style="margin:auto; display:block;">
                        Guardar
                    </button>
                </form>
            </div>
        </main>
    </div>
    <script src="public/js/main.js"></script>
    </body>
</html>
