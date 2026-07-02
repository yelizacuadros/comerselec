<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC Admin</h2>
            <ul class="admin-nav">
                <li><a href="index.php?action=dashboard">Dashboard</a></li>
                <li><a href="index.php?action=categories" style="background-color: rgba(255,255,255,0.1); color: white;">Gestión Categorías</a></li>
                <li><a href="index.php?action=products">Gestión Productos</a></li>
                <li><a href="index.php?action=catalog" target="_blank">Ver Catálogo Público</a></li>
                <li><a href="index.php?action=logout" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Gestión de Categorías</h1>
                <a href="index.php?action=categories_add" class="btn btn-primary">NUEVA CATEGORÍA</a>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
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
                            <a href="index.php?action=categories_edit&id=<?php echo $c['id']; ?>" class="btn btn-secondary">Editar</a>
                            <a href="index.php?action=categories_delete&id=<?php echo $c['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?');">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
