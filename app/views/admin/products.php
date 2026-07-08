<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    
    <?php $products = $products ?? []; ?>
    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Gestión de Productos</h1>
                <a href="index.php?url=admin/productos_crear" class="btn btn-primary">NUEVO PRODUCTO</a>
            </div>
            
            <table class="admin-table" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Proveedor</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($products as $p): ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td><?php echo htmlspecialchars($p['name']); ?></td>
                        <td><?php echo htmlspecialchars($p['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($p['marca']); ?></td>
                        <td><?php echo htmlspecialchars($p['proveedor']); ?></td>
                        <td>$<?php echo number_format($p['price'], 2); ?></td>
                        <td>
                            <a href="index.php?url=admin/productos_editar&id=<?php echo $p['id']; ?>" class="btn btn-secondary">Editar</a>
                            <a href="index.php?url=admin/productos_eliminar&id=<?php echo $p['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>

