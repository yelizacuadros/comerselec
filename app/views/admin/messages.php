<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensajes - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>COMERSELEC Admin</h2>
            <ul class="admin-nav">
                <li><a href="index.php?action=dashboard">Dashboard</a></li>
                <li><a href="index.php?action=categories">Gestión Categorías</a></li>
                <li><a href="index.php?action=products">Gestión Productos</a></li>
                <li><a href="index.php?action=messages" style="background-color: rgba(255,255,255,0.1); color: white;">Mensajes</a></li>
                <li><a href="index.php?action=catalog" target="_blank">Ver Catálogo Público</a></li>
                <li><a href="index.php?action=logout" style="color: #e74c3c;">Cerrar Sesión</a></li>
            </ul>
        </aside>

        <main class="admin-content">
            <div class="admin-header">
                <h1>Mensajes de Clientes</h1>
            </div>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($messages) > 0): ?>
                        <?php foreach($messages as $msg): ?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i', strtotime($msg['created_at'])); ?></td>
                                <td><?php echo htmlspecialchars($msg['name']); ?></td>
                                <td><?php echo htmlspecialchars($msg['email']); ?></td>
                                <td><?php echo htmlspecialchars($msg['subject']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($msg['message'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay mensajes de contacto.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>