<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Producto - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php $categories = $categories ?? []; ?>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC <span style="font-size: 16px; color: var(--light-blue); font-weight: normal;">Admin</span></h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                <li><a href="index.php?url=admin/categorias">GestiÃ³n CategorÃ­as</a></li>
                <li><a href="index.php?url=admin/productos" style="background-color: rgba(255,255,255,0.1); color: white;">GestiÃ³n Productos</a></li>
                <li><a href="index.php?url=admin/marcas">GestiÃ³n Marcas</a></li>
                <li><a href="index.php?url=admin/proveedores">GestiÃ³n Proveedores</a></li>
                <li><a href="index.php?url=admin/usuarios">Usuario</a></li> 
                <li><a href="index.php?url=admin/panel">Inventario</a></li> 
                <li><a href="index.php?url=admin/panel">FacturaciÃ³n</a></li>
                <li><a href="index.php?url=admin/panel">Ventas</a></li>
                <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver CatÃ¡logo PÃºblico</a></li>
                <li><a href="index.php?url=admin/salir" style="color: #e74c3c;">Cerrar SesiÃ³n</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1><?php echo isset($product['id']) ? 'Editar' : 'Nuevo'; ?> Producto</h1>
                <a href="index.php?url=admin/productos" class="btn btn-secondary">Volver</a>
            </div>
            <br>
            <div class="text-container" style="background: white; border-radius: 8px; max-width: 600px; margin: 0;">
                <form action="index.php?url=<?php echo isset($product['id']) ? 'admin/productos_editar&id='.$product['id'] : 'admin/productos_crear'; ?>" method="POST" id="productForm">
                    
                    <div class="form-group">
                        <label>CategorÃ­a:</label>
                        <select name="category_id" id="prod_category" class="form-control" required>
                            <option value="">Seleccione una categorÃ­a</option>
                            <?php foreach($categories as $c): ?>
                                <option value="<?php echo $c['id']; ?>" <?php echo (isset($product['category_id']) && $product['category_id'] == $c['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($c['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Marca:</label>
                        <select name="id_marca" class="form-control" required>
                            <option value="">Seleccione una marca</option>
                            <?php foreach($marcas as $m): ?>
                                <option value="<?php echo $m['id_marca']; ?>"
                                    <?php echo (isset($product['id_marca']) && $product['id_marca'] == $m['id_marca']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($m['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Proveedor:</label>
                        <select name="id_proveedor" class="form-control" required>
                            <option value="">Seleccione un proveedor</option>
                            <?php foreach($proveedores as $p): ?>
                                <option value="<?php echo $p['id_proveedor']; ?>"
                                    <?php echo (isset($product['id_proveedor']) && $product['id_proveedor'] == $p['id_proveedor']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($p['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nombre del Producto:</label>
                        <input type="text" name="name" id="prod_name" class="form-control" value="<?php echo isset($product['name']) ? htmlspecialchars($product['name']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>DescripciÃ³n:</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo isset($product['description']) ? htmlspecialchars($product['description']) : ''; ?></textarea>
                    </div>

                    <div class="form-group" style="display: flex; gap: 20px;">
                        <div style="flex: 1;">
                            <label>Precio ($):</label>
                            <input type="number" step="0.01" min="0" name="price" id="prod_price" class="form-control" 
                            value="<?php echo $product['price'] ?? ''; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>URL de la Imagen (Opcional)</label>
                        <input type="url" name="image_url" class="form-control" value="<?php echo isset($product['image_url']) ? htmlspecialchars($product['image_url']) : ''; ?>" placeholder="https://ejemplo.com/imagen.jpg">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin: auto; display: block;">Guardar Producto</button>
                </form>
            </div>
        </main>
    </div>
    <script src="public/js/main.js"></script>
</body>
</html>
