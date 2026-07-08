<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensajes - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php $messages = $messages ?? []; ?>
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
                <li><a href="index.php?url=admin/inventario">Inventario</a></li>
                <li><a href="index.php?url=admin/panel">Facturación</a></li>
                <li><a href="index.php?url=admin/panel">Ventas</a></li>
                <li><a href="index.php?url=admin/mensajes" style="background-color: rgba(255,255,255,0.1); color: white;">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver Catálogo Público</a></li>
                <li><a href="index.php?url=admin/salir" style="color: #e74c3c;">Cerrar Sesión</a></li>
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
