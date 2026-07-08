<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php $categories = $categories ?? []; ?>
    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Gestión de Categorías</h1>
                <a href="index.php?url=admin/categorias_crear" class="btn btn-primary">NUEVA CATEGORÍA</a>
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
                            <a href="index.php?url=admin/categorias_editar&id=<?php echo $c['id']; ?>" class="btn btn-secondary">Editar</a>
                            <a href="index.php?url=admin/categorias_eliminar&id=<?php echo $c['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?');">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
