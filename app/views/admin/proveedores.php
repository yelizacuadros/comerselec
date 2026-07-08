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
        <aside class="admin-sidebar">
            <h2>
                COMERSELEC 
                <span style="font-size: 16px; color: var(--light-blue); font-weight: normal;">
                    Admin
                </span>
            </h2>
            <ul class="admin-nav" style="border-top: 3px solid var(--secondary-orange);">
                <br>
                <li><a href="index.php?url=admin/panel">Dashboard</a></li>
                <li><a href="index.php?url=admin/categorias">GestiÃ³n CategorÃ­as</a></li>
                <li><a href="index.php?url=admin/productos">GestiÃ³n Productos</a></li>
                <li><a href="index.php?url=admin/marcas">GestiÃ³n Marcas</a></li>
                <li>
                    <a href="index.php?url=admin/proveedores" 
                    style="background-color: rgba(255,255,255,0.1); color: white;">
                        GestiÃ³n Proveedores
                    </a>
                </li>
                <li><a href="index.php?url=admin/usuarios">Usuario</a></li>
                <li><a href="index.php?url=admin/inventario">Inventario</a></li>
                <li><a href="index.php?url=admin/panel">FacturaciÃ³n</a></li>
                <li><a href="index.php?url=admin/panel">Ventas</a></li>
                <li><a href="index.php?url=admin/mensajes">Mensajes</a></li>
                <li><a href="index.php?url=catalogo" target="_blank">Ver CatÃ¡logo PÃºblico</a></li>
                <li>
                    <a href="index.php?url=admin/salir" style="color: #e74c3c;">
                        Cerrar SesiÃ³n
                    </a>
                </li>
            </ul>
        </aside>
        <main class="admin-content">
            <div class="admin-header">
                <h1>GestiÃ³n de Proveedores</h1>
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
                        <th>TelÃ©fono</th>
                        <th>DirecciÃ³n</th>
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
                               onclick="return confirm('Â¿Seguro que deseas eliminar este proveedor?');">
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
