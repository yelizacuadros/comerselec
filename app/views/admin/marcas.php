<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Marcas - COMERSELEC S.A.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <?php $marcas = $marcas ?? []; ?>

    <div class="admin-layout">

        <?php require_once __DIR__ . '/_sidebar.php'; ?>
        <main class="admin-content">
            <div class="admin-header">
                <h1>Gestión de Marcas</h1>
                <a href="index.php?url=admin/marcas_crear" class="btn btn-primary">
                    NUEVA MARCA
                </a>
            </div>


            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>País de origen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($marcas as $m): ?>
                    <tr>
                        <td>
                            <?php echo $m['id_marca']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($m['nombre']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($m['descripcion']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($m['pais_origen']); ?>
                        </td>

                        <td>
                            <a href="index.php?url=admin/marcas_editar&id=<?php echo $m['id_marca']; ?>" 
                               class="btn btn-secondary">
                                Editar
                            </a>

                            <a href="index.php?url=admin/marcas_eliminar&id=<?php echo $m['id_marca']; ?>" 
                               class="btn btn-danger"
                               onclick="return confirm('¿Seguro que deseas eliminar esta marca?');">
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
