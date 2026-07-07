<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <?php $inventario = $inventario ?? []; ?>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC <span style="font-size: 16px; color: var(--light-blue); font-weight: normal;">Admin</span></h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                <li><a href="index.php?url=admin/categorias">Gestión Categorías</a></li>
                <li><a href="index.php?url=admin/productos">Gestión Productos</a></li>
                <li><a href="index.php?url=admin/marcas">Gestión Marcas</a></li>
                <li><a href="index.php?url=admin/proveedores">Gestión Proveedores</a></li>
                <li><a href="index.php?url=admin/usuarios">Usuario</a></li>
                <li><a href="index.php?url=admin/inventario" style="background-color: rgba(255,255,255,0.1); color: white;">Inventario</a></li>
                <li><a href="index.php?url=admin/panel">Facturación</a></li>
                <li><a href="index.php?url=admin/panel">Ventas</a></li>
                <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver Catálogo Público</a></li>
                <li><a href="index.php?url=admin/salir" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Gestión de Inventario</h1>
                <a href="index.php?url=admin/inventario_crear" class="btn btn-primary">NUEVO REGISTRO</a>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Proveedor</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($inventario as $p): ?>
                    <tr>
                        <td><?php echo $i['id_inventario']; ?></td>
                        <td><?php echo htmlspecialchars($i['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($i['marca']); ?></td>
                        <td><?php echo htmlspecialchars($i['proveedor']); ?></td>
                        <td><?php echo htmlspecialchars($i['name']); ?></td>
                        <td>$<?php echo number_format($i['price'],2); ?></td>
                        <td><?php echo $i['stock']; ?></td>
                        <td>
                            <a href="index.php?url=admin/inventario_editar&id=<?php echo $i['id_inventario']; ?>" class="btn btn-secondary">Editar</a>

                            <a href="index.php?url=admin/inventario_eliminar&id=<?php echo $i['id_inventario']; ?>" class="btn btn-danger"
                            onclick="return confirm('¿Seguro que deseas eliminar este registro?');">
                            Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
