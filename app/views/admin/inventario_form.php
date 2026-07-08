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
        <?php require_once __DIR__ . '/_sidebar.php'; ?>

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
                        <label>Ubicación:</label>
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
