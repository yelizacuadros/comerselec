<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Proveedores - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <?php $proveedores = $proveedores ?? []; ?>

    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?>
        <main class="admin-content">
            <div class="admin-header">
                <h1>Gestión de Proveedores</h1>
                <a href="index.php?url=admin/proveedores_crear" class="btn btn-primary">
                    NUEVO PROVEEDOR
                </a>
            </div>
            <table class="admin-table" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($proveedores as $p): ?>
                    <tr>
                        <td>
                            <?php echo $p['id_proveedor']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($p['nombre']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($p['correo']); ?>
                        </td>


                        <td>
                            <?php echo htmlspecialchars($p['telefono']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($p['direccion']); ?>
                        </td>

                        <td>
                            <a href="index.php?url=admin/proveedores_editar&id=<?php echo $p['id_proveedor']; ?>" 
                               class="btn btn-secondary">
                                Editar
                            </a>

                            <a href="index.php?url=admin/proveedores_eliminar&id=<?php echo $p['id_proveedor']; ?>" 
                               class="btn btn-danger"
                               onclick="return confirm('¿Seguro que deseas eliminar este proveedor?');">
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
