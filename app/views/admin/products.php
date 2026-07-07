<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <?php $products = $products ?? []; ?>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC <span style="font-size: 16px; color: var(--light-blue); font-weight: normal;">Admin</span></h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                <li><a href="index.php?url=admin/categorias">Gestión Categorías</a></li>
                <li><a href="index.php?url=admin/productos" style="background-color: rgba(255,255,255,0.1); color: white;">Gestión Productos</a></li>
                <li><a href="index.php?url=admin/marcas">Gestión Marcas</a></li>
                <li><a href="index.php?url=admin/proveedores">Gestión Proveedores</a></li>
                <li><a href="index.php?url=admin/usuarios">Usuario</a></li>
                <li><a href="index.php?url=admin/inventario">Inventario</a></li>
                <li><a href="index.php?url=admin/panel">Facturación</a></li>
                <li><a href="index.php?url=admin/panel">Ventas</a></li>
                <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver Catálogo Público</a></li>
                <li><a href="index.php?url=admin/salir" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Gestión de Productos</h1>
                <a href="index.php?url=admin/productos_crear" class="btn btn-primary">NUEVO PRODUCTO</a>
            </div>
            
            <table class="admin-table" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Proveedor</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $p): ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td><?php echo htmlspecialchars($p['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($p['marca']); ?></td>
                        <td><?php echo htmlspecialchars($p['proveedor']); ?></td>
                        <td><?php echo htmlspecialchars($p['name']); ?></td>
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
