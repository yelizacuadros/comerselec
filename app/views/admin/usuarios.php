<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php $usuarios = $usuarios ?? []; ?>
    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?>
         
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Gestión de Usuarios</h1>
                <a href="index.php?url=admin/usuarios_crear" class="btn btn-primary">Registro</a>
            </div>
            
            <table class="admin-table" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Fecha De Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $c): ?>
                    <tr>
                        <td><?php echo $c['id']; ?></td>
                        <td><?php echo htmlspecialchars($c['username']); ?></td>
                        <td><?php echo htmlspecialchars($c['password']); ?></td>
                        <td><?php echo htmlspecialchars($c['created_at']); ?></td>
                        <td>
                            <a href="index.php?url=admin/usuarios_editar&id=<?php echo $c['id']; ?>" class="btn btn-secondary">Editar</a>
                            <a href="index.php?url=admin/usuarios_eliminar&id=<?php echo $c['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
