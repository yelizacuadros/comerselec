<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CategorÃ­as - COMERSELEC S.A.</title>
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
                <li><a href="index.php?url=admin/categorias" style="background-color: rgba(255,255,255,0.1); color: white;">GestiÃ³n CategorÃ­as</a></li>
                <li><a href="index.php?url=admin/productos">GestiÃ³n Productos</a></li>
                <li><a href="index.php?url=admin/marcas">GestiÃ³n Marcas</a></li>
                <li><a href="index.php?url=admin/proveedores">GestiÃ³n Proveedores</a></li>
                <li><a href="index.php?url=admin/usuarios">Usuario</a></li>
                <li><a href="index.php?url=admin/inventario">Inventario</a></li> 
                <li><a href="index.php?url=admin/panel">FacturaciÃ³n</a></li>
                <li><a href="index.php?url=admin/panel">Ventas</a></li> 
                <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver CatÃ¡logo PÃºblico</a></li>
                <li><a href="index.php?url=admin/salir" style="color: #e74c3c;">Cerrar SesiÃ³n</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>GestiÃ³n de CategorÃ­as</h1>
                <a href="index.php?url=admin/categorias_crear" class="btn btn-primary">NUEVA CATEGORÃA</a>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>DescripciÃ³n</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $c): ?>
                    <tr>
                        <td><?php echo $c['id']; ?></td>
                        <td><?php echo htmlspecialchars($c['name']); ?></td>
                        <td><?php echo htmlspecialchars($c['description']); ?></td>
                        <td>
                            <a href="index.php?url=admin/categorias_editar&id=<?php echo $c['id']; ?>" class="btn btn-secondary">Editar</a>
                            <a href="index.php?url=admin/categorias_eliminar&id=<?php echo $c['id']; ?>" class="btn btn-danger" onclick="return confirm('Â¿Seguro que deseas eliminar esta categorÃ­a?');">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
