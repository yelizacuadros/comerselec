<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Inventario - COMERSELEC S.A.</title>
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body>

    <?php $inventario = $inventario ?? [];?>

    <div class="admin-layout">
        <?php require_once __DIR__ . '/_sidebar.php'; ?>

        <main class="admin-content">

            <div class="admin-header">
                <h1>Gestión de Inventario</h1>
                <a href="index.php?url=admin/inventario_crear" class="btn btn-primary">
                    NUEVO REGISTRO
                </a>
            </div>

            <table class="admin-table" style="font-size:10px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Proveedor</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Ubicación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($inventario as $i): ?>
                    <tr>
                        <td><?php echo $i['id_inventario']; ?></td>
                        <td><?php echo htmlspecialchars($i['name']); ?></td>
                        <td><?php echo htmlspecialchars($i['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($i['marca']); ?></td>
                        <td><?php echo htmlspecialchars($i['proveedor']); ?></td>
                        <td>$<?php echo number_format($i['price'], 2); ?></td>
                        <td><?php echo $i['stock']; ?></td>
                        <td><?php echo htmlspecialchars($i['ubicacion']); ?></td>
                        <td>
                            <a href="index.php?url=admin/inventario_editar&id=<?php echo $i['id_inventario']; ?>" class="btn btn-secondary">Editar</a>
                            <a href="index.php?url=admin/inventario_eliminar&id=<?php echo $i['id_inventario']; ?>" class="btn btn-danger"
                            onclick="return confirm('¿Seguro que deseas eliminar este registro?');">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
    </body>
</html>
