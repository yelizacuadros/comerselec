<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <h1>Administración COMERSELEC</h1>
            <nav>
                <a href="index.php?action=dashboard">Dashboard</a>
                <a href="index.php?action=logout">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <div class="container" style="padding: 20px 0;">
        <h2>Mensajes de Clientes</h2>
        
        <table class="data-table">
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
    </div>
</body>
</html>
